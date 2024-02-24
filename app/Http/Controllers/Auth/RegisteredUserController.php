<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use App\Models\Campuses;
use App\Models\Organizations;
use App\Models\Colleges;
use App\Models\Departments;
use App\Models\Offices;
use App\Models\Positions;
use App\Models\OrgRoles;
use App\Models\Academics;
use App\Models\Nonacademics;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */

    public function getCollegesByID(Request $request)
    {
        $campusID = $request->campusID;
        $data = Colleges::getColleges($campusID);
        return response($data);
    }

    public function getDepartmentsByID(Request $request)
    {
        $departmentID = $request->departmentID;
        $data = Departments::getDepartments($departmentID);
        return response($data);
    }

    public function getOfficesByID(Request $request)
    {
        $campusID = $request->campusID;
        $data = Offices::getOffices($campusID);
        return response($data);
    }

    public function getPositionsByID(Request $request)
    {
        $positionID = $request->positionID;
        $data = Positions::getPositions($positionID);
        return response($data);
    }

    public function create(Request $request): View
    {
        $roleData['roles'] = Roles::where('status', 'ACTIVE')
            ->whereNotIn('id', [1, 2])
            ->select('id', 'role')
            ->get();
        $campusData['campuses'] = Campuses::where('status', 1)->select('id', 'campus')->get();

        $organizationData['organizations'] = Organizations::where('status', 1)->select('id', 'orgName')->get();

        return view('auth.register', compact('roleData', 'campusData', 'organizationData'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $messages = [
                'fName.required' => 'This field is required.',
                'lName.required' => 'This field is required.',
                'fName.regex' => 'This field cannot be numeric.',
                'mName.regex' => 'This field cannot be numeric.',
                'lName.regex' => 'This field cannot be numeric.',
                'orgPosition.regex' => 'This field cannot be numeric.',
                'universityID.required' => 'This field is required.',
                'userType.required' => 'This field is required.',
                'campus.required' => 'This field is required.',
                'college.required' => 'This field is required.',
                'organization.required' => 'This field is required.',
                'orgPosition.required' => 'This field is required.',
                'cNumber.required' => 'This field is required.',
                'universityID.digits_between' => 'The University ID must should be 4-10 digits long.',
                'cNumber.digits' => 'The Contact number must be of exactly 11 digits long.',
                'universityID.unique' => 'The University ID has already been taken.',
                'email.required' => 'This field is required.',
                'email.email' => 'The Email must be a valid email address.',
                'email.unique' => 'The Email has already been taken.',
                'office.required' => 'This field is required.',
                'password.required' => 'This field is required.',
                'password.confirmed' => 'The Password confirmation does not match.',
            ];

            $selectedUser = Roles::find($request->userType);
            $selectedCampus = Campuses::find($request->campus);

            $request->validate([
                'fName' => ['required', 'max:255', 'regex:/^[A-Za-zñÑ\s]+$/'],
                'mName' => ['nullable', 'max:255', 'regex:/^[A-Za-zñÑ\s]+$/'],
                'lName' => ['required', 'max:255', 'regex:/^[A-Za-zñÑ\s]+$/'],
                'universityID' => ['required', 'digits_between:4,10', 'unique:' . User::class],
                'cNumber' => ['required', 'digits:11'],
                'userType' => ['required'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], $messages);

            if ($selectedUser->role == 'Student' || $selectedUser->role == 'Faculty') {
                $error = $request->validate([
                    'campus' => ['required'],
                    'college' => ['required'],
                    'department' => ['nullable'],
                ], $messages);
            }

            if ($selectedUser->role == 'Staff') {
                $error = $request->validate([
                    'campus' => ['required'],
                    'office' => ['required'],
                    'position' => ['nullable'],
                ], $messages);
            }

            if ($selectedUser->role == 'Student Leader') {
                $error = $request->validate([
                    'campus' => ['required'],
                    'college' => ['required'],
                    'department' => ['nullable'],
                    'organization' => ['required'],
                    'orgPosition' => ['required', 'max:255', 'regex:/^[A-Za-z\s]+$/']
                ], $messages);
            }

            $user = User::create([
                'fName' => $request->fName,
                'mName' => $request->mName,
                'lName' => $request->lName,
                'name' => $request->fName . ' ' . $request->mName . ' ' . $request->lName,
                'universityID' => $request->universityID,
                'campus' => $selectedCampus->campus,
                'cNumber' => $request->cNumber,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'ACTIVE',
                'created_by' => $request->fName . ' ' . $request->lName,
            ]);

            UserRoles::create([
                'userID' => $user->id,
                'roleID' => $request->userType,
                'created_by' => $request->fName . ' ' . $request->lName,
            ]);

            if ($selectedUser->role == 'Student' || $selectedUser->role == 'Faculty') {
                $selectedCollege = Colleges::find($request->college);
                $selectedDepartment = Departments::find($request->department);
                Academics::create([
                    'userID' => $user->id,
                    'college' => $selectedCollege->college,
                    'department' => optional($selectedDepartment)->department,
                ]);
            }

            if ($selectedUser->role == 'Staff') {
                $selectedOffice = Offices::find($request->office);
                $selectedPosition = Positions::find($request->position);
                Nonacademics::create([
                    'userID' => $user->id,
                    'office' => $selectedOffice->office,
                    'position' => optional($selectedPosition)->position,
                ]);
            }

            if ($selectedUser->role == 'Student Leader') {
                $selectedCollege = Colleges::find($request->college);
                $selectedDepartment = Departments::find($request->department);
                $selectedOrganization = Organizations::find($request->organization);
                Academics::create([
                    'userID' => $user->id,
                    'college' => $selectedCollege->college,
                    'department' => $selectedDepartment->department,
                ]);
                OrgRoles::create([
                    'userID' => $user->id,
                    'orgID' => $request->organization,
                    'orgName' => $selectedOrganization->orgName,
                    'orgPosition' => $request->orgPosition,
                    'created_by' => $request->fName . ' ' . $request->lName,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;

            return redirect('register')->with('error', 'An unexpected error occurred during registration. Please try again.');
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

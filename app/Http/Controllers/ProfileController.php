<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Campuses;
use App\Models\Colleges;
use App\Models\Departments;
use App\Models\Offices;
use App\Models\Organizations;
use App\Models\Positions;
use App\Models\Roles;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
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

    public function edit(Request $request): View
    {
        $user = $request->user();
        $roleData['roles'] = Roles::where('status', 'ACTIVE')
            ->whereNotIn('id', [1, 2])
            ->select('id', 'role')
            ->get();
        $campusData['campuses'] = Campuses::where('status', 1)->select('id', 'campus')->get();

        $organizationData['organizations'] = Organizations::where('status', 1)->select('id', 'orgName')->get();
        return view('profile.edit', compact('user', 'roleData', 'campusData', 'organizationData'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = $request->user();

        $academic = $user->academic;
        $nonacademic = $user->nonacademic;
        $userRole = $user->user_role->first()->roleID;

        $messages = [
            'orgPosition.regex' => 'This field cannot be numeric.',
            'campus.required' => 'This field is required.',
            'college.required' => 'This field is required.',
            'organization.required' => 'This field is required.',
            'orgPosition.required' => 'This field is required.',
            'office.required' => 'This field is required.',
            'cNumber.required' => 'This field is required.',
        ];

        $selectedUser = Roles::find($userRole);
        $selectedCampus = Campuses::find($request->campus);
        $selectedCollege = Colleges::find($request->college);
        $selectedDepartment = Departments::find($request->department);
        $selectedOffice = Offices::find($request->office);
        $selectedPosition = Positions::find($request->position);
        $selectedOrganization = Organizations::find($request->organization);


        if ($selectedUser->role == 'Student' || $selectedUser->role == 'Faculty' || $selectedUser->role == 'Student Leader') {
            $error = $request->validate([
                'campus' => ['required'],
                'college' => ['required'],
                'department' => ['nullable'],
            ], $messages);

            if ($selectedCampus !== null) {
                $user->update([
                    'campus' => $selectedCampus->campus,
                ]);
            } else {
                $user->update([
                    'campus' => $request->input('campus'),
                ]);
            }

            if ($selectedCollege !== null) {
                $academic->update([
                    'college' => $selectedCollege->college,
                ]);
            } else {
                $academic->update([
                    'college' => $request->input('college'),
                ]);
            }

            if ($selectedDepartment !== null) {
                $academic->update([
                    'department' => $selectedDepartment->department,
                ]);
            } else {
                $academic->update([
                    'department' => $request->input('department'),
                ]);
            }

            if ($selectedUser->role == 'Student Leader') {
                $error = $request->validate([
                    'organization' => ['required'],
                    'orgPosition' => ['required', 'max:255', 'regex:/^[A-Za-z\s]+$/']
                ], $messages);
                if ($selectedOrganization !== null) {
                    $academic->update([
                        'organization' => $selectedOrganization->orgName,
                        'orgPosition' => $selectedOrganization->orgPosition,
                    ]);
                } else {
                    $academic->update([
                        'organization' => $request->input('organization'),
                        'orgPosition' => $request->input('orgPosition'),
                    ]);
                }
            }
        }

        if ($selectedUser->role == 'Staff' || $selectedUser->role == 'Facility in charge' || $selectedUser->role == 'Admin') {
            $error = $request->validate([
                'campus' => ['required'],
                'office' => ['nullable'],
            ], $messages);
            if ($selectedOffice !== null) {
                $nonacademic->update([
                    'office' => $selectedOffice->office,
                ]);
            } else {
                $user->update([
                    'office' => $request->input('office'),
                ]);
            }

            if ($selectedPosition !== null) {
                $nonacademic->update([
                    'position' => $selectedPosition->position,
                ]);
            } else {
                $user->update([
                    'position' => $request->input('position'),
                ]);
            }
        }

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('public/images');
            $data["img_url"] = str_replace('public/', '', $imagePath);
            $user->update($data);
        }

        if ($request->hasFile('imgSvg')) {
            $imagePath = $request->file('imgSvg')->store('public/images');
            $data["img_url"] = str_replace('public/', '', $imagePath);
            $user->update($data);
        }

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

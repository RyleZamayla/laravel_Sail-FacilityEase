<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Buildings;
use App\Models\Campuses;
use App\Models\Colleges;
use App\Models\Departments;
use App\Models\Facility;
use App\Models\Offices;
use App\Models\Organizations;
use App\Models\Positions;
use App\Models\Roles;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class SettingsController extends Controller
{
    public function tableData(): View
    {
        $activeRoleData = Roles::select('id', 'role', 'status')->get();
        $activeOrganizationData = Organizations::where('status', 1)->select('id', 'orgName')->get();
        $activeCampusData = Campuses::where('status', 1)->select('id', 'campus', 'status')->get();

        $roleData = UserRoles::where('roleID', 2)->select('id', 'roleID', 'userID')->get();
        $organizationData = Organizations::select('id', 'orgName', 'moderator', 'status', 'campusID')->get();
        $campusData = Campuses::select('id', 'campus', 'status')->get();
        $userData = User::select('id', 'universityID', 'fName', 'mName', 'lName', 'cNumber', 'email', 'status', 'campus')->get();
        $buildingData = Buildings::select('id', 'buildingNumber', 'building', 'floor', 'status')->get();

        return view('admin.settings', compact('activeCampusData', 'campusData', 'userData', 'buildingData', 'roleData', 'activeRoleData', 'activeCampusData', 'activeOrganizationData', 'organizationData'));
    }

    public function toggleRoleStatus(Request $request, $roleId)
    {
        $role = Roles::find($roleId);

        if (!$role) {
            abort(404, 'Role not found');
        }

        $role->status = $role->status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
        $role->save();

        return redirect()->back()->with('role-toggle-status-success', 'Role status updated successfully');
    }

    public function toggleCampusStatus(Request $request, $campusId)
    {
        $campus = Campuses::find($campusId);

        if (!$campus) {
            abort(404, 'Campus not found');
        }

        $campus->status = $campus->status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
        $campus->save();

        return redirect()->back()->with('campus-toggle-status-success', 'Campus status updated successfully');
    }

    public function toggleBuildingStatus(Request $request, $buildingId)
    {
        $buildings = Buildings::find($buildingId);

        if (!$buildings) {
            abort(404, 'Building not found');
        }

        $buildings->status = $buildings->status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
        $buildings->save();

        $facilities = Facility::where('buildingID', $buildings->id)->get();
        $facilities->each->update([
            'status' => $buildings->status
        ]);

        return redirect()->back()->with('building-toggle-status-success', 'Building status updated successfully');
    }

    public function editBuildingData(Request $request, $buildingId)
    {
        $buildings = Buildings::find($buildingId);

        $buildings->update([
            'buildingNumber' => $request->buildingNumber,
            'building' => $request->building,
        ]);

        $buildings->save();

        return redirect()->back()->with('building-data-edit-success', 'Building data updated successfully');
    }

    public function toggleUserStatus(Request $request, $userId)
    {
        $users = User::find($userId);

        if (!$users) {
            abort(404, 'User not found');
        }

        $users->status = $users->status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
        $users->save();

        return redirect()->back()->with('user-status-toggle-success', 'User status updated successfully');
    }

    public function editUserData(ProfileUpdateRequest $request, $userId): RedirectResponse
    {
        $users = User::find($userId);
        $academic = $users->academic;
        $nonacademic = $users->nonacademic;
        $userRole = $users->user_role->first();

        $messages = [
            'orgPosition.regex' => 'This field cannot be numeric.',
            'campus.required' => 'This field is required.',
            'college.required' => 'This field is required.',
            'organization.required' => 'This field is required.',
            'orgPosition.required' => 'This field is required.',
            'office.required' => 'This field is required.',
        ];

        $selectedUser = Roles::find($request->userType);
        $selectedCampus = Campuses::find($request->campus);
        $selectedCollege = Colleges::find($request->college);
        $selectedDepartment = Departments::find($request->department);
        $selectedOffice = Offices::find($request->office);
        $selectedPosition = Positions::find($request->position);
        $selectedOrganization = Organizations::find($request->organization);

        if ($selectedUser->role == 'Student' || $selectedUser->role == 'Faculty' || $selectedUser->role == 'Student Leader') {
            $request->validate([
                'campus' => ['required'],
                'college' => ['required'],
                'department' => ['nullable'],
            ], $messages);

            if ($selectedCampus !== null) {
                $users->update([
                    'campus' => $selectedCampus->campus,
                ]);
            } else {
                $users->update([
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
                $request->validate([
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
            $request->validate([
                'campus' => ['required'],
                'office' => ['required'],
                'office' => ['nullable'],
            ], $messages);
            if ($selectedOffice !== null) {
                $nonacademic->update([
                    'office' => $selectedOffice->office,
                ]);
            } else {
                $users->update([
                    'office' => $request->input('office'),
                ]);
            }

            if ($selectedPosition !== null) {
                $nonacademic->update([
                    'position' => $selectedPosition->position,
                ]);
            } else {
                $users->update([
                    'position' => $request->input('position'),
                ]);
            }
        }

        $users->fill($request->validated());

        if ($users->isDirty('email')) {
            $users->email_verified_at = null;
        }

        UserRoles::find($userRole->id)->update([
            'roleID' => $request->userType
        ]);

        $users->save();

        return redirect()->back()->with('user-data-edit-success', 'User Information updated successfully');
    }

    public function toggleOrgStatus(Request $request, $orgId)
    {
        $org = Organizations::find($orgId);

        if (!$org) {
            abort(404, 'Organization not found');
        }

        $org->status = $org->status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
        $org->save();

        return redirect()->back()->with('user-organization-toggle-success', 'Organization status updated successfully');
    }

    public function editOrgData(Request $request, $orgId)
    {
        $org = Organizations::find($orgId);

        $org->update([
            'orgName' => $request->orgName,
            'moderator' => $request->moderator,
        ]);

        $org->save();

        return redirect()->back()->with('org-data-edit-success', 'Organization data updated successfully');
    }
}

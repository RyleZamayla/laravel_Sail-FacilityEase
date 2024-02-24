<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buildings;
use App\Models\BuildingFloors;
use App\Models\Facility;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Auth;


class FacilitiesController extends Controller
{
    public function facilities()
    {
        $user = Auth::user();

        $facilities = Facility::with('building', 'user_role', 'user')->get();
        $buildings = Buildings::where('status', 'ACTIVE')->select('id', 'buildingNumber', 'building')->get();
        $userFacilityInCharges = UserRoles::with('user')->where('roleID', 2)->select('id', 'userID', 'roleID')->get();

        if ($user->user_role->whereIn('roleID', 2)->count() > 0) {
            $facilities = $user->facilities()->with('building')->get();
        }
        elseif($user->user_role->whereIn('roleID', [3, 4, 5, 6])->count() > 0) {
            $facilities = Facility::with('building', 'user_role', 'user')->where('status', 'ACTIVE')->get();
            $buildings = Buildings::where('status', 'ACTIVE')->select('id', 'buildingNumber', 'building')->get();
            $userFacilityInCharges = UserRoles::with('user')->where('roleID', 2)->select('id', 'userID', 'roleID')->get();

            return view('admin.facilities', compact('facilities', 'buildings', 'userFacilityInCharges'));
        }



        return view('admin.facilities', compact('facilities', 'buildings', 'userFacilityInCharges'));
    }

    public function addFacility(Request $request)
    {
        // try {
            $request->validate([
                'buildingID' => 'required|exists:buildings,id',
                'buildingFloorID' => 'required|exists:building_floors,id',
                'userRoleID' => 'required|exists:user_roles,id',
                'facility' => 'required|string|max:255',
                'capacity' => 'required|integer',
                'noOfHours' => 'required|integer',
                'openTime' => 'required|date_format:H:i',
                'closeTime' => 'required|date_format:H:i',
                'maxDays' => 'required|integer',
                'maxHours' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $dataFacility = $request->all();
            // $imagePath = $request->file('image')->store('public/images');
            //dd($dataFacility);
            $dataFacility["created_by"] = \Auth::user()->fName . ' ' . \Auth::user()->lName;
            $dataFacility["status"] = "ACTIVE";
            // $dataFacility["img_url"] = str_replace('public/', '', $imagePath);


            Facility::create($dataFacility);

            return redirect()->route('facilities')->with('success', 'Facility added successfully');
        // } catch (\Exception $e) {
        //     \Log::error($e);

        //     return redirect()->route('facilities')->with('error', $e);
        // //     // return response()->json(['message' => 'An error occurred.', 'error' => $e->getMessage()], 500);
        // }
    }


    public function toggleFacilityStatus(Request $request, $facilityId)
    {
        $facility = Facility::find($facilityId);

        if (!$facility) {
            abort(404, 'Facility not found');
        }

        $facility->status = $facility->status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
        $facility->save();

        return redirect()->back()->with('success', 'Facility status updated successfully');
    }

    public function editFacilityData(Request $request, $facilityId)
    {
        $facilities = Facility::find($facilityId);

        $facilities->update([
            'facility'=> $request->input('facility'),
            'buildingID' => $request->input('buildingID'),
            'buildingFloorID' => $request->input('buildingFloorID'),
            'userRoleID' => $request->input('userRoleID'),
            'capacity' => $request->input('capacity'),
            'noOfHours'=> $request->input('noOfHours'),
            'openTime'=> $request->input('openTime'),
            'closeTime'=> $request->input('closeTime'),
            'maxDays'=> $request->input('maxDays'),
            'maxHours'=> $request->input('maxHours'),

        ]);


        $facilities->save();

        return redirect()->back()->with('success', 'Facility updated Successfully');
    }

    public function getBuildingByNumber(Request $request)
    {
        $buildingNumber = $request->buildingNumber;
        $data = Buildings::getBuildings($buildingNumber);
        return response($data);
    }

    public function getFloorsEachBuilding(Request $request)
    {
        $buildingID = $request->buildingID;
        $data = BuildingFloors::getFloors($buildingID);
        return response($data);
    }
}

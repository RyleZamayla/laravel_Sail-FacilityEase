<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function equipment()
    {
        $equipments = Equipment::with('facility')->get();
        $facilities = Facility::all();

        return view('admin.equipment',compact('equipments', 'facilities'));
    }

    public function addEquipment(Request $request)
    {
        try {
            $request->validate([
                'facilityID' => 'required|exists:facilities,id',
                'equipment' => 'required|string|max:255',
                'brand' => 'nullable|string|max:255',
                'model' => 'nullable|string|max:255',
                'quantity' => 'required|integer',
            ]);

            $dataEquipment = $request->all();
            $dataEquipment["created_by"] = \Auth::user()->fName . ' ' . \Auth::user()->lName;
            $dataEquipment["status"] = "SERVICEABLE";

            Equipment::create($dataEquipment);

            return redirect()->route('equipment')->with('equipment-success', 'Equipment added successfully');
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['message' => 'An error occurred.', 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleEquipmentStatus(Request $request, $equipmentId)
    {
        $equipment = Equipment::find($equipmentId);

        if (!$equipment) {
            abort(404, 'Equipment not found');
        }

        $equipment->status = $equipment->status === 'SERVICEABLE' ? 'NON-SERVICEABLE' ?? 'UNDER-REPAIR' : 'SERVICEABLE';
        $equipment->save();

        return redirect()->back()->with('equipment-toggle-success', 'Equipment status updated successfully');
    }

    public function editEquipmentData(Request $request, $equipmentId)
    {
        $equipments = Equipment::find($equipmentId);

        $equipments->update([
            'facilityID' => $request->input('facilityID'),
            'equipment' => $request->input('equipment'),
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'quantity' => $request->input('quantity'),
        ]);


        $equipments->save();

        return redirect()->back()->with('equipment-edit-success', 'Equipment updated successfully');
    }
}

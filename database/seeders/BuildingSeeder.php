<?php

namespace Database\Seeders;

use App\Models\BuildingFloors;
use App\Models\Buildings;
use App\Models\UserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('buildings')->truncate();
        DB::table('building_floors')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currentTimestamp = Carbon::now();

        $buildings = [
            ['campusID' => '2', 'buildingNumber' => '2', 'building' => 'ITB Building', 'floor' => '2', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '3', 'building' => '', 'floor' => '2', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '4', 'building' => 'Old Engineering and Architecture Building', 'floor' => '1', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '5', 'building' => 'Old Engineering and Architecture Building', 'floor' => '1', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '9', 'building' => 'ICT', 'floor' => '4', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '14', 'building' => 'Senior High School', 'floor' => '2', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '16', 'building' => 'DRER', 'floor' => '2', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '18', 'building' => 'Culinary Arts', 'floor' => '1', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '19', 'building' => '', 'floor' => '1', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '23', 'building' => 'LRC', 'floor' => '4', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '24', 'building' => 'Girls Trade', 'floor' => '1', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '25', 'building' => 'FIC', 'floor' => '1', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '28', 'building' => 'Old Science Building', 'floor' => '1', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '41', 'building' => '', 'floor' => '5', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '42', 'building' => 'Engineering Complex', 'floor' => '6', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => '43', 'building' => '', 'floor' => '8', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => 'TB', 'building' => 'Technology Building', 'floor' => '4', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'buildingNumber' => 'MS', 'building' => 'Fab Lab', 'floor' => '1', 'created_by' => 'ustp-facilityease.online', 'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        $floors = [];

        foreach ($buildings as $building) {
            $buildingData = [
                'campusID' => $building['campusID'],
                'buildingNumber' => $building['buildingNumber'],
                'building' => $building['building'],
                'floor' => $building['floor'],
                'created_by' => $building['created_by'],
                'status' => $building['status'],
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ];

            $buildingModel = Buildings::create($buildingData);

            // Seed floors based on the 'floor' field in the building data
            for ($i = 1; $i <= $building['floor']; $i++) {
                $floors[] = [
                    'buildingID' => $buildingModel->id,
                    'floorNumber' => $i,
                    'created_by' => "ustp-facilityease.online",
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp,
                ];
            }
        }

        BuildingFloors::insert($floors);
    }
}

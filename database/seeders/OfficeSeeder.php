<?php

namespace Database\Seeders;

use App\Models\Offices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('offices')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currentTimestamp = Carbon::now();

        $offices = [
            ['campusID' => '2', 'office' => 'President', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'office' => 'Vice Chancellor Student Affairs', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'office' => 'Vice Chancellor Finance and Administration', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'office' => 'Vice Chancellor Academic Affairs', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'office' => 'Vice Chancellor Research and Innovation', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'office' => 'Vice President for Administration and Legal Affairs', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'office' => 'Vice President for Finance, Planning and Development', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'office' => 'Vice President for Academic Affairs', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => '2', 'office' => 'Vice President for Research and Innovation', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        Offices::insert($offices);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Campuses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('campuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currentTimestamp = Carbon::now();

        $campus = [
            ['campus' => 'Alubijid','status' => 'INACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campus' => 'Cagayan de Oro', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campus' => 'Claveria', 'status' => 'INACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campus' => 'Balubal', 'status' => 'INACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campus' => 'Jasaan', 'status' => 'INACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campus' => 'Oroquieta', 'status' => 'INACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campus' => 'Panaon', 'status' => 'INACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campus' => 'Villanueva', 'status' => 'INACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        Campuses::insert($campus);
    }
}

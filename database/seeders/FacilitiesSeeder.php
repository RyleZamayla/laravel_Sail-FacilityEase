<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currentTimestamp = Carbon::now();

        $facilities = [
            ['buildingID'=> 5,'buildingFloorID'=>10,'userRoleID'=>1 , 'facility'=> 'ICT AVR','capacity'=> '300', 'noOfHours'=> '12', 'openTime'=> '07:00:00', 'closeTime'=> '17:00:00', 'maxDays' => '5', 'maxHours' => '5' ,'status'=> 'ACTIVE','img_url'=> null,'created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['buildingID'=> 15,'buildingFloorID'=>34,'userRoleID'=>1 , 'facility'=> 'PAT AVR','capacity'=> '350', 'noOfHours'=> '12','openTime'=> '07:00:00', 'closeTime'=> '17:00:00', 'maxDays' => '5', 'maxHours' => '5' ,'status'=> 'ACTIVE','img_url'=> null,'created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['buildingID'=> 1,'buildingFloorID'=>1,'userRoleID'=>1 , 'facility'=> 'ITB AVR','capacity'=> '350', 'noOfHours'=> '12','openTime'=> '07:00:00', 'closeTime'=> '17:00:00', 'maxDays' => '5', 'maxHours' => '5' ,'status'=> 'ACTIVE','img_url'=> null,'created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['buildingID'=> 10,'buildingFloorID'=>18,'userRoleID'=>1 , 'facility'=> 'Discussion Room - Graduate Library','capacity'=> '20', 'noOfHours'=> '12','openTime'=> '07:00:00','closeTime'=> '17:00:00', 'maxDays' => '1', 'maxHours' => '2' ,'status'=> 'ACTIVE','img_url'=> null,'created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['buildingID'=> 10,'buildingFloorID'=>19,'userRoleID'=>1 , 'facility'=> 'Discussion Room - Main Library','capacity'=> '20', 'noOfHours'=> '12', 'openTime'=> '07:00:00', 'closeTime'=> '17:00:00', 'maxDays' => '1', 'maxHours' => '2' ,'status'=> 'ACTIVE','img_url'=> null,'created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['buildingID'=> 12,'buildingFloorID'=>22,'userRoleID'=>1, 'facility'=> 'Cafeteria Function Hall','capacity'=> '50', 'noOfHours'=> '12','openTime'=> '07:00:00', 'closeTime'=> '17:00:00', 'maxDays' => '3', 'maxHours' => '5' ,'status'=> 'ACTIVE','img_url'=> null,'created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['buildingID'=> 7,'buildingFloorID'=>13,'userRoleID'=>1 , 'facility'=> 'DRER Gymnasium','capacity'=> '1000', 'noOfHours'=> '12','openTime'=> '07:00:00', 'closeTime'=> '17:00:00','maxDays' => '3', 'maxHours' => '5' ,'status'=> 'ACTIVE','img_url'=> null,'created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        Facility::insert($facilities);
    }
}

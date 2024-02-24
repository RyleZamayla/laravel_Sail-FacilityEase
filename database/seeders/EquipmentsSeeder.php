<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EquipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currentTimestamp = Carbon::now();

        $equipments = [
            ['facilityID'=> 1,'equipment'=>'LCD Projector','brand'=>'' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 1,'equipment'=>'Sound System Set','brand'=>'' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 2,'equipment'=>'LCD Projector','brand'=>'' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 2,'equipment'=>'Sound System Set','brand'=>'' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 3,'equipment'=>'LCD Projector','brand'=>'' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 3,'equipment'=>'Sound System Set','brand'=>'' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 4,'equipment'=>'Television','brand'=>'Sony' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 4,'equipment'=>'Remote','brand'=>'Sony' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 4,'equipment'=>'Extension Wire','brand'=>'Omni' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 5,'equipment'=>'Television','brand'=>'Sony' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 5,'equipment'=>'Remote','brand'=>'Sony' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 5,'equipment'=>'Extension Wire','brand'=>'Omni' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 6,'equipment'=>'Chairs','brand'=>'' , 'model'=> '','quantity'=> 50,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 7,'equipment'=>'LCD Projector','brand'=>'' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 7,'equipment'=>'Sound System','brand'=>'' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 7,'equipment'=>'Scoreboard','brand'=>'' , 'model'=> '','quantity'=> 1,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 7,'equipment'=>'Table','brand'=>'' , 'model'=> '','quantity'=> 10,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['facilityID'=> 7,'equipment'=>'Chairs','brand'=>'' , 'model'=> '','quantity'=> 1000,'status'=> 'SERVICEABLE','created_by'=> 'ustp-facilityease.online','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        Equipment::insert($equipments);
    }
}

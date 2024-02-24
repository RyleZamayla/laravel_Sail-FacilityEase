<?php

namespace Database\Seeders;

use App\Models\Colleges;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('colleges')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currentTimestamp = Carbon::now();

        $colleges = [
            ['campusID' => 2, 'college' => 'College of Technology', 'dean' => 'Ruvel J. Cuasito', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'college' => 'College of Engineering and Architecture', 'dean' => 'Lory Liza D. Bulay-Og', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'college' => 'College of Science and Mathematics', 'dean' => 'Maria Luisa B. Salingay', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'college' => 'College of Science and Technology Education', 'dean' => 'Grace S. Pimentel', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'college' => 'College of Information Technology and Computing', 'dean' => 'Love Jhoye M. Raboy', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'college' => 'Senior High School Department', 'dean' => 'Kristiane Pagurayan', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        Colleges::insert($colleges);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Departments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('departments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currentTimestamp = Carbon::now();

        $departments = [
            ['collegeID' => 1, 'department' => 'Bachelor of Science in Autotronics', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 1, 'department' => 'Bachelor of Science in Electro-Mechanical', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 1, 'department' => 'Bachelor of Science in Electronics Technology (ES)', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 1, 'department' => 'Bachelor of Science in Electronics Technology (MST)', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 1, 'department' => 'Bachelor of Science in Electronics Technology (TN)', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 1, 'department' => 'Bachelor of Science in Energy Systems and Management (EMCM)', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 1, 'department' => 'Bachelor of Science in Energy Systems and Management (PSDE)', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 1, 'department' => 'Bachelor of Science in Manufacturing Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 1, 'department' => 'Bachelor of Science in Technology Operations and Management', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 1, 'department' => 'MASTER in Industrial and Operations', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Bachelor of Science in Architecture', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Bachelor of Science in Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Bachelor of Science in Computer Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Bachelor of Science in Electrical Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Bachelor of Science in Electronics Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Bachelor of Science in Geodetic Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Bachelor of Science in Mechanical Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Bachelor of Science in Energy Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Diploma Programme in Energy Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Master of Science in Engineering Program', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Master of Science in Electrical Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Master of Science in Sustainable Development', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 2, 'department' => 'Professional Science Master in Power System Engineering and Management', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 3, 'department' => 'Bachelor of Science in Applied Mathematics', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 3, 'department' => 'Bachelor of Science in Chemistry', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 3, 'department' => 'Bachelor of Science in Chemistry', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 3, 'department' => 'Bachelor of Science in Applied Physics', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 3, 'department' => 'Bachelor of Science in Environmental Science', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 3, 'department' => 'Bachelor of Science in Food Technology', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 3, 'department' => 'Masters of Science in Applied Mathematical Sciences', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 3, 'department' => 'Doctor of Philosophy in Applied Mathematical Sciences', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 4, 'department' => 'Certificate of Teaching', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 4, 'department' => 'Diploma Programme in Mathematics Education', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 4, 'department' => 'Diploma Programme in Educational Planning and Administration', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 4, 'department' => 'Masters of Arts in Teaching English as Second Language', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 4, 'department' => 'Masters of Arts in Teaching Special Education', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 4, 'department' => 'Masters of Science in Education Planning and Administration', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 4, 'department' => 'Masters of Science in Mathematics Education', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 4, 'department' => 'Masters of Science in Technical and Technology Education', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 4, 'department' => 'Doctor of Philosophy in Science Education (Chemistry)', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 5, 'department' => 'Bachelor of Science in Computer Science', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 5, 'department' => 'Bachelor of Science in Data Science', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 5, 'department' => 'Bachelor of Science in Computer Engineering', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 5, 'department' => 'Bachelor of Science in Information Technology', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 5, 'department' => 'Masters of Science in Technology Communication Management', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['collegeID' => 5, 'department' => 'Masters of Science in Information Technology', 'chairman' => '', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        Departments::insert($departments);
    }
}

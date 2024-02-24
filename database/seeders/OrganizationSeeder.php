<?php

namespace Database\Seeders;

use App\Models\Organizations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('organizations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currentTimestamp = Carbon::now();

        $organizations = [
            ['campusID' => 2, 'orgName' =>  "Junior Philippine Society of Mechanical Engineers - USTP Chapter", 'moderator' => 'Reyvencer T. Reyes', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Leadership Empowerment and Development Society", 'moderator' => 'John David O. Moncada', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Google Developer Student Clubs - USTP", 'moderator' => 'Petal M. Dal', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  'Philippine Association of Food Technologists', 'moderator' => 'Victoria Guno De la Fabio Jr', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "USTP DOST-SEI Scholars' Guild", 'moderator' => 'Kennet Cuarteros', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "University City Scholars", 'moderator' => 'Mary Louise S. Pimentel', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Junior Philippine Institute of Civil Engineers - USTP CDO Chapter", 'moderator' => 'Prances Cloribel ', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Student Council of Science and Mathematics", 'moderator' => 'Mr. Barry B. Omongos', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Peer Group Society", 'moderator' => 'Ariel Tecson', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Junior Institute of Electronics Engineers of the Philippines-USTP CDO Chapter", 'moderator' => 'Ace Virgil Villaruz', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "University Student Government -CDO", 'moderator' => 'Maria Angeles D. Hinosolango', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "USTP Scholars Society", 'moderator' => 'Josephine Visande', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Institute of Integrated Electrical Engineers - Council of Students Chapters USTP", 'moderator' => 'John Rey Bajuyo', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "USTP- Chess Enthusiasts", 'moderator' => 'Abdul Halil S. Abdullah', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Guild of Junior Data Scientists", 'moderator' => 'Matthew Real Maulion', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Association of Geodetic Engineering Students", 'moderator' => 'Mark Dave Plaza', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Student Council of Engineering and Architecture", 'moderator' => 'Vera Karla Caingles', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Association of Research Innovation and Extension Services", 'moderator' => 'Sofia C. Naelga', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Society of Information Technology Enthusiasts", 'moderator' => 'Geraldine Blanco', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Student Council of Technology", 'moderator' => 'Dominic Cagadas', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "The Trailblazer Publication", 'moderator' => 'Ramir Philip Jones V. Sonsona', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Student Council of Information Technology and Computing", 'moderator' => 'Jc Vanny Mill A. Saledaien', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Institute of Computer Engineers of the Philippines Student Edition - USTP", 'moderator' => 'Rodesita S. Estenzo', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Solidarity of Autotronics Society", 'moderator' => 'Arnelo D. Naelga', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Society of Electronics and Communication Technology", 'moderator' => 'Dexter L. Duat', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "State University Mathematics Society", 'moderator' => 'Julie Catherine de los Santos', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "AL-RAID Muslim Student Organization - USTP CDO", 'moderator' => 'Denrazir M. Atara', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Senior High School Governing Council", 'moderator' => 'Kristiane B. Pagurayan', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "State University Technology Communication Management Society", 'moderator' => 'Jerwin S. Borres', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "USTP - Red Cross Youth", 'moderator' => 'Rhegie M. Caga-anan', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "United Architects of the Philippines Student Auxiliary - USTP", 'moderator' => 'William Harvey Evangelista', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Environmental Science Society", 'moderator' => 'Mae Oljae Canencia-Badilla', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Andam Higala-USTP", 'moderator' => 'Maria Teresa M. Fajardo', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Society of Manufacturing Engineering Technologist", 'moderator' => 'Celil May R. Ylagan', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['campusID' => 2, 'orgName' =>  "Chemistry Society", 'moderator' => 'Kristiane Lomonsod-Nagamora', 'status' => 'ACTIVE', 'created_by' => 'ustp-facilityease.online', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        Organizations::insert($organizations);

    }
}

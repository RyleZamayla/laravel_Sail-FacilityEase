<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRoles;
use App\Models\Academics;
use App\Models\Nonacademics;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('user_roles')->truncate();
        DB::table('academics')->truncate();
        DB::table('nonacademics')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currentTimestamp = Carbon::now();

        $users=[
            ['img_url' => null, 'email' => 'joshuaryle4107@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2020302820', 'name' => 'Joshua Ryle Zamayla Bracho','fname' =>'Joshua Ryle', 'mname' => 'Zamayla', 'lname' => 'Bracho', 'cNumber' => '09350917392', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('admin'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            ['img_url' => null, 'email' => 'iammaxine19@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2020304297', 'name' => 'Lady Maxine Yarra Sarsalijo','fname' =>'Lady Maxine', 'mname' => 'Yarra', 'lname' => 'Sarsalijo', 'cNumber' => '09354514513', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('facilityincharge'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'alexvgamer2@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2020304356', 'name' => 'Client John Binondo Subibi','fname' =>'Client John', 'mname' => 'Binondo', 'lname' => 'Subibi', 'cNumber' => '09358565678', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('staff'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'wawamhubmens.87000@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2020302821', 'name' => 'Richian Reib Banaag Suan','fname' =>'Richian Reib', 'mname' => 'Banaag', 'lname' => 'Suan', 'cNumber' => '09867564536', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('faculty'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'ralphronan5@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2020300926', 'name' => 'Ralph Ronan Dungo Descallar','fname' =>'Ralph Ronan', 'mname' => 'Dungo', 'lname' => 'Descallar', 'cNumber' => '09358560742', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('studentleader'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'giasumagang1908@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2020309859', 'name' => 'Gia Marie Sumagang','fname' =>'Gia', 'mname' => 'Marie', 'lname' => 'Sumagang', 'cNumber' => '09871236587', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('student'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'rockystephen.clavero@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => '3213953', 'name' => 'Rocky Stephen Quinol Clavero','fname' =>'Rocky Stephen', 'mname' => 'Quinol', 'lname' => 'Clavero', 'cNumber' => '09772561045', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('facilityincharge'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'arlene.baldelovar@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => null, 'name' => 'Arlene Baldelovar','fname' =>'Arlene', 'mname' => '', 'lname' => 'Baldelovar', 'cNumber' => null, 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'geraldine.blanco@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => null, 'name' => 'Geraldine A Blanco','fname' =>'Geraldine', 'mname' => 'A', 'lname' => 'Blanco', 'cNumber' => null, 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'petalmay.dal@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => null, 'name' => 'Petal May M Dal','fname' =>'Petal May', 'mname' => 'M', 'lname' => 'Dal', 'cNumber' => null, 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'jcvannymill.saledaien@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => null, 'name' => 'Jc Vanny Mill A Saledaien','fname' =>'Jc Vanny Mill', 'mname' => 'A', 'lname' => 'Saledaien', 'cNumber' => null, 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'charlane.vallar@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => null, 'name' => 'Charlane Vallar','fname' =>'Charlane', 'mname' => '', 'lname' => 'Vallar', 'cNumber' => null, 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'jomar.llevado@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => null, 'name' => 'Jomar C Llevado','fname' =>'Jomar', 'mname' => 'C', 'lname' => 'Llevado', 'cNumber' => null, 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['img_url' => null, 'email' => 'basseydaomar@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2020301908', 'name' => 'Bassey May Galvezo Daomar','fname' =>'Bassey Mae', 'mname' => 'Galvezo', 'lname' => 'Daomar', 'cNumber' => '09098762349', 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['img_url' => null, 'email' => 'tommyusaraga@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2020768578', 'name' => 'Tommy Ernest Usaraga','fname' =>'Tommy', 'mname' => 'Ernest', 'lname' => 'Usaraga', 'cNumber' => '09675987645', 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['img_url' => null, 'email' => 'hellolove@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2020897098', 'name' => 'Kathryn May Benardo','fname' =>'Kathryn', 'mname' => 'May', 'lname' => 'Bernardo', 'cNumber' => '09895609876', 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['img_url' => null, 'email' => 'itsmewah@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '2021546879', 'name' => 'Taylor Alison Swift','fname' =>'Taylor', 'mname' => 'Alison', 'lname' => 'Swift', 'cNumber' => '09890954876', 'campus' => 'Cagayan de Oro', 'password' => null,'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['img_url' => null, 'email' => 'earapearl.asentista@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => '2013100951', 'name' => 'Eara Pearl Perez Asentista','fname' =>'Eara Pearl', 'mname' => 'Perez', 'lname' => 'Asentista', 'cNumber' => '09051972533', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('admin'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['img_url' => null, 'email' => 'edelyn.balmeo@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => '3000319', 'name' => 'Edelyn Pabayo Balmeo','fname' =>'Edelyn', 'mname' => 'Pabayo', 'lname' => 'Balmeo', 'cNumber' => '09279991475', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('admin'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['img_url' => null, 'email' => 'charliecabilona@gmail.com', 'email_verified_at' => $currentTimestamp , 'universityID' => '3234601', 'name' => 'Charlie Caibigan Cabilona','fname' =>'Charlie', 'mname' => 'Caibigan', 'lname' => 'Cabilona', 'cNumber' => '09531884856', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('admin'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['img_url' => null, 'email' => 'rockystephen.clavero@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => '3213953', 'name' => 'Rocky Stephen Quinol Clavero','fname' =>'Rocky Stephen', 'mname' => 'Quinol', 'lname' => 'Clavero', 'cNumber' => '09772561045', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('admin'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['img_url' => null, 'email' => 'jeamarie.marba@ustp.edu.ph', 'email_verified_at' => $currentTimestamp , 'universityID' => '3182858', 'name' => 'Jeamarie A Marba','fname' =>'Jeamarie', 'mname' => 'A', 'lname' => 'Marba', 'cNumber' => '09751093851', 'campus' => 'Cagayan de Oro', 'password' => Hash::make('admin'),'status' => 'ACTIVE', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

        ];
        User::insert($users);

        $user_roles= [
            ['userID' => 1, 'roleID' => 1, 'created_by' => 'ustp-facilityease.online' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            ['userID' => 2, 'roleID' => 2, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 3, 'roleID' => 3, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 4, 'roleID' => 4, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 5, 'roleID' => 5, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 6, 'roleID' => 6, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 7, 'roleID' => 2, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['userID' => 8, 'roleID' => 4, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 9, 'roleID' => 4, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 10, 'roleID' => 4, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 11, 'roleID' => 4, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 12, 'roleID' => 4, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 13, 'roleID' => 4, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],


            // ['userID' => 7, 'roleID' => 6, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 8, 'roleID' => 6, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 9, 'roleID' => 3, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 10, 'roleID' => 3, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 11, 'roleID' => 2, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 12, 'roleID' => 2, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 13, 'roleID' => 2, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 14, 'roleID' => 2, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 15, 'roleID' => 2, 'created_by' => 'Administrator-Seeders' , 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

        ];

        UserRoles::insert($user_roles);

        // $academics = [
        //     ['userID' => 3, 'college' => 'College of Information Technology and Computing', 'department' => 'Bachelor of Science in Information Technology','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        //     ['userID' => 5, 'college' => 'College of Information Technology and Computing', 'department' => 'Bachelor of Science in Information Technology','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        //     ['userID' => 6, 'college' => 'College of Information Technology and Computing', 'department' => 'Bachelor of Science in Information Technology','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

        //     ['userID' => 8, 'college' => 'College of Information Technology and Computing', 'department' => 'Bachelor of Science in Information Technology','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        //     ['userID' => 9, 'college' => 'College of Information Technology and Computing', 'department' => 'Bachelor of Science in Information Technology','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        //     ['userID' => 10, 'college' => 'College of Information Technology and Computing', 'department' => 'Bachelor of Science in Information Technology','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        //     ['userID' => 11, 'college' => 'College of Information Technology and Computing', 'department' => 'Bachelor of Science in Information Technology','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        //     ['userID' => 12, 'college' => 'College of Information Technology and Computing', 'department' => 'Bachelor of Science in Information Technology','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        //     ['userID' => 13, 'college' => 'College of Information Technology and Computing', 'department' => 'Bachelor of Science in Information Technology','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        // ];

        // Academics::insert($academics);

        $nonacademics = [
            ['userID' => 1, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CITC','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['userID' => 2, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CITC','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 4, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CITC','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 7, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CITC','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

            // ['userID' => 6, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CITC','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 7, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CITC','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 8, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CITC','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 9, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CITC','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 10, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CITC','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 11, 'office' => 'Vice Chancellor Academic Affairs', 'position' => 'Office of the Dean CSTE','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 12, 'office' => 'Vice Chancellor Finance and Administration', 'position' => 'Enterprise Division','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 13, 'office' => 'Vice Chancellor Finance and Administration', 'position' => 'Auxiliary Management Services Division','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 14, 'office' => 'Vice Chancellor Student Affairs', 'position' => 'Library and Audio Visual Services','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            // ['userID' => 15, 'office' => 'Vice Chancellor Student Affairs', 'position' => 'Library and Audio Visual Services','created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

        ];

        Nonacademics::insert($nonacademics);

    }
}

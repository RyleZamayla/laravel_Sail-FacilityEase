<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CampusSeeder::class,
            CollegeSeeder::class,
            DepartmentSeeder::class,
            OfficeSeeder::class,
            PositionSeeder::class,
            OrganizationSeeder::class,
            BuildingSeeder::class,
            UsersSeeder::class,
            FacilitiesSeeder::class,
            EquipmentsSeeder::class,
            ReportsSeeder::class
        ]);
    }
}

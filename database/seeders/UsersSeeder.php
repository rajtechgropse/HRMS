<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();



        foreach (range(1, 10) as $index) {
            $userDepartment = $faker->numberBetween(0, 4); // Randomly assign user departments (0 to 4)
            $userDesignation = $faker->randomElement(["Sales", "Admin", "Manager", "Designer", "Developer", "QA Engineer", "Marketing"]); // Randomly assign user designations

            DB::table('users')->insert([
                'employee_Id' => $index, // Assuming employee IDs are sequential
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('12345'), // Hash a default password
                'userDepartment' => $userDepartment,
                'userDesignation' => $userDesignation,
                'role_id' => 'admin', // Assuming 'admin' is the role ID for admin users
                'status' => 1, // Assuming 1 represents active status
                'created_at' => now(), // Setting created_at timestamp
                'updated_at' => now(), // Setting updated_at timestamp
            ]);
        }
    }
}

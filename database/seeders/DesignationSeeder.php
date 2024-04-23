<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            ['name' => 'QA', 'department_id' => 1],
            ['name' => 'Software Engineer', 'department_id' => 1],
            ['name' => 'Senior Software Engineer', 'department_id' => 1],
            ['name' => 'Project Manager', 'department_id' => 1],
            // Add more designations as needed
        ];

        // Insert data into designations table
        DB::table('designations')->insert($designations);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Delivery'],
            ['name' => 'Marketing'],
            ['name' => 'Admin'],
            ['name' => 'HR'],
            ['name' => 'Business'],
            // Add more departments as needed
        ];
    }
}

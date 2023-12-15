<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = User::create([
            'name' => 'Employee',
            'email' => 'employee@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        $employee->assignRole('Employee');
    }
}

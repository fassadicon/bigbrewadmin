<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin1 = User::create([
            'name' => 'MJ Pava',
            'email' => 'mjpava@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        $admin1->assignRole('Admin');

        $admin2 = User::create([
            'name' => 'Arcenio Ambayec',
            'email' => 'arambayec@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        $admin2->assignRole('Admin');

        $admin3 = User::create([
            'name' => 'Admin',
            'email' => 'admin@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        $admin3->assignRole('Admin');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        User::create([
            'name' => 'super admin 2 (co owner)',
            'email' => 'coowner@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        User::create([
            'name' => 'Gary Bitong',
            'email' => 'gbitong@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
    }
}

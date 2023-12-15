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
        $superadmin1 = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        $superadmin1->assignRole('Super Admin');
    }
}

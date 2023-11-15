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
        $superadmin2 = User::create([
            'name' => 'super admin 2 (co owner)',
            'email' => 'coowner@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        $superadmin3 = User::create([
            'name' => 'Gary Bitong',
            'email' => 'gbitong@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        $superadmin1->assignRole('Super Admin');
        $superadmin2->assignRole('Super Admin');
        $superadmin3->assignRole('Super Admin');
    }
}

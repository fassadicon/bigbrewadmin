<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner= User::create([
            'name' => 'Gary Bitong',
            'email' => 'owner@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        $owner->assignRole('Owner');

        $owner2= User::create([
            'name' => 'MJ Pava',
            'email' => 'MJ@bigbrew.com',
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        $owner2->assignRole('Owner');
    }
}

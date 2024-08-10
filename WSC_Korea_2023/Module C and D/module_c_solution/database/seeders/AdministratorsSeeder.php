<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrators')->insert([
            [
                'username' => 'admin1',
                'password' => Hash::make('hellouniverse1!'),
                'created_at' => now()->subDays(5)->subHours(3),
                'updated_at' => now()->subDays(5)->subHours(3),
            ],
            [
                'username' => 'admin2',
                'password' => Hash::make('hellouniverse2!'),
                'created_at' => now()->subDays(5)->subHours(1)->subMinutes(27)->subSeconds(48),
                'updated_at' => now()->subDays(5)->subHours(1)->subMinutes(27)->subSeconds(48),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // expected users
        $users = [
            [
                'username' => 'player1',
                'password' => Hash::make('helloworld1!'),
                'created_at' => now()->subDays(2)->subHours(35)->subMinutes(12)->subSeconds(49),
                'updated_at' => now()->subDays(2)->subHours(35)->subMinutes(12)->subSeconds(49),
            ],
            [
                'username' => 'player2',
                'password' => Hash::make('helloworld2!'),
                'created_at' => now()->subDays(2)->subHours(34)->subMinutes(57)->subSeconds(21),
                'updated_at' => now()->subDays(2)->subHours(34)->subMinutes(57)->subSeconds(21),
            ],
            [
                'username' => 'dev1',
                'password' => Hash::make('hellobyte1!'),
                'created_at' => now()->subDays(2)->subHours(33)->subMinutes(33)->subSeconds(33),
                'updated_at' => now()->subDays(2)->subHours(33)->subMinutes(33)->subSeconds(33),
            ],
            [
                'username' => 'dev2',
                'password' => Hash::make('hellobyte2!'),
                'created_at' => now()->subDays(2)->subHours(32)->subMinutes(05)->subSeconds(05),
                'updated_at' => now()->subDays(2)->subHours(32)->subMinutes(05)->subSeconds(05),
            ],
        ];

        // additional users
        for ($i = 3; $i <= 30; $i++) {
            $users[] = [
                'username' => 'player'.$i,
                'password' => Hash::make('helloworld'.$i.'!'),
                'created_at' => now()->subDays(2)->subHours(33 - $i)->subMinutes($i * 2)->subSeconds($i),
                'updated_at' => now()->subDays(2)->subHours(33 - $i)->subMinutes($i * 2)->subSeconds($i),
            ];
        }

        DB::table('users')->insert($users);
    }
}

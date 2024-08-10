<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // expected games
        $dev1 = User::where('username', 'dev1')->firstOrFail();
        $dev2 = User::where('username', 'dev2')->firstOrFail();
        $games = [
            [
                'title' => 'Demo Game 1',
                'slug' => 'demo-game-1',
                'description' => 'This is demo game 1',
                'created_by' => $dev1->id,
                'created_at' => now()->subDays(1)->subHours(1)->subMinutes(23),
                'updated_at' => now()->subDays(1)->subHours(1)->subMinutes(23),
            ],
            [
                'title' => 'Demo Game 2',
                'slug' => 'demo-game-2',
                'description' => 'This is demo game 2',
                'created_by' => $dev2->id,
                'created_at' => now()->subDays(1)->subMinutes(05)->subSeconds(05),
                'updated_at' => now()->subDays(1)->subMinutes(05)->subSeconds(05),
            ],
        ];

        // additional games
        for ($i = 3; $i <= 30; $i++) {
            $games[] = [
                'title' => 'Demo Game '.$i,
                'slug' => 'demo-game-'.$i,
                'description' => 'This is demo game '.$i,
                'created_by' => $dev2->id,
                'created_at' => now()->subHours(24 - floor($i / 4))->subMinutes($i * 2 + 4)->subSeconds($i * 4),
                'updated_at' => now()->subHours(24 - floor($i / 4))->subMinutes($i * 2 + 4)->subSeconds($i * 4),
            ];
        }

        DB::table('games')->insert($games);
    }
}

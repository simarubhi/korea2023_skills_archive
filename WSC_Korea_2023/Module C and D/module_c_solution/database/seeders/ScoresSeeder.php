<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GameVersion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $player1 = User::where('username', 'player1')->firstOrFail()->id;
        $player2 = User::where('username', 'player2')->firstOrFail()->id;
        $dev1 = User::where('username', 'dev1')->firstOrFail()->id;
        $dev2 = User::where('username', 'dev2')->firstOrFail()->id;
        $game1 = Game::where('slug', 'demo-game-1')->firstOrFail()->id;
        $game2 = Game::where('slug', 'demo-game-2')->firstOrFail()->id;
        $game1v1 = GameVersion::where('game_id', $game1)->where('version', 'v1')->withTrashed()->firstOrFail()->id;
        $game1v2 = GameVersion::where('game_id', $game1)->where('version', 'v2')->firstOrFail()->id;
        $game2v1 = GameVersion::where('game_id', $game2)->where('version', 'v1')->firstOrFail()->id;

        // expected scores
        $scores = [
            [
                'user_id' => $player1,
                'game_version_id' => $game1v1,
                'score' => 10.0,
                'created_at' => now()->subDays(1)->subHours(1)->subMinutes(20),
                'updated_at' => now()->subDays(1)->subHours(1)->subMinutes(20),
            ],
            [
                'user_id' => $player1,
                'game_version_id' => $game1v1,
                'score' => 15.0,
                'created_at' => now()->subDays(1)->subHours(1)->subMinutes(19),
                'updated_at' => now()->subDays(1)->subHours(1)->subMinutes(19),
            ],
            [
                'user_id' => $player1,
                'game_version_id' => $game1v2,
                'score' => 12.0,
                'created_at' => now()->subDays(1)->subHours(1)->subMinutes(1)->subSeconds(14),
                'updated_at' => now()->subDays(1)->subHours(1)->subMinutes(1)->subSeconds(14),
            ],
            [
                'user_id' => $player2,
                'game_version_id' => $game1v2,
                'score' => 20.0,
                'created_at' => now()->subDays(1)->subHours(1)->subSeconds(2),
                'updated_at' => now()->subDays(1)->subHours(1)->subSeconds(2),
            ],
            [
                'user_id' => $player2,
                'game_version_id' => $game2v1,
                'score' => 30.0,
                'created_at' => now()->subDays(1)->subMinutes(02),
                'updated_at' => now()->subDays(1)->subMinutes(02),
            ],
            [
                'user_id' => $dev1,
                'game_version_id' => $game1v2,
                'score' => 1000.0,
                'created_at' => now()->subDays(1)->subMinutes(02),
                'updated_at' => now()->subDays(1)->subMinutes(02),
            ],
            [
                'user_id' => $dev1,
                'game_version_id' => $game1v2,
                'score' => -300.0,
                'created_at' => now()->subDays(1)->subMinutes(01),
                'updated_at' => now()->subDays(1)->subMinutes(01),
            ],
            [
                'user_id' => $dev2,
                'game_version_id' => $game1v2,
                'score' => 5.0,
                'created_at' => now()->subHours(23)->subMinutes(59),
                'updated_at' => now()->subHours(23)->subMinutes(59),
            ],
            [
                'user_id' => $dev2,
                'game_version_id' => $game2v1,
                'score' => 200.0,
                'created_at' => now()->subHours(23)->subMinutes(58),
                'updated_at' => now()->subHours(23)->subMinutes(58),
            ],
        ];

        // additional scores
        for ($i = 3; $i <= 30; $i++) {
            $user = User::where('username', 'player'.$i)->firstOrFail();

            for ($j = 3; $j <= 30; $j++) {
                $scores[] = [
                    'user_id' => $user->id,
                    'game_version_id' => $j + 1,
                    'score' => ($i % 3) * (30 - $j) + 5 * (30 - $i),
                    'created_at' => now()->subHours(24 - floor($j / 4))->subMinutes($j * 2 + 4)->subSeconds($j * 4)->addSeconds($i * 3),
                    'updated_at' => now()->subHours(24 - floor($j / 4))->subMinutes($j * 2 + 4)->subSeconds($j * 4)->addSeconds($i * 3),
                ];
            }
        }

        DB::table('scores')->insert($scores);
    }
}

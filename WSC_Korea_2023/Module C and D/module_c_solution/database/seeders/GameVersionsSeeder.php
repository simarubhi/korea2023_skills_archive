<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameVersionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $game1 = Game::where('slug', 'demo-game-1')->firstOrFail()->id;
        $game2 = Game::where('slug', 'demo-game-2')->firstOrFail()->id;

        // expected game versions
        $versions = [
            [
                'game_id' => $game1,
                'version' => 'v1',
                'storage_path' => 'games/'.$game1.'/v1/',
                'created_at' => now()->subDays(1)->subHours(1)->subMinutes(23),
                'updated_at' => now()->subDays(1)->subHours(1)->subMinutes(23),
                'deleted_at' => now()->subDays(1)->subHours(1)->subMinutes(10),
            ],
            [
                'game_id' => $game1,
                'version' => 'v2',
                'storage_path' => 'games/'.$game1.'/v2/',
                'created_at' => now()->subDays(1)->subHours(1)->subMinutes(10),
                'updated_at' => now()->subDays(1)->subHours(1)->subMinutes(10),
                'deleted_at' => null,
            ],
            [
                'game_id' => $game2,
                'version' => 'v1',
                'storage_path' => 'games/'.$game2.'/v1/',
                'created_at' => now()->subDays(1)->subMinutes(05)->subSeconds(05),
                'updated_at' => now()->subDays(1)->subMinutes(05)->subSeconds(05),
                'deleted_at' => null,
            ],
        ];

        // additional game versions
        for ($i = 3; $i <= 30; $i++) {
            $gameId = Game::where('slug', 'demo-game-'.$i)->firstOrFail()->id;
            $versions[] = [
                'game_id' => $gameId,
                'version' => 'v1',
                'storage_path' => 'games/'.$gameId.'/v1/',
                'created_at' => now()->subHours(24 - floor($i / 4))->subMinutes($i * 2 + 4)->subSeconds($i * 4),
                'updated_at' => now()->subHours(24 - floor($i / 4))->subMinutes($i * 2 + 4)->subSeconds($i * 4),
                'deleted_at' => null,
            ];
        }

        DB::table('game_versions')->insert($versions);
    }
}

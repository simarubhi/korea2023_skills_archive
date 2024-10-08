<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use App\Models\Game;
use App\Models\GameScore;
use App\Models\GameVersion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Admin::factory()->create([
            'username' => 'admin1',
            'password' => Hash::make('hellouniverse1!'),
        ]);
        Admin::factory()->create([
            'username' => 'admin2',
            'password' => Hash::make('hellouniverse2!'),
        ]);

        User::factory()->create([
            'username' => 'player1',
            'password' => Hash::make('helloworld1!'),
        ]);
        User::factory()->create([
            'username' => 'player2',
            'password' => Hash::make('helloworld2!'),
        ]);
        User::factory()->create([
            'username' => 'dev1',
            'password' => Hash::make('hellobyte1!'),
        ]);
        User::factory()->create([
            'username' => 'dev2',
            'password' => Hash::make('hellobyte2!'),
        ]);

        Game::factory()->create([
            'title' => 'Demo Game 1',
            'slug' => 'demo-game-1',
            'description' => 'This is demo game 1',
            'user_id' => 3,
        ]);    
        Game::factory()->create([
            'title' => 'Demo Game 2',
            'slug' => 'demo-game-2',
            'description' => 'This is demo game 2',
            'user_id' => 4,
        ]);

        GameVersion::factory()->create([
            'game_id' => 1,
            'game_path' => '/demo-game-1-v1',
            'deleted_at' => now(),
        ]);
        GameVersion::factory()->create([
            'game_id' => 1,
            'version_time' => now()->addSeconds(1),
            'game_path' => '/demo-game-1-v2'
        ]);
        GameVersion::factory()->create([
            'game_id' => 2,
            'version_time' => now()->addSeconds(2),
            'game_path' => '/demo-game-2-v1',
        ]);

        GameScore::factory()->create([
            'user_id' => 1,
            'game_version_id' => 1,
            'score' => 10.0,
        ]);
        GameScore::factory()->create([
            'user_id' => 1,
            'game_version_id' => 1,
            'score' => 15.0,
        ]);
        GameScore::factory()->create([
            'user_id' => 1,
            'game_version_id' => 2,
            'score' => 12.0,
        ]);
        GameScore::factory()->create([
            'user_id' => 2,
            'game_version_id' => 2,
            'score' => 20.0,
        ]);
        GameScore::factory()->create([
            'user_id' => 2,
            'game_version_id' => 3,
            'score' => 30.0,
        ]);
        GameScore::factory()->create([
            'user_id' => 3,
            'game_version_id' => 2,
            'score' => 1000.0,
        ]);
        GameScore::factory()->create([
            'user_id' => 3,
            'game_version_id' => 2,
            'score' => -300.0,
        ]);
        GameScore::factory()->create([
            'user_id' => 4,
            'game_version_id' => 2,
            'score' => 5.0,
        ]);
        GameScore::factory()->create([
            'user_id' => 4,
            'game_version_id' => 3,
            'score' => 200.0,
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use App\Models\Game;
use App\Models\Score;
use App\Models\Version;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'username' => 'admin1',
            'password' => Hash::make('hellouniverse1!'),
            'created' => now()
        ]);
        Admin::factory()->create([
            'username' => 'admin2',
            'password' => Hash::make('hellouniverse2!'),
            'created' => now()
        ]);

        User::factory()->create([
            'username' => 'player1',
            'password' => Hash::make('helloworld1!'),
            'created' => now()
        ]);
        User::factory()->create([
            'username' => 'player2',
            'password' => Hash::make('helloworld2!'),
            'created' => now()
        ]);
        User::factory()->create([
            'username' => 'dev1',
            'password' => Hash::make('hellobyte1!'),
            'created' => now()
        ]);
        User::factory()->create([
            'username' => 'dev2',
            'password' => Hash::make('hellobyte2!'),
            'created' => now()
        ]);

        Game::factory()->create([
            'title' => 'Demo Game 1',
            'slug' => 'demo-game-1',
            'description' => 'This is demo game 1',
            'user_id' => '3',
        ]);
        Game::factory()->create([
            'title' => 'Demo Game 2',
            'slug' => 'demo-game-2',
            'description' => 'This is demo game 2',
            'user_id' => '4',
        ]);

        Version::factory()->create([
            'game_id' => '1',
            'path' => '/games/demo-game-1-v1',
            'version_time' => now(),
        ]);
        Version::factory()->create([
            'game_id' => '1',
            'path' => '/games/demo-game-1-v2',
            'version_time' => now()->modify('+1 second'),
        ]);
        Version::factory()->create([
            'game_id' => '2',
            'path' => '/games/demo-game-2-v1',
            'version_time' => now()->modify('+2 second'),
        ]);

        Score::factory()->create([
            'user_id' => '1',
            'version_id' => '1',
            'score' => 10.0,
        ]);
        Score::factory()->create([
            'user_id' => '1',
            'version_id' => '1',
            'score' => 15.0,
        ]);
        Score::factory()->create([
            'user_id' => '1',
            'version_id' => '2',
            'score' => 12.0,
        ]);

        Score::factory()->create([
            'user_id' => '2',
            'version_id' => '2',
            'score' => 20.0,
        ]);
        Score::factory()->create([
            'user_id' => '2',
            'version_id' => '3',
            'score' => 30.0,
        ]);

        Score::factory()->create([
            'user_id' => '3',
            'version_id' => '2',
            'score' => 1000.0,
        ]);
        Score::factory()->create([
            'user_id' => '3',
            'version_id' => '2',
            'score' => -300.0,
        ]);

        Score::factory()->create([
            'user_id' => '4',
            'version_id' => '2',
            'score' => 5.0,
        ]);
        Score::factory()->create([
            'user_id' => '4',
            'version_id' => '3',
            'score' => 200.0,
        ]);
        
    }
}

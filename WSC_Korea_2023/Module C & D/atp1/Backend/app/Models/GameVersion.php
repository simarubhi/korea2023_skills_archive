<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Game;
use App\Models\GameScore;

class GameVersion extends Model
{
    use HasFactory;

    protected $gaurded = [];

    public $timestamps = false;

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function scores()
    {
        return $this->hasMany(GameScore::class, 'id');
    }
}

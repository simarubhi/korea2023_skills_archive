<?php

namespace App\Models;

use App\Models\Game;
use App\Models\Score;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Version extends Model
{
    use HasFactory;

    public $timestamps = false;


    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}

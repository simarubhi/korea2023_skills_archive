<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameVersion extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function scores()
    {
        return $this->hasMany(GameScore::class);
    }
}

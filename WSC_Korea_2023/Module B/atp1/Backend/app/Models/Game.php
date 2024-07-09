<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\GameVersion;

class Game extends Model
{
    use HasFactory;

    protected $gaurded = [];

    public function version()
    {
        return $this->hasOne(GameVersion::class, 'game_version_id');
    }
}

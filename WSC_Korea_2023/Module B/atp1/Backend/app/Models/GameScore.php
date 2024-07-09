<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\GameVersion;

class GameScore extends Model
{
    use HasFactory;

    protected $gaurded = [];

    public function version()
    {
        return $this->belongsTo(GameVersion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

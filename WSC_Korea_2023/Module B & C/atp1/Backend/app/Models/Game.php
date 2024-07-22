<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\GameVersion;

class Game extends Model
{
    use HasFactory;

    protected $gaurded = [];

    public function versions()
    {
        return $this->hasMany(GameVersion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

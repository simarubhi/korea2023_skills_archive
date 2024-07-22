<?php

namespace App\Models;

use App\Models\User;
use App\Models\Version;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function versions()
    {
        return $this->hasMany(Version::class);
    }
}

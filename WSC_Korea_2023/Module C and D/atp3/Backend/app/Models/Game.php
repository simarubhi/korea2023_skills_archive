<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function versions()
    {
        return $this->hasMany(GameVersion::class)->withTrashed()->orderBy('version_time', 'desc');
    }

    public function latest_version()
    {
        return $this->hasOne(GameVersion::class)->whereNull('deleted_at');
    }

    public function thumbnail()
    {
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['thumbnail', 'uploadTimestamp', 'author', 'scoreCount', 'gamePath'];
    protected $dates = ['uploadTimestamp'];

    public function getThumbnailAttribute()
    {
        if ($this->latestVersion && $this->latestVersion->hasThumbnail()) {
            return $this->getGamePathAttribute().'thumbnail.png';
        }

        return null;
    }

    public function getUploadTimestampAttribute()
    {
        if ($this->latestVersion) {
            return $this->latestVersion->created_at;
        }

        return $this->created_at;
    }

    public function getAuthorAttribute()
    {
        return $this->gameAuthor->username;
    }

    public function getScoreCountAttribute()
    {
        $score = Score::select(DB::raw('COUNT(DISTINCT user_id) as scoreCount'))
            ->leftJoin('game_versions', 'game_versions.id', 'scores.game_version_id')
            ->where('game_versions.game_id', $this->id)
            ->first();

        return $score->scoreCount ?? 0;
    }

    public function getGamePathAttribute()
    {
        if ($this->latestVersion) {
            return '/games/'.$this->slug.'/'.$this->latestVersion->version.'/';
        }

        return null;
    }

    public function gameAuthor()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function latestVersion()
    {
        return $this->hasOne(GameVersion::class)->whereNull('deleted_at');
    }

    public function versions()
    {
        return $this->hasMany(GameVersion::class)->withTrashed();
    }
}

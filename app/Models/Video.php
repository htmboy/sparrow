<?php

namespace App\Models;

use App\Admin\Actions\Video\Poster;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'sparrow_videos';

    protected $fillable = [
        'name', 'country_id', 'starring', 'director', 'introduction', 'issued_at', 'kind',
        'cover', 'is_show', 'sort', 'types'
    ];

    protected $attributes = ['is_show' => 1];

    public function country() {
        return $this->belongsTo(VideoCountry::class);
    }

    public function types(){
        return $this->belongsToMany(VideoType::class, 'sparrow_video_with_type', 'video_id', 'type_id');
    }

    public function discuss()
    {
        return $this->hasMany(Video::class);
    }

    public function posters()
    {
        return $this->hasMany(VideoPoster::class);
    }

    public function sources()
    {
        return $this->hasMany(VideoSource::class);
    }

    const KIND_MOVIE = 1;
    const KIND_DRAMA = 2;

    public static $kindsMap = [
        self::KIND_MOVIE => '电影',
        self::KIND_DRAMA => '电视剧'
    ];
}

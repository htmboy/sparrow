<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class VideoWithType extends Pivot
{
    protected $table = 'sparrow_video_with_type';

    protected $fillable = [
        'video_id', 'type_id'
    ];

    public $timestamps = false;

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function types()
    {
        return $this->hasMany(VideoType::class);
    }
}

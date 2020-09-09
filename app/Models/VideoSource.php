<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoSource extends Model
{
    protected $table = 'sparrow_video_sources';

    protected $fillable = [
        'video_id', 'title', 'link', 'clicks', 'is_show', 'sort'
    ];

    public $timestamps = false;

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}

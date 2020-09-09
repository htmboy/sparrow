<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoDiscuss extends ContentStatus
{
    protected $table = 'sparrow_video_discusses';

    protected $fillable = [
        'video_id', 'ip', 'content', 'created_at', 'status'
    ];

    public $timestamps = false;

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoPoster extends Model
{
    protected $table = 'sparrow_video_posters';

    protected $fillable = [
        'video_id', 'title', 'source', 'alt', 'is_show', 'sort'
    ];

    public $timestamps = false;

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

}

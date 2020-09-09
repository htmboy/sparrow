<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoType extends Model
{
    protected $table = 'sparrow_video_types';

    protected $fillable = [
        'name', 'sort'
    ];

    public $timestamps = false;

    public function video()
    {
        return $this->belongsToMany(Video::class, 'sparrow_video_with_type', 'type_id', 'video_id');
    }
}

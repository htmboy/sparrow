<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoCountry extends Model
{
    protected $table = 'sparrow_video_countries';

    protected $fillable = [
        'name', 'sort'
    ];

    public $timestamps = false;

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

}

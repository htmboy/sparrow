<?php
/**
 * Created by PhpStorm.
 * User: htmboy
 * Date: 20-9-4
 * Time: 下午9:54
 */

namespace App\Services;


use App\Models\VideoPoster;

class VideoPosterService
{
    public function getCountByVideoId($video_id)
    {
        return VideoPoster::where('video_id', $video_id)->count();
    }
}
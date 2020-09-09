<?php
/**
 * Created by PhpStorm.
 * User: htmboy
 * Date: 20-9-9
 * Time: 下午9:35
 */

namespace App\Services;


use App\Models\VideoSource;

class VideoSourceService
{
    public function getCountByVideoId($video_id)
    {
        return VideoSource::where('video_id', $video_id)->count();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: htmboy
 * Date: 20-9-3
 * Time: 下午7:59
 */

namespace App\Services;


use App\Models\VideoType;

class VideoTypeService
{
    public function getTypes(){
        return VideoType::all()->pluck('name', 'id');
    }
}
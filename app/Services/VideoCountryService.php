<?php
/**
 * Created by PhpStorm.
 * User: htmboy
 * Date: 20-9-3
 * Time: 下午7:49
 */

namespace App\Services;


use App\Models\VideoCountry;

class VideoCountryService
{

    public function getCountries($id = null){
        $countries = VideoCountry::all()->pluck('name', 'id');
        return $id ? $countries[$id] : $countries;
    }
}
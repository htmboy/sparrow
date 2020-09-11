<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use App\Services\PositionService;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

    public function index($position)
    {

        return view('index.index');
    }

    public function region()
    {
        return view('root.root');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class RootController extends Controller
{
    public function index()
    {

        if(session('place_id'))
            return redirect()->route('index', [idToSlugs(session('place_id'))]);
        return $this->region(new Position());
    }

    public function region(Position $position)
    {
        $provinces = $position->where('parent_id', 0)->get();
        $towns = $position->where('is_town', 1)->get();
        return view('root.index', compact('provinces', 'towns'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Services\PositionService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct(Request $request, PositionService $positionService)
    {
        $this->middleware('position');
    }
}

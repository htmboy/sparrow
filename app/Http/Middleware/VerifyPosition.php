<?php

namespace App\Http\Middleware;

use App\Services\PositionService;
use Closure;

class VerifyPosition
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $position = $request->position;
        if(!$position){
            return $this->toRoot($request);
        }

        $id = (new PositionService)->slugToId($position);
        if(!$id){
            return $this->toRoot($request);
        }
        $request->session()->put('place', $position);
        $request->session()->put('place_id', $id);
        return $next($request);
    }

    private function toRoot($request)
    {
        $request->session()->forget('place');
        return redirect()->route('root');
    }
}

<?php
namespace App\Http\View;

use App\Models\Theme;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        $themes = Theme::where('parent_id', 0)->get();
//        dd($themes);
        $view->with(compact('themes'));
    }
}
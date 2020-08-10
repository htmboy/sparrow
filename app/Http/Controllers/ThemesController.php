<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemesController extends Controller
{
    public function show(Theme $theme)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $messages = Message::where('id', $theme->id)->paginate(20);
        // 传参变量话题和分类到模板中
        return view('messages.index', compact('messages', 'themes'));
    }
}

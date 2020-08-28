<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Position;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemesController extends BaseController
{
    public function show($position, Theme $theme, Request $request, Message $message)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
//        dd($request->session()->get('place_id'));
        $messages = $message->withOrder($request->order)
            ->where([['theme_id', $theme->id], ['position_id', $request->session()->get('place_id')]])
            ->with('user', 'theme')   // 预加载防止 N+1 问题
            ->paginate(20);
        // 传参变量话题和分类到模板中
        return view('messages.index', compact('messages', 'themes'));
    }
}

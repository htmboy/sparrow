<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;

class RepliesController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function store(ReplyRequest $request, Reply $reply)
	{
        $reply->content = $request->get('content');
        $reply->user_id = \Auth::id();
        $reply->message_id = $request->message_id;
        $reply->save();
		return redirect()->to($reply->message->link())->with('success', '评论创建成功！');
	}

	public function destroy(Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$reply->delete();

		return redirect()->to($reply->message->link())->with('success', '评论删除成功！');
	}
}
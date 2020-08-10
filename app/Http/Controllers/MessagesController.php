<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Message $message)
    {
        $messages = $message->withOrder($request->order)
            ->with('user', 'theme')  // 预加载防止 N+1 问题
            ->paginate(20);
        return view('messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

	public function create(Message $message)
	{
        $themes = Theme::all();
		return view('messages.create_and_edit', compact('message', 'themes'));
	}

	public function store(MessageRequest $request, Message $message)
	{
		$message->fill($request->all());
		$message->user_id = Auth::id();
		$message->save();
		return redirect()->route('messages.show', $message->id)->with('success', '帖子创建成功！');
	}

	public function edit(Message $message)
	{
        $this->authorize('update', $message);
		return view('messages.create_and_edit', compact('message'));
	}

	public function update(MessageRequest $request, Message $message)
	{
		$this->authorize('update', $message);
		$message->update($request->all());

		return redirect()->route('messages.show', $message->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Message $message)
	{
		$this->authorize('destroy', $message);
		$message->delete();

		return redirect()->route('messages.index')->with('message', 'Deleted successfully.');
	}
}
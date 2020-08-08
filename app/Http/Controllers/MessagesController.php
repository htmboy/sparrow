<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$messages = Message::paginate();
		return view('messages.index', compact('messages'));
	}

    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

	public function create(Message $message)
	{
		return view('messages.create_and_edit', compact('message'));
	}

	public function store(MessageRequest $request)
	{
		$message = Message::create($request->all());
		return redirect()->route('messages.show', $message->id)->with('message', 'Created successfully.');
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
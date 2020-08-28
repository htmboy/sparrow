<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Message;
use App\Models\Position;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;

class MessagesController extends BaseController
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

    public function show($position, Message $message)
    {
        // URL 矫正
//        if ( ! empty($message->slug) && $message->slug != $message->slug) {
//            return redirect($message->link(), 301);
//        }
//        dd($message->position);
        return view('messages.show', compact('message'));
    }

	public function create(Message $message)
	{
        $themes = Theme::all();
        $positions = Position::where('is_town', 1)->orderByDesc('path')->get();
        $sort = Message::count();
		return view('messages.create_and_edit', compact('message', 'themes', 'positions', 'sort'));
	}

	public function store(MessageRequest $request, Message $message)
	{
		$message->fill($request->all());
		$message->user_id = Auth::id();
		$message->save();
		return redirect()->to($message->link())->with('success', '帖子创建成功！');
	}

	public function edit(Message $message)
	{
        $this->authorize('update', $message);
        $themes = Theme::all();
        $positions = Position::all();
		return view('messages.create_and_edit', compact('message', 'themes', 'positions'));
	}

	public function update(MessageRequest $request, Message $message)
	{
		$this->authorize('update', $message);
		$message->update($request->all());

		return redirect()->to($message->link())->with('success', '更新成功！');
	}

	public function destroy(Message $message)
	{
		$this->authorize('destroy', $message);
		$message->delete();

		return redirect()->route('messages.index')->with('success', '成功删除！');
	}

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($file, 'topics', Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }


}
<?php

namespace App\Observers;

use App\Models\Message;
use App\Models\Reply;
use App\Notifications\MessageReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function created(Reply $reply)
    {
        $reply->message->reply_count = $reply->message->replies->count();
        $reply->message->save();
        // 通知话题作者有新的评论
        $reply->message->user->notify(new MessageReplied($reply));
    }

    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_message_body');
    }

    public function deleted(Reply $reply)
    {
        $reply->message->updateReplyCount();
    }

    public function saving(Reply $reply)
    {
//        $reply->created_at = now();
    }
}
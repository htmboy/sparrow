<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Message;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class MessageObserver
{
    public function creating(Message $message)
    {
        //
    }

    public function updating(Message $message)
    {
        //
    }

    public function saving(Message $message)
    {
        // XSS 过滤
        $message->content = clean($message->content, 'user_message_body');

        // 生成话题摘录
        $message->excerpt = make_excerpt($message->body);

    }

    public function saved(Message $message)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $message->slug) {

            // 推送任务到队列
            dispatch(new TranslateSlug($message));
        }
    }
}
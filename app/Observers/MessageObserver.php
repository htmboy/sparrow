<?php

namespace App\Observers;

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
        $message->content = clean($message->content, 'user_message_body');

        $topic->excerpt = make_excerpt($topic->body);
    }
}
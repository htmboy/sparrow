<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Message;

class MessagePolicy extends Policy
{
    public function update(User $user, Message $message)
    {
        // return $message->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Message $message)
    {
        return true;
    }
}

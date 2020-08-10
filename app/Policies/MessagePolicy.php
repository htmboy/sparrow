<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Message;

class MessagePolicy extends Policy
{
    public function update(User $user, Message $message)
    {
        return $user->isAuthorOf($message);
    }

    public function destroy(User $user, Message $message)
    {
        return $user->isAuthorOf($message);
    }
}

<?php

namespace App\Models;

class Reply extends Information
{
    protected $table = 'sparrow_replies';
    protected $fillable = [
        'message_id', 'user_id', 'content', 'created_at', 'status'
    ];

}

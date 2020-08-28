<?php

namespace App\Models;

class Reply extends ContentStatus
{
    protected $table = 'sparrow_replies';
    protected $fillable = [
        'message_id', 'user_id', 'content', 'created_at', 'status'
    ];

    public $timestamps = false;

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

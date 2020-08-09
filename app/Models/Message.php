<?php

namespace App\Models;

class Message extends Information
{
    protected $table = 'sparrow_messages';
    protected $fillable = [
        'position_id', 'user_id', 'title', 'content', 'sort',
        'seo_title', 'seo_keywords', 'seo_description', 'status'
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}

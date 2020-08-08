<?php

namespace App\Models;

class Message extends Model
{
    protected $fillable = ['position_id', 'user_id', 'title', 'content', 'sort', 'seo_title', 'seo_keywords', 'seo_description', 'status'];
}

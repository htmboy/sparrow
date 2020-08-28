<?php

namespace App\Models;

use App\Services\PositionService;

class Message extends ContentStatus
{
    protected $table = 'sparrow_messages';
    protected $fillable = [
        'position_id', 'user_id', 'title', 'content', 'sort', 'theme_id', 'position_id',
        'seo_title', 'seo_keywords', 'seo_description', 'status', 'reply_count'
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

    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query->recentReplied();
                break;

            default:
                $query->recent();
                break;
        }
    }

    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function link($params = [])
    {
        return route('messages.show', array_merge([(new PositionService)->idToSlugs($this->position_id), $this->id], $params));
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function updateReplyCount()
    {
        $this->reply_count = $this->replies->count();
        $this->save();
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable, MustVerifyEmailTrait;

    use Notifiable {
        notify as protected laravelNotify;
    }

    protected $table = 'sparrow_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sex', 'birth', 'avatar', 'introduction', 'username', 'email', 'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    const STATUS_UNREVIEWED = 0;
    const STATUS_NORMAL = 1;
    const STATUS_VIOLATION = 2;
    const STATUS_SUSPICIOUS = 7;
    const STATUS_FREEZE = 8;
    const STATUS_DESTROY = 9;

    public static $statusMap = [
        self::STATUS_UNREVIEWED => '未审核',
        self::STATUS_NORMAL => '正常',
        self::STATUS_VIOLATION => '违规',
        self::STATUS_SUSPICIOUS => '异常',
        self::STATUS_FREEZE => '冻结',
        self::STATUS_DESTROY => '销户'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }

        // 只有数据库类型通知才需提醒，直接发送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}

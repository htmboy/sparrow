<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;


class User extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable, MustVerifyEmailTrait;

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

    const UNREVIEWED = 0;
    const NORMAL = 1;
    const VIOLATION = 2;
    const SUSPICIOUS = 7;
    const FREEZE = 8;
    const DESTROY = 9;

    public static $statusMap = [
        self::UNREVIEWED => '未审核',
        self::NORMAL => '正常',
        self::VIOLATION => '违规',
        self::SUSPICIOUS => '异常',
        self::FREEZE => '冻结',
        self::DESTROY => '销户'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: htmboy
 * Date: 20-8-8
 * Time: 下午11:51
 */

namespace App\Models;



Abstract Class ContentStatus extends Model
{
    const STATUS_UNREVIEWED = 0;
    const STATUS_PASS = 1;
    const STATUS_VIOLATION = 2;
    CONST STATUS_EXPIRED = 3;
    CONST STATUS_DELETED = 4;

    public static $statusMap = [
        self::STATUS_UNREVIEWED => '未审核',
        self::STATUS_PASS => '通过审核',
        self::STATUS_VIOLATION => '内容违反规定',
        self::STATUS_EXPIRED => '已过期',
        self::STATUS_DELETED => '已删除'
    ];

    protected $attributes = [
        'status' => 0,
    ];
}
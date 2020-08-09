<?php
/**
 * Created by PhpStorm.
 * User: htmboy
 * Date: 20-8-8
 * Time: 下午11:51
 */

namespace App\Models;



Abstract Class Information extends Model
{
    const UNREVIEWED = 0;
    const PASS = 1;
    const VIOLATION = 2;
    CONST EXPIRED = 3;
    CONST DELETED = 4;

    public static $statusMap = [
        self::UNREVIEWED => '未审核',
        self::PASS => '通过审核',
        self::VIOLATION => '内容违反规定',
        self::EXPIRED => '已过期',
        self::DELETED => '已删除'
    ];
}
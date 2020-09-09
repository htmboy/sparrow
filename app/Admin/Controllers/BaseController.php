<?php
/**
 * Created by PhpStorm.
 * User: htmboy
 * Date: 20-9-9
 * Time: 下午7:49
 */

namespace App\Admin\Controllers;


use Encore\Admin\Controllers\AdminController;

class BaseController extends AdminController
{
    protected $is_show = [
        'on' => ['value' => 1, 'text' => '显示'],
        'off' => ['value' => 0, 'text' => '不显示'],
    ];
}
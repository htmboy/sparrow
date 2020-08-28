<?php
/**
 * Created by PhpStorm.
 * User: htmboy
 * Date: 20-8-13
 * Time: 下午11:55
 */

namespace App\Providers;

use App\Http\View\HeaderComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ViewServiceProvider extends ServiceProvider
{

    /**
     * 注册任何应用服务
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * 引导任何应用程序服务
     *
     * @return void
     */
    public function boot()
    {
        // 使用基于合成器的类...
        View::composer(
            'layouts._header', HeaderComposer::class
        );

    }

}
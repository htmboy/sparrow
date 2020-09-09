<?php

namespace App\Admin\Controllers;

use App\Models\VideoDiscuss;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VideoDiscussController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '电影评论';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VideoDiscuss());



        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(VideoDiscuss::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VideoDiscuss());



        return $form;
    }
}

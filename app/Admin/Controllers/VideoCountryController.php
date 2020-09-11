<?php

namespace App\Admin\Controllers;

use App\Models\VideoCountry;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VideoCountryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '影片国家';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VideoCountry());
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->model()->orderByDesc('sort');
        $grid->column('name', '国家');
        $grid->column('sort', '排名')->editable();
        $grid->actions(function ($actions) {

            // 去掉查看
            $actions->disableView();
        });
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
        $show = new Show(VideoCountry::findOrFail($id));

        $show->field('name', '国家');
        $show->field('sort', '排序');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VideoCountry());

        $form->text('name', '国家');
        $form->number('sort', '排序')->min(0)->default(VideoCountry::count() + 1);

        return $form;
    }
}

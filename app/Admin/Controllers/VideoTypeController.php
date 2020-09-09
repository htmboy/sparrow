<?php

namespace App\Admin\Controllers;

use App\Models\VideoType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VideoTypeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'VideoType';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VideoType());
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableRowSelector();


        $grid->model()->orderByDesc('sort');
        $grid->column('name', '类型');
        $grid->column('sort', '排序')->editable();

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
        $show = new Show(VideoType::findOrFail($id));

        $show->field('name', '类型');
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
        $form = new Form(new VideoType());

        $form->text('name', '类型');
        $form->number('sort', '排序')->min(0)->default(VideoType::count() + 1);


        return $form;
    }
}

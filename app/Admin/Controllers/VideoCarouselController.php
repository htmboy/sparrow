<?php

namespace App\Admin\Controllers;

use App\Models\VideoCarousel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VideoCarouselController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'VideoCarousel';

    protected $is_show = [
        'on' => ['value' => 1, 'text' => '显示'],
        'off' => ['value' => 0, 'text' => '不显示'],
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VideoCarousel());
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->model()->orderByDesc('sort');
        $grid->column('summary', '描述');
        $grid->column('source', '轮播图')->image('', 200);
        $grid->column('link', '链接')->link(function($link){
            return $link;
        });
        $grid->column('alt', '图片描述');
        $grid->column('title', '图片标题');
        $grid->column('is_show', '是否上线')->switch($this->is_show);
        $grid->column('sort', '排序')->editable();
        $grid->column('created_at', '创建日期');

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
        $show = new Show(VideoCarousel::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VideoCarousel());

        $form->text('summary', '描述')->required();
        $form->text('title', '图片标题')->required();
        $form->text('alt', '图片描述')->required();
        $form->url('link', '链接');
        $form->image('source', '轮播图比例 4:1')->removable()->uniqueName()->rules('required|max:150')
            ->resize(1200, 300)->required();
        $form->switch('is_show', '是否显示')->states($this->is_show);

        $form->number('sort', '排序')->min(0)->default(VideoCarousel::count() + 1)->required();

        $form->hidden('created_at');
        $form->saving(function (Form $form){
            $form->created_at = now();
        });

        return $form;
    }
}

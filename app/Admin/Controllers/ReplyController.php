<?php

namespace App\Admin\Controllers;

use App\Models\Reply;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReplyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reply';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reply());

        $grid->column('message_id', __('Message id'));
        $grid->column('user_id', __('User id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('status', __('Status'));

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
        $show = new Show(Reply::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('message_id', __('Message id'));
        $show->field('user_id', __('User id'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('status', __('Status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Reply());

        $form->text('message_id', __('Message id'))->readonly();
        $form->text('user_id', __('User id'))->readonly();
        $form->textarea('content', __('Content'))->readonly();
        $form->select('status', __('Status'))->options(Reply::$statusMap);

        return $form;
    }
}

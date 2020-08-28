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
        $grid = $grid->disableFilter();
        $grid = $grid->disableExport();
        $grid = $grid->disableCreateButton();
        $grid->model()->orderByDesc('created_at');
        $grid->column('message')->title('标题')->link(function ($message){
//            return $message->message->link();
            return route('admin.messages.show', [$message->id]);
        });
        $grid->column('content', '内容')->display(function ($content){
            return $content;
        });
        $grid->column('user')->username('用户名');
        $grid->column('created_at', __('Created at'));

        $statusMap = Reply::$statusMap;
        $grid->column('status', __('Status'))->editable('select', $statusMap)->filter($statusMap);

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

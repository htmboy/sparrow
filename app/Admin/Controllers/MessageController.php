<?php

namespace App\Admin\Controllers;

use App\Models\Message;
use App\Models\Position;
use App\Services\PositionService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MessageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Message';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Message());
        $grid = $grid->disableFilter();
        $grid = $grid->disableExport();
        $grid = $grid->disableCreateButton();
        $grid->model()->orderByDesc('created_at');
        $grid->column('position_id', '地区')->display(function ($position){
            return idToProvinceSlugs($position, false);
        })->filter((new PositionService)->getProvinceMap()->toArray());

        $grid->column('user', __('User id'))->username('用户');
        $grid->column('title', __('Title'))->link(function ($message){
            return route('admin.messages.show', [$message->id]);
        });
        $statusMap = Message::$statusMap;
        $grid->column('status', '状态')->editable('select', $statusMap)->filter($statusMap);
        $grid->column('created_at', __('Created at'));
        $grid->column('sort', __('Sort'))->editable();
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
        $show = new Show(Message::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('position_id', __('Position id'));
        $show->field('user_id', __('User id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('sort', __('Sort'));
        $show->field('seo_title', __('Seo title'));
        $show->field('seo_keywords', __('Seo keywords'));
        $show->field('seo_description', __('Seo description'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Message());

        $form->select('position_id', __('Position id'))->options(Position::getTownsMap())->readOnly();
        $form->text('title', __('Title'))->readonly();
        $form->textarea('content', __('Content'))->readonly();
        $form->number('sort', __('Sort'));
        $form->text('seo_title', __('Seo title'));
        $form->text('seo_keywords', __('Seo keywords'));
        $form->textarea('seo_description', __('Seo description'));
        $form->select('status', __('Status'))->options(Message::$statusMap);

        return $form;
    }
}

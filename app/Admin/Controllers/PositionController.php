<?php

namespace App\Admin\Controllers;

use App\Models\Position;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Tree;
use Illuminate\Http\Request;

class PositionController extends AdminController
{
    use ModelTree;

    private $id;

    public function index(Content $content)
    {
        $tree = new Tree(new Position);
        return $content->header('位置信息')->body($tree);
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */

    public function edit($id, Content $content)
    {
        $this->id = $id;
        return parent::edit($id, $content);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Position);
        $form->select('parent_id', __('parent_id'))->options(
            array_merge(
                [0 => 'root'],
                Position::findByNotTown()->keyBy('id')
                    ->map(function ($item){return $item->place;})->except([$this->id])
                    ->toArray())
        );
        $form->text('place', __('place'))->required();

        $states = [
            'on'  => ['value' => '1', 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => '0', 'text' => '关闭', 'color' => 'danger'],
        ];

        $form->switch('is_town', __('is_town'))->states($states);
        $form->switch('is_show', __('is_show'))->states($states);
        $form->hidden('level');
        $form->hidden('path');
        $form->saving(function (Form $form){
            if($form->parent_id == 0){
                $form->level = 1;
                $form->path = '-';

            } else {
                $position = Position::findByParentId($form->parent_id);
                $form->level = ++$position->level;
                $form->path = $position->path.$position->parent_id.'-';
            }
        });
        return $form;
    }
}

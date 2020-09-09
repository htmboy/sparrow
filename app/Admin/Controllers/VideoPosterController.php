<?php

namespace App\Admin\Controllers;

use App\Models\VideoPoster;
use App\Services\VideoPosterService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Symfony\Component\HttpFoundation\Request;


class VideoPosterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'VideoPoster';

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VideoPoster());

        $grid->column('id', __('Id'));
        $grid->column('video_id', __('Video id'));
        $grid->column('title', __('Title'));
        $grid->column('source', __('Source'))->image('', '200');
        $grid->column('alt', __('Alt'));
        $grid->column('is_show', __('Is show'))->switch();
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
        $show = new Show(VideoPoster::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('video_id', __('Video id'));
        $show->field('title', '标题');
        $show->field('source', __('Source'));
        $show->field('alt', __('Alt'));
        $show->field('link', __('Link'));
        $show->field('is_show', __('Is show'));
        $show->field('sort', __('Sort'));
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
        $video_id = $this->request->input('video_id');
        $form = new Form(new VideoPoster());
        $form->tools(function (Form\Tools $tools) use ($video_id) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();

            $tools->append('<a href="'. route('admin.v2.videos.show', [$video_id, 'action' => 'poster']).'" class="btn btn-sm btn-default" title="列表"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;列表</span></a>');
        });

        $form->text('title', '标题')->required();
        $form->image('source', '图片')->removable()->uniqueName()->rules('required|max:120')
            ->resize(800, 300)->required();
        $form->text('alt', '图片表述')->required();
        $form->switch('is_show', __('Is show'));
        $form->number('sort', '排序')->min(0)->default((new VideoPosterService)->getCountByVideoId($video_id) +1 );
        $form->hidden('video_id')->default($video_id);
        $form->saved(function (Form $form) use ($video_id){
            return redirect()->route('admin.v2.videos.show', [$video_id, 'action'=>'poster']);
        });
        return $form;
    }
}

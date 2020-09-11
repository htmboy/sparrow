<?php

namespace App\Admin\Controllers;

use App\Models\VideoSource;
use App\Services\VideoSourceService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Symfony\Component\HttpFoundation\Request;

class VideoSourceController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '片源';

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
        $grid = new Grid(new VideoSource());



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
        $show = new Show(VideoSource::findOrFail($id));



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
        $action = $this->request->input('action');
        $form = new Form(new VideoSource());
        $form->tools(function (Form\Tools $tools) use ($video_id) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();

            $tools->append('<a href="'. route('admin.v2.videos.show', [$video_id, 'action' => 'source']).'" class="btn btn-sm btn-default" title="列表"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;列表</span></a>');
        });
        $form->text('title', '标题')->required();
        $form->url('link', '片源链接')->required();
        $form->number('clicks', '点击数')->min(0)->default(0)->required();
        $form->switch('is_show', '是否显示')->states($this->is_show);

        $form->number('sort', '排序')->min(0)->default((new VideoSourceService)->getCountByVideoId($video_id) + 1)->required();
        $form->hidden('video_id')->default($video_id);
        $form->saved(function (Form $form) use ($video_id, $action){
            return redirect()->route('admin.v2.videos.show', [$video_id, 'action'=>'source']);
        });

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\Video\PosterEdit;
use App\Admin\Actions\Video\SourceEdit;
use App\Admin\Actions\Video\Poster;
use App\Admin\Actions\Video\Source;

use Symfony\Component\HttpFoundation\Request;
use App\Models\Video;
use App\Models\VideoCountry;
use App\Models\VideoType;
use App\Models\VideoWithType;
use App\Services\VideoCountryService;
use App\Services\VideoTypeService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;



class VideoController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '影片';


    private $request;

    /**
     * VideoController constructor.
     * @param Request $request
     */
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

        $grid = new Grid(new Video());
        $grid->model()->orderByDesc('sort');
        $grid->column('name', '片名');
        $grid->column('country_id', '国家')->display(function ($country_id){
            return (new VideoCountryService)->getCountries($country_id);
        });
        $grid->column('director', '导演');
        $grid->column('kind', '类型')->display(function ($kind) {
            return Video::$kindsMap[$kind];
        });
        $grid->column('cover', '封面')->image('', 80);
        $grid->column('is_show', '是否上线')->switch($this->is_show);
        $grid->column('sort', '排序')->editable();
        $grid->column('updated_at', '修改日期');

        $grid->actions(function ($actions) {

            // 去掉查看
            $actions->disableView();

            $actions->add(new Source($actions->getKey()));
            $actions->add(new Poster($actions->getKey()));
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

        $show = new Show(Video::findOrFail($id));
        $show->panel()->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });
        $show->field('name', '片名');
        $show->field('country_id', '国家')->as(function ($country_id){
            return (VideoCountry::all()->pluck('name', 'id'))[$country_id];
        });
        $show->field('starring', '主演');
        $show->field('director', '导演');
        $show->field('issued_at', '发行日期');
        $show->field('kind', '类型')->as(function ($kind){
            return Video::$kindsMap[$kind];
        });
        $action = $this->request->input('action');
        if($action == 'poster')
            $show->posters('海报', function ($posters)use($id, $action){
                $posters->resource(route('admin.v2.video-posters.index'));
                $posters->disableFilter();
                $posters->disableExport();
                $posters->disableRowSelector();
                $posters->model()->orderByDesc('sort');
                $posters->title('标题');
                $posters->source('图片')->image();
                $posters->alt('图片表述');
                $posters->link('链接');
                $posters->sort('排序')->editable();
                $posters->is_show('是否显示')->switch();
                $posters->actions(function ($actions) use($id, $action){
                    // 去掉删除
//                    $actions->disableDelete();

                    // 去掉编辑
                    $actions->disableEdit();

                    // 去掉查看
                    $actions->disableView();

                    $actions->add(new PosterEdit($actions->getKey(), $id));
//                    $actions->add(new Poster($actions->getKey()));
                });
            });
        if($action == 'source')
            $show->sources('片源', function ($sources) use($id, $action){
                $sources->resource(route('admin.v2.video-sources.index'));
                $sources->disableFilter();
                $sources->disableExport();
                $sources->disableRowSelector();
                $sources->model()->orderByDesc('sort');
                $sources->title('标题')->editable();
                $sources->link('链接')->editable();
                $sources->clicks('点击数');
                $sources->sort('排序')->editable();
                $sources->is_show('是否显示')->switch();
                $sources->actions(function ($actions)use($id, $action) {
                    // 去掉删除
//                    $actions->disableDelete();

                    // 去掉编辑
                    $actions->disableEdit();

                    // 去掉查看
                    $actions->disableView();

                    $actions->add(new SourceEdit($actions->getKey(), $id));
//                    $actions->add(new Poster($actions->getKey()));
                });
            });
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Video());

        $form->text('name', '片名')->required();
        $form->select('country_id', '国家')->options((new VideoCountryService)->getCountries())->required();
        $form->text('starring', '主演')->required();
        $form->text('director', '导演')->required();
        $form->textarea('introduction', '简介')->required();
        $form->datetime('issued_at', '发行日期')->required();
        $form->select('kind', '影片类型')->options(Video::$kindsMap)->required();
        $form->image('cover', '封面比例 3:4(竖)')->removable()->uniqueName()->rules('required|max:100')
            ->resize(300, 400)->required();
        $form->switch('is_show', '是否显示')->states($this->is_show);

        $form->checkbox('types', '影片类型')->options((new VideoTypeService)->getTypes());

        $form->number('sort', '排序')->min(0)->default(Video::count() + 1)->required();


        return $form;
    }
}

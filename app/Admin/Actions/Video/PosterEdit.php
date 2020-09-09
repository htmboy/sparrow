<?php

namespace App\Admin\Actions\Video;

use Encore\Admin\Actions\BatchAction;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Collection;

class PosterEdit extends RowAction
{
    public $name = '编辑海报';
    private $id;
    private $video_id;

    public function __construct($id, $video_id)
    {
        $this->id = $id;
        $this->video_id = $video_id;
    }

    public function href()
    {
        return route('admin.v2.video-posters.edit', [$this->id, 'video_id' => $this->video_id]);
    }

}
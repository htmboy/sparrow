<?php

namespace App\Admin\Actions\Video;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Poster extends RowAction
{
    public $name = '海报';
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function href()
    {
        return route('admin.v2.videos.show', [$this->id, 'action' => 'poster']);
    }

}
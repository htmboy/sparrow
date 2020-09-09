<?php

namespace App\Admin\Actions\Video;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Source extends RowAction
{
    public $name = '片源';

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function href()
    {
        return route('admin.v2.videos.show', [$this->id, 'action' => 'source']);
    }

}
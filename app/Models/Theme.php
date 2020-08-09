<?php

namespace App\Models;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use ModelTree;

    protected $table = 'sparrow_themes';

    public $timestamps = false;

    protected $fillable = [
        'parent_id', 'name', 'status', 'sort', 'level', 'path'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }

    public static function findByParentId($id)
    {
        return self::find($id);
    }
}

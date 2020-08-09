<?php

namespace App\Models;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use ModelTree;

    protected $table = 'sparrow_positions';

    public $timestamps = false;

    protected $fillable = [
        'parent_id', 'place', 'level', 'is_town', 'path', 'is_show'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('id');
        $this->setTitleColumn('place');
    }

    public static function findByParentId($id)
    {
        return self::find($id);
    }

    public static function findByNotTown()
    {
        return self::where('is_town', '0')->get();
    }

    public static function getTowns()
    {
        return self::where('is_town', '1')->get();
    }

    public static function getTownsMap()
    {
        return self::getTowns()->keyBy('id')->map(function ($item){
            return $item->place;
        })->toArray();
    }
}

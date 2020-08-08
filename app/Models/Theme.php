<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'sparrow_themes';

    public $timestamps = false;

    protected $fillable = [
        'parent_id', 'name', 'level', 'path', 'status', 'sort'
    ];
}

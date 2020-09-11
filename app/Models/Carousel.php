<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table = 'sparrow_carousels';

    protected $fillable = [
        'summary', 'source', 'link', 'alt', 'title', 'created_at', 'is_show', 'sort'
    ];

    protected $attributes = ['is_show' => 1];

    public $timestamps = false;
}

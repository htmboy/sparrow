<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IPLibrary extends Model
{
    protected $table = 'ip_libraries';
    public $timestamps = false;

    protected $fillable = [
        'ip', 'region', 'created_at'
    ];
}

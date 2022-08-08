<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'filename',
        'actby',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

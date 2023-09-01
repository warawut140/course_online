<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject_Works extends Model
{
    protected $table = 'subject__works';
    protected $fillable = [
        'data_type',
        'name',
        'actby',
        'created_at',
        'updated_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'name',
        'position',
        'option_type_id',
        'course_list_id',
        'actby',
        'created_at',
        'updated_at',
    ];
}

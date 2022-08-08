<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseComment extends Model
{
    protected $table = 'course_comments';
    protected $fillable = [
        'details',
        'course_list_id',
        'actby',
        'user_id',
        'created_at',
        'updated_at',
    ];
}

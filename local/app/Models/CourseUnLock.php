<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUnLock extends Model
{
    protected $table = 'course_un_locks';
    protected $fillable = [
        'course_id',
        'unlock',
        'user_id',
        'created_at',
        'updated_at',
    ];
}

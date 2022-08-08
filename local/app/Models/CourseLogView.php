<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLogView extends Model
{
    public $timestamps = false;
    protected $table = 'course_log_views';
    protected $fillable = [
        'course_list_id',
        'ip',
        'count',
    ];
}

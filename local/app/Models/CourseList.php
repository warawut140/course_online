<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseList extends Model
{
    protected $table = 'course_lists';
    public $incrementing=true;
    // protected $fillable = [
    //     'course_id',
    //     'course_name',
    //     'course_detail',
    //     'course_image',
    //     'course_video',
    //     'course_order',
    //     'course_free',
    //     'course_time',
    //     'actby',
    //     'created_at',
    //     'updated_at',
    //     'chapter_id',
    // ];
}

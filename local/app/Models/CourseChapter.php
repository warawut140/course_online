<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseChapter extends Model
{
    protected $table = 'courses_chapter';
    protected $fillable = [
        'course_id',
        'name',
        'actby',
        'order',
        'created_at',
        'updated_at',
    ];

    public function CourseList(){
        return $this->hasMany('App\Models\CourseList','chapter_id','id');
    }
}

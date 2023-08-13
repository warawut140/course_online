<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionsDetail extends Model
{
    protected $table = 'questions_details';
    public $incrementing=true;
    // protected $fillable = [
    //     'course_list_id',
    //     'time_test',
    //     'details',
    //     'created_at',
    //     'updated_at',
    // ];

    public function CourseList()
    {
        return $this->hasOne('\App\Models\CourseList','id','course_list_id');
    }

}

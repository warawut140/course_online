<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    public $incrementing=true;
    // protected $fillable = [
    //     'name',
    //     'status',
    //     'price',
    //     'image',
    //     'detail',
    //     'actby',
    //     'created_at',
    //     'updated_at',
    // ];

    public function GetStatus()
    {
        $data=$this->status;
        if($this->status==1){
            $data = 'เปิด';
        }elseif($this->status==0){
            $data = 'ปิด';
        }
        return $data;
    }

    public function Profile()
    {
        return $this->hasOne('\App\Models\Profile','id','profile_id');
    }


    public function CategoryCourse()
    {
        return $this->hasOne('\App\Models\CategoryCourse','id','category_course_id');
    }

}

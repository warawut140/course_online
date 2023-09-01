<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileQuestionDetail extends Model
{
    protected $table = 'profile_question_detail';
    public $incrementing=true;
    // protected $fillable = [
    //     'question_id',
    //     'option_id',
    //     'option_text',
    //     'pass',
    //     'user_id',
    //     'created_at',
    //     'updated_at',
    //     'idcheck',
    // ];

    public function User()
    {
        return $this->hasOne('\App\User','id','user_id');
    }

    public function QuestionsDetail()
    {
        return $this->hasOne('\App\Models\QuestionsDetail','id','questions_detail_id');
    }

    public function get_status()
    {
        $text = '';
        if($this->status==0){
            $text = 'รอผลตรวจ';
        }
        if($this->status==1){
            $text = 'ผ่าน';
        }
        if($this->status==2){
            $text = 'ไม่ผ่าน';
        }
        return $text;
    }
}

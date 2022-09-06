<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $table = 'answers';
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
}

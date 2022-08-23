<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $table = 'options';
    public $incrementing=true;
    // protected $fillable = [
    //     'name',
    //     'position',
    //     'question_id',
    //     'correct_answer',
    //     'created_at',
    //     'updated_at',
    // ];
}

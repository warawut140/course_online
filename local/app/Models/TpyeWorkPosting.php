<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpyeWorkPosting extends Model
{
    protected $table = 'tpye_work_postings';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}

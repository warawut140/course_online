<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProcedure extends Model
{
    protected $table = 'work_procedures';
    protected $fillable = [
        'wp_id',
        'detail',
        'created_at',
        'updated_at',
    ];
}

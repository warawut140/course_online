<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkComment extends Model
{
    protected $table = 'work_comments';
    protected $fillable = [
        'details',
        'rate',
        'wp_id',
        'user_id',
        'created_at',
        'updated_at',
    ];
}

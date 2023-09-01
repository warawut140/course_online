<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkMgmt extends Model
{
    protected $table = 'work_mgmts';
    protected $fillable = [
        'wp_id',
        'title',
        'price',
        'detail_scope',
        'start_date',
        'end_date',
        'status',
        'user_id',
        'owner_id',
        'created_at',
        'updated_at',
    ];
}

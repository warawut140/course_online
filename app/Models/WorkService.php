<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkService extends Model
{
    protected $table = 'work_services';
    protected $fillable = [
        'wp_id',
        'detail',
        'created_at',
        'updated_at',
    ];
}

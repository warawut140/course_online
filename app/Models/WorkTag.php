<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkTag extends Model
{
    protected $table = 'work_tags';
    protected $fillable = [
        'wp_id',
        'tag_id',
        'created_at',
        'updated_at',
    ];
}

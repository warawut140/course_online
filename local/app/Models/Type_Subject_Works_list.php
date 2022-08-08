<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_Subject_Works_list extends Model
{
    protected $table = 'type__subject__works_lists';
    protected $fillable = [
        'name',
        'type_sub_work_id',
        'actby',
        'created_at',
        'updated_at',
    ];
}

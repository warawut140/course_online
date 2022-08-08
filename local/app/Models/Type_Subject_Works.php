<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_Subject_Works extends Model
{
    protected $table = 'type__subject__works';
    protected $fillable = [
        'name',
        'sub_work_id',
        'id_sub',
        'type_select',
        'type_list',
        'sort',
        'actby',
        'created_at',
        'updated_at',
    ];
}

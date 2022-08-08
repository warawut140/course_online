<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuddingAir extends Model
{
    protected $table = 'budding_airs';
    protected $fillable = [
        'project_id',
        'type_work_sub',
        'work_type_id',
        'work_type_name',
        'sub_work_id',
        'sub_work_name',
        'sub_brand_id',
        'sub_brand_name',
        'totalAll_sub',
        'user_id',
        'created_at',
        'updated_at',
    ];
}

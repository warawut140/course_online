<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Percent extends Model
{
    protected $table = 'percents';
    protected $fillable = [
        'name',
        'title_type',
        'sub_name_id',
        'cost_of_offer',
        'cost_of_invest',
        'labor_cost_offer',
        'labor_cost_invest',
        'actby',
        'created_at',
        'updated_at',
    ];
}

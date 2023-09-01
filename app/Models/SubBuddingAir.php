<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubBuddingAir extends Model
{
    protected $table = 'sub_budding_airs';
    protected $fillable = [
        'budding_air_id',
        'air_id',
        'btu',
        'cost_labour',
        'cost_material',
        'price',
        'qty',
        'ac_name',
        'b_name',
        'brand_id',
        'model',
        'labour_unitCost',
        'labour_unitTotal',
        'materail_unitCost',
        'materail_unitTotal',
        'qty_labour',
        'qty_material',
        's_name',
        'totalCost',
        'u_name',
        'unit_id',
        'w_name',
        'created_at',
        'updated_at',
    ];
}

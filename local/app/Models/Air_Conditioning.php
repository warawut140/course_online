<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Air_Conditioning extends Model
{
    protected $table = 'air_conditionings';
    protected $fillable = [
        'data_type',
        'product_type',
        'product_id',
        'product_id_type',
        'price',
        'price2',
        'btu',
        'model',
        'unit_id',
        "qty_material",
        "cost_material",
        "qty_labour",
        "cost_labour",
        'standard_id',
        'brand_id',
        'type_sub_work_id',
        'type_sub_work_list_id',
        'actby',
        'created_at',
        'updated_at',
        'deleted_at',
        'air_id',
    ];
}

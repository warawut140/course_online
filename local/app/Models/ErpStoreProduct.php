<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErpStoreProduct extends Model
{
    protected $table = 'erp_store_products';
    protected $fillable = [
        'product_name',
        'product_image',
        'product_air_id',
        'product_details',
        'product_brand',
        'product_series',
        'product_btu',
        'product_price',
        'product_vat',
        'product_stock',
        'product_setup',
        'product_setup2',
        'product_piping',
        'user_id',
        'created_at',
        'updated_at',
    ];
}

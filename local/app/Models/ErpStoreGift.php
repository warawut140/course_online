<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErpStoreGift extends Model
{
    protected $table = 'erp_store_gifts';
    protected $fillable = [
        'psp_id',
        'gift_name',
        'gift_count',
        'created_at',
        'updated_at',
    ];
}

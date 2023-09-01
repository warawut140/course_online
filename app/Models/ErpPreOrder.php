<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErpPreOrder extends Model
{
    protected $table = 'erp_pre_orders';
    protected $fillable = [
        'user_id',
        'erp_sp_id',
        'erp_sp_brand',
        'erp_sp_series',
        'erp_sp_btu',
        'erp_sp_setup',
        'erp_sp_setup_value',
        'erp_sp_vat',
        'erp_gifts',
        'erp_sp_promotion',
        'erp_pre_count',
        'erp_pre_date_setup',
        'erp_pre_fullname',
        'erp_pre_tel',
        'erp_pre_email',
        'erp_pre_line',
        'erp_sp_payment',
        'created_at',
        'updated_at',
        'erp_pre_status_payment',
        'erp_pre_status_install',
        'erp_pre_review',
        'erp_pre_review_detail',
        'created_at',
        'updated_at',
    ];
}

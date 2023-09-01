<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErpService extends Model
{
    protected $table = 'erp_services';
    protected $fillable = [
        'erp_po_id',
        'erp_service',
        'erp_s_type',
        'erp_s_status',
        'erp_s_details',
        'erp_s_date',
        'erp_s_date_setup',
        'erp_s_price',
        'service_user_id',
        'created_at',
        'updated_at',
    ];
}

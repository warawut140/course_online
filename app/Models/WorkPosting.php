<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkPosting extends Model
{
    protected $table = 'work_postings';
    protected $fillable = [
        'title',
        'tpye_wp_id',
        'detail_data',
        'time_work',
        'price_range_id',
        'detail_price',
        'profile_id',
        'provinces_id',
        'created_at',
        'updated_at',
        'source',
    ];
}

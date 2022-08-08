<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAuction extends Model
{
    protected $table = 'project_auctions';
    protected $fillable = [
        'user_id',
        'profile_id',
        'project_name',
        'type_project_id',
        'date_end',
        'time_end',
        'price_ranges_id',
        'provinces_id',
        'amphures_id',
        'districts_id',
        'startdate',
        'enddate',
        'period',
        'details',
        'countDown',
        'vote',
        'created_at',
        'updated_at',
    ];
}

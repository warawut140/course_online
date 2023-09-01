<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAuctionWork extends Model
{
    protected $table = 'project_auction_works';
    protected $fillable = [
        'project_id',
        'work_id',
        'install_machine',
        'piping',
        'control',
        'main',
        'duct_piping',
        'created_at',
        'updated_at',
    ];
}

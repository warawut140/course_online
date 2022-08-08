<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAuctionGallery extends Model
{
    protected $table = 'project_auction_galleries';
    protected $fillable = [
        'project_id',
        'filename',
        'created_at',
        'updated_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkGallery extends Model
{
    protected $table = 'work_galleries';
    protected $fillable = [
        'wp_id',
        'filename',
        'created_at',
        'updated_at',
    ];
}

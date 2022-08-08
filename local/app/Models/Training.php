<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'trainings';
    protected $fillable = [
        'title',
        'details',
        'image_training',
        'video_training',
        'actby',
        'user_id',
        'created_at',
        'updated_at',
    ];
}

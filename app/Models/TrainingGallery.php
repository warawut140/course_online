<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingGallery extends Model
{
    protected $table = 'training_galleries';
    protected $fillable = [
        'filename',
        'training_id',
        'actby',
        'created_at',
        'updated_at',
    ];
}

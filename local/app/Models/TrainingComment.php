<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingComment extends Model
{
    protected $table = 'training_comments';
    protected $fillable = [
        'details',
        'training_id',
        'actby',
        'user_id',
        'created_at',
        'updated_at',
    ];
}

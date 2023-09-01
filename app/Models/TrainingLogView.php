<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingLogView extends Model
{
    protected $table = 'training_log_views';
    protected $fillable = [
        'training_id',
        'ip',
        'count',
        'created_at',
        'updated_at',
    ];
}

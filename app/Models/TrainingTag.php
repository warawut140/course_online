<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingTag extends Model
{
    protected $table = 'training_tags';
    protected $fillable = [
        'training_id',
        'tag_id',
        'created_at',
        'updated_at',
    ];
}

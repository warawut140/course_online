<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuggestLogView extends Model
{
    protected $table = 'suggest_log_views';
    protected $fillable = [
        'suggest_id',
        'ip',
        'count',
        'created_at',
        'updated_at',
    ];
}

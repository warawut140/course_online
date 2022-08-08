<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuggestComment extends Model
{
    protected $table = 'suggest_comments';

    protected $fillable = [
        'details',
        'suggest_id',
        'actby',
        'user_id',
        'created_at',
        'updated_at',
    ];
}

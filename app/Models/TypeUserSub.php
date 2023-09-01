<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeUserSub extends Model
{
    protected $table = 'type_user_subs';
    protected $fillable = [
        'name',
        'type_user_id',
        'created_at',
        'updated_at',
    ];
}

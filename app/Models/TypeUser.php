<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    protected $table = 'type_users';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    protected $table = 'works';
    protected $fillable = [
        'data_type',
        'name',
        'created_at',
        'updated_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'provinces';
    protected $fillable = [
        'PROVINCE_ID',
        'PROVINCE_CODE',
        'PROVINCE_NAME',
        'PROVINCE_NAME_ENG',
        'GEO_ID',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

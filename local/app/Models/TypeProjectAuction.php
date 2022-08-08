<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProjectAuction extends Model
{
    protected $table = 'type_project_auctions';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}

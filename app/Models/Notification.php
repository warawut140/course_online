<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'detail',
        'path',
        'type',
        'btn_name',
        'isActive',
        'user_id_send',
        'user_id_to',
        'created_at',
        'updated_at',
    ];
}

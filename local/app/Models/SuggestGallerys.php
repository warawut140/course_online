<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuggestGallerys extends Model
{
    protected $table = 'suggest_gallery';
    protected $fillable = [
        'filename',
        'suggest_id',
        'created_at',
        'updated_at',
    ];
}

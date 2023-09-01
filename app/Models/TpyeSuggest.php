<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpyeSuggest extends Model
{
    protected $table = 'tpye_suggests';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    public function Suggests()
    {
//        return $this->hasMany(Suggests::class);
//        return $this->hasMany('App\Models\Suggests');
    }
}

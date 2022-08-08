<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggests extends Model
{
    protected $table = 'suggests';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'type_suggest_id',
        'details',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function TpyeSuggests()
    {
//        return $this->belongsTo(TpyeSuggest::class,'type_suggest_id');
//        return $this->belongsTo('App\Models\TpyeSuggest','type_suggest_id');
    }
}

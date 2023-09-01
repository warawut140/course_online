<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataType extends Model
{
    protected $table = 'data_type';
    public $incrementing=true;

    public function Admin()
    {
        return $this->hasOne('\App\Admin','id','admin_id');
    }

}

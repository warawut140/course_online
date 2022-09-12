<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRegister extends Model
{
    protected $table = 'job_register';
    public $incrementing=true;

    public function Profile()
    {
        return $this->hasOne('\App\Models\Profile','id','profile_id');
    }


}

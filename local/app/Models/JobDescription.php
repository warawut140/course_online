<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    protected $table = 'job_description';
    public $incrementing=true;

    public function Profile()
    {
        return $this->hasOne('\App\Models\Profile','id','profile_id');
    }

}

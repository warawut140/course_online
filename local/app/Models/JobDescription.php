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

    public function get_employment_type()
    {
        $data = "";
        if($this->employment_type==1){
            $data = "เต็มเวลา";
        }
        if($this->employment_type==2){
            $data = "Part-time";
        }
        return $data;
    }

}

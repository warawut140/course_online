<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    public $incrementing=true;

    // protected $fillable = [
    //     'firstname',
    //     'lastname',
    //     'tel',
    //     'image_profile',
    //     'image_card',
    //     'filename_reference',
    //     'filename_award',
    //     'filename_diploma',
    //     'prefix_id',
    //     'type_user_id',
    //     'type_user_id_2',
    //     'type_user_id_3',
    //     'type_user_sub_id',
    //     'user_id',
    //     'admin_id',
    //     'created_at',
    //     'updated_at',
    //     'review_profile',
    //     'details',
    //     'company',
    //     'birthday',
    //     'provinces_id',
    //     'amphures_id',
    //     'districts_id',
    //     'company_logo',
    //     'company_address',
    //     'latitude',
    //     'longitude',
    //     'zoom',
    // ];
}

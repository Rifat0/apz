<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class subscribePayment extends Model
{
    protected $table = 'as_subscribe_payment';
    protected $primaryKey = 'subscribe_payment_id';

    public function softwareDetails()
    {
        return $this->hasOne('App\Model\software', 'software_id');
    }

    public function softwareVariationDetails()
    {
        return $this->hasOne('App\Model\software_variation', 'software_variation_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\user', 'user_id', 'user_id');
    }
}


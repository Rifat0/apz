<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = 'as_users';

    protected $primaryKey = 'user_id';

    protected $hidden = ['password'];

    public function userDetails()
    {
        return $this->hasOne('App\Model\userDetails', 'user_id');
    }

    public function subscribtion()
    {
        return $this->hasmany('App\Model\subscribe', 'user_id', 'user_id');
    }

    public function agent_commission()
    {
        return $this->hasmany('App\Model\agent_commission', 'agent_id','user_id');
    }

    public function agent_payment()
    {
        return $this->hasmany('App\Model\agent_payment', 'agent_id','user_id');
    }
}

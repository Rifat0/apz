<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class pos_requirements extends Model
{
    protected $table = 'as_pos_requirements';
    protected $primaryKey = 'pos_requirement_id';

    public function user()
    {
        return $this->belongsTo('App\Model\user', 'user_id', 'user_id');
    }
}

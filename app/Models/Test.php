<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';

    public $timestamp = true;

    public function user() 
    {
    	return $this->belongsTo('App\Models\User', 'owner_id', 'id');
    }

    public function exam ()
    {
    	return $this->belongsTo('App\Models\Exam');
    }
}

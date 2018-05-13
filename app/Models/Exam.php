<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Traits\GetOwnerUpdater;

class Exam extends Model
{
    protected $table = 'exams';

    public $timestamps = true;

	public function tests()
	{
		return $this->hasMany('App\Models\Test');
	}

	public function examination()
	{
		return $this->belongsTo('App\Models\Examination');
	}    
}

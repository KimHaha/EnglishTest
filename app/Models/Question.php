<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\GetOwnerUpdater;

class Question extends Model
{
	use GetOwnerUpdater;
    protected $table = 'questions';

    public $timestamps = true;    

    public function categories() {
    	return $this->belongsToMany('App\Models\Category');
    }
}

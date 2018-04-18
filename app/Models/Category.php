<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Traits\GetOwnerUpdater;

class Category extends Model
{
	use GetOwnerUpdater;
    protected $table = 'categories';

    public $timestamps = true; 

    public function questions() {
    	return $this->belongsToMany('App\Models\Question');
    }   
}

<?php 

namespace App\Http\Traits;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;

trait GetOwnerUpdater {
	public function owner() {
    	return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updater() {
    	return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }	
}
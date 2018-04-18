<?php 

namespace App\Http\Traits;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;

trait GetUser {
	public $user = Auth::user();	
}
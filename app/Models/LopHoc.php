<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\GetOwnerUpdater;

class LopHoc extends Model
{
    use GetOwnerUpdater;

    protected $table = "classes";
    public $timestamp = true;

    public function users()
    {
    	return $this->hasMany('App\Models\User', 'class_id', 'id');
    }

    public function examinations()
    {
    	return $this->belongsToMany('App\Models\Examination', 'class_examination','class_id', 'examination_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'teacher_id', 'id');
    }
}

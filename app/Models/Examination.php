<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Traits\GetOwnerUpdater;

class Examination extends Model
{
    use GetOwnerUpdater;

    protected $table = 'examinations';
    public $timestamp = true;

    public function classes() {
    	return $this->belongsToMany('App\Models\LopHoc', 'class_examination', 'examination_id', 'class_id');
    }

    public function exams() {
    	return $this->hasMany('App\Models\Exam');
    }
}

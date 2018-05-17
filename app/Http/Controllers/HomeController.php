<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\Examination;
use App\Models\Permission;
use App\Models\User;
use App\Models\LopHoc;
use App\Models\Test;

use Illuminate\Support\Facades\Schema;

use App\Http\Traits\GetUser;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Carbon\Carbon;
class HomeController extends Controller
{
    public $current_menu_item = 'home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_examination = Examination::all();
        $today = Carbon::now()->toDateTimeString();
        $user = Auth::user();
        $examination_join = [];
        $examination_upcoming = [];

        $active_count = 0;
        $upcoming = 0;
        foreach ($list_examination as $examination) {
            if ($examination->start_time < $today && $today < $examination->end_time)
                $active_count ++;
            elseif ($examination->start_time > $today) {
                $upcoming ++;
                array_push($examination_upcoming, $examination);
            }

            if ($user->hasRole('student'))
                foreach ($user->tests as $test) {
                    if ($test->exam->examination->id == $examination->id)
                        if (!in_array($examination, $examination_join))
                            array_push($examination_join, $examination);
                }
        }

        $last_examination = Examination::where('end_time', '<', $today)
            ->orderBy('end_time', 'desc')
            ->first();

        $data = array (
            'active_count_examination' => $active_count,
            'upcoming_count_examination' => $upcoming,
            'finished_count_examination' => count($examination_join),
            'examination_upcoming' => $examination_upcoming,
            'current_menu_item' => $this->current_menu_item,
            'last_examination' => $last_examination,
        );
        // return $data;
        return view('admin.admin_home')->with($data);
    }
}

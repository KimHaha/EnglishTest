<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Question;
use App\Models\Examination;
use App\Models\Permission;
use App\Models\User;
use App\Models\LopHoc;
use App\Models\Test;
use App\Models\Exam;

use Illuminate\Support\Facades\Schema;

use App\Http\Traits\GetUser;

use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public $user;
    public $current_menu_item;

    public function __construct() 
    {
        $this->current_menu_item = 'results';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'current_menu_item' => $this->current_menu_item,
            'examination_list' => Examination::all(),
            'class_list' => LopHoc::all()
        ];
        return view('exam.result_index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('show_result', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search (Request $request) 
    {
        $user = Auth::user();

        if ($user->hasRole('student'))
        {
            $tests = Test::where('owner_id', '=', $user->id)->get();
        } 
        elseif ($user->hasRole('teacher')) {
            if ($request->name_or_email == NULL && $request->class_id_list == NULL) {
                $tests = Test::all();
            } elseif ($request->name_or_email != NULL) {
                $field = filter_var($request->name_or_email, FILTER_VALIDATE_EMAIL) ? 'email': 'name';

                if ($request->class_id_list == NULL) {
                    $tests = DB::table('tests')
                        ->join('users', 'tests.owner_id', '=', 'users.id')
                        ->where($field, '=', $request->name_or_email)
                        ->get();
                } else {
                    $tests = DB::table('tests')
                        ->join('users', 'tests.owner_id', '=', 'users.id')
                        ->where($field, '=', $request->name_or_email)
                        ->whereIn('class_id', $request->class_id_list)
                        ->get();
                }
            }
        }

        // check examination
        $test_list_search_examination = $tests;
        if ($request->examination_id != 0) {
            $test_list_search_examination = [];
            foreach ($tests as $test) {
                if ($test->exam->examination->id == $request->examination_id) {
                    array_push($test_list_search_examination, $test);
                }
            }
        }
            
        // check result
        $test_list_search = $test_list_search_examination;

        if ($request->result != 'all') {
            $test_list_search = [];
            foreach ($test_list_search_examination as $test) {
                if (($test->pass && $request->result == 'pass') ||
                    (!$test->pass && $request->result == 'fail')) {
                    array_push($test_list_search, $test);
                }
            }
        }


        $data = [
            'tests' => $test_list_search,
            'current_menu_item' => 'results'
        ];

        return view('exam.result_list')->with($data);
    }
}

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

use Carbon\Carbon;

class ExaminationController extends Controller
{
    public $user;
    public $current_menu_item;
    public $table;


    public function __construct () {
        $this->current_menu_item = 'examinations';
        $this->table = 'examinations';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_examiation = Examination::all();
        $data = [
            'list_item' => $list_examiation,
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item
        ];
        return view('item_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_class = LopHoc::all();
        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'create',
            'list_class' => $list_class
        ];
        return view('item_modify')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->user = Auth::user();
        $new_examination = new Examination;

        $new_examination->name         = $request->name;
        $new_examination->display_name = $request->display_name;
        $new_examination->description  = $request->description;
        $new_examination->start_time   = $request->start_time;
        $new_examination->end_time     = $request->end_time;
        $new_examination->max_try     = $request->max_try;
        $new_examination->pass_score     = $request->pass_score;

        $new_examination->created_by = $this->user->id;
        $new_examination->updated_by = $this->user->id;

        $new_examination->save();

        $new_examination->classes()->sync($request->class_id);

        return redirect()->route('examinations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $examination = Examination::findOrFail($id);
        $this->current_menu_item = 'exams';
        $this->table = 'exams';

        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'list_item' => $examination->exams,

        ];

        return view('item_list')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Examination::findOrFail($id);
        $list_class = LopHoc::all();

        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'edit',
            'item' => $item,
            'list_class' => $list_class
        ];

        return view('item_modify')->with($data);
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
        $this->user = Auth::user();

        $item = Examination::findOrFail($id);
        
        $item->name         = $request->name;
        $item->display_name = $request->display_name;
        $item->description  = $request->description;
        $item->start_time   = $request->start_time;
        $item->end_time     = $request->end_time;
        $item->pass_score  = $request->pass_score;
        $item->max_try  = $request->max_try;

        $item->updated_by = $this->user->id;

        $item->save();

        $item->classes()->sync($request->class_id);

        return redirect()->route('examinations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Examination::destroy($id);

        return redirect()->route('examinations.index');
    }

    /**
     * Create list exam for examination
     */
    public function createExam($id)
    {
        return redirect()->action(
            'ExamController@generateListExam', 
            ['examination_id' => $id, 'num' => config('examination.num_exam')]
        );
    }

    public function do_contest ()
    {
        $examination_list = $this->find_contest_avaiable();

        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'examination_list' => $examination_list
        ];

        return view('exam.pick_examination')->with($data);
    }

    public function find_contest_avaiable ()
    {
        $this->user = Auth::user();
        if ($this->user->class == null) {
            return null;
        }
        $examination_list = $this->user->class->examinations;
        $examination_available = [];

        $today = date("Y-m-d H:i:s");
        foreach ($examination_list as $exam) {
            if ($today > $exam->start_time && $today < $exam->end_time) {
                array_push($examination_available, $exam);
            }
        }

        return $examination_available;
    }

    /**
     * Do examination
     */
    public function do_examination($examination_id)
    {
        $user = Auth::user();
        $examination = Examination::findOrFail($examination_id);

        // check max attemp
        $count = \DB::table('tests')
            ->join('users', 'tests.owner_id', '=', 'users.id')
            ->join('exams', 'tests.exam_id', '=', 'exams.id')
            ->join('examinations', 'exams.examination_id', '=', 'examinations.id')
            ->where('tests.owner_id', '=', $user->id)
            ->where('examinations.id', '=', $examination_id)
            ->count();
        if ($count > $examination->max_try) {
            return redirect()->back();
        }

        // check test exists
        if (!$this->check_test($examination_id)){
            // pass count to increase num_try
            $test = $this->generate_test($examination_id, $count);
        } else 
            foreach ($user->tests as $test_) {
                if ($test_->exam->examination->id == $examination_id) {
                    $test = $test_;
                    break;
                }
            }

        // data for question            
        $question_list_id = explode(',' , $test->exam->question_list);
        $question_list = [];
        foreach ($question_list_id as $question_id) {
            array_push($question_list, Question::findOrFail($question_id));
        }

        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'doing_exam',
            'exam' => $test,
            'question_list' => $question_list
        ];

        return view('exam.exam')->with($data);
    }

    // check if a test exists and not finished 
    public function check_test ($examination_id)
    {
        $user = Auth::user();
        if ($user->tests == null)
            return false;

        // check test have examination_id and not finished
        foreach ($user->tests as $test) {
            if (!$test->finished && $test->exam->examination_id == $examination_id)
                return true;
        }
        return false;
    }

    public function generate_test ($examination_id, $count) 
    {
        $user = Auth::user();
        $examination = Examination::findOrFail($examination_id);
        $exams = $examination->exams;
        $exam = $exams[rand(0, 3)];

        $test = new Test;
        $test->exam_id = $exam->id;

        // time
        $test->start_time = Carbon::now()->toDateTimeString();
        $test->end_time = Carbon::now()->addMinutes(40)->toDateTimeString();

        $question_list = explode(',', $exam->question_list);
        $list_result = array();
        $list_choice = array();
        $label = ['A', 'B', 'C', 'D', 'E'];

        // generate random choice and result
        foreach ($question_list as $question_id) {
            $question = Question::findOrFail($question_id);
            $choices = explode(',', $question->choice);
            shuffle($choices);

            $index = 0;
            foreach ($choices as $choice) {
                if ($choice == $question->solution) {
                    array_push($list_result, $label[$index]);
                    break;
                }
                $index++;
            }
            $choices = implode(',', $choices);
            array_push($list_choice, $choices);
        }

        // push random answer if something wrong happen
        if (count($list_result) < 40) {
            $num = count($list_result);
            for ($i = 0; $i < 40 - $num; $i++) {
                array_push($list_result, $label[rand(0,3)]);
            }
        }

        $test->list_result = implode(',', $list_result);
        $test->list_choice = implode('|', $list_choice);
        $test->content     = null;
        $test->score       = 0;
        $test->owner_id    = $user->id;
        $test->num_try     = $count + 1;
        $test->finished    = false;
        $test->pass = false;

        $test->save();

        return $test;
    }
}

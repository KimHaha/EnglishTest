<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Question;
use App\Models\Examination;
use App\Models\Permission;
use App\Models\User;
use App\Models\Exam;
use App\Models\Test;

use Illuminate\Support\Facades\Schema;

use App\Http\Traits\GetUser;

use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public $user;
    public $current_menu_item;
    public $table;

    public function __construct () {
        $this->current_menu_item = 'exams';
        $this->table = 'exams';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_item = Exam::all();
        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'list_item' => $list_item
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
        $exam = Exam::findOrFail($id);
        $question_list_id = explode(',' ,$exam->question_list);
        $question_list = [];
        foreach ($question_list_id as $question_id) 
        {
            array_push($question_list, Question::findOrFail($question_id));
        }
        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'show',
            'exam' => $exam,
            'question_list' => $question_list
        ];

        return view('exam.exam')->with($data);
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

    public function generateListExam($examination_id, $num)
    {
        $num_exam_in_db = Exam::where('examination_id', '=', $examination_id)->count();

        if ($num <= $num_exam_in_db) 
            return redirect()->route('examinations.show', $examination_id);

        for ($i=0; $i < $num - $num_exam_in_db; $i++) 
        {
            $exam = $this->generateOneExam($examination_id);
            $exam->question_list = implode(",", $exam->question_list);
            $exam->save();
        }
        return redirect()->route('examinations.show', $examination_id);
    }

    /**
     * Create an exam for new examination
     * if question_list is an array of question id
     */
    public function generateOneExam($examination_id)
    {
        $list_question = Question::all();
        $exam = $this->generateRandomExam($examination_id);

        if ($exam == null) 
            return redirect()->route('exams.index', $examination_id);

        $exam = $this->calculateInfoExam($exam);
        $obj = $this->calculateObjective($exam);

        // step and candidate of localsearch
        $step = 0;
        $list_candidate = [];
        foreach ($list_question as $question) {
            if (!in_array($question->id, $exam->question_list))
                array_push($list_candidate, $question);
        }

        // if list candidate empty
        // return current exam
        if (empty($list_candidate))
            return $exam;

        while ($step > config('exam.max_step_localsearch'))
        {
            for ($i = 0; $i < config('exam.num_questions'); $i++) {
                $best_candidate_id = $exam->question_list[$i];
                $best_obj = $obj;
                $old_question_id = $exam->question_list[$i];

                foreach ($list_candidate as $candidate) {
                    // swap 
                    $exam->question_list[$i] = $candidate->id;

                    // calculate objective and update
                    $exam = $this->calculateInfoExam($exam);
                    $current_obj = $this->calculateObjective($exam);

                    if ($current_obj >= $best_obj) 
                    {
                        $best_obj = $current_obj;
                        $best_candidate_id = $candidate->id;
                    }

                    // swap again
                    $exam->question_list[$i] = $old_question_id;
                    $exam = $this->calculateInfoExam($exam);
                }

                // if better solution found
                // remove candidate from list candidate 
                // add it to solution
                // add removed elements to list candidate
                if ($best_candidate_id != $exam->question_list[$i]) 
                {
                    $exam->question_list[$i] = $best_candidate_id;
                    $obj = $this->calculateObjective($exam);
                    array_diff($list_candidate, array($best_candidate_id));
                    array_push($list_candidate, $old_question_id);
                }
                $step ++;
            }
        }

        return $exam;
    }

    public function calculateObjective($exam) 
    {
        $delta_weight = abs($exam->weight - config('exam.weight')) / config('exam.weight');
        $delta_difficult = abs($exam->difficult - config('exam.difficult')) / config('exam.difficult');
        return ($delta_difficult + $delta_weight) / 2;
    }

    // validate exam
    public function validateExam($exam)
    {
        $delta_weight = abs($exam->weight - config('exam.weight')) / config('exam.weight');
        $delta_difficult = abs($exam->difficult - config('exam.difficult')) / config('exam.difficult');
        if ((($delta_weight + $delta_difficult) / 2) < config('exam.delta'))
            return true;
        return false; 
    }

    // calculate difficult and weight of given exam
    public function calculateInfoExam($exam)
    {
        $total_difficult = 0;
        $exam->weight = 0;
        foreach ($exam->question_list as $question_id) 
        {
            $question = Question::findOrFail($question_id);

            $exam->weight += $question->weight;
            $total_difficult += $question->difficult; 
        }
        $exam->difficult = $total_difficult / config('exam.num_questions');
        return $exam;
    }

    // generate random id of question in exam->question_list
    public function generateRandomExam($examination_id)
    {
        $list_question = Question::all();

        $list_id = [];
        foreach ($list_question as $question) {
            array_push($list_id, $question->id);
        }


        if (count($list_question) < config('exam.num_questions'))
            return null;

        $key_question = array_rand($list_id, config('exam.num_questions'));

        $question_exam = array();
        foreach ($key_question as $key) {
            array_push($question_exam, $list_id[$key]);
        }

        $exam = new Exam;
        $exam->examination_id = $examination_id;
        $exam->question_list = $question_exam;
        return $exam;
    }

    public function calculate_score(Request $request, $test_id) 
    {
        $test = Test::findOrFail($test_id);
        $score = 0;
        $score_each_question = 100/40;
        $list_answer = [];

        $question_list = explode(',', $test->exam->question_list);
        foreach ($question_list as $question_id) 
        {
            $question = Question::findOrFail($question_id);

            if ($question->solution == $request->$question_id) {
                $score += $score_each_question;
            }
            array_push($list_answer, $request->$question_id);
        }

        $test->score = $score;
        $test->finished = true;
        $test->content = implode(',', $list_answer);
        $test->save();

        return redirect()->route('show_result', $test->id);
    }

    public function show_result ($test_id) 
    {
        $test = Test::findOrFail($test_id);

        $question_list_id = explode(',' ,$test->exam->question_list);
        $question_list = [];
        foreach ($question_list_id as $question_id) 
            array_push($question_list, Question::findOrFail($question_id));

        // solution
        $content_list = explode(',', $test->content);

        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'view_result',
            'exam' => $test,
            'question_list' => $question_list,
            'content_list' => $content_list
        ];

        return view('exam.exam')->with($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Question;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use App\Http\Datas\ListDataPassing;

class QuestionController extends Controller
{
    public $user;
    public $current_menu_item;
    public $table;
    public $question_type, $question_skill, $question_max_weight, $question_min_weight
        , $question_max_diff, $question_min_diff;

    public function __construct() {
        $this->question_type = ['true_false', 'many_choice', 'group', 'match', 'complete'];
        $this->question_skill = ['reading', 'listening'];
        $this->table = 'questions';
        $this->current_menu_item = 'questions';
        $this->question_max_weight = 8;
        $this->question_min_weight = 1;
        $this->question_max_diff = 5;
        $this->question_min_diff = 1;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_question = Question::all();
        $data = [
            'list_item' => $list_question,
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
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
        $list_data = new ListDataPassing;

        $list_data->type = $this->question_type;
        $list_data->skill = $this->question_skill;
        $list_data->category = Category::all();


        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'create',
            'list_data' => $list_data
        ];

        return view('teacher.questions.question_create')->with($data);
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
        $new_question = new Question;

        $new_question->type      = $request->type;
        $new_question->weight    = $request->weight;
        $new_question->difficult = $request->difficult;
        $new_question->skill     = $request->skill;
        $new_question->question  = $request->question;

        if ($request->type == "true_false") {
            $new_question->solution = $request->true_false_solution;
        } else {
            $new_question->solution = $request->solution;
        }

        if ($request->type == "many_choice") {
            $new_question->choice = $request->choice;
        }

        $new_question->created_by = $this->user->id;
        $new_question->updated_by = $this->user->id;

        $new_question->save();

        $new_question->categories()->sync($request->category_id);

        return redirect()->route('questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_data = new ListDataPassing;

        $list_data->type = $this->question_type;
        $list_data->skill = $this->question_skill;
        $list_data->category = Category::all();

        $edited_question = Question::findOrFail($id);

        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'edit',
            'list_data' => $list_data,
            'edited_question' => $edited_question
        ];

        return view('teacher.questions.question_edit')->with($data);
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
        $new_question = Question::findOrFail($id);

        $new_question->type      = $request->type;
        $new_question->weight    = $request->weight;
        $new_question->difficult = $request->difficult;
        $new_question->skill     = $request->skill;
        $new_question->question  = $request->question;

        if ($request->type == "true_false") {
            $new_question->solution = $request->true_false_solution;
        } else {
            $new_question->solution = $request->solution;
        }

        if ($request->type == "many_choice") {
            $new_question->choice = $request->choice;
        }

        $new_question->updated_by = $this->user->id;

        $new_question->save();

        $new_question->categories()->sync($request->category_id);

        return redirect()->route('questions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::destroy($id);

        return redirect()->route('questions.index');
    }
}

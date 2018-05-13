<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Question;
use App\Models\Examination;
use App\Models\Permission;
use App\Models\User;
use App\Models\Exam;
use App\Models\LopHoc;

use Illuminate\Support\Facades\Schema;

use App\Http\Traits\GetUser;

use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
	public $user;
    public $current_menu_item;
    public $table;

    public function __construct () {
        $this->current_menu_item = 'classes';
        $this->table = 'classes';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$list_class = LopHoc::all();

        $data = [
            'list_item' => $list_class,
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
        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'create'
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
        $new_record = new LopHoc;

        $new_record->name = $request->name;
        $new_record->display_name = $request->display_name;
        $new_record->max_quantity = $request->max_quantity;
        $new_record->quantity = 0;

        $new_record->save();

        return redirect()->route('classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list_item = User::where('class_id', '=', $id)->get();
        $this->current_menu_item = 'users';
        $this->table = 'users';
        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'show class',
            'list_item' => $list_item,
            'class_id' => $id
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
        $item = LopHoc::findOrFail($id);
        $data = [
            'table' => $this->table,
            'current_menu_item' => $this->current_menu_item,
            'action' => 'edit',
            'item' => $item
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

        $item = LopHoc::findOrFail($id);

        $item->name = $request->name;
        $item->display_name = $request->display_name;
        $item->max_quantity = $request->max_quantity;

        $teacher = User::where('email', '=', $request->email)->get();
        $item->teacher_id = $teacher->id;

        $item->save();

        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LopHoc::destroy($id);

        return redirect()->route('classes.index');
    }

    /**
     * Add User to class
     * @param [type] $id [description]
     */ 
    public function add_user($id) 
    {
        $data = [
            'class_id' => $id,
            'current_menu_item' => $this->current_menu_item
        ];
        return view('teacher.classes.add_user')->with($data);
    }

    /**
     * 
     */
    public function store_user(Request $request, $id) 
    {
        $class = LopHoc::find($id);
        $user = User::where('email', '=', $request->email)->get();
        $class->users()->save($user);
        $class->quantity = $class->quantity + 1;
        $class->save();

        return redirect()->route('classes.show', $id);
    }

    public function remove_user($id, $user_id)
    {
        $user = User::findOrFail($user_id);         
        $user->class_id = null;
        $user->save();
        $class = LopHoc::findOrFail($id);
        $class->quantity = $class->quantity - 1;
        $class->save();
        return redirect()->route('classes.show', $id);
    }
}

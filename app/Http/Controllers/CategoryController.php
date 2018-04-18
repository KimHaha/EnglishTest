<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use Illuminate\Support\Facades\Schema;

use App\Http\Traits\GetUser;

use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public $user;
    public $current_menu_item;
    public $table;

    public function __construct () {
        $this->current_menu_item = 'categories';
        $this->table = 'categories';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_category = Category::all();

        $data = [
            'list_item' => $list_category,
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
        $this->user = Auth::user();

        $new_record = new Category;

        $new_record->name = $request->name;
        $new_record->display_name = $request->display_name;
        $new_record->description = $request->description;

        $new_record->created_by = $this->user->id;
        $new_record->updated_by = $this->user->id;

        $new_record->save();

        return redirect()->route('categories.index');
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
        $item = Category::findOrFail($id);
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

        $item = Category::findOrFail($id);

        $item->name = $request->name;
        $item->display_name = $request->display_name;
        $item->description = $request->description;

        $item->updated_by = $this->user->id;

        $item->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return redirect()->route('categories.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models
use App\Models\Permission;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public $current_menu_item = 'users';
    public $table = 'users';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_list = User::all();

        $data = [
            'current_menu_item' => $this->current_menu_item,
            'list_item' => $item_list,
            'table' => $this->table
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
        $user = User::findOrFail($id);
        $role_list = Role::all();

        $data = [
            'user' => $user,
            'current_menu_item' => $this->current_menu_item,
            'role_list' => $role_list
        ];

        return view('admin.users.user_edit')->with($data);
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
        $user = User::findOrFail($id);
        $role = Role::findOrFail($request->role_id);

        $user->detachRoles();
        $user->attachRole($role);

        return redirect()->route('users.index');
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
}

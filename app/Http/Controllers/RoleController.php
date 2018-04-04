<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

// request
//
use App\Http\Requests\StoreRolePost;
use App\Http\Requests\UpdateRolePut;

class RoleController extends Controller
{
    public $current_menu_item = 'roles';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_list = Role::all();

        $data = array(
            'role_list' => $role_list,
            'current_menu_item' => $this->current_menu_item
        );

        return view('admin.role_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolePost $request)
    {
        $new_role = new Role();
        $new_role->name = $request->name;
        $new_role->display_name = $request->display_name;
        $new_role->description = $request->description;

        $new_role->save();

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        $permission_list = $role->permissions;

        $data = [
            'role'            => $role,
            'permission_list' => $role->permissions
        ];

        return view('admin.role_list_permission')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('id', '=', $id)->first();

        $data = array ('role' => $role);

        return view('admin.role_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolePut $request, $id)
    {
        $role = Role::where('id', '=', $id)->first();

        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->save();

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('roles.index');
    }


    /**
     * Add permission for role
     */
    public function edit_permission($id)
    {

    }
}

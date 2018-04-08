<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models
use App\Models\Permission;
use App\Models\User;
use App\Models\Role;

class RolePermissionController extends Controller
{
    public $current_menu_item = 'roles';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role_id)
    {
        $role = Role::findOrFail($role_id);

        $data = [
            'role' => $role,
            'current_menu_item' => $this->current_menu_item
        ];
        return view('admin.roles.role_list_permission')->with($data);
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
    public function destroy($role_id, $permission_id)
    {
        $role = Role::findOrFail($role_id);
        $permission = Permission::findOrFail($permission_id);

        $role->detachPermission($permission);

        return redirect()->route('roles.permissions.index', $role_id);
    }
}

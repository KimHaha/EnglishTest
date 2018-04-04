<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permission;


// request

use App\Http\Requests\StorePermissionPost;
use App\Http\Requests\UpdatePermissionPut;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission_list = Permission::all();

        $data = ['permission_list' => $permission_list];

        return view('admin.permission_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionPost $request)
    {
        $new_permission = new Permission ();

        $new_permission->name = $request->name ;
        $new_permission->display_name = $request->display_name ;
        $new_permission->description = $request->description ;

        $new_permission->save();

        return redirect()->route('permissions.index');
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
        $permission = Permission::find($id);

        $data = array ('permission' => $permission);
        return view('admin.permission_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionPut $request, $id)
    {
        $permission = Permission::find($id);

        $permission->name         = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description  = $request->description;

        $permission->save();

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::destroy($id);

        return redirect()->route('permissions.index');
    }
}

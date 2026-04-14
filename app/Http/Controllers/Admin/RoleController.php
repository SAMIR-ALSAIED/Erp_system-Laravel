<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct()
{
    $this->middleware('role:admin');
}


    //   public function __construct()
    // {
    //     // تأكد Middleware حسب الدور
    //     $this->middleware('role:admin');
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles=Role::all();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();


        return view('roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddRoleRequest $request)
    {
        $data=$request->validated();

        // Role::create($data);

        // dd($request->all());


    $role = Role::create(['name' => $request->name]);


    // ربط الصلاحيات
    // $role->syncPermissions($request->permissions); // أسماء الصلاحيات

        // $role->assignRole($request->role);

//    $role->load('permissions');

    $role->syncPermissions($data['permissions']);



        return redirect()->route('roles.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

            $permission = Permission::all();

            return view('roles.edit',compact('role','permission'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {

             $data=$request->validated();

             $role->update();

                 $role->syncPermissions($data['permissions'] ?? []);

                 return redirect()->route('roles.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {

        if ($role->name === 'admin') {
        return redirect()->route('roles.index')
            ->with('error', 'لا يمكن حذف صلاحية المدير');
    }
        $role->delete();

        return back();
    }
}

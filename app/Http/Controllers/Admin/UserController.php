<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Pest\Support\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\View\View as IlluminateView;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::all();

        return View('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
//     public function store(AddUserRequest $request)
//     {
// $data = $request->validated();
// $data['password'] = Hash::make($data['password']);

// $user = User::create($data);
// $user->assignRole($request->role);

//         return redirect()->route('users.index');



//     }



public function store(AddUserRequest $request)
{
    $data = $request->validated();
    $data['password'] = Hash::make($data['password']);

    $user = User::create($data);
    // تعيين الدور
    $user->assignRole($request->roles_name);

    // تعيين الصلاحيات المحددة من checkbox (لو فيه)
    if ($request->has('permissions')) {
        $user->syncPermissions($request->permissions);
    }

    return redirect()->route('users.index');
}


    public function edit(User $user)
    {

     $roles = Role::all();

        return view('users.edit',compact('user','roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateUserRequest $request, User $user)
    // {
    //     $data=$request->validated();

    //         if ($request->filled('password')) {
    //     $data['password'] = Hash::make($request->password);
    // } else {
    //     unset($data['password']); // لو فاضي نحتفظ بالباسورد القديم
    // }

    //     $user->update($data);

    //     return redirect()->route('users.index')->with('update','تم تعديل بيانات المستخدم بناجح');
    // }


    public function update(UpdateUserRequest $request, User $user)
{
    $data = $request->validated();

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    } else {
        unset($data['password']);
    }

    $user->update($data);

    // تحديث الدور
    $user->syncRoles($request->role);

    // تحديث الصلاحيات
    if ($request->has('permissions')) {
        $user->syncPermissions($request->permissions);
    }

    return redirect()->route('users.index')->with('update','تم تعديل بيانات المستخدم بنجاح');
}


    /**
     *
     *
     *
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
    
        if ($user->hasRole('admin')) {
        return redirect()->route('users.index')
            ->with('error', 'لا يمكن حذف المدير');
    }

    if ($user->id === auth()->id()) {
        return redirect()->route('users.index')
            ->with('error', 'لا يمكنك حذف حسابك أنت');
    }

        $user->delete();

        return back();
    }
}

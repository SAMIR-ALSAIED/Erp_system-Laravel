<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddcategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {

        $categories=Category::paginate(6);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddcategoryRequest $request)
    {
                $data=$request->validated();
    $data['Created_by'] = Auth::user()->name;
 Category::create($data);


    return redirect()->back()->with('success', 'تم إضافة القسم بنجاح');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( UpdatecategoryRequest $request,Category $category)
    {
            $data = $request->validated();


    $category->update($data);
        return redirect()->back()->with('update', 'تم تعديل القسم بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('error', 'تم حذف القسم بنجاح');
    }
}

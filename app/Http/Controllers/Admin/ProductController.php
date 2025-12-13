<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {


$categories = Category::all();
$products = Product::paginate(9);

        return view('products.index',compact('categories','products'));
    }


    public function create()
    {
        //
    }


    public function store(AddProductRequest $request)
    {

        $data=$request->validated();

         Product::create($data);
        return redirect()->back()->with('success', 'تم إضافة المنتج بنجاح');



    }



    public function edit(string $id)
    {
        //
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
           $data = $request->validated();


    $product->update($data);
        return redirect()->back()->with('update', 'تم تعديل المنتج بنجاح');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('error', 'تم حذف المنتج بنجاح');

    }
}


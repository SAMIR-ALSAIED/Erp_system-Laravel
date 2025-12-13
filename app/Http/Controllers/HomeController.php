<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

  $categoriesCount = Category::count();
        $productsCount   = Product::count();
        $invoicesCount   = Invoice::count();
        $usersCount   = User::count();

        return view('home',compact(
            'categoriesCount',
            'productsCount',
            'usersCount',
            'invoicesCount'
        ));

    }
}

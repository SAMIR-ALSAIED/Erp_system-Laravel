<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\InvoiceReportController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InvoiceDetailsController;
use App\Http\Controllers\Admin\RoleController;


Route::get('/', function () {
    return view('auth.login');
});

// Auth routes
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

Route::middleware(['auth'])->group(function () {


    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);


    Route::resource('invoices', InvoiceController::class)
        ->parameters(['invoices' => 'invoice']);

    Route::resource('invoicesdetails', InvoiceDetailsController::class);


    Route::get('export/invoices', [InvoiceController::class, 'export'])->name('exportInvoices');

    Route::get('/invoicepaid', [InvoiceController::class,'paid'])->name('invoice.paid');
    Route::get('/invoiceunpaid', [InvoiceController::class,'unpaid'])->name('invoice.unpaid');

    Route::get('/category/{id}', [InvoiceController::class, 'getproducts']);
//reports

Route::get('reports/invoices', [InvoiceReportController::class,'index'])->name('reports.invoices');
Route::post('reports/invoices/search', [InvoiceReportController::class, 'search'])->name('reports.invoices.search');


Route::resource('roles',RoleController::class);

    // Users
    Route::resource('users', UserController::class);

    // Route عام للصفحات الأخرى (آخر حاجة)
    Route::get('/{page}', [AdminController::class, 'index']);
});

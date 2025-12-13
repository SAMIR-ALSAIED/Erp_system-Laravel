<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\InvoiceExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Termwind\Components\Dd;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $invoices=Invoice::paginate(5);

        // dd(auth()->user()->roles_name);
        return view('invoices.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
                $categories=Category::all();

       return view('invoices.add_invoice',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateInvoiceRequest $request)
    {

                        $data=$request->validated();

  if ($request->status == 'مدفوعة') {
        $data['value_status'] = 1;
    } elseif ($request->status == 'غير مدفوعة') {
        $data['value_status'] = 2;
    }
                        Invoice::create($data);
                        return Redirect()->route('invoices.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {

    $categories = Category::all();
       return view('invoices.PrintInvoice',compact('invoice','categories'));
    }
    // }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Invoice $invoice)
{

    $categories = Category::all();


    return view('invoices.edit_invoice', compact('invoice','categories'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {

         $data=$request->validated();
             // حساب القيمة الرقمية للحالة
    if ($request->status == 'مدفوعة') {
        $data['value_status'] = 1; // أو $data['total'] لو تحب حسب الفاتورة
    } elseif ($request->status == 'غير مدفوعة') {
        $data['value_status'] = 2;
    } elseif ($request->status == 'مدفوعة جزئياً') {
        $data['value_status'] = 3; // حسب احتياجك
    }
        $invoice->update($data);

        return redirect()->route('invoices.index')->with('update', 'تم تعديل الفاتورة بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return back();
    }


    public function getproducts($id){

        $products=DB::table('products')->where('category_id',$id)->select('name','id','price')->get();
        return json_encode($products);
    }


     public function export()
    {
        return Excel::download(new InvoiceExport, 'InvoiceExport.xlsx');
    }


    public function paid()
    {

        $invoices = invoice::where('value_status','1')->get();
        return view('invoices.paid',compact('invoices'));

    }

    public function unpaid()
    {


        $invoices = invoice::where('value_status','2')->get();
        return view('invoices.unpaid',compact('invoices'));

    }

    public function printInvoice(Invoice $invoice ){

        return view('invoices.PrintInvoice',compact('invoice'));

    }





}

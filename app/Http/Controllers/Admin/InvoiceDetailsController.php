<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Illuminate\Http\Request;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

        $invoices=Invoice::where('id',$id)->first();
        $details=InvoiceDetails::where('id_Invoice',$id)->get();

        return view('Invoices.InvoicesDetails', compact('invoices','details'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

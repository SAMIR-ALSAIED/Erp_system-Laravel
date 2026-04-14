<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InvoiceReportController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('reports.invoices', compact('invoices'));
    }

    public function search(Request $request)
    {
        $query = Invoice::query();

        if ($request->value_status) {
            $query->where('value_status', $request->value_status);
        }

        if ($request->start_at && $request->end_at) {
            $query->whereBetween('invoice_date', [$request->start_at, $request->end_at]);
        }

        if ($request->client_name) {
            $query->where('name_client', 'like', '%' . $request->client_name . '%');
        }

        $invoices = $query->get();

        return view('reports.invoices', compact('invoices'));
    }
}
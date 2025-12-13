<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InvoiceReportController extends Controller
{
    public function index()
    {
        return view('reports.invoices');
    }

    public function search(Request $request)
{
    $query = Invoice::query();

    if ($request->type === 'status' && $request->value_status) {
        $query->where('value_status', $request->value_status);
    }

    if ($request->type === 'date') {
        if ($request->start_at && $request->end_at) {
            $query->whereBetween('invoice_date', [$request->start_at, $request->end_at]);
        } elseif ($request->start_at) {
            $query->where('invoice_date', '>=', $request->start_at);
        } elseif ($request->end_at) {
            $query->where('invoice_date', '<=', $request->end_at);
        }
    }

    $invoices = $query->get();

    return view('reports.invoices', compact('invoices'));
}



}

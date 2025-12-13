<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
      protected $fillable = [
        'id_Invoice',
        'invoice_Date',
        'due_Date',
        'product_id',
        'category_id',
        'rate_vat',
        'value_vat',
        'value_vat',
        'total',
        'status',
        'value_status',
        'notes',
    ];
}

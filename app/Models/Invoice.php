<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     protected $fillable = [
        'name_client',
        'invoice_number',
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
        'amount_paid',
'remaining',
'quantity'

    ];

    protected $casts = [
    'invoice_Date' => 'date',
    'due_Date' => 'date',
];


        public function category()
    {
        return $this->belongsTo(Category::class);
    }
        public function product()
    {
        return $this->belongsTo(Product::class);
    }

}

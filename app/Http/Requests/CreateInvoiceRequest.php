<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name_client'     => 'required|string|max:150',
        'invoice_number'  => 'required|string|max:255|unique:invoices,invoice_number,' . $this->invoice?->id,
        'invoice_Date'    => 'required|date',
        'due_Date'        => 'required|date|after_or_equal:invoice_Date',
        'product_id'      => 'required|exists:products,id',
        'category_id'     => 'required|exists:categories,id',
        'quantity'        => 'required|integer|min:1',
        'Amount_Commission'=> 'nullable|numeric|min:0',
        'Discount'        => 'nullable|numeric|min:0',
        'rate_vat'        => 'required|integer|in:5,10',
        'value_vat'       => 'required|numeric|min:0',
        'total'           => 'required|numeric|min:0',
        'status'          => 'required|string|in:مدفوعة,غير مدفوعة,مدفوعة جزئياً',
        'value_status'    => 'required|integer',
        'notes'           => 'nullable|string',

        ];
    }
}

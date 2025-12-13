@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/jquery-ui/themes/base/all.css') }}">
@endsection

@section('title')
تعديل فاتورة
@stop

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="page-title">تعديل الفاتورة</h4>
    </div>
</div>
@endsection

@section('content')

@if (session()->has('Edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>⚠️ هناك بعض الأخطاء في الإدخال:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- بيانات الفاتورة --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>رقم الفاتورة</label>
                            <input type="text" class="form-control" name="invoice_number"
                                   value="{{ old('invoice_number', $invoice->invoice_number) }}" required>
                        </div>
                        <div class="col">
                            <label>اسم العميل</label>
                            <input type="text" class="form-control" name="name_client"
                                   value="{{ old('name_client', $invoice->name_client) }}" required>
                        </div>
                        <div class="col">
                            <label>تاريخ الفاتورة</label>
                            <input class="form-control fc-datepicker" name="invoice_Date"
                                   value="{{ old('invoice_Date', \Carbon\Carbon::parse($invoice->invoice_Date)->format('Y-m-d')) }}"
                                   type="text" required>
                        </div>
                        <div class="col">
                            <label>تاريخ الاستحقاق</label>
                            <input class="form-control fc-datepicker" name="due_Date"
                                   value="{{ old('due_Date', \Carbon\Carbon::parse($invoice->due_Date)->format('Y-m-d')) }}"
                                   type="text" required>
                        </div>
                    </div>

                    {{-- القسم والمنتج --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>القسم</label>
                            <select name="category_id" class="form-control SlectBox" required>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $invoice->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label>المنتج</label>
                            <select id="product_id" name="product_id" class="form-control" required>
                                <option value="{{ $invoice->product_id }}" selected
                                        data-price="{{ $invoice->product->price }}">
                                    {{ $invoice->product->name }}
                                </option>
                            </select>
                        </div>

                        <div class="col">
                            <label>سعر المنتج</label>
                            <input type="text" class="form-control" id="product_price"
                                   value="{{ $invoice->product->price }}" readonly>
                        </div>

                        <div class="col">
                            <label>الكمية</label>
                            <input type="number" class="form-control" id="Quantity" name="quantity"
                                   value="{{ $invoice->quantity }}" min="1"
                                   oninput="this.value=this.value.replace(/[^0-9]/g,''); calculateTotal();" required>
                        </div>
                    </div>

                    {{-- العمولة والخصم والضريبة --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>مبلغ العمولة</label>
                            <input type="number" step="0.01" id="commission" class="form-control"
                                   name="Amount_Commission" value="{{ $invoice->Amount_Commission }}">
                        </div>
                        <div class="col">
                            <label>الخصم</label>
                            <input type="number" step="0.01" id="discount" class="form-control"
                                   name="Discount" value="{{ $invoice->Discount }}">
                        </div>
                        <div class="col">
                            <label>نسبة الضريبة</label>
                            <select id="vat_rate" name="rate_vat" class="form-control">
                                <option value="5" {{ $invoice->rate_vat==5?'selected':'' }}>5%</option>
                                <option value="10" {{ $invoice->rate_vat==10?'selected':'' }}>10%</option>
                            </select>
                        </div>
                    </div>

                    {{-- الضريبة والإجمالي --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>قيمة الضريبة</label>
                            <input type="text" id="vat_value" class="form-control"
                                   name="value_vat" value="{{ $invoice->value_vat }}" readonly>
                        </div>
                        <div class="col">
                            <label>الإجمالي</label>
                            <input type="text" id="total" class="form-control"
                                   name="total" value="{{ $invoice->total }}" readonly>
                        </div>
                    </div>

                    {{-- الحالة --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>حالة الفاتورة</label>
                            <select id="status" name="status" class="form-control">
                                <option value="مدفوعة" {{ $invoice->status=='مدفوعة'?'selected':'' }}>مدفوعة</option>
                                <option value="غير مدفوعة" {{ $invoice->status=='غير مدفوعة'?'selected':'' }}>غير مدفوعة</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>القيمة الرقمية</label>
                            <input type="text" id="value_status" name="value_status"
                                   value="{{ $invoice->value_status }}" class="form-control" readonly>
                        </div>
                    </div>

                    {{-- الملاحظات --}}
                    <div class="row mb-4">
                        <div class="col">
                            <label>ملاحظات</label>
                            <textarea class="form-control" name="notes" rows="3">{{ $invoice->notes }}</textarea>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">تحديث الفاتورة</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

<script>
$(document).ready(function(){

    $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });

    // تحميل المنتجات عند اختيار القسم
    $('select[name="category_id"]').on('change', function() {
        var catId = $(this).val();
        var productSelect = $('select[name="product_id"]');
        productSelect.prop('disabled', true).html('<option>جارٍ التحميل...</option>');

        if(catId){
            $.ajax({
                url: "{{ URL::to('category') }}/" + catId,
                type: "GET",
                dataType: "json",
                success: function(data){
                    productSelect.prop('disabled', false).empty().append('<option selected disabled>اختر المنتج</option>');
                    if(data.length > 0){
                        $.each(data, function(index, product){
                            var selected = product.id == "{{ $invoice->product_id }}" ? 'selected' : '';
                            productSelect.append('<option value="'+product.id+'" data-price="'+product.price+'" '+selected+'>'+product.name+'</option>');
                        });
                    } else {
                        productSelect.append('<option disabled>لا يوجد منتجات</option>');
                    }
                    calculateTotal();
                },
                error: function(){
                    productSelect.prop('disabled', false).html('<option disabled>حدث خطأ، حاول مرة أخرى</option>');
                }
            });
        }
    });

    // عرض السعر عند اختيار المنتج
    $('select[name="product_id"]').on('change', function(){
        var price = parseFloat($(this).find(':selected').data('price')) || 0;
        $('#product_price').val(price.toFixed(2));
        calculateTotal();
    });

    // تحديث الحقول الحسابية عند أي تغيير
    $('#commission, #discount, #vat_rate, #Quantity, #product_price, #status').on('input change', calculateTotal);

    // دالة الحساب
    function calculateTotal(){
        var price = parseFloat($('#product_price').val()) || 0;
        var quantity = parseInt($('#Quantity').val()) || 1;
        var commission = parseFloat($('#commission').val()) || 0;
        var discount = parseFloat($('#discount').val()) || 0;
        var vatRate = parseFloat($('#vat_rate').val()) || 0;

        // حساب الإجمالي قبل الضريبة
        var totalBeforeVat = (price * quantity) + commission - discount;

        // حساب الضريبة
        var vatValue = totalBeforeVat * (vatRate / 100);

        // الإجمالي النهائي
        var total = totalBeforeVat + vatValue;

        // تحديث الحقول
        $('#vat_value').val(vatValue.toFixed(2));
        $('#total').val(total.toFixed(2));

        // القيمة الرقمية للحالة كـ integer
        var status = $('#status').val();
        var valueStatus = (status === 'مدفوعة') ? total : 0;
        $('#value_status').val(Math.round(valueStatus));
    }

    // حساب أولي عند تحميل الصفحة
    calculateTotal();

});
</script>
@endsection

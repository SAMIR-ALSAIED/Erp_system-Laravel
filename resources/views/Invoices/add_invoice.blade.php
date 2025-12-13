@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection

@section('title')
إضافة فاتورة
@stop

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="page-title">إضافة فاتورة جديدة</h4>
    </div>
</div>
@endsection

@section('content')

@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf

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

                    {{-- الصف الأول --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>رقم الفاتورة</label>
                            <input type="text" class="form-control" name="invoice_number" placeholder="أدخل رقم الفاتورة" required>
                        </div>
                        <div class="col">
                            <label>اسم العميل</label>
                            <input type="text" class="form-control" name="name_client" placeholder="أدخل اسم العميل" required>
                        </div>
                        <div class="col">
                            <label>تاريخ الفاتورة</label>
                            <input class="form-control fc-datepicker" value="{{ date('Y-m-d') }}" name="invoice_Date" type="text" required>
                        </div>
                        <div class="col">
                            <label>تاريخ الاستحقاق</label>
                            <input class="form-control fc-datepicker" value="{{ date('Y-m-d') }}" name="due_Date" type="text" required>
                        </div>
                    </div>

                    {{-- الصف الثاني --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>القسم</label>
                            <select name="category_id" class="form-control SlectBox" required>
                                <option value="" selected disabled>حدد القسم</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label>المنتج</label>
                            <select id="product_id" name="product_id" class="form-control" required>
                                <option value="" selected disabled>اختر المنتج</option>
                            </select>
                        </div>

                        <div class="col">
                            <label>سعر المنتج</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" readonly>
                        </div>

                        <div class="col">
                            <label>الكمية</label>
                            <input type="number" class="form-control" id="Quantity" name="quantity" value="1" min="1"
                                oninput="this.value=this.value.replace(/[^0-9]/g,''); calculateTotal();" required>
                        </div>
                    </div>

                    {{-- الصف الثالث --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>الخصم</label>
                            <input type="text" class="form-control" id="Discount" name="Discount" value="0"
                                oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1'); calculateTotal();">
                        </div>

                        <div class="col">
                            <label>نسبة ضريبة القيمة المضافة</label>
                            <select name="rate_vat" id="rate_vat" class="form-control" required>
                                <option value="" selected disabled>حدد نسبة الضريبة</option>
                                <option value="5">5%</option>
                                <option value="10">10%</option>
                            </select>
                        </div>
                    </div>

                    {{-- الصف الرابع: الضريبة والإجمالي --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>قيمة الضريبة</label>
                            <input type="text" class="form-control" id="Value_VAT" name="value_vat" readonly>
                        </div>
                        <div class="col">
                            <label>الإجمالي شامل الضريبة</label>
                            <input type="text" class="form-control" id="Total" name="total" readonly>
                        </div>
                    </div>

                    {{-- الصف السادس: الحالة --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label>حالة الفاتورة</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="" selected disabled>اختر الحالة</option>
                                <option value="مدفوعة" data-value="1">مدفوعة</option>
                                <option value="غير مدفوعة" data-value="2">غير مدفوعة</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>القيمة الرقمية للحالة</label>
                            <input type="text" class="form-control" id="value_status" name="value_status" readonly>
                        </div>
                    </div>

                    {{-- الملاحظات --}}
                    <div class="row mb-4">
                        <div class="col">
                            <label>ملاحظات</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="اكتب أي ملاحظات هنا..."></textarea>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">حفظ البيانات</button>
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
                        productSelect.append('<option value="'+product.id+'" data-price="'+product.price+'">'+product.name+'</option>');
                    });
                } else {
                    productSelect.append('<option disabled>لا يوجد منتجات</option>');
                }
                $('#product_price, #Quantity').val(1);
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

// ضبط القيمة الرقمية للحالة
$('#status').on('change', function(){
    var val = $(this).find(':selected').data('value');
    $('#value_status').val(val || '');
});

// تحديث الحساب عند أي تغيير
$('#Discount, #rate_vat, #Quantity, #product_price').on('input change', calculateTotal);

// دالة الحساب الأساسية
function calculateTotal(){
    var price = parseFloat($('#product_price').val()) || 0;
    var quantity = parseInt($('#Quantity').val()) || 1;
    var discount = parseFloat($('#Discount').val()) || 0;
    var rate = parseFloat($('#rate_vat').val()) || 0;

    // 1️⃣ إجمالي المنتجات
    var totalProducts = price * quantity;

    // 2️⃣ تطبيق الخصم (لا يزيد عن إجمالي المنتجات)
    if(discount > totalProducts) discount = totalProducts;
    var afterDiscount = totalProducts - discount;

    // 3️⃣ حساب الضريبة
    var vatValue = afterDiscount * (rate / 100);

    // 4️⃣ الإجمالي النهائي
    var total = afterDiscount + vatValue;

    // تحديث الحقول
    $('#Value_VAT').val(vatValue.toFixed(2));
    $('#Total').val(total.toFixed(2));
}
</script>
@endsection

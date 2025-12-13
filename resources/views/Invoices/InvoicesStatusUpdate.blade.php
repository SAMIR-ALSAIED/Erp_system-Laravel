{{-- @extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection

@section('title')
    تعديل فاتورة
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



    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{route('Invoices.update',$invoice->id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                        {{-- الصف الأول --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label class="control-label">رقم الفاتورة</label>
                                <input type="text" disabled class="form-control" name="invoice_number" placeholder="أدخل رقم الفاتورة" value="{{$invoice->invoice_number}}">
                            </div>
                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" disabled value="{{$invoice->invoice_Date->format('m/d/Y')}}"   name="invoice_Date"  type="text">
                            </div>
                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" disabled value="{{$invoice->due_Date->format('m/d/Y')}}" name="due_Date"type="text">
                            </div>
                        </div>

                        {{-- الصف الثاني --}}
                        {{-- <div class="row mb-3">
                            <div class="col">
                                <label class="control-label">القسم</label>
                                <select disabled  name="category_id" class="form-control SlectBox">
                                    <option value="" selected disabled>حدد القسم</option>
                                    @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', isset($invoice) ? $invoice->category_id : '') == $cat->id ? 'selected' : '' }}>
    {{ $cat->name }}
</option> --}}
{{--
                                    @endforeach
                                </select>
                            </div> --}}

                            {{-- <div class="col">
                                <label class="control-label">المنتج</label>
                                <select id="product_id" name="product_id" class="form-control">
                                    <option value="" selected disabled>اختر المنتج</option>
                                </select>
                            </div> --}}

                            {{-- <div class="col">
    <label class="control-label">المنتج</label>
    <select disabled id="product_id" name="product_id" class="form-control">
        @if(isset($invoice))
            {{-- في حالة التعديل --}}
            <option value="{{ $invoice->product_id }}" selected>
                {{ $invoice->product->name ?? 'المنتج الحالي' }}
            {{-- </option>
        @else
            {{-- في حالة الإضافة --}}
            <option value="" selected disabled>اختر المنتج</option>
        @endif
    </select>
</div>

                            {{-- <div class="col">
                                <label class="control-label">سعر المنتج</label>
                                <input type="text" class="form-control" id="product_price" name="product_price" readonly  >

                            </div> --}}

                            <div class="col">
    <label class="control-label">سعر المنتج</label>
    <input

        type="text"
            disabled
        class="form-control"
        id="product_price"
        name="product_price"
        readonly
        value="{{ old('product_price', isset($invoice) ? $invoice->product->price : '') }}"
    >
</div>

                        </div>

                        {{-- الصف الثالث --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label class="control-label">مبلغ العمولة</label>
                        <input type="text" disabled class="form-control" id="Amount_Commission" name="Amount_Commission"
         value="{{ old('product_price', isset($invoice) ? $invoice->product->price : '') }}"

       placeholder="أدخل مبلغ العمولة"
       oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1');">

                            </div>

                            <div class="col">
                                <label class="control-label">الخصم</label>
                                <input type="text" disabled class="form-control" id="Discount" name="Discount" value="{{$invoice->rate_vat}}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1');">
                            </div>

                            <div class="col">
                                <label class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select disabled name="rate_vat" id="rate_vat" class="form-control" onchange="myFunction()">
                                    <option value="" selected disabled>حدد نسبة الضريبة</option>
                                      <option value="5" {{ $invoice->rate_vat == 5 ? 'selected' : '' }}>5%</option>
            <option value="10" {{ $invoice->rate_vat == 10 ? 'selected' : '' }}>10%</option>
                                </select>
                            </div>
                        </div>

                        {{-- الصف الرابع --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label class="control-label">قيمة الضريبة</label>
                                <input type="text" disabled class="form-control" id="Value_VAT" name="value_vat" readonly value="{{$invoice->value_vat}}">
                            </div>
                            <div class="col">
                                <label class="control-label">الإجمالي شامل الضريبة</label>
                                <input type="text" disabled class="form-control" id="Total" name="total" readonly value="{{$invoice->total}}">
                            </div>
                        </div>
{{--
                        {{-- الصف الخامس (الحالة) --}}
             <div class="row mb-3">
    <div class="col">
        <label class="control-label">حالة الفاتورة</label>
        <select name="status" id="status" class="form-control">
            <option value="" disabled>اختر الحالة</option>
            <option value="مدفوعة" >مدفوعة</option>
            <option value="غير مدفوعة">غير مدفوعة</option>
            <option value="مدفوعة جزئياً" >مدفوعة جزئياً</option>
        </select>
    </div>

    <div class="col">
        <label class="control-label">  تاريخ الدفع</label>
      <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" disabled value="{{$invoice->invoice_Date->format('m/d/Y')}}"   name="invoice_Date"  type="text">
                            </div>
    </div>
</div>


                        {{-- الملاحظات --}}
                        <div class="row mb-4">
                            <div class="col">
                                <label>ملاحظات</label>
                                <textarea class="form-control" name="notes" rows="3" placeholder="اكتب أي ملاحظات هنا...">{{$invoice->notes}}</textarea>
                            </div>
                        </div>

                        {{-- زر الحفظ --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"> حفظ البيانات</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Internal Scripts -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script> --}}

    {{-- <script>
        $('.fc-datepicker').datepicker({ dateFormat: 'yy-mm-dd' });

        // عند اختيار القسم - تحميل المنتجات
        $('select[name="category_id"]').on('change', function() {
            var catId = $(this).val();
            if (catId) {
                $.ajax({
                    url: "{{ URL::to('category') }}/" + catId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var productSelect = $('select[name="product_id"]');
                        productSelect.empty();
                        productSelect.append('<option selected disabled>اختر المنتج</option>');
                        $.each(data, function(index, product) {
                            productSelect.append('<option value="' + product.id + '" data-price="' + product.price + '">' + product.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('حدث خطأ أثناء تحميل المنتجات!');
                    }
                });
            }
        });

        // عند اختيار المنتج - عرض السعر تلقائياً
        $('select[name="product_id"]').on('change', function() {
            var price = $(this).find(':selected').data('price') || 0;
            $('#product_price').val(price);
            $('#Amount_Commission').val(price);
        });

        // عند اختيار الحالة - ضبط القيمة الرقمية
        $('#status').on('change', function() {
            var val = $(this).val();
            if (val === 'مدفوعة') $('#value_status').val(1);
            else if (val === 'غير مدفوعة') $('#value_status').val(2);
            else if (val === 'مدفوعة جزئياً') $('#value_status').val(3);
            else $('#value_status').val('');
        });

        // دالة حساب الضريبة والإجمالي
        function myFunction() {
            var commission = parseFloat($('#Amount_Commission').val()) || 0;
            var discount = parseFloat($('#Discount').val()) || 0;
            var rate = parseFloat($('#rate_vat').val()) || 0;

            if (commission === 0) {
                alert('يرجى إدخال مبلغ العمولة أولاً');
                return;
            }

            var afterDiscount = commission - discount;
            var vatValue = afterDiscount * (rate / 100);
            var total = afterDiscount + vatValue;

            $('#Value_VAT').val(vatValue.toFixed(2));
            $('#Total').val(total.toFixed(2));
        }
    </script> --}}
@endsection

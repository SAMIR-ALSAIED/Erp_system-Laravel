@extends('layouts.master')


@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعة الفاتورة</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-md-12 col-xl-12">
        <div class="card card-invoice">
            <div class="card-body">
                <!-- Header -->
                <div class="invoice-header d-flex justify-content-between align-items-center" id="print">
                    <h1 class="invoice-title">فاتورة رقم {{ $invoice->invoice_number }}</h1>
                    <div>
                        <button  id="print_Button" onclick="printDiv()" class="btn btn-primary no-print"><i class="mdi mdi-printer"></i> طباعة</button>
                    </div>
                </div>

                <!-- بيانات الشركة والعميل -->
                <div class="row mg-t-20">
                    <div class="col-md-6 billed-from">
                        <h6>من:</h6>
                        <p>اسم الشركة<br>العنوان<br> الهاتف: 01225399159</p>
                    </div>
                    <div class="col-md-6 billed-to">
                        <h6>إلى:</h6>
                        <p>اسم العميل: {{ $invoice->name_client}} </p>
                        <p>تاريخ الإصدار: {{ $invoice->invoice_Date ? $invoice->invoice_Date->format('d/m/Y') : '—' }}</p>
                        <p>تاريخ الاستحقاق: {{ $invoice->due_Date ? $invoice->due_Date->format('d/m/Y') : '—' }}</p>
                    </div>
                </div>

                <!-- جدول المنتجات -->
                <div class="table-responsive mg-t-20">
                    <table class="table table-invoice table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>المنتج</th>
                                <th>القسم</th>
                                <th>الكمية</th>
                                <th>سعر الوحدة</th>
                                <th>الضريبة (%)</th>
                                <th>الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $invoice->product->name ?? '—' }}</td>
                                <td>{{ $invoice->category->name ?? '—' }}</td>
                                <td>1</td>
                                <td>{{ $invoice->total - $invoice->value_vat }}</td>
                                <td>{{ $invoice->rate_vat }}%</td>
                                <td>{{ $invoice->total }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>

                            </tr>
                            <tr>
                                <th colspan="5" class="text-right">قيمة الضريبة:</th>
                                <th>{{ $invoice->value_vat }}</th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right">الإجمالي:</th>
                                <th>{{ $invoice->total }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- ملاحظات -->


            </div>
        </div>
    </div>
</div>

{{-- <script>

    function printDiv(){

        var printContents=document.getElementById('print').innerHtml;
        var Orginalcontents=document.body.innerHtml;
        document.body.innerHtml=printContents;

        window.print();
        document.body.innerHtml=printContents();
location.reaload();

    }






</script> --}}

<script>
function printDiv() {
    // نجيب الجزء اللي فيه الفاتورة فقط (بدون الهيدر)
    var printContents = document.querySelector('.card-invoice').outerHTML;

    // نفتح صفحة جديدة للطباعة فقط
    var printWindow = window.open('', '', 'height=700,width=900');
    printWindow.document.write('<html><head><title>فاتورة</title>');
    printWindow.document.write('<link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">');
    printWindow.document.write('<style>body{direction:rtl;padding:20px}.no-print{display:none}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    // نطبع المحتوى
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}
</script>


@endsection

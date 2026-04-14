@extends('layouts.master')

@section('title')
تقرير الفواتير
@endsection

@section('content')

<div class="card p-4">

    <form action="{{ route('reports.invoices.search') }}" method="POST">
        @csrf

        <div class="row mb-3">

            {{-- الحالة --}}
            <div class="col">
                <label>الحالة</label>
                <select name="value_status" class="form-control">
                    <option value="">اختر الحالة</option>
                    <option value="1">مدفوعة</option>
                    <option value="2">غير مدفوعة</option>
                    <option value="3">مدفوعة جزئياً</option>
                </select>
            </div>

            {{-- اسم العميل --}}
            <div class="col">
                <label>اسم العميل</label>

                <select name="client_name" class="form-control">
    <option value="">اختر العميل</option>

@foreach($invoices as $invoice)

        <option value="{{ $invoice->name_client }}">
            {{ $invoice->name_client }}
        </option>
    @endforeach
</select>
                
            </div>

        </div>

        <div class="row mb-3">

            {{-- من تاريخ --}}
            <div class="col">
                <label>من تاريخ</label>
                <input type="date" name="start_at" class="form-control">
            </div>

            {{-- إلى تاريخ --}}
            <div class="col">
                <label>إلى تاريخ</label>
                <input type="date" name="end_at" class="form-control">
            </div>

        </div>

        <button class="btn btn-primary mt-3">عرض التقرير</button>
        <a href="{{ route('reports.invoices') }}" class="btn btn-dark mt-3">رجوع</a>

    </form>

</div>

{{-- النتائج --}}
@if(isset($invoices))

<div class="card mt-4 p-3">

    <h4 class="mb-3">نتائج التقرير</h4>

    <div class="table-responsive">

        <table class="table table-bordered text-center">

            <thead>
                <tr>
                    <th>#</th>
                    <th>رقم الفاتورة</th>
                    <th>اسم العميل</th>
                    <th>تاريخ الفاتورة</th>
                    <th>تاريخ الاستحقاق</th>
                    <th>المنتج</th>
                    <th>القسم</th>
                    <th>الكمية</th>
                    <th>قيمة الضريبة</th>
                    <th>الإجمالي</th>
                    <th>ملاحظات</th>
                    <th>الحالة</th>
                </tr>
            </thead>

            <tbody>

                @forelse($invoices as $invoice)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->name_client }}</td>

                    <td>{{ optional($invoice->invoice_Date)->format('m/d/Y') }}</td>
                    <td>{{ optional($invoice->due_Date)->format('m/d/Y') }}</td>

                    <td>{{ optional($invoice->product)->name }}</td>
                    <td>{{ optional($invoice->category)->name }}</td>

                    <td>{{ $invoice->quantity }}</td>
                    <td>{{ $invoice->value_vat }}</td>
                    <td>{{ $invoice->total }} ج</td>

                    <td>{{ $invoice->notes ?? 'لا يوجد' }}</td>

                    <td>
                        @if($invoice->value_status == 1)
                            <span class="badge bg-success">{{ $invoice->status }}</span>
                        @elseif($invoice->value_status == 2)
                            <span class="badge bg-danger">{{ $invoice->status }}</span>
                        @else
                            <span class="badge bg-warning">{{ $invoice->status }}</span>
                        @endif
                    </td>

                </tr>

                @empty
                    <tr>
                        <td colspan="12" class="text-center text-danger">
                            لا توجد نتائج
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endif

@endsection
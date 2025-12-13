@extends('layouts.master')



@section('content')

<div class="card p-4">

    <form action="{{ route('reports.invoices.search')}}" method="POST">
        @csrf

        <div class="row mb-4">
            <div class="col">
                <label>نوع البحث</label>
                <select name="type" class="form-control">
                    <option value="status">بحث حسب حالة الفاتورة</option>
                    <option value="date">بحث حسب التاريخ</option>
                </select>
            </div>

            <!-- الحالة -->
            <div class="col">
                <label>الحالة</label>
                <select name="value_status" class="form-control">
                    <option value="1">مدفوعة</option>
                    <option value="2">غير مدفوعة</option>
                </select>
            </div>
        </div>

        <hr>

        <h5>بحث حسب التاريخ</h5>

        <div class="row mb-3">
            <div class="col">
                <label>من تاريخ</label>
                <input type="date" name="start_at" class="form-control">
            </div>

            <div class="col">
                <label>إلى تاريخ</label>
                <input type="date" name="end_at" class="form-control">
            </div>
        </div>



        <button class="btn btn-primary mt-3 ms-3">عرض التقرير</button>
        <a href="{{route('reports.invoices')}}" class="btn btn-dark mt-3 me-5">رجوع </a>
    </form>

</div>

@if(isset($invoices))
    <div class="card p-4 mt-4">
        <h4>نتائج التقرير</h4>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>رقم الفاتورة</th>
                    <th>التاريخ</th>
                    <th>القسم</th>
                    <th>الحالة</th>
                    <th>الإجمالي</th>
                </tr>
            </thead>

            <tbody>
                @foreach($invoices as $x)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $x->invoice_number }}</td>
                    <td>{{ $x->invoice_date }}</td>
                    {{-- <td>{{ $x->section->section_name }}</td> --}}
                    <td>{{ $x->status }}</td>
                    <td>{{ $x->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection

@extends('layouts.master')
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
    إضافة مستخدم
@stop

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <h4 class="page-title">إضافة مستخدم جديدة</h4>
        </div>
    </div>
@endsection

@section('content')



    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('roles.store') }}" method="POST">
    @csrf

    <!-- اسم الصلاحية -->
    <div class="col-md-6 mb-3">
        <label for="roleName" class="form-label">اسم الصلاحية</label>
        <input type="text" class="form-control" id="roleName" name="name" value="{{ old('name') }}" placeholder="أدخل اسم الصلاحية">
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- الصلاحيات -->
    <div class="col-12 mb-3">
        <h5>الصلاحيات</h5>
        <div class="d-flex flex-wrap gap-3">
            @foreach($permission as $per)
                <div class="form-check card p-3 shadow-sm text-center">
                    <input class="form-check-input me-2 mt-4 " type="checkbox" name="permissions[]" value="{{ $per->name }}" id="perm{{ $per->name }}">
                    <label class="form-check-label" for="perm{{ $per->name }}">
                        {{ $per->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- زر الحفظ -->
    <div class="col-12">
        <button type="submit" class="btn btn-primary w-100 mt-3">حفظ</button>
    </div>
</form>


                </div>
            </div>
        </div>
    </div>
@endsection




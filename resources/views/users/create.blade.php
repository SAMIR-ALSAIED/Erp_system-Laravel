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

                    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf





                            <div class="col mb-3">
                                <label> اسم المستخدم</label>
                                <input class="form-control fc-datepicker"  name="name" type="text" value="{{old('name')}}">


                            @error('name')
    <small class="text-danger mt-3">{{ $message }}</small>
@enderror

                            </div>


                            <div class="col mb-3">
                                <label>  الايميل</label>
                                <input class="form-control " name="email" type="email" value="{{old('email')}}">


                            @error('email')
    <small class="text-danger mt-3">{{ $message }}</small>
@enderror

                            </div>


<div class="col mb-3">
    <label>كلمة المرور</label>
    <input class="form-control" name="password" type="password">
    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col mb-3">
    <label>كلمة المرور تاكيد</label>
    <input type="password" name="password_confirmation" class="form-control">

    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>








<div class="mb-3">
    <label>الدور</label>
    <select name="roles_name" class="form-control select2">
        <option value="">اختر الدور</option>
        @foreach($roles as $role)
            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>
    @error('role')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="mb-3">
    <label>الحالة</label>
    <select name="status" class="form-control" required>
        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>مفعل</option>
        <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>غير مفعل</option>
    </select>
    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>



                            </div>
                        {{-- زر الحفظ --}}
                        <div class="">
                            <button type="submit" class=" bg-primary form-control text-white   mt-4"> حفظ </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection




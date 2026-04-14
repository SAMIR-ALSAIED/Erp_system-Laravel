@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection

@section('title')
تعديل مستخدم
@stop

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="page-title">تعديل مستخدم</h4>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('users.update', $user->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="mb-3">
                        <label>اسم المستخدم</label>
                        <input class="form-control" name="name" type="text" value="{{ old('name', $user->name) }}">

                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label>الإيميل</label>
                        <input class="form-control" name="email" type="email" value="{{ old('email', $user->email) }}">

                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label>الباسورد (اختياري)</label>
                        <input class="form-control" name="password" type="password">

                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="mb-3">
                        <label>الدور</label>
                        <select name="role" class="form-control select2">
                            <option value="">اختر الدور</option>

                            @foreach($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ optional($user->roles->first())->name == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('role')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label>الحالة</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>مفعل</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>غير مفعل</option>
                        </select>

                        @error('status')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        حفظ التعديلات
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
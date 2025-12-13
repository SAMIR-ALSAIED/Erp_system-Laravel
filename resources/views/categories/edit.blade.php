@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->

				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->


					<!--/div-->

					<!--div-->

					<!--/div-->

					<!--div-->

					<div class="col-12">
						<div class="card mg-b-20 ">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">

<!-- زر فتح المودال -->
<form action="{{route('categories.store')}}" method="POST">
    @csrf

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
    <i class="bx bx-plus"></i> إضافة قسم جديد
</button>

<!-- بداية المودال -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- رأس المودال -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title text-white" id="addCategoryLabel">إضافة قسم جديد</h5>
      </div>

      <!-- جسم المودال -->
      <div class="modal-body">
        <form action="{{ route('categories.store') }}" method="POST">
          @csrf

          <div class="mb-3 text-start">
            <label class="form-label">اسم القسم</label>
            <input type="text" name="name" class="form-control" placeholder="أدخل اسم القسم" >
          </div>

          <div class="mb-3 text-start">
            <label class="form-label">ملاحظات</label>
            <textarea name="description" class="form-control h-25" rows="3" placeholder="أدخل ملاحظات (اختياري)"></textarea>
          </div>

       <div class="text-center mt-3 d-flex justify-content-between gap-2">
    <!-- زر الإغلاق -->
    <button type="button" class="btn btn-secondary w-50 d-flex align-items-center justify-content-center gap-2 py-2"
            data-bs-dismiss="modal">
        <i class="bx bx-x-circle fs-5"></i>
        <span class="fw-bold">إغلاق</span>
    </button>

    <!-- زر الحفظ -->
    <button type="submit" class="btn btn-success w-50 d-flex align-items-center justify-content-center gap-2 py-2">
        <i class="bx bx-save fs-5"></i>
        <span class="fw-bold">حفظ</span>
    </button>
</div>

        </form>
      </div>

    </div>
  </div>
</div>
<!-- نهاية المودال -->

								</div>

							</div>
							<div class="card-body">
								<div class="table-responsive">

                                        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <i class="bx bx-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close border-0 shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                                        @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <i class="bx bx-check-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close border-0 shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

									<table id="example1" class="table table-bordered text-center  table-hover ">

										<thead class="">
											<tr>
												<th class=" ">#</th>

												<th class="">القسم</th>

                                            	<th class="">ملاحظات  </th>
                                            	<th class="">العمليات  </th>


											</tr>
										</thead>
										<tbody>
                                            @foreach ($categories as $cat )


											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$cat->name}}</td>

												<td>{{$cat->description	??'لا يوجد ملاحظات'}}</td>
								<td>

    <a href="" class="btn btn-sm btn-info me-1">
        <i class="bx bx-edit-alt">تعديل</i>
    </a>

    <form action="{{ route('categories.destroy',$cat->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="bx bx-trash">حذف</i>
        </button>
    </form>
</td>


											</tr>
                                             @endforeach


										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

					<!--div-->

				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


@endsection

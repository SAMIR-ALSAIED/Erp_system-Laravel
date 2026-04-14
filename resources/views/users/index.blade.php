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

@section('title')
    المستخدمين
@stop
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


                                <a href="{{route('users.create')}}"  class="btn btn-primary mt-3" >
    <i class="bx bx-plus"></i> إضافة  مستخدم جديد
</a>

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
                                        @if(session('update'))
    <div class="alert alert-warning alert-dismissible fade show text-center " role="alert">
        <i class="bx bx-check-circle"></i> {{ session('update') }}
        <button type="button" class="btn-close border-0 shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
									<table id="example1" class="table table-bordered text-center  table-hover ">

										<thead class="">
											<tr>
												<th class="bg-primary text-white">#</th>
												<th class="bg-primary text-white">الاسم</th>
												<th class="bg-primary text-white">الايميل</th>
												<th class="bg-primary text-white">الحالة</th>
												<th class="bg-primary text-white">نوع المستخدم</th>


                                            	<th class="bg-primary text-white">العمليات  </th>


											</tr>
										</thead>
										<tbody>
                                            @foreach ($users as $user )


											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$user->name}}</td>
												<td>{{$user->email}}</td>
<td>
    @if($user->status == 1)
        مفعل
    @else
        غير مفعل
    @endif
</td>
                                                <td>{{ $user->getRoleNames()->implode(',') }}</td>


								<td class="text-center">



@if(!$user->hasRole('admin'))

<a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-info ms-1">   <i class="bx bx-edit-alt fs-5"></i></a>
    <form action="{{route('users.destroy',$user->id)}}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="bx bx-trash  fs-5"></i>
        </button>
    </form>
</td>
@endif


										</tr>
<!-- مودال تعديل المنتج -->



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

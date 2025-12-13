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
<form action="" method="POST">
    @csrf

    @can('اضافة منتج')


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
    <i class="bx bx-plus"></i> إضافة  منتج
</button>

   @endcan
<!-- بداية المودال -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- رأس المودال -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title text-white" id="addCategoryLabel">إضافة منتج </h5>
      </div>

      <!-- جسم المودال -->
<div class="modal-body">
  <form action="{{route('products.store')}}" method="POST">
    @csrf

    <!-- الصف الأول -->
    <div class="row mb-3 text-start">
      <div class="col-md-6">
        <label class="form-label">الباركود</label>
        <input type="text" name="barcode" class="form-control" placeholder="أدخل باركود المنتج">
            @error('barcode')
      <span class="text-danger small">{{ $message }}</span>
    @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">اسم المنتج</label>
        <input type="text" name="name" class="form-control" placeholder="أدخل اسم المنتج">
                    @error('name')
      <span class="text-danger small">{{ $message }}</span>
    @enderror
      </div>
    </div>

    <!-- الصف الثاني -->
    <div class="row mb-3 text-start">
      <div class="col-md-6">
        <label class="form-label">سعر المنتج</label>
        <input type="number" step="0.01" name="price" class="form-control" placeholder="أدخل سعر المنتج">
                           @error('price')
      <span class="text-danger small">{{ $message }}</span>
    @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">الصنف</label>
        <select name="category_id" class="form-control">
          <option value="">اختر الصنف</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <!-- الملاحظات -->
    <div class="mb-3 text-start">
      <label class="form-label">ملاحظات</label>
      <textarea name="notes" class="form-control" rows="3" placeholder="أدخل ملاحظات (اختياري)"></textarea>
                               @error('notes')
      <span class="text-danger small">{{ $message }}</span>
    @enderror
    </div>

    <!-- الأزرار -->
    <div class="text-center mt-3 d-flex justify-content-between gap-2">
      <!-- زر الإغلاق -->
      <button type="button" class="btn btn-secondary w-50 d-flex align-items-center justify-content-center gap-2 py-2"
              data-bs-dismiss="modal">
          <i class="bx bx-x-circle fs-5"></i>
          <span class="fw-bold">إغلاق</span>
      </button>

      <!-- زر الحفظ -->
      <button type="submit" class="btn btn-primary w-50 d-flex align-items-center justify-content-center gap-2 py-2">
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

												<th class="bg-primary text-white">الباركود</th>
                                            	<th class="bg-primary text-white">اسم المنتج  </th>
                                            	<th class="bg-primary text-white">سعر المنتج  </th>
                                            	<th class="bg-primary text-white"> الصنف  </th>
                                            	<th class="bg-primary text-white"> الملاحظات  </th>
                                            	<th class="bg-primary text-white"> تاريخ الاضافة  </th>
                                            	<th class="bg-primary text-white">العمليات  </th>


											</tr>
										</thead>
										<tbody>
                                            @foreach ($products as $product )


											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$product->barcode}}</td>
												<td>{{$product->name}}</td>
												<td>{{$product->price}} ج </td>
												<td>{{$product->category->name}}  </td>

												<td>{{$product->description	??'لا يوجد '}}</td>
                                                <td>{{ $product->created_at->timezone('Africa/Cairo')->translatedFormat('m-d-Y ') }}</td>


								<td class="d-flex text-center">


                   @can('تعديل منتج')



    <button type="button" class="btn btn-sm btn-info ms-1 "
                    data-bs-toggle="modal"
                    data-bs-target="#editModal{{$product->id }}">
                <i class="bx bx-edit-alt fs-5"></i>
            </button>

               @endcan



                 @can('حذف منتج')


    <form action="{{route('products.destroy',$product->id)}}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="bx bx-trash  fs-5"></i>
        </button>
    </form>

        @endcan
</td>



										</tr>
<!-- مودال تعديل المنتج -->
<div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="editModalLabel{{ $product->id }}">تعديل المنتج</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3 text-start">
                        <div class="col-md-6">
                            <label class="form-label">الباركود</label>
                            <input type="text" name="barcode" value="{{ $product->barcode }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">اسم المنتج</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3 text-start">
                        <div class="col-md-6">
                            <label class="form-label">سعر المنتج</label>
                            <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الصنف</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label">ملاحظات</label>
                        <textarea name="notes" class="form-control" rows="3">{{ $product->notes }}</textarea>
                    </div>

                    <div class="text-center mt-3 d-flex justify-content-between gap-2">
                        <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal">
                            <i class="bx bx-x-circle"></i> إغلاق
                        </button>
                        <button type="submit" class="btn btn-primary w-50">
                            <i class="bx bx-save"></i> تعديل
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


                                             @endforeach


										</tbody>
									</table>

<div class="d-flex justify-content-center mt-3">
    {{ $products->links('pagination::bootstrap-4') }}
</div>


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
<script>
    $('#table').DataTable({
    paging: false
});
</script>


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


<script>

</script>

@endsection

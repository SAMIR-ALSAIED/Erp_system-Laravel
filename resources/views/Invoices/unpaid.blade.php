

@extends('layouts.master')

@section('title')

الفواتير
@endsection
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
						<div class="card mg-b-20">
							<div class="card-header pb-0">

								<div class="tx-12 tx-gray-500 mb-2">
        <a href="{{route('exportInvoices')}}" class="btn  btn-dark me-3  p-2 " ><i class="fas fa-plus"></i>&nbsp; تصدير الاكسيل </a>

                                </div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered text-center  ">
										<thead class=" ">
											<tr>
												<th >#</th>
												<th >رقم الفاتورة</th>
												<th>اسم العميل</th>
												<th >تاريخ الفاتورة</th>
												<th>تاريخ الاستحقاق</th>
												<th>المنتج </th>
												<th >القسم</th>
												<th >الخصم </th>
												<th >نسبة الضريبة </th>
												<th >قيمة الضريبة</th>
                                            	<th >الاجمالى </th>
                                            	<th >ملاحظات  </th>
                                            	<th >الحالة  </th>



											</tr>
										</thead>
										<tbody>
                                            @foreach ($invoices as $invoice )


											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{$invoice->invoice_number}}</td>
												<td>{{ $invoice->name_client }}</td>
												<td >{{$invoice->invoice_Date->format('m/d/Y')}}</td>
												<td >{{$invoice->due_Date->format('m/d/Y')}}</td>
												<td>{{$invoice->product->name}}</td>
												<td><a href="{{route('invoicesdetails.show', $invoice->id) }}">{{$invoice->category->name}}</a></td>
												<td>{{$invoice->rate_vat}}</td>
												<td>{{$invoice->rate_vat}}</td>
												<td>{{$invoice->value_vat}}</td>
												<td>{{$invoice->total}} ج</td>


												<td>{{$invoice->notes?? 'لايوجد'}}</td>

                                                <td>

										@if ($invoice->value_status === 1)
    <span class="badge  bg-success p-1">{{ $invoice->status }}</span>
@elseif ($invoice->value_status == 2)
    <span class="badge bg-danger p-1">{{ $invoice->status }}</span>
@elseif ($invoice->value_status == 3)
    <span class="badge bg-warning p-1">{{ $invoice->status }}</span>
@endif
</td>
{{-- <td class="text-center">
    <div class="dropdown">

        <button class="btn btn-sm btn-light border-0" type="button"
                id="dropdownMenu{{ $invoice->id }}" data-bs-toggle="dropdown"
                aria-expanded="false" title="خيارات">
            <i class="bx bx-dots-vertical-rounded fs-4 text-secondary"></i>
        </button>


        <ul class="dropdown-menu dropdown-menu-end shadow-sm"
            aria-labelledby="dropdownMenu{{ $invoice->id }}">

            <li>
                <a class="dropdown-item d-flex align-items-center"
                   href="{{ route('InvoicesDetails.show', $invoice->id) }}">
                    <i class="bx bx-show text-primary fs-5 me-2"></i>
                    <span>عرض الفاتورة</span>
                </a>
            </li>

            <li>
                <a class="dropdown-item d-flex align-items-center"
                   href="{{ route('Invoices.edit', $invoice->id) }}">
                    <i class="bx bx-edit-alt text-info fs-5 me-2"></i>
                    <span>تعديل الفاتورة</span>
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <form action="{{ route('Invoices.destroy', $invoice->id) }}"
                      method="POST"
                      onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="dropdown-item d-flex align-items-center text-danger">
                        <i class="bx bx-trash fs-5 me-2"></i>
                        <span>حذف الفاتورة</span>
                    </button>
                </form>
            </li>


        </ul>
    </div>
</td> --}}





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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
@endsection

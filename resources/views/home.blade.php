@extends('layouts.master')

@section('title') لوحة التحكم@endsection


@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"></h2>
						  <p class="mg-b-0"></p>
						</div>
					</div>

				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
			<div class="row row-sm">

    <!-- الأقسام -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-primary-gradient shadow-lg border-0">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="text-uppercase text-white-50 mb-2">الأقسام</h5>
                    <h3 class="text-white mb-0">{{ $categoriesCount ?? 0 }}</h3>
                    <p class="text-white-50 mb-0">إجمالي الأقسام </p>
                </div>
                <div class="icon-container">
                    <i class="fas fa-layer-group fa-3x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- المنتجات -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-primary-gradient shadow-lg border-0">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="text-uppercase text-white-50 mb-2">المنتجات</h5>
                    <h3 class="text-white mb-0">{{ $productsCount ?? 0 }}</h3>
                    <p class="text-white-50 mb-0">إجمالي المنتجات </p>
                </div>
                <div class="icon-container">
                    <i class="fas fa-boxes fa-3x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- الفواتير -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-primary-gradient shadow-lg border-0">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="text-uppercase text-white-50 mb-2">الفواتير</h5>
                    <h3 class="text-white mb-0">{{ $invoicesCount ?? 0 }}</h3>
                    <p class="text-white-50 mb-0">إجمالي الفواتير </p>
                </div>
                <div class="icon-container">
                    <i class="fas fa-file-invoice-dollar fa-3x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- المستخدمين -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-primary-gradient shadow-lg border-0">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="text-uppercase text-white-50 mb-2">المستخدمين</h5>
                    <h3 class="text-white mb-0">{{ $usersCount ?? 0 }}</h3>
                    <p class="text-white-50 mb-0">عدد المستخدمين  </p>
                </div>
                <div class="icon-container">
                    <i class="fas fa-users fa-3x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

</div>

				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-12 ">
						<div class="card">

							<div class="card-body">
								<div class="total-revenue">



								  </div>
								<div id="bar" class="sales-bar mt-4"></div>
							</div>
						</div>
					</div>

				</div>
				<!-- row closed -->

				<!-- row opened -->

				<!-- row close -->

				<!-- row opened -->

				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
@endsection

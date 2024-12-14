<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    
    <style>
        #spinner-div {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; 
            visibility: hidden; 
            opacity: 0; 
            transition: opacity 0.3s ease; 
        }
    
        #spinner-div.show {
            visibility: visible;
            opacity: 1; 
        }
    
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3); 
            border-top: 4px solid #3498db; 
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite; 
        }
    
        /* Spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .table.dataTable thead .sorting_desc {
            background-image: none !important;
        }
        .table.dataTable thead .sorting_asc {
            background-image: none !important;
        }

    </style>
</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	{{-- <div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div> --}}
    <div id="spinner-div">
        <div class="spinner"></div>
    </div>    
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
    @include('admin.include.sidebar')
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
    @include('admin.include.header')
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    @yield('content')
</div>
<div class="popup_render_div"></div>



<!-- Required Js -->
<script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/pcoded.min.js')}}"></script>

<script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>


<!-- custom-chart js -->
<script src="{{asset('assets/js/pages/dashboard-main.js')}}"></script>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('admin/custom.js')}}"></script>
@stack('scripts')
</body>

</html>

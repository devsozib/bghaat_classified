<!doctype html>
@if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="app-url" content="{{ getBaseURL() }}">
	<meta name="file-base-url" content="{{ getFileBaseURL() }}">

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Favicon -->
	<link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">
	<title>{{ get_setting('website_name').' | '.get_setting('site_motto') }}</title>

	<!-- google font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

	<!-- aiz core css -->
	<link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
	<link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/animate/animate.css') }}">
   <!--===============================================================================================-->	
       <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}">
   <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/animsition/css/animsition.min.css') }}">
   <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/select2/select2.min.css') }}">
   <!--===============================================================================================-->	
       <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/daterangepicker/daterangepicker.css') }}">
   <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/css/util.css') }}">
       <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/css/main.css') }}">

   <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
   <link rel="stylesheet" href="{{ static_asset('assets/css/style.css') }}">
    <style>
        body {
            font-size: 12px;
        }
    </style>
	<script>
    	var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '{{ translate('Nothing selected') }}',
            nothing_found: '{{ translate('Nothing found') }}',
            choose_file: '{{ translate('Choose file') }}',
            file_selected: '{{ translate('File selected') }}',
            files_selected: '{{ translate('Files selected') }}',
            add_more_files: '{{ translate('Add more files') }}',
            adding_more_files: '{{ translate('Adding more files') }}',
            drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',
            browse: '{{ translate('Browse') }}',
            upload_complete: '{{ translate('Upload complete') }}',
            upload_paused: '{{ translate('Upload paused') }}',
            resume_upload: '{{ translate('Resume upload') }}',
            pause_upload: '{{ translate('Pause upload') }}',
            retry_upload: '{{ translate('Retry upload') }}',
            cancel_upload: '{{ translate('Cancel upload') }}',
            uploading: '{{ translate('Uploading') }}',
            processing: '{{ translate('Processing') }}',
            complete: '{{ translate('Complete') }}',
            file: '{{ translate('File') }}',
            files: '{{ translate('Files') }}',
        }
	</script>

</head>
<body class="">

	<div class="aiz-main-wrapper d-flex">
        <div class="flex-grow-1">
            @yield('content')
        </div>
    </div><!-- .aiz-main-wrapper -->

    @yield('modal')


    <script src="{{ static_asset('assets/js/vendors.js') }}" ></script>
    <script src="{{ static_asset('assets/js/aiz-core.js') }}" ></script>
 <!--===============================================================================================-->
 {{-- <script src="vendor/jquery/jquery-3.2.1.min.js"></script> --}}
 <!--===============================================================================================-->
     <script src="{{ static_asset('assets/vendor/animsition/js/animsition.min.js') }}"></script>

     <script src="{{ static_asset('assets/vendor/select2/select2.min.js') }}"></script>
 <!--===============================================================================================-->
     <script src="{{ static_asset('assets/vendor/daterangepicker/moment.min.js') }}"></script>
     <script src="{{ static_asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
 <!--===============================================================================================-->
     <script src="{{ static_asset('assets/vendor/countdowntime/countdowntime.js') }}"></script>
 <!--===============================================================================================-->
     <script src="{{ static_asset('assets/js/main.js') }}"></script>


    @yield('script')

    <script type="text/javascript">
        @foreach (session('flash_notification', collect())->toArray() as $message)
            AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
        @endforeach
    </script>

</body>
</html>
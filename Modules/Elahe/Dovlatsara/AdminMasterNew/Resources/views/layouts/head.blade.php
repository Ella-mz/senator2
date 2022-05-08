<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="googlebot" content="noindex">
    <meta name="googlebot-news" content="nosnippet">
    <meta name="robots" content="noindex">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <title>{{\Modules\Setting\Entities\Setting::
        where('title', 'title_of_site')->first()->str_value}} | @yield('urlHeader')</title>
<!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
<!-- Theme style -->
    <link rel="stylesheet" href="{{asset('files/adminMaster/dist/css/adminlte.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/iCheck/flat/blue.css')}}">
    {{--<link rel="stylesheet" href="{{asset('files/adminMaster/plugins/iCheck/flat/purple.css')}}">--}}

<!-- Morris chart -->
{{--    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/morris/morris.css')}}">--}}
    <!-- jvectormap -->
{{--    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">--}}
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/adminMaster/dist/css/persian-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
{{--    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">--}}
    <!-- Google Font: Source Sans Pro -->
{{--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
<!-- bootstrap rtl -->
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{asset('files/adminMaster/dist/css/custom-style.css')}}">

    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/adminMaster/dist/css/bootstrap-rtl.min.css')}}">

{{--    <link rel="stylesheet" href="{{asset('files/custom/CustomStyle.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/custom/cardStyle.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/custom/chat.css')}}">--}}

<!-- data tables css -->

    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/datatables/dataTables.bootstrap4.css')}}">

    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/jpg" href="{{asset(\Modules\Setting\Entities\Setting::where('title', 'favicon_file')->first()->str_value)}}">

    @yield('css')
</head>

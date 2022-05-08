{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />--}}
{{--    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'--}}
{{--          name='viewport'/>--}}
{{--    <link rel="icon" type="image/png" href="https://www.digikala.com/mag/wp-content/themes/digikalamag/assets/common/img/ms-icon-144x144.png">--}}
{{--    <link rel="apple-touch-icon" sizes="144x144" href="https://www.digikala.com/mag/wp-content/themes/digikalamag/assets/common/img/ms-icon-144x144.png">--}}
{{--    <title>پنل مشاورین کسب و کار| @yield('title_realestate')</title>--}}
{{--    <!--    font--------------------------------------------->--}}
{{--    <link rel="stylesheet" href="{{asset('files/realestateMaster/assets/css/font-awesome.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/realestateMaster/assets/css/materialdesignicons.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/realestateMaster/assets/css/materialdesignicons.css.map')}}">--}}
{{--    <!--    font--------------------------------------------->--}}
{{--    <link rel="stylesheet" href="{{asset('files/realestateMaster/assets/css/bootstrap.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/realestateMaster/assets/css/owl.carousel.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/realestateMaster/assets/css/style.css')}}">--}}
{{--    @yield('css_realestate')--}}
{{--</head>--}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    @if(auth()->user()->hasRole('real-state-administrator') || auth()->user()->hasRole('real-state-agent'))
    <title>مدیران کسب و کار | @yield('title_realestate')</title>
    @elseif(auth()->user()->hasRole('contractor'))
        <title>پیمانکاران | @yield('title_realestate')</title>
    @elseif(auth()->user()->hasRole('ordinary-user'))
        <title>کاربران | @yield('title_realestate')</title>
    @else
        <title>کارشناسان | @yield('title_realestate')</title>

    @endif
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
<!-- Theme style -->
    <link rel="stylesheet" href="{{asset('files/realestateMaster/dist/css/adminlte.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/iCheck/flat/blue.css')}}">
    {{--<link rel="stylesheet" href="{{asset('files/adminMaster/plugins/iCheck/flat/purple.css')}}">--}}

<!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/realestateMaster/dist/css/persian-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
{{--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
<!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('files/realestateMaster/dist/css/bootstrap-rtl.min.css')}}">
    <!-- template rtl version -->
{{--    <link rel="stylesheet" href="{{asset('files/realestateMaster/dist/css/custom-style.css')}}">--}}

    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/select2/select2.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('files/custom/CustomStyle.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/custom/cardStyle.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/custom/chat.css')}}">--}}
    <link rel="stylesheet" href="{{asset('files/realestateMaster/dist/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('files/realestateMaster/dist/css/private-style.css')}}">

    <!-- data tables css -->

    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/datatables/dataTables.bootstrap4.css')}}">

    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/jpg" href="{{asset(\Modules\Setting\Entities\Setting::where('title', 'favicon_file')->first()->str_value)}}">

    @yield('css')
</head>

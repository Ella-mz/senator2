<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

{{--    <script src="https://kit.fontawesome.com/0cbb892daa.js" crossorigin="anonymous"></script>--}}
{{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/bootstrap.css')}}">--}}
<!-- Link bootsrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/product.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/materialdesignicons.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/materialdesignicons.css.map')}}">
{{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/all.css')}}">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/font-awesome/css/font-awesome.min.css')}}">

    <link rel="shortcut icon" type="image/jpg" href="{{asset(\Modules\Setting\Entities\Setting::where('title', 'favicon_file')->first()->str_value)}}">

{{--    <script src="https://kit.fontawesome.com/0cbb892daa.js" crossorigin="anonymous"></script>--}}
    <title>@yield('title_user')</title>
    @yield('css_user')
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=288450890"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '288450890');
    </script>
{{--    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/reset.css')}}" />--}}

    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/common.css')}}" />
    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/dolatsaraMenu.css')}}" />

    <!-- medias -->
    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/mediaDolatsara.css')}}" />
    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/mediaCommon.css')}}" />
    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/mediaDolatsaraMenu.css')}}" />

    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/themify-icons.css')}}" />

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Link fontawesome CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('files/userMaster/src/css/all.min.css')}}" rel="stylesheet" />
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}

</head>

<html lang="en">
@include('UserMasterNew::layouts.head')
{{--<link rel="stylesheet" href="{{asset('files/userMaster/assets/css/shareStyle.css')}}">--}}

<body>
<div id="firstPageTop">
{{--    {!! $content !!}--}}
{{--<div class="advertisments-place header"><div class="ad-box short"></div></div>--}}
</div>
@include('UserMasterNew::layouts.header')
{{--<div class="shareButtons">--}}
{{--    <nav>--}}
{{--        <ul>--}}
{{--            <li><a><i class="fa fa-whatsapp"></i><span>واتس اپ</span> </a></li>--}}
{{--            <li><a><i class="fa fa-instagram"></i> <span>اینستاگرام</span></a></li>--}}
{{--            <li><a><i class="fa fa-telegram"></i> <span>تلگرام</span></a></li>--}}

{{--        </ul>--}}
{{--    </nav>--}}
{{--</div>--}}
@yield('content_userMasterNew')

@include('UserMasterNew::layouts.footer')
@include('UserMasterNew::layouts.foot')
@include('sweetalert::alert')
</body>
</html>

<html lang="en">
@include('UserMaster::layouts.head')
<body>
@include('UserMaster::layouts.header')
@yield('content_userMaster')

@include('UserMaster::layouts.footer')
@include('UserMaster::layouts.foot')
@include('sweetalert::alert')
</body>
</html>

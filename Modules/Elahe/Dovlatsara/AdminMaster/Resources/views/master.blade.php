
<!DOCTYPE html>
<html>
@include('AdminMaster::layouts.head')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
{{--    @include('AdminMaster::layouts.preloader')--}}
    @include('AdminMaster::layouts.navbar')
    @include('AdminMaster::layouts.sidebar')
    <div class="content-wrapper">
        @include('AdminMaster::layouts.header')
        <section class="content">
            <div class="container-fluid">
            @yield('content')
            </div>
        </section>
    </div>
    @include('AdminMaster::layouts.footer')
    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
@include('AdminMaster::layouts.foot')
@include('sweetalert::alert')
</body>
</html>


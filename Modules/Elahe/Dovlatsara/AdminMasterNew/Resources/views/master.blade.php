
<!DOCTYPE html>
<html>
@include('AdminMasterNew::layouts.head')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
{{--    @include('AdminMaster::layouts.preloader')--}}
    @include('AdminMasterNew::layouts.navbar')
    @include('AdminMasterNew::layouts.sidebar')
    <div class="content-wrapper">
        @include('AdminMasterNew::layouts.header')
        <section class="content">
            <div class="container-fluid">
            @yield('content')
            </div>
        </section>
    </div>
    @include('AdminMasterNew::layouts.footer')
{{--    <aside class="control-sidebar control-sidebar-dark"></aside>--}}
</div>
@include('AdminMasterNew::layouts.foot')
@include('sweetalert::alert')
@include('AdminMasterNew::layouts.tinyEditor')

</body>
</html>


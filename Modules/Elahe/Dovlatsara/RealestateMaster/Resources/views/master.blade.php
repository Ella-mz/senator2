<!DOCTYPE html>
<html lang="fa">
@include('RealestateMaster::layouts.head')
<body class="hold-transition sidebar-mini" id="sidebarCollapseChange">
<div class="wrapper">
@include('RealestateMaster::layouts.navbar')
@include('RealestateMaster::layouts.sidebar')
    <div class="content-wrapper">

@include('RealestateMaster::layouts.header')
        <section class="content">
            <div class="container-fluid">
{{--@include('RealestateMaster::layouts.content')--}}
@yield('content_realestateMaster')
            </div>
        </section>
    </div>
@include('RealestateMaster::layouts.footer')
{{--    <aside class="control-sidebar control-sidebar-dark"></aside>--}}
</div>
@include('RealestateMaster::layouts.foot')
@include('AdminMasterNew::layouts.tinyEditor')
@include('sweetalert::alert')
</body>
</html>

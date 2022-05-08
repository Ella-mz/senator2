
{{--<div class="content-header">--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row mb-2">--}}

{{--            <div class="col-sm-6">--}}
{{--                @yield('header')--}}
{{--                <ol class="breadcrumb float-sm-right" >--}}
{{--                    <li class="breadcrumb-item"><a href="{{route('adminMaster')}}">داشبورد</a></li>--}}
{{--                    <li class="breadcrumb-item active">--}}
{{--                        <li class="breadcrumb-item"><a href="{{route('adminMaster')}}">داشبورد</a></li>@yield('header')--}}
{{--                    </li>--}}
{{--                </ol>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6">--}}
{{--                <h1 class="m-0"></h1>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                <h1 class="m-0 text-dark">@yield('header')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                @yield('routeHeader')

                {{--                <ol class="breadcrumb float-sm-left">--}}
{{--                    <li class="breadcrumb-item"><a href="#">خانه</a></li>--}}
{{--                    <li class="breadcrumb-item active">داشبورد ورژن 2</li>--}}
{{--                </ol>--}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

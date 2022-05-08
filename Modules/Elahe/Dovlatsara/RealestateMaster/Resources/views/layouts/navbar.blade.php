<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu"><i class="fa fa-bars"></i></a>
        </li>
{{--        <li class="nav-item d-none d-sm-inline-block">--}}
{{--            <a href="index3.html" class="nav-link">خانه</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item d-none d-sm-inline-block">--}}
{{--            <a href="#" class="nav-link">تماس</a>--}}
{{--        </li>--}}
    </ul>
    <form class="form-inline mr-auto" id="logout-form" action="{{ route('realestate_logout') }}" method="post">
        @csrf
        <button name="user" data-toggle="tooltip" title="خروج" class="btn btn-light btn-sm nav-link" type="submit">
            خروج
        </button>
        {{--                        <div class="input-group input-group-sm">--}}
        {{--                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
        {{--                            <div class="input-group-append">--}}
        {{--                                <button class="btn btn-navbar" type="submit">--}}
        {{--                                    <i class="fas fa-search"></i>--}}
        {{--                                </button>--}}
        {{--                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">--}}
        {{--                                    <i class="fas fa-times"></i>--}}
        {{--                                </button>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
    </form>
    <!-- SEARCH FORM -->
{{--    <form class="form-inline ml-3">--}}
{{--        <div class="input-group input-group-sm">--}}
{{--            <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-navbar" type="submit">--}}
{{--                    <i class="fa fa-search"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}

    <!-- Right navbar links -->
{{--    <ul class="navbar-nav mr-auto">--}}
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->


{{--    </ul>--}}
</nav>

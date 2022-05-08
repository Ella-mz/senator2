{{--<header>--}}
{{--    <nav class="navbar">--}}
{{--        <div class="container">--}}
{{--            <div class="right">--}}
{{--                <div class="logo">--}}
{{--                    <img src2="{{\Modules\Setting\Entities\Setting::where('title', 'logo_of_site')->first()->str_value}}" alt="logo">--}}
{{--                </div>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"--}}
{{--                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}
{{--                <div class=" navbar-collapse" id="navbarNav">--}}
{{--                    <ul class="navbar-nav">--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link cool-move purple selected" href="#"><span--}}
{{--                                    class="sr-only">خانه</span></a>--}}
{{--                        </li>--}}
{{--                        @if(\Illuminate\Support\Facades\Auth::check())--}}
{{--                        <li class="nav-item">--}}
{{--                            <form action="{{ route('auth.user.logout.user') }}" method="post">--}}
{{--                                @csrf--}}
{{--                                <button class="nav-link cool-move purple" type="submit">--}}
{{--                                    خروج--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </li>--}}
{{--                        @else--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link cool-move purple" href="{{route('auth.loginForm.user')}}">ورود</a>--}}
{{--                            </li>--}}
{{--                        @endif--}}

{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link cool-move purple" href="#">مجله خبری</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link cool-move purple" href="#">تماس با ما</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="left">--}}
{{--                <div class="urgent">--}}
{{--                    <a href="">--}}
{{--                        آگهی فوری--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="profile">--}}
{{--                    <div class="name"><span>--}}
{{--                            @if(\Illuminate\Support\Facades\Auth::check())--}}
{{--                            {{\Illuminate\Support\Facades\Auth::user()->name}} {{\Illuminate\Support\Facades\Auth::user()->sirName}}--}}
{{--                                @endif--}}
{{--                        </span></div>--}}
{{--                    <div class="dashboard">--}}
{{--                        <a href="#">--}}
{{--                            داشبورد--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="phone">--}}
{{--                    <a href="tel:021-8330568" title="phone">--}}
{{--                        <span class="number">8330568</span>--}}
{{--                        <span class="perfix">-021</span>--}}

{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}

{{--</header>--}}
<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="{{route('homePage.user')}}">
                <div class="logo">
                @if(isset(\Modules\Setting\Entities\Setting::
where('title', 'logo_of_site')->first()->str_value))
                <img src="{{asset(\Modules\Setting\Entities\Setting::
where('title', 'logo_of_site')->first()->str_value)}}" alt="logo">
@endif
            </div>
            </a>

            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav mx-3 mb-lg-0">
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link active" aria-current="page" href="#">اگهی ها</a>--}}
{{--                    </li>--}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('realEstate.index.user')}}">پنل مشاوران</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contractors.index.user')}}">پنل پیمانکاران</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            حساب شخصی
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('ad.myPosts.supplier.user')}}">آگهی های من</a></li>
{{--                            <li><a class="dropdown-item" href="#">بازدیدهای اخیر</a></li>--}}
                            <li><a class="dropdown-item" href="{{route('ad.bookmarks.supplier.user')}}">نشان شده ها</a></li>
{{--                            <li><a class="dropdown-item" href="#">املا</a></li>--}}

{{--                            <li>--}}
{{--                                <hr class="dropdown-divider">--}}
{{--                            </li>--}}
{{--                            <li><a class="dropdown-item" href="#">آیتم متفاوت</a></li>--}}
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('aboutUs.index.user')}}">درباره ما</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">مشاوران</a>--}}
{{--                    </li>--}}
                </ul>

                <!-- <div class="urgent">
                    <a href="" >
                        آگهی فوری
                    </a>
                </div> -->
                <div class="phone">
                    <a href="tel:021-8330568" title="phone">
                        <span class="number">{{(\Modules\Setting\Entities\Setting::where('title', 'phone_number_of_header')->first()->str_value)}}</span>
                        <span class="perfix">-021</span>

                    </a>

                </div>

            </div>



            <div class="profile">

                <div class="dashboard">
                    <img src="{{asset('files/userMaster/assets/img/user-alt-solid.png')}}" alt="">
                    @if(auth()->check())
                        <span style="cursor: pointer ">

                        خروج
                    </span>
                        <form action="{{route('auth.user.logout.user')}}" id="logoutID" method="post">
                            @csrf


                                <a onclick="document.getElementById('logoutID').submit()"></a>
                        </form>
{{--                        <form action="{{route('auth.user.logout.user')}}" method="post">--}}
{{--                            @csrf--}}
{{--                            <button>--}}

{{--                              خروج--}}
{{--                    </button>--}}
{{--                        </form>--}}

                </div>
{{--                <a href="{{route('auth.loginForm.user')}}"></a>--}}
                @else
                    <span>

                        ثبت نام / ورود
                    </span>
            </div>
            <a href="{{route('auth.loginForm.user')}}"></a>
                    @endif

            </div>

        </div>

    </nav>

</header>

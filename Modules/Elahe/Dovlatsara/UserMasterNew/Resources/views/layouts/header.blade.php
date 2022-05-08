<header class="dolatsara__menu">
    <div class="dolatsara__all-menu">
        <nav class="navbar navbar-expand-lg dolatsara__right-menu">
            <button class="navbar-toggler dolatsara__toggle-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#dolatsara__menu-list">
                <span class="menu navbar-toggler-icon ti-menu"></span>
            </button>

            <div class="collapse navbar-collapse" id="dolatsara__menu-list">
                <a href="{{route('homePage.user')}}" class="logo-img-link">
                    <img
                        class="logo-img"
                        alt="dolatsara"
                        src="{{asset(\Modules\Setting\Entities\Setting::
        where('title', 'logo_of_site')->first()->str_value)}}"
                    />
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 dolatsara__menu">
                    <li class="nav-item dolatsara__menu-item">
                        <a class="nav-link" href="{{route('homePage.user')}}">خانه</a>
                    </li>
                    <li class="nav-item dolatsara__menu-item">
                        <a class="nav-link" href="{{route('supplierFilterPage.user')}}">کل آگهی ها</a>
                    </li>
                    <li class="nav-item dolatsara__menu-item">
                        <a class="nav-link" href="{{route('categories.find.cats', ['type'=>'supplier', 'panel'=>'user'])}}">
                            ثبت آگهی</a>
                    </li>
                    <li class="nav-item dolatsara__menu-item">
                        <a class="nav-link" href="{{route('categories.find.cats', ['type'=>'applicant', 'panel'=>'user'])}}">
                            ثبت درخواست</a>
                    </li>

                    <li class="nav-item dolatsara__menu-item">
                        <a class="nav-link" href="{{route('articles.index.user')}}">مجله {{\Modules\Setting\Entities\Setting::
        where('title', 'title_of_site')->first()->str_value}}</a>
                    </li>
{{--                    <li class="nav-item dolatsara__menu-item">--}}
{{--                        <a class="nav-link" href="{{route('general-blog')}}" target="_blank">مجله--}}
{{--                            {{\Modules\Setting\Entities\Setting::--}}
{{--        where('title', 'title_of_site')->first()->str_value}}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item dolatsara__menu-item">--}}
{{--                        <a class="nav-link" href="{{route('realEstate.index.user')}}">لیست کسب و کارها</a>--}}
{{--                    </li>--}}
                    <li class="nav-item dolatsara__menu-item">
                        <a class="nav-link" href="{{route('application.list.user')}}">درخواست های خرید</a>
                    </li>
{{--                    <li class="nav-item dolatsara__menu-item">--}}
{{--                        <a class="nav-link" href="{{route('membership.index.user')}}">تعرفه </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item dolatsara__menu-item">--}}
{{--                        <a class="nav-link" href="{{route('advertisings.index.user')}}">رزرو تبلیغات</a>--}}
{{--                    </li>--}}
                    @if(auth()->check())

                        <li class="nav-item dolatsara__menu-item dropdown">
                            <a class="nav-link" href="#" id="navbar-dropdown" role="button" data-bs-toggle="dropdown">
                                حساب شخصی
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dolatsara__sub-menu">
                                <li><a class="dropdown-item" href="{{route('user.profile.realestate', auth()->id())}}">پنل من</a></li>
                                <hr class="dropdown-divider">
                                <li><a class="dropdown-item" href="{{route('ad.myPosts.supplier.user')}}">آگهی
                                        های
                                        من</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{route('application.index.user')}}">درخواست
                                        های
                                        من</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{route('ad.recentseens.supplier.user')}}">بازدیدهای
                                        اخیر</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{route('ad.bookmarks.supplier.user')}}">نشان
                                        شده
                                        ها</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{route('auth.user.logout.user')}}" id="logoutID" method="post">
                                        @csrf
                                        <a class="dropdown-item" onclick="document.getElementById('logoutID').submit()"
                                           style="cursor: pointer">
                                            خروج</a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <div class="dolatsara__left-menu">
            <button class="dolatsara__city-button" data-bs-toggle="modal" data-bs-target="#city-modal"
                    style="cursor:pointer;">

                @if(session('cities'))
                    {{count(session('cities'))}}
                @endif شهر
                <i class="material-icons">location_on</i>
            </button>
            <div class="modal fade dolatsara__city-modal" id="city-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="dolatsara__header">
                                <h5 class="modal-title">انتخاب شهر</h5>
                                <button class="dolatsara__delete-all">حذف همه</button>

                            </div>
                            <span class="dolatsara__selected-city">حداقل یک شهر را انتخاب کنید.</span>
                            <div class="dolatsara__city-name-parent">
                                @if(session('cities'))
                                    @foreach(session('cities') as $se)
                                        <div class="dolatsara__selected-city sessionCity{{$se}}">
                                            <p class="dolatsara__city-name">{{\Modules\City\Entities\City::find($se)->title}}</p>
                                            <i class="material-icons delete-city" onclick="closeCity({{$se}})">close</i>
                                        </div>
                                @endforeach
                            @endif
                                <!--
                                                    <div class="dolatsara__selected-city">
                                                      <p class="dolatsara__city-name">تهران</p>
                                                      <i class="material-icons delete-city">close</i>
                                                    </div> -->
                            </div>
                        </div>
                        <form class="dolatsara__city-modal-form" action="{{route('user.city.setCookie')}}" method="post" id="sessionCities">
                            @csrf
                            <div class="modal-body">
                                <i class="fa fa-search search-icon"></i>
                                <input
                                    type="text"
                                    class="dolatsara__search-city"
                                    placeholder="جستجو در شهرها"
                                    id="search-city"
                                    oninput="searchCity()"
                                />

                                <ul class="dolatsara__city-list" id="dolatsara__city-list">
                                    <li class="dolatsara__city-list-item">
                                        <label for="select-all" class="dolatsara__city-list-label">
                                            انتخاب همه
                                            <input
                                                type="checkbox"
                                                name="select-all"
                                                id="select-all"
                                                class="select-all"
                                                value="انتخاب همه"
                                                style="display: unset"
                                            />
                                        </label>
                                    </li>
                                    @foreach(\Modules\City\Entities\City::all() as $city)

                                    <li class="dolatsara__city-list-item">
                                        <label for="{{$city->title}}" class="dolatsara__city-list-label">
                                            {{$city->title}}
                                            <input
                                                type="checkbox"
                                                name="city[{{$city->id}}]"
                                                id="{{$city->title}}"
                                                class="city-name"
                                                value="{{$city->id}}"
                                                @if(session('cities') && array_search($city->id, session('cities')))checked
                                                @endif
                                                style="display: unset"
                                            />
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="dolatsara__cancel-button"
                                    data-bs-dismiss="modal"
                                    style="cursor: pointer">
                                    انصراف
                                </button>
                                <button class="dolatsara__confirm-button" style="cursor: pointer">تایید</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(isset(\Modules\Setting\Entities\Setting::where('title', 'phone_number_of_header')->first()->str_value))

                <a href="tel:{{(\Modules\Setting\Entities\Setting::where('title', 'phone_number_of_header')->first()->str_value)}}"
                   class="dolatsara__phone">
                    <strong>{{(\Modules\Setting\Entities\Setting::where('title', 'phone_number_of_header')->first()->str_value)}}</strong>
                    <small>-021</small>
                </a>
            @endif
{{--            <a class="dolatsara__log-button" href="{{route('auth.loginForm.user')}}" style="cursor: pointer">--}}
{{--                ورود--}}
{{--            </a>--}}
{{--            <a class="dolatsara__submit-ad-button" href="{{route('categories.find.cats', ['type'=>'supplier', 'panel'=>'user'])}}" style="cursor: pointer">--}}
{{--                ثبت آگهی--}}
{{--            </a>--}}

            <div class="dropdown dolatsara__setting-list">
                <button type="button" class="dolatsara__setting-button" data-bs-toggle="dropdown"
                        @if($widgets->count()<=0) disabled @endif>
                    <img src="{{asset('files/userMaster/src/images/icons8-settings-50 (1).png')}}" alt="dolatsara__setting"/>
                </button>
                <ul class="dropdown-menu dolatsara__setting-list-icons">
                    <div class="row">
                        @foreach($widgets as $widget)
                            <li>
                                <a class="dropdown-item" href="{{$widget->link}}" target="_blank">
                                    <img src="{{asset($widget->image)}}">{{$widget->title}}
                                </a>
                            </li>
                        @endforeach
                    </div>
                </ul>
            </div>

        </div>
    </div>
</header>

{{--<div class="col-lg-3 col-md-4 col-xs-12">--}}
{{--    <div class="sidebar-wrapper">--}}

{{--        <div class="box-sidebar">--}}
{{--            <span class="box-header-sidebar">حساب کاربری شما</span>--}}
{{--            <ul class="profile-menu-items">--}}
{{--                <li><a href="{{route('user.profile.realestate', \Illuminate\Support\Facades\Auth::id())}}" class="profile-menu-url"><span class="mdi mdi-account-outline"></span>پروفایل</a></li>--}}
{{--                <li><a href="{{route('users.changePasswordForm.realestate', \Illuminate\Support\Facades\Auth::id())}}" class="profile-menu-url"><span class="fa fa-key"></span>تغییر رمز عبور</a></li>--}}

{{--                <li><a href="{{route('user.shop.index.realestate', \Illuminate\Support\Facades\Auth::user()->shop->id)}}" class="profile-menu-url"><span class="fa fa-building"></span>کسب و کاری من</a></li>--}}
{{--                <li><a href="{{route('membership.index.realestate')}}" class="profile-menu-url"><span class="fa fa-star-o"></span>حق اشتراک ها</a></li>--}}
{{--                <li><a href="{{route('membership.show.realestate', \Illuminate\Support\Facades\Auth::id())}}" class="profile-menu-url"><span class="fa fa-star"></span>حق اشتراک های من</a></li>--}}
{{--                --}}{{--                <li><a href="profile-favorites.html" class="profile-menu-url"><span class="fa fa-star-o"></span>لیست علاقه مندی ها</a></li>--}}
{{--                <li><a href="profile-comments.html" class="profile-menu-url"><span class="fa fa-file-text-o"></span>نقد و نظرات</a></li>--}}
{{--                <li><a href="profile-addresses.html" class="profile-menu-url"><span class="mdi mdi-map"></span>آدرس ها</a></li>--}}
{{--                <li><a href="#" class="profile-menu-url"><span class="fa fa-clock-o"></span>بازدید های اخیر</a></li>--}}
{{--                <li><a href="profile-personal-info.html" class="profile-menu-url"><span class="mdi mdi-account-outline"></span>اطلاعات شخصی</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}
<aside class="main-sidebar temp-blue-background elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('homePage.user')}}" class="brand-link temp-white-background justify-content-between"
       style="direction: rtl">
        @if(isset(\Modules\Setting\Entities\Setting::
where('title', 'logo_of_site')->first()->str_value))
            <img src="{{asset(\Modules\Setting\Entities\Setting::
where('title', 'logo_of_site')->first()->str_value)}}" alt="AdminLTE Logo" class="brand-image"
                 style="opacity: .8; width: 80px; height: 50px">
        @endif
        <span class="brand-text font-weight-light text-dark">پنل کاربران </span>
    </a>
{{--    <a href="" class="brand-link">--}}
{{--        @if(isset(\Modules\Setting\Entities\Setting::where('title', 'bright_logo_of_site')->first()->str_value))--}}
{{--            <img src="{{asset(\Modules\Setting\Entities\Setting::where('title', 'bright_logo_of_site')->first()->str_value)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
{{--                 style="opacity: .8">--}}
{{--        @endif--}}
{{--        <span class="brand-text font-weight-light">پنل مدیریت </span>--}}
{{--    </a>--}}

<!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 d-flex flexBox-center-col ">
                <div class="image">
                </div>
                <div class="info ">
                    <a class="d-block">
                        <span style="color: #fff">{{auth()->user()->roles->first()->name}}</span>
                    </a>
                </div>
                <div class="info ">
                    <a class="d-block temp-white-text"><span
                            style="color: #fff">{{auth()->user()->name}} {{auth()->user()->sirName}}</span></a>
                </div>
            </div>
            <div class="user-panel pb-3 mb-3 d-flex flexBox-center-col ">
                <div class="info ">
                    <a class="d-block temp-white-text"><span
                            style="color: #fff">کد معرف: {{auth()->user()->invitedCode}}</span></a>
                </div>
            </div>
            <hr style="background-color: #fff">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @can('ProfileInPanel')
                        <li class="nav-item">
                            <a href="{{route('user.profile.realestate', auth()->id())}}" class="nav-link">
                                <i class="nav-icon fa fa-user text-warning"></i>
                                <p class="temp-white-text">پروفایل</p>
                            </a>
                        </li>
                    @endcan
                    @can('ChangePasswordInPanel')
                        <li class="nav-item">
                            <a href="{{route('users.changePasswordForm.realestate', auth()->id())}}" class="nav-link">
                                <i class="nav-icon fa fa-key text-warning"></i>
                                <p class="temp-white-text">تغییر رمز عبور</p>
                            </a>
                        </li>
                    @endcan
                    @can('CustomerClubInPanel')

                    <li class="nav-item">
                        <a href="{{route('scores.score2wallet.panel')}}" class="nav-link">
                            <i class="nav-icon fa fa-money text-warning"></i>
                            <p class="temp-white-text">تبدیل امتیاز به پول</p>
                        </a>
                    </li>
                    @endcan
                @can('MyShopInPanel')
                        <li class="nav-item">
                            <a href="{{route('user.shop.index.realestate', auth()->id())}}" class="nav-link">
                                <i class="nav-icon fa fa-building text-warning"></i>
                                <p class="temp-white-text">کسب و کار من</p>
                            </a>
                        </li>
                    @endcan
                    @can('MyShopAgentsInPanel')
                        <li class="nav-item">
                            <a href="{{route('user.shop.agents.realestate', auth()->id())}}" class="nav-link">
                                <i class="nav-icon fa fa-users text-warning"></i>
                                <p class="temp-white-text">کارشناسان کسب و کار</p>
                            </a>
                        </li>
                    @endcan
                    @can('AdsInPanel')
                        <li class="nav-item has-treeview">
                            <a class="nav-link" style="cursor: pointer">
                                <i class="nav-icon fa fa-bullhorn text-warning"></i>
                                <p class="temp-white-text">
                                    آگهی ها
                                    <i class="right fa fa-angle-left nav-icon"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('ad.index.supplier.realestate', ['user'=>auth()->id(), 'type'=>'my-ads'])}}"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon text-warning"></i>
                                        <p class="temp-white-text">آگهی های من</p>
                                    </a>
                                </li>
                                @can('MyAdsInAgencyPanel')
                                    <li class="nav-item">
                                        <a href="{{route('ad.index.supplier.realestate', ['user'=>auth()->id(), 'type'=>'my-ads-in-agency'])}}"
                                           class="nav-link">
                                            <i class="fa fa-circle-o nav-icon text-warning"></i>
                                            <p class="temp-white-text">آگهی های من در آژانس</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('AdsOfAgencyPanel')
                                    <li class="nav-item">
                                        <a href="{{route('ad.index.supplier.realestate', ['user'=>auth()->id(), 'type'=>'ads-of-agency'])}}"
                                           class="nav-link">
                                            <i class="fa fa-circle-o nav-icon text-warning"></i>
                                            <p class="temp-white-text">آگهی های آژانس</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="{{route('ad.index.supplier.realestate', auth()->id())}}" class="nav-link">--}}
                        {{--                                <i class="nav-icon fa fa-bullhorn text-warning"></i>--}}
                        {{--                                <p class="temp-white-text">آگهی های من</p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                    @endcan
                    @can('BookmarksInPanel')
                        <li class="nav-item">
                            <a href="{{route('ad.bookmarks.supplier.realestate')}}" class="nav-link">
                                <i class="nav-icon fa fa-bookmark text-warning"></i>
                                <p class="temp-white-text">آگهی های نشان شده</p>
                            </a>
                        </li>
                    @endcan
                    @can('RecentseensInPanel')
                        <li class="nav-item">
                            <a href="{{route('ad.recentseens.supplier.realestate')}}" class="nav-link">
                                <i class="nav-icon fa fa-eye text-warning"></i>
                                <p class="temp-white-text">بازدیدهای اخیر</p>
                            </a>
                        </li>
                    @endcan
                    @can('PostedAdsInPanel')
                        <li class="nav-item has-treeview">
                            <a class="nav-link" style="cursor: pointer">
                                <i class="nav-icon fa fa-upload text-warning"></i>
                                <p class="temp-white-text">
                                    آگهی های ارسال شده
                                    <i class="right fa fa-angle-left nav-icon"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('ad.index.postedToSpecificAgency.panel', auth()->user()->hasRole('real-state-agent') ? \Modules\User\Entities\User::find(auth()->id())->real_estate_admin_id:auth()->id())}}"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon text-warning"></i>
                                        <p class="temp-white-text">ویژه کسب و کار شما</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('ad.index.postedAgencies.panel')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon text-warning"></i>
                                        <p class="temp-white-text">درخواست به تمامی کسب و کار ها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('MembershipsInPanel')
                        @if(\Modules\Membership\Entities\Membership::where('active', 1)->get()->count()>0 ||
\Modules\ApplicantMembership\Entities\ApplicantMembership::where('active', 1)->get()->count()>0)
                            <li class="nav-item">
                                <a href="{{route('membership.index.realestate')}}"
                                   class="nav-link">
                                    <i class="nav-icon fa fa-star text-warning"></i>
                                    <p class="temp-white-text">حق اشتراک ها</p>
                                </a>
                            </li>
                        @endif
                    @endcan
                    @can('MyMembershipsInPanel')
                        @if(auth()->user()->memberships()
                ->wherePivot('startDate', '<=', \Carbon\Carbon::now())
                ->wherePivot('endDate', '>', \Carbon\Carbon::now())
                ->get()->count()>0 || auth()->user()->applicantMemberships()
                ->wherePivot('startDate', '<=', \Carbon\Carbon::now())
                ->wherePivot('endDate', '>', \Carbon\Carbon::now())
                ->get()->count()>0)
                            <li class="nav-item">
                                <a href="{{route('membership.show.realestate', auth()->id())}}" class="nav-link">
                                    <i class="nav-icon fa fa-star-o text-warning"></i>
                                    <p class="temp-white-text">حق اشتراک های من</p>
                                </a>
                            </li>
                        @endif
                    @endcan
                    {{--                    @if(auth()->user()->hasRole('contractor'))--}}
                    @can('ContractorProjectsInPanel')
                        <li class="nav-item">
                            <a href="{{route('contractorProject.index.realestate')}}" class="nav-link">
                                <i class="nav-icon fa fa-list-ul text-warning"></i>
                                <p class="temp-white-text">پروژه های پیمانکاران</p>
                            </a>
                        </li>
                    @endcan
                    {{--                        @endif--}}
                    @can('UserHologramApplyInPanel')
                        <li class="nav-item">
                            <a href="{{route('hologram.index.realestate', ['type'=>'user', 'id'=>auth()->id()])}}"
                               class="nav-link">
                                <i class="nav-icon fa fa-certificate text-warning"></i>
                                <p class="temp-white-text">درخواست هولوگرام کاربر</p>
                            </a>
                        </li>
                    @endcan
                    @can('MyHologramsInPanel')
                        <li class="nav-item">
                            <a href="{{route('hologram.myHolograms.realestate')}}" class="nav-link">
                                <i class="nav-icon fa fa-certificate text-warning"></i>
                                <p class="temp-white-text"> هولوگرام های من</p>
                            </a>
                        </li>
                    @endcan
                    @can('HologramsInPanel')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <i class="nav-icon fa fa-certificate text-warning"></i>

                                <p class="temp-white-text">
                                    هولوگرام ها
                                    <i class="right fa fa-angle-left text-warning"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('hologramInterface.index.realestate', 'pending')}}"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon text-warning"></i>
                                        <p class="temp-white-text">درخواست ها</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('hologramInterface.index.realestate', 'checked')}}"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon text-warning"></i>
                                        <p class="temp-white-text">بررسی شده ها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('AdvertisementInPanel')

                        <li class="nav-item">
                            <a href="{{route('advertisings.index.realestate')}}"
                               class="nav-link">
                                <i class="nav-icon fa fa-camera-retro text-warning"></i>
                                <p class="temp-white-text">تبلیغات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('advertisingApplicants.index.realestate')}}"
                               class="nav-link">
                                <i class="nav-icon fa fa-camera-retro text-warning"></i>
                                <p class="temp-white-text">تبلیغات رزرو شده ی شما</p>
                            </a>
                        </li>
                    @endcan
                    @can('ApplicationsInPanel')
                        <li class="nav-item has-treeview">
                            <a class="nav-link" style="cursor: pointer">
                                <i class="nav-icon fa fa-list-alt text-warning"></i>
                                <p class="temp-white-text">
                                    درخواست ها
                                    <i class="right fa fa-angle-left nav-icon"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('applications.index.postedToSpecificAgency.panel', auth()->user()->hasRole('real-state-agent') ? \Modules\User\Entities\User::find(auth()->id())->real_estate_admin_id:auth()->id())}}"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon text-warning"></i>
                                        <p class="temp-white-text">ویژه کسب و کار شما</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('applications.index.realestate')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon text-warning"></i>
                                        <p class="temp-white-text">درخواست به تمامی کسب و کار ها</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('applications.seen.realestate')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon text-warning"></i>
                                        <p class="temp-white-text">درخواست های دیده شده</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="{{route('applications.index.realestate')}}"--}}
                        {{--                               class="nav-link">--}}
                        {{--                                <i class="nav-icon fa fa-list-alt text-warning"></i>--}}
                        {{--                                <p class="temp-white-text">درخواست ها</p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="{{route('applications.seen.realestate')}}" class="nav-link">--}}
                        {{--                                <i class="nav-icon fa fa-list-alt text-warning"></i>--}}
                        {{--                                <p class="temp-white-text">درخواست های دیده شده</p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                    @endcan
                    @can('ArticlesInPanel')

                        <li class="nav-item">
                            <a href="{{route('articles.index.panel')}}"
                               class="nav-link">
                                <i class="nav-icon fa fa-list-ul text-warning"></i>
                                <p class="temp-white-text">مقالات</p>
                            </a>
                        </li>
                    @endcan

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>

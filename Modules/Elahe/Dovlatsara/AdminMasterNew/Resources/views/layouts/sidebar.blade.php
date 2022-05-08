<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        @if(isset(\Modules\Setting\Entities\Setting::where('title', 'bright_logo_of_site')->first()->str_value))
            <img
                src="{{asset(\Modules\Setting\Entities\Setting::where('title', 'bright_logo_of_site')->first()->str_value)}}"
                alt="AdminLTE Logo" class="brand-image elevation-3"
                style="opacity: .8">
        @endif
        <span class="brand-text font-weight-light">پنل مدیریت </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    {{--                    <img src2="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">--}}
                </div>
                <div class="info">
                    <a href="#"
                       class="d-block">{{\Modules\Setting\Entities\Setting::where('title', 'title_of_site')->first()->str_value}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @can('PermissionsInAdmin')

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <p>
                                    سطح دسترسی
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('roles.index')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>نقش ها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('UsersInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                {{--                            <i class="nav-icon fa fa-pie-chart"></i>--}}
                                <p>
                                    کاربران
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach(\Modules\RoleAndPermissionNew\Entities\RoleNew::all() as $role)
                                    @if($role->slug != 'contractor')
                                        <li class="nav-item">
                                            <a href="{{route('users.index.admin', $role->slug)}}"
                                               class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>{{$role->name}}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endcan
                    @can('CitiesInAdmin')
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                {{--                            <i class="nav-icon fa fa-pie-chart"></i>--}}
                                <p>
                                    شهرها و محله ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('cities.index')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست شهرها و محله ها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('CategoriesInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                {{--                            <i class="nav-icon fa fa-pie-chart"></i>--}}
                                <p>
                                    دسته بندی ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('category.index.admin', 0)}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست دسته بندی ها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('AdsInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                {{--                            <i class="nav-icon fa fa-pie-chart"></i>--}}
                                <p>
                                    آگهی ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="margin-right: 10px">
                                <li class="nav-item">
                                    <a href="{{route('ad.index.supplier.admin', 'disConfirm')}}" class="nav-link">
                                        <span
                                            style="color: yellow">{{\Modules\Ad\Entities\Ad::where('active', 'disConfirm')->endDateGreaterThan(\Carbon\Carbon::now())->get()->count()}}</span>
                                        {{--                                        <i class="fa fa-circle-o nav-icon"></i>--}}
                                        <p>تایید نشده</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('ad.index.supplier.admin', 'active')}}" class="nav-link">
                                        <span
                                            style="color: yellow">{{\Modules\Ad\Entities\Ad::where('active', 'active')->endDateGreaterThan(\Carbon\Carbon::now())->get()->count()}}</span>
                                        {{--                                        <i class="fa fa-circle-o nav-icon"></i>--}}
                                        <p>تایید شده</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('ad.index.supplier.admin', 'inactive')}}" class="nav-link">
                                        <span
                                            style="color: yellow">{{\Modules\Ad\Entities\Ad::where('active', 'inactive')->endDateGreaterThan(\Carbon\Carbon::now())->get()->count()}}</span>
                                        {{--                                        <i class="fa fa-circle-o nav-icon"></i>--}}
                                        <p>غیرفعال</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('ad.index.supplier.admin', 'expire')}}" class="nav-link">
                                        <span
                                            style="color: yellow">{{\Modules\Ad\Entities\Ad::endDateSmallerThan(\Carbon\Carbon::now())->get()->count()}}</span>
                                        <p>منقضی شده</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('ad.index.supplier.admin', 'delete')}}" class="nav-link">
                                        <span
                                            style="color: yellow">{{\Modules\Ad\Entities\Ad::where('active', 'delete')->endDateGreaterThan(\Carbon\Carbon::now())->get()->count()}}</span>
                                        {{--                                        <i class="fa fa-circle-o nav-icon"></i>--}}
                                        <p>حذف شده</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('ApplicationsInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    درخواست ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('application.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست درخواست ها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('MembershipsInAdmin')

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                {{--                            <i class="nav-icon fa fa-pie-chart"></i>--}}
                                <p>
                                    حق اشتراک ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('memberships.index')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست حق اشتراک ها</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('membership_reduction_score.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>کسر امتیازها</p>
                                    </a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('applicant-memberships.index')}}" class="nav-link">--}}
{{--                                        <i class="fa fa-circle-o nav-icon"></i>--}}
{{--                                        <p>لیست حق اشتراک ها ی درخواست</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                        </li>
                    @endcan
                    {{--                    @can('AssociationsInAdmin')--}}

                    {{--                        <li class="nav-item has-treeview">--}}
                    {{--                            <a href="" class="nav-link">--}}
                    {{--                                <p>--}}
                    {{--                                    اصناف--}}
                    {{--                                    <i class="right fa fa-angle-left"></i>--}}
                    {{--                                </p>--}}
                    {{--                            </a>--}}
                    {{--                            <ul class="nav nav-treeview">--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="{{route('associations.index.admin', 0)}}" class="nav-link">--}}
                    {{--                                        <i class="fa fa-circle-o nav-icon"></i>--}}
                    {{--                                        <p>لیست اصناف</p>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </li>--}}
                    {{--                    @endcan--}}
                    @can('ShopsInAdmin')

                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    کسب و کار ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('users.shops.index.admin', 'inactive')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>غیرفعال</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('users.shops.index.admin', 'disConfirm')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>تایید نشده</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('users.shops.index.admin', 'active')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>تایید شده</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('HologramsInAdmin')

                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    هولوگرام ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('holograms.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست هولوگرام ها</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('hologramInterface.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست درخواست ها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('AdvertisementInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    تبلیغات
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('advertisings.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست تبلیغات</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('advertisingApplicants.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست درخواست ها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('SettingsInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    تنظیمات
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('setting.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>تنظیمات</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('CommonQuestionsInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    سوالات متداول
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('commonQuestions.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست سوالات</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('ArticlesInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    مقالات
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('article-groups.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>گروه مقالات</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('articles.all.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست مقالات</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('PaymentsInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    پرداخت ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach(\Modules\Order\Entities\Order::$enumType as $type)
                                    @if($type!='applicantMembership')
                                        <li class="nav-item">
                                            <a href="{{route('payments.index.admin', $type)}}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                @if($type=='ad')
                                                    <p>آگهی</p>
                                                @elseif($type=='advertisement')
                                                    <p>تبلیغات</p>

                                                @elseif($type=='membership')
                                                    <p>حق اشتراک ها</p>

                                                @elseif($type=='applicantMembership')
                                                    <p>حق اشتراک های درخواست</p>
                                                @elseif($type=='hologram')
                                                    <p>هولوگرام ها</p>

                                                @endif
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endcan
                    @can('CustomerClubInAdmin')

                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                {{--                            <i class="nav-icon fa fa-pie-chart"></i>--}}
                                <p>
                                    باشگاه مشتریان
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('scores.index.admin')}}"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>امتیازها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('BlogInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    وبلاگ {{\Modules\Setting\Entities\Setting::where('title', 'title_of_site')->first()->str_value}}
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('position.index.admin')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> پوزیشن های وبلاگ</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('CommentInAdmin')
                        <li class="nav-item has-treeview">
                            <a class="nav-link">
                                <p>
                                    نظرات
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin-comments-index')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> نظرات</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    <hr>
                    @can('WidgetsInAdmin')
                        <li class="nav-item">
                            <a href="{{route('widget.index.admin')}}" class="nav-link">
                                <i class="fa fa-th nav-icon"></i>
                                <p>ویجت ها</p>
                            </a>
                        </li>
                    @endcan
                    @can('HeaderIconInAdmin')
                        <li class="nav-item">
                            <a href="{{route('header_icon.index.admin')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>آیکون های صفحه اصلی</p>
                            </a>
                        </li>
                    @endcan
                    @can('AppInAdmin')
                        <li class="nav-item">
                            <a href="{{route('app.create.admin')}}" class="nav-link">
                                <i class="fa fa-android nav-icon"></i>
                                <p>اپلیکیشن</p>
                            </a>
                        </li>
                    @endcan
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a href="{{route('contactUs.create.admin')}}" class="nav-link">--}}
                    {{--                            <i class="fa fa-phone nav-icon"></i>--}}
                    {{--                            <p>تماس با ما</p>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    @can('AboutUsInAdmin')
                        <li class="nav-item">
                            <a href="{{route('aboutUs.create.admin')}}" class="nav-link">
                                <i class="fa fa-info nav-icon"></i>
                                <p>درباره ما</p>
                            </a>
                        </li>
                    @endcan
                    @can('TermsInAdmin')
                        <li class="nav-item">
                            <a href="{{route('rulesAndTerms.create.admin')}}" class="nav-link">
                                <i class="fa fa-gavel nav-icon"></i>
                                <p>قوانین و مقررات</p>
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

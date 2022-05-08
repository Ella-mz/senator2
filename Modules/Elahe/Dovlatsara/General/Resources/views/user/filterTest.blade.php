@extends('UserMasterNew::master')
@section('title_user')آگهی های {{$category->title}}
@endsection
@section('content_userMasterNew')
    <main>
        <div class="header-search-box">
            <div class="container">
                <div class="search-box">
                    <div class="row">

                        <div class="input-box my-4 px-3">
                            @foreach($categories as $category)
                                @component('UserMaster::components.searchInSupplierAds',
                                ['id'=>$category->id,
                                'title'=>$category->title
                                ])

                                @endcomponent
                            @endforeach
                            {{--                            <form action="/action_page.php">--}}
                            {{--                                <select name="titles" id="titles">--}}
                            {{--                                    <option value="volvo"> اپ </option>--}}
                            {{--                                    <option value="saab">اجاره خانه</option>--}}
                            {{--                                    <option value="opel">خرید خانه</option>--}}
                            {{--                                    <option value="audi">درخواست خانه</option>--}}
                            {{--                                </select>--}}
                            {{--                                <input type="input" class="header-input large my-2" placeholder="آدرس، منطقه، محله">--}}
                            {{--                                <button class="RecBtn red">جستجو</button>--}}
                            {{--                            </form>--}}
                        </div>
                    </div>


                    <div class="search-map">
                        <a href="#">
                            <img src="{{asset('files/userMaster/assets/img/download (2).jpg')}}" alt="">
                            <span>جستجو روی نقشه</span>
                        </a>

                    </div>
                </div>

            </div>

        </div>
        <!-- show product -->
        <section class="show-product">
            <div class="container">
                <div class="row">


                    <div class="col-lg-3 col-md-4 col-xs-12 d-lg-block d-none">
                        <div class="sidebar-wrapper search-sidebar">
                            <div class="box-sidebar">
                                <span class="box-header-sidebar">دسته‌بندی نتایج</span>
                                <div class="catalog">
                                    <ul class="catalog-list">
                                        <li><a href="#" class="catalog-link"><i class="fa fa-angle-left"></i>کالای
                                                دیجیتال</a>
                                            <div class="show-more">
                                                <span class="catalog-cat-item"><i class="fa fa-angle-down"></i>لوازم جانبی گوشی</span>
                                                <span class="catalog-cat-item"><i class="fa fa-angle-down"></i>لوازم جانبی گوشی موبایل</span>
                                                <ul class="catalog-list">
                                                    <li><a href="#" class="catalog-link"> کیف و کاور گوشی</a></li>
                                                    <li><a href="#" class="catalog-link">محافظ صفحه نمایش گوشی</a></li>
                                                    <li><a href="#" class="catalog-link">هندزفری</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="box-sidebar">
                                <span class="box-header-sidebar">حدود قیمت</span>
                                <div class="price minimum" style="display: none">
                                    <p>حداقل قیمت:</p>
                                    <input type="number" class="minimum-price">
                                </div>
                                <div class="price maximum">
                                    <p>حداکثر قیمت:</p>
                                    <input type="number" class="maximum-price">
                                </div>


                            </div>
                            <div class="box-sidebar">
                                <span class="box-header-sidebar activeacc"><i class="fa fa-chevron-up arrow"></i>فروشنده</span>
                                <div class="catalog" style="display: none;">
                                    <ul>
                                        <li>
                                            <a href="#" class="filter-label">
                                                <div class="form-auth-row">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" value="1" name="login" id="remember">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <label for="remember" class="remember-me">دیجی استور</label>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="filter-label">
                                                <div class="form-auth-row">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" value="1" name="login" id="remember">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <label for="remember" class="remember-me">دیجی استور</label>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="box-sidebar">
                                <span class="box-header-sidebar activeacc"><i class="fa fa-chevron-up arrow"></i>فروشنده</span>
                                <div class="catalog" style="display: none;">
                                    <ul>
                                        <li>
                                            <a href="#" class="filter-label">
                                                <div class="form-auth-row">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" value="1" name="login" id="remember">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <label for="remember" class="remember-me">دیجی استور</label>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="filter-label">
                                                <div class="form-auth-row">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" value="1" name="login" id="remember">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <label for="remember" class="remember-me">دیجی استور</label>
                                                </div>
                                            </a>

                                            <a href="#" class="filter-label">
                                                <div class="form-auth-row">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" value="1" name="login" id="remember">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <label for="remember" class="remember-me">دیجی استور</label>
                                                </div>
                                            </a>

                                            <a href="#" class="filter-label">
                                                <div class="form-auth-row">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" value="1" name="login" id="remember">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <label for="remember" class="remember-me">دیجی استور</label>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="box-sidebar">
                                <div class="filter-switch">
                                    <div class="switch-box">
                                        <div class="centered hidden-xs">
                                            <div class="">
                                                <a href="#">
                                                    <label for="switch1">
                                                        <input type="checkbox" id="switch1"><span class="switch"><h1
                                                                class="switch-title">فقط کالای موجود</h1></span>
                                                        <span class="toggle"></span>
                                                    </label>
                                                </a>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-sidebar">
                                <div class="filter-switch">
                                    <div class="switch-box">
                                        <div class="centered hidden-xs">
                                            <div class="">
                                                <a href="#">
                                                    <label for="switch2">
                                                        <input type="checkbox" id="switch2"><span class="switch"><h1
                                                                class="switch-title">فقط کالای آماده ارسال</h1></span>
                                                        <span class="toggle"></span>
                                                    </label>
                                                </a>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--   adplacement -------------------->

                            <!--   adplacement -------------------->

                        </div>
                    </div>

                    <div class="col-lg-9 col-12">

                        <div class="resent-product">
                            <div class="container">
                                <div class="resent-product-title">

                                    <h1>آخرین ملک ها</h1>
                                    <h6>جدید ترین ملک های ثبت شده</h6>
                                </div>
                                <div class="header-product-box-left mb-4">

                                    <div class="filter d-lg-none">
                                        <button type="button" class="RecBtn red show" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal2">
                                            فیلتر‌های بیشتر
                                        </button>
                                        <div class="modal fade" id="exampleModal2" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">فیلترها</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="sidebar-wrapper search-sidebar">
                                                            <div class="box-sidebar">
                                                                <span class="box-header-sidebar">دسته‌بندی نتایج</span>
                                                                <div class="catalog">
                                                                    <ul class="catalog-list">
                                                                        <li><a href="#" class="catalog-link"><i
                                                                                    class="fa fa-angle-left"></i>کالای
                                                                                دیجیتال</a>
                                                                            <div class="show-more">
                                                                                <span class="catalog-cat-item"><i
                                                                                        class="fa fa-angle-down"></i>لوازم جانبی گوشی</span>
                                                                                <span class="catalog-cat-item"><i
                                                                                        class="fa fa-angle-down"></i>لوازم جانبی گوشی موبایل</span>
                                                                                <ul class="catalog-list">
                                                                                    <li><a href="#"
                                                                                           class="catalog-link"> کیف و
                                                                                            کاور گوشی</a></li>
                                                                                    <li><a href="#"
                                                                                           class="catalog-link">محافظ
                                                                                            صفحه نمایش گوشی</a></li>
                                                                                    <li><a href="#"
                                                                                           class="catalog-link">هندزفری</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>


                                                            <div class="box-sidebar">
                                                                <span class="box-header-sidebar">حدود قیمت</span>
                                                                <div class="price minimum">
                                                                    <p>حداقل قیمت:</p>
                                                                    <input type="number" class="minimum-price">
                                                                </div>
                                                                <div class="price maximum">
                                                                    <p>حداکثر قیمت:</p>
                                                                    <input type="number" class="maximum-price">
                                                                </div>


                                                            </div>
                                                            <div class="box-sidebar">
                                                                <span class="box-header-sidebar activeacc"><i
                                                                        class="fa fa-chevron-up arrow"></i>فروشنده</span>
                                                                <div class="catalog" style="display: none;">
                                                                    <ul>
                                                                        <li>
                                                                            <a href="#" class="filter-label">
                                                                                <div class="form-auth-row">
                                                                                    <label for="#" class="ui-checkbox">
                                                                                        <input type="checkbox" value="1"
                                                                                               name="login"
                                                                                               id="remember">
                                                                                        <span
                                                                                            class="ui-checkbox-check"></span>
                                                                                    </label>
                                                                                    <label for="remember"
                                                                                           class="remember-me">دیجی
                                                                                        استور</label>
                                                                                </div>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="filter-label">
                                                                                <div class="form-auth-row">
                                                                                    <label for="#" class="ui-checkbox">
                                                                                        <input type="checkbox" value="1"
                                                                                               name="login"
                                                                                               id="remember">
                                                                                        <span
                                                                                            class="ui-checkbox-check"></span>
                                                                                    </label>
                                                                                    <label for="remember"
                                                                                           class="remember-me">دیجی
                                                                                        استور</label>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="box-sidebar">
                                                                <span class="box-header-sidebar activeacc"><i
                                                                        class="fa fa-chevron-up arrow"></i>فروشنده</span>
                                                                <div class="catalog" style="display: none;">
                                                                    <ul>
                                                                        <li>
                                                                            <a href="#" class="filter-label">
                                                                                <div class="form-auth-row">
                                                                                    <label for="#" class="ui-checkbox">
                                                                                        <input type="checkbox" value="1"
                                                                                               name="login"
                                                                                               id="remember">
                                                                                        <span
                                                                                            class="ui-checkbox-check"></span>
                                                                                    </label>
                                                                                    <label for="remember"
                                                                                           class="remember-me">دیجی
                                                                                        استور</label>
                                                                                </div>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="filter-label">
                                                                                <div class="form-auth-row">
                                                                                    <label for="#" class="ui-checkbox">
                                                                                        <input type="checkbox" value="1"
                                                                                               name="login"
                                                                                               id="remember">
                                                                                        <span
                                                                                            class="ui-checkbox-check"></span>
                                                                                    </label>
                                                                                    <label for="remember"
                                                                                           class="remember-me">دیجی
                                                                                        استور</label>
                                                                                </div>
                                                                            </a>

                                                                            <a href="#" class="filter-label">
                                                                                <div class="form-auth-row">
                                                                                    <label for="#" class="ui-checkbox">
                                                                                        <input type="checkbox" value="1"
                                                                                               name="login"
                                                                                               id="remember">
                                                                                        <span
                                                                                            class="ui-checkbox-check"></span>
                                                                                    </label>
                                                                                    <label for="remember"
                                                                                           class="remember-me">دیجی
                                                                                        استور</label>
                                                                                </div>
                                                                            </a>

                                                                            <a href="#" class="filter-label">
                                                                                <div class="form-auth-row">
                                                                                    <label for="#" class="ui-checkbox">
                                                                                        <input type="checkbox" value="1"
                                                                                               name="login"
                                                                                               id="remember">
                                                                                        <span
                                                                                            class="ui-checkbox-check"></span>
                                                                                    </label>
                                                                                    <label for="remember"
                                                                                           class="remember-me">دیجی
                                                                                        استور</label>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="box-sidebar">
                                                                <div class="filter-switch">
                                                                    <div class="switch-box">
                                                                        <div class="centered hidden-xs">
                                                                            <div class="">
                                                                                <a href="#">
                                                                                    <label for="switch1">
                                                                                        <input type="checkbox"
                                                                                               id="switch1"><span
                                                                                            class="switch"><h1
                                                                                                class="switch-title">فقط کالای موجود</h1></span>
                                                                                        <span class="toggle"></span>
                                                                                    </label>
                                                                                </a>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="box-sidebar">
                                                                <div class="filter-switch">
                                                                    <div class="switch-box">
                                                                        <div class="centered hidden-xs">
                                                                            <div class="">
                                                                                <a href="#">
                                                                                    <label for="switch2">
                                                                                        <input type="checkbox"
                                                                                               id="switch2"><span
                                                                                            class="switch"><h1
                                                                                                class="switch-title">فقط کالای آماده ارسال</h1></span>
                                                                                        <span class="toggle"></span>
                                                                                    </label>
                                                                                </a>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--   adplacement -------------------->

                                                            <!--   adplacement -------------------->

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="RecBtn white operate "
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
                                                        <button type="button" class="RecBtn red close">اعمال
                                                            تغییرات
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    @foreach($ads as $ad)
                                        <div
                                            class=" col-xl-4 col-sm-6 mb-5 d-flex justify-content-center flex-column align-items-center">
                                            @component('UserMasterNew::components.adCard')
                                                @slot('image')
                                                    {{isset($ad->adImages->first()->image)?$ad->adImages->first()
                                                                    ->iamge:\Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}
                                                @endslot
                                                @slot('golden_hologram')
                                                    {{\Modules\Setting\Entities\Setting::where('title', 'golden_hologram')->first()->str_value}}
                                                @endslot
                                                @slot('emergency_label')
                                                    {{$ad->type=='emergency'?\Modules\Setting\Entities\Setting::where('title', 'emergency_label')
                                                    ->first()->str_value:null}}
                                                @endslot
                                                @slot('real_estate')
                                                    {{isset($ad->user->shop_id)?$ad->user->shop->title:''}}
                                                @endslot
                                                @slot('title')
                                                    {{$ad->title}}
                                                @endslot
                                                @slot('city')
                                                    {{$ad->city->title}}
                                                @endslot
                                                @slot('ad_unique_code')
                                                    {{$ad->uniqueCodeOfAd}}
                                                @endslot
                                                @slot('first_attr')
                                                    @if($ad->attributes->first())
                                                        {{$ad->attributes->first()->title}}
                                                    @endif
                                                @endslot
                                                @slot('second_attr')
                                                    @if($ad->attributes->count()>1)
                                                        {{($ad->attributes()->skip(1)->first()->pivot->value)}}
                                                    @endif

                                                @endslot
                                            @endcomponent
                                        </div>
                                    @endforeach
                                </div>
                                <div class="product-more">
                                    <a href="">
                                        <span>موارد بیشتر</span>
                                        <img src="{{asset('files/userMaster/assets/img/Group 18.svg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- show product -->

    </main>

@endsection
@section('js_user')

    <script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>
@endsection

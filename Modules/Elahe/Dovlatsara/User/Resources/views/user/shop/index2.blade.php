@extends('UserMasterNew::master')
@section('title_user')کسب و کار ها
@endsection
@section('css_user')
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.carousel.min.css')}}" />--}}
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/dolatsara.css')}}"/>--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.theme.default.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/contractor.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/store.css')}}">
    {{--    <link rel="stylesheet" href="./assets/css/slick.css">--}}
    {{--    <link rel="stylesheet" href="./assets/css/slick-theme.css">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.carousel2.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/pagination.css')}}">
    <style>
        div.dolat-header {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            position: relative;
        }

        div.dolat-header div.dolat-content {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 100%;
        }

        div.dolat-header div.dolat-content div.dolat__forms-box {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 90%;
            max-width: 600px;
            align-items: center;
            justify-content: center;
        }

        div.dolat-header div.dolat-content div.dolat__forms-box form {
            position: relative;
        }

        div.dolat-header div.dolat-content div.dolat__forms-box form input.dolat__search-input {
            font-size: 14px;
            color: #4a1f61;
            border: 1px solid #b8b8b8;
            /*background: #eeeeee;*/
            padding: 0.65rem 2.1rem 0.65rem 2rem;
            border-top-right-radius: 28px;
            border-bottom-right-radius: 28px;
            border-bottom-left-radius: 28px;
            border-top-left-radius: 28px;
            width: 420px;
            height: 50px;
            direction: rtl;
        }

        div.dolat-header div.dolat-content div.dolat__forms-box form input.dolat__search-input::-webkit-input-placeholder {
            font-size: 12px;
            color: #b8b8b8;
        }

        div.dolat-header div.dolat-content div.dolat__forms-box form input.dolat__search-input:-ms-input-placeholder {
            font-size: 12px;
            color: #b8b8b8;
        }

        div.dolat-header div.dolat-content div.dolat__forms-box form input.dolat__search-input::placeholder {
            font-size: 12px;
            color: #b8b8b8;
        }

        div.dolat-header div.dolat-content div.dolat__forms-box form button.dolat__search-button {
            position: absolute;
            left: 0.5rem;
            top: 10px;
            background: transparent;
            border: 0;
            padding: 7px;
            border-right: 1px solid #b8b8b8;
            width: 33px;
        }

        div.dolat-header div.dolat-content div.dolat__forms-box form button.dolat__search-button2 {
            position: absolute;
            right: 0.5rem;
            top: 18px;
            background: transparent;
            border: 0;
            padding: 0;
        }

        div.dolat-header div.dolat-content div.dolat__forms-box form svg,
        div.dolat-header div.dolat-content div.dolat__forms-box form i,
        div.dolat-header div.dolat-content div.dolat__forms-box form span{
            color: #b8b8b8;
        }

        div.dolat-header div.dolat-content h2.dolatsara__title-placeholder-title {
            color: #4a1f61;
            margin-bottom: 2rem;
        }

    </style>
@endsection
@section('content_userMasterNew')
    <main>

        <div class="container">

            <div class="ad-slider owl-carousel2 owl-theme slider d-flex d-lg-none mb-3">
                @foreach($advertisement as $key=>$ad)
                    <div class="item">
                        <div class="advertisments-place header">
                            <div class="ad-box medium">
                                <img src="{{asset($ad->image)}}" alt="">
                                <a href="{{$ad->link}}" target="_blank"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($advertisement->count()==1)
                    <div class="item">
                        <div class="advertisments-place header">
                            <div class="ad-box medium">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-6 py-4">
                                        <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="item">
                            <div class="advertisments-place header">
                                <div class="ad-box medium">
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-6 py-4">
                                            <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
                    @if($advertisement->count()==2)
                        <div class="item">
                            <div class="advertisments-place header">
                                <div class="ad-box medium">
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-6 py-4">
                                            <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @if($advertisement->count()<=0)
                    @for($i=0; $i<3; $i++)
                        <div class="item">
                            <div class="advertisments-place header">
                                <div class="ad-box medium">
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-6 py-4">
                                            <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif

            </div>
{{--        </div>--}}
{{--        <div class="container">--}}
            <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-12 d-lg-block d-none"></div>
            <div class="col-lg-9 col-12 justify-content-center align-items-center">
                <div class="best-contractor-slider-title">
                    <h4 style="color: #ddb24f">
                        بزرگان صنعت ساختمان
                    </h4>
                </div>
                <div class="dolat-header">
                    <div class="dolat-content">
                        <div class="dolat__forms-box">
                            <div class="dolatsara__search-title-head">
                                <form action="{{route('realEstate.index.user')}}" method="get">
                                    <button class="dolat__search-button2">
                                        <i class="fa fa-list search-icon"></i>
                                    </button>
                                    <input type="text" class="dolat__search-input" name="search" value="{{isset($search)?$search:old('search')}}"
                                           placeholder="جستجو با نام کسب و کارها">
                                    <button class="dolat__search-button">
{{--                                        <img src="{{asset('files/userMaster/src/images/icons8-vertical-line-50.png')}}" width="25">--}}
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </form>
                                {{--                        <form action="{{route('supplierFilterPage.user')}}" method="get" style="margin-right:2px">--}}
                                {{--                            <input hidden name="type"--}}
                                {{--                                   value="emergency">--}}
                                {{--                            <button class="dolatsara__instant-ads-button">آگهی های فوری</button>--}}
                                {{--                        </form>--}}

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <div class="show-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12 d-lg-block d-none">
                        <div class="sidebar-wrapper search-sidebar">
                            <div class="box-sidebar">
                                <div class="catalog grouping">
                                    <div class="sidebar-title">
                                        <p>حوزه تخصصی فعالیت</p>
                                    </div>
                                    <ul class="catalog-list">
                                        @foreach($categories->where('depth', 1) as $key=>$cat1)
                                            <li>
                                                <div class="type-category accordion-item">
                                                    <form action="{{route('realEstate.index.user')}}" method="get"
                                                          id="level1{{$cat1->id}}">
                                                        <input hidden name="category"
                                                               value="{{$cat1->id}}">
                                                        <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"
                                                           style="cursor: pointer"> <span
                                                                style="margin-right: 10px">{{$cat1->title}}</span></a>
                                                    </form>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                            <form class="form-horizontal" id="shopFilter_form"
                                  method="post">
                                @csrf
                                <input hidden name="filter" value="1">
                                <div class="box-sidebar">
                                    <span class="box-header-sidebar activeacc"><i class="fa fa-chevron-down arrow"></i>شهر و محله</span>
                                    <div class="catalog" style="display: none;">
                                        <div class="select-box">
                                            <select class="js-example-basic-multiple city" style="width: 100%;"
                                                    name="city">
                                                <option value="all">شهر</option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="select-box">
                                            <select class="js-example-basic-multiple neighborhood" style="width: 100%;"
                                                    name="neighborhood[]" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-sidebar">
                                    <span class="box-header-sidebar activeacc">به جمع بزرگان صنعت، بپیوندید</span>
                                    <div class="catalog">
                                        <span style="color: #4a1f61;font-weight: bold">
{{--                                            میخواهم برای خودم کسب و کار ایجاد کنم--}}
                                        </span>
                                        <div class="d-flex justify-content-end align-items-end" style=" margin-bottom: 2%; margin-left: 5%;margin-top: 15%">
                                            <a target="_blank" href="{{route('auth.realestate.registerForm.user')}}" class="btn btn-danger">ایجاد کسب و کار</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="sidebar-advertisement">
                                    <div class="advertisments-place">
                                        @if($advertisement->count()>0)
                                            @foreach($advertisement as $key=>$ad3)
                                                @if($ad3->advertising->advertisingOrder->location=='R1' && isset($ad3->image))
                                                    <div class="ad-box short"><img src="{{asset($ad3->image)}}"
                                                                                   alt="">
                                                        <a href="{{$ad3->link}}" target="_blank"></a>
                                                    </div>
                                                @else
                                                    <div class="ad-box short">
                                                        <div class="row">
                                                            <div class="col-1"></div>
                                                            <div class="col-6 py-4">
                                                                <span
                                                                    style="font-weight: bolder">مکان تبلیغات شما</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($ad3->advertising->advertisingOrder->location=='R2' && isset($ad3->image))
                                                    <div class="ad-box medium"><img
                                                            src="{{asset($ad3->image)}}"
                                                            alt="">
                                                        <a href="{{$ad3->link}}" target="_blank"></a>
                                                    </div>
                                                @else
                                                    <div class="ad-box medium">
                                                        <div class="row">
                                                            <div class="col-1"></div>
                                                            <div class="col-6 py-4">
                                                                <span
                                                                    style="font-weight: bolder">مکان تبلیغات شما</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($ad3->advertising->advertisingOrder->location=='R3' && isset($ad3->image))
                                                    <div class="ad-box long"><img src="{{asset($ad3->image)}}"
                                                                                  alt="">
                                                        <a href="{{$ad3->link}}" target="_blank"></a>
                                                    </div>
                                                @else
                                                    <div class="ad-box long">
                                                        <div class="row">
                                                            <div class="col-1"></div>
                                                            <div class="col-6 py-4">
                                                                <span
                                                                    style="font-weight: bolder">مکان تبلیغات شما</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @endforeach
                                        @else
                                            <div class="ad-box short">
                                                <div class="row">
                                                    <div class="col-1"></div>
                                                    <div class="col-6 py-4">
                                                        <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ad-box medium">
                                                <div class="row">
                                                    <div class="col-1"></div>
                                                    <div class="col-6 py-4">
                                                        <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ad-box long">
                                                <div class="row">
                                                    <div class="col-1"></div>
                                                    <div class="col-6 py-4">
                                                        <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </form>

                            <!--   adplacement -------------------->

                        </div>
                    </div>
                    <div class="col-lg-9 col-12 justify-content-center align-items-center">

                        <div class="resent-product" style="margin-top: 40px">
                            <div class="container">
                                {{--                                <div class="resent-product-title">--}}

                                {{--                                    <h4>آخرین آگهی ها</h4>--}}
                                {{--                                </div>--}}
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
                                                                <div class="catalog grouping">
                                                                    <div class="sidebar-title">
                                                                        <p>حوزه تخصصی فعالیت</p>
                                                                    </div>
                                                                    <ul class="catalog-list">
                                                                        @foreach($categories->where('depth', 1) as $key=>$cat1)
                                                                            <li>
                                                                                <div
                                                                                    class="type-category accordion-item">
                                                                                    <form
                                                                                        action="{{route('realEstate.index.user')}}"
                                                                                        method="get"
                                                                                        id="level1{{$cat1->id}}">
                                                                                        <input hidden name="category"
                                                                                               value="{{$cat1->id}}">
                                                                                        <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"
                                                                                           style="cursor: pointer"> <span
                                                                                                style="margin-right: 10px">{{$cat1->title}}</span></a>
                                                                                    </form>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <form class="form-horizontal" id="shopFilter_form_modal"
                                                                  method="post">
                                                                @csrf

                                                                <input hidden name="modalFilter" value="1">

                                                                <div class="box-sidebar">
                                                                    <span class="box-header-sidebar activeacc"><i
                                                                            class="fa fa-chevron-down arrow"></i>شهر</span>
                                                                    <div class="catalog" style="display: none;">
                                                                        <div class="select-box">
                                                                            <select
                                                                                class="js-example-basic-multiple cityModal"
                                                                                style="width: 100%;" name="cityModal">
                                                                                <option value="all">شهر</option>
                                                                                @foreach($cities as $city)
                                                                                    <option
                                                                                        value="{{$city->id}}">{{$city->title}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="select-box">
                                                                            <select
                                                                                class="js-example-basic-multiple neighborhoodModal"
                                                                                style="width: 100%;"
                                                                                name="neighborhoodModal[]"
                                                                                multiple="multiple">
                                                                                {{--                                                <option value="" >محله</option>--}}
                                                                                {{--                                                @foreach($cities as $city)--}}
                                                                                {{--                                                    <option value="{{$city->id}}">{{$city->title}}</option>--}}
                                                                                {{--                                                @endforeach--}}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="box-sidebar">
                                                                    <span class="box-header-sidebar activeacc">به جمع بزرگان صنعت، بپیوندید</span>
                                                                    <div class="catalog">
                                                                        <span style="color: #4a1f61;font-weight: bold">
{{--                                                                            میخواهم برای خودم کسب و کار ایجاد کنم--}}
                                                                        </span>
                                                                        <div class="d-flex justify-content-end align-items-end" style=" margin-bottom: 2%; margin-left: 5%;margin-top: 15%">
                                                                            <a target="_blank" href="{{route('auth.realestate.registerForm.user')}}" class="btn btn-danger">ایجاد کسب و کار</a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </form>

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

                                <div class="row" id="shopFilterPage">
                                    @foreach($shops as $shop)

                                        <div class="store col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-4">
                                            @component('UserMasterNew::components.shopCard')
                                                @slot('image')
                                                    {{isset($shop_default_photo)?$shop_default_photo:''}}
                                                @endslot

                                                @slot('title')
                                                    {{$shop->shop_title}}
                                                @endslot
                                                @slot('hologram')
                                                    @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()
                                                            && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()->status=='approved')
                                                        {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()->hologram->logo}}
                                                    @else
                                                        {{''}}
                                                    @endif
                                                @endslot
                                                @slot('city')
                                                    {{$shop->city->title}}
                                                @endslot
                                                @slot('neighborhood')
                                                    {{isset($shop->shop_neighborhood_id)?'-'.$shop->neighborhood->title:''}}
                                                @endslot
                                                @slot('phone')
                                                    {{$shop->shop_phone}}
                                                @endslot
                                                @slot('logo')
                                                    {{isset($shop->shop_logo)?$shop->shop_logo:$shop_default_logo}}
                                                @endslot
                                                @slot('id')
                                                    {{$shop->slug}}
                                                @endslot
                                            @endcomponent
                                        </div>
                                    @endforeach

                                </div>
                                <div class="justify-content-center align-content-center d-flex" id="pagination">
                                    {{--                                    @if($shops->count()>0 && $shops->links())--}}
                                    {{--                                        {{$shops->links()}}--}}
                                    {{--                                    @endif--}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
@section('js_user')
    <script>
        $(document).ready(function () {

            $(".owl-carousel").owlCarousel({
                rtl: true,
                items: 4,
                nav: true,
                autoplay: true,
                loop: true,
                autoplaySpeed: 2000,
                autoplayHoverPause: true,
                autoplayTimeout: 3000,
                dots: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                        loop: true
                    },
                    370: {
                        items: 1.05,
                        nav: false,
                        loop: true
                    },

                    390: {
                        items: 1.1,
                        nav: false,
                        loop: true
                    },
                    420: {
                        items: 1.15,
                        nav: false,
                        loop: true
                    },

                    450: {
                        items: 1.2,
                        nav: false,
                        loop: true
                    },
                    490: {
                        items: 1.3,
                        nav: false,
                        loop: true
                    },
                    550: {
                        items: 1.5,
                        nav: false,
                        loop: true
                    },
                    768: {
                        items: 1.9,
                        nav: false,
                        loop: true
                    },
                    920: {
                        items: 2.15,
                        nav: false,
                        loop: true
                    },
                    990: {
                        items: 2.6,
                        nav: true,
                        loop: true
                    },
                    1200: {
                        items: 3.2,
                        nav: true,
                        loop: true
                    },
                    1320: {
                        items: 3.3,
                        nav: true,
                        loop: true
                    },
                    1380: {
                        items: 3.4,
                        nav: true,
                        loop: true
                    },


                    1420: {
                        items: 4,

                        loop: true
                    },

                }

            });
        })
    </script>
    <script>
        $(document).ready(function () {
            $(".owl-carousel2").owlCarousel({
                rtl: true,
                items: 4,
                nav: true,
                autoplay: true,
                loop: true,
                autoplaySpeed: 2000,
                autoplayHoverPause: true,
                autoplayTimeout: 3000,
                dots: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                        loop: true
                    },
                    370: {
                        items: 1.05,
                        nav: false,
                        loop: true
                    },

                    390: {
                        items: 1.1,
                        nav: false,
                        loop: true
                    },
                    420: {
                        items: 1.15,
                        nav: false,
                        loop: true
                    },

                    450: {
                        items: 1.2,
                        nav: false,
                        loop: true
                    },
                    490: {
                        items: 1.3,
                        nav: false,
                        loop: true
                    },
                    550: {
                        items: 1.5,
                        nav: false,
                        loop: true
                    },
                    768: {
                        items: 1.9,
                        nav: false,
                        loop: true
                    },
                    920: {
                        items: 2.15,
                        nav: true,
                        loop: true
                    },
                    990: {
                        items: 2.6,
                        nav: true,
                        loop: true
                    },
                    1200: {
                        items: 3.2,
                        nav: true,
                        loop: true
                    },
                    1320: {
                        items: 3.3,
                        nav: true,
                        loop: true
                    },
                    1380: {
                        items: 3.4,
                        nav: true,
                        loop: true
                    },


                    1420: {
                        items: 4,

                        loop: true
                    },

                }

            });

        })
    </script>
    <script src="{{asset('files/userMaster/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/select2.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"]').on('change', function () {
                var cityId = jQuery(this).val();
                if (cityId) {
                    // console.log(cityId)
                    jQuery.ajax({
                        url: "{{route('gettingNeighborhood')}}",
                        data: {
                            'city': cityId
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="neighborhood[]"]').empty();
                            $('select[name="neighborhood[]"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhood[]"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="neighborhood[]"]').empty();
                }
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="cityModal"]').on('change', function () {
                var cityId = jQuery(this).val();
                if (cityId) {
                    jQuery.ajax({
                        url: "{{route('gettingNeighborhood')}}",
                        data: {
                            'city': cityId
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="neighborhoodModal[]"]').empty();
                            $('select[name="neighborhoodModal[]"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhoodModal[]"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="neighborhoodModal[]"]').empty();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#shopFilter_form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('realEstate.index.filter.user')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data)
                        $('#shopFilterPage').empty();
                        $('#shopFilterPage').append(data.content);
                        // $('#shopFilterTag').empty();
                        // $('#shopFilterTag').append(data.tags);
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#shopFilter_form_modal').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('realEstate.index.filter.user')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#shopFilterPage').empty();
                        $('#shopFilterPage').append(data.content);
                        // $('#shopFilterTag').empty();
                        // $('#shopFilterTag').append(data.tags);
                    }
                })
            });
        });
    </script>
    <script>
        jQuery(document).ready(function () {
        })
        $('.city').change(function (e) {
            $("#shopFilter_form").submit();
        });

        $('.neighborhood').change(function (e) {
            $("#shopFilter_form").submit();

        });
        $('.cityModal').change(function (e) {
            $("#shopFilter_form_modal").submit();
        });
        $('.neighborhoodModal').change(function (e) {
            $("#shopFilter_form_modal").submit();
        });

        // function searchFunc(val) {
        //     $("#shopFilter_form").submit();
        //
        // }

        // })
    </script>
@endsection

@extends('UserMasterNew::master')
@section('title_user')خانه
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/contractor.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/dolatsara.css')}}"/>

    <style>
        @media screen and ( max-width: 400px ) {

            li.page-item {

                display: none;
            }

            .page-item:first-child,
            .page-item:nth-child( 2 ),
            .page-item:nth-last-child( 2 ),
            .page-item:last-child,
            .page-item.active,
            .page-item.disabled {

                display: block;
            }
        }
        {{--.mainTop {--}}
        {{--    background-image: url('{{asset($header_image)}}');--}}
        {{--    /*background-image: url(../img/header2.jpeg);*/--}}
        {{--}--}}

        {{--@media (max-width: 768px) {--}}
        {{--    .mainTop {--}}
        {{--        background-image: url('{{asset($header_image_responsive)}}');--}}

        {{--    }--}}
        {{--}--}}

        {{--.section.dolatsara__main-header div.dolatsara__main-content h2.dolatsara__title-placeholder-title {--}}
        {{--    color: '{{$header_title_color}}';--}}
        {{--}--}}
    </style>
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/articleShow.css')}}">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/store.css')}}">

    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/materialdesignicons.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/materialdesignicons.css.map')}}">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/materialdesignicons.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/materialdesignicons.css.map')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/pagination.css')}}">
    <style>
        .sidebar-wrapper .box-sidebar .type-category {
            font-size: 12px;
            font-weight: normal;

        }
    </style>
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/pagination-color.css')}}">
<style>
    section.dolatsara__main-header{
        background-image: url('{{asset($header_image)}}')
    }

    @media (max-width: 768px) {
        section.dolatsara__main-header{
            background-image: url('{{asset($header_image_responsive)}}')
        }

    }
</style>
@endsection

@section('content_userMasterNew')
    @include('UserMasterNew::layouts.preloader')
    <section class="dolatsara__main-header">
        <div class="dolatsara__main-content">
            <div class="image-placeholder">
{{--                <img src="{{asset(\Modules\Setting\Entities\Setting::--}}
{{--        where('title', 'logo_of_first_page')->first()->str_value)}}" alt="dolatsara"/>--}}
            </div>

            <h1 class="dolatsara__title-placeholder-title"
                style="color: {{$header_title_color}};font-size:135%;margin-bottom: 10px;position: relative; bottom: 1rem">{{$header_title}}
            </h1>
            <div class="dolatsara__search-title-head">

                <div class="dolatsar__seacrh-tabs" style="margin-bottom:.5rem;">
                    @foreach($categories as $key=>$category)
                        @if($category->selected)
                            <form action="{{route('supplierFilterPage.user')}}" method="get" id="dolatsara_filter_category{{$category->id}}">
                                <input hidden name="category" value="{{$category->id}}">
{{--                                <a style="cursor: pointer" onclick="document.getElementById('emergencyAds').submit()">--}}
                                <a class="dolatsara__tabs-link" style="border: none; cursor: pointer" onclick="document.getElementById('dolatsara_filter_category{{$category->id}}').submit()">
                                    {{--                               href="https://www.dolatsara.com/supplier/filter?category={{$category->id}}">--}}
                                    {{$category->title}}
                                </a>
                            </form>
                        @endif
                    @endforeach

                </div>
                <div class="dolatsara__forms-box">
                    <form action="{{route('supplierFilterPage.user')}}" method="get">
                        <input type="text" class="dolatsara__search-input" name="search" value="{{old('search')}}"
                               placeholder="جستجو در میان صد ها هزار آگهی صنعت ساختمان">
                        <button class="dolatsara__search-button">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </form>
                    <form action="{{route('supplierFilterPage.user')}}" method="get" style="margin-right:2px">
                        <input hidden name="type"
                               value="emergency">
                        <button class="dolatsara__instant-ads-button">آگهی های فوری</button>
                    </form>

                </div>
            </div>

        </div>

        {{--        @if($header_icons->count()>0)--}}
        <div class="dolatsara__box-icons">
{{--            @foreach($header_icons as $header_icon)--}}
{{--                <a href="{{$header_icon->link}}" class="dolatsara__icon-placehlder" target="_blank">--}}
{{--                    <img src="{{asset($header_icon->image)}}" alt="dolatsara">--}}
{{--                </a>--}}
{{--            @endforeach--}}
        </div>
        {{--        @endif--}}
    </section>
{{--    <section class="best-categorie-icon">--}}
{{--        <div class="icon-box-parent">--}}
{{--            <div class="icon-box">--}}
{{--                <i class="fas fa-home icon-category"></i>--}}
{{--            </div>--}}
{{--            <div class="icon-box">--}}
{{--                <i class="fas fa-home icon-category"></i>--}}
{{--            </div>--}}
{{--            <div class="icon-box">--}}
{{--                <i class="fas fa-home icon-category"></i>--}}
{{--            </div>--}}
{{--            <div class="icon-box">--}}
{{--                <i class="fas fa-home icon-category"></i>--}}
{{--            </div>--}}
{{--            <div class="icon-box">--}}
{{--                <i class="fas fa-home icon-category"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <main>
        <!-- show product -->

        <div class="ad-slider owl-carousel owl-theme sslider d-flex d-lg-none">
            @if($advertisement->count()>0)

                @foreach($advertisement as $key=>$ad2)
                    @if($ad2->advertising->advertisingOrder->location=='top1' && isset($ad2->image))

                        <div class="item">
                            <div class="advertisments-place header" style="height: 100%;">
                                <div class="ad-box medium">
                                    <img src="{{isset($ad2->responsive_image)?asset($ad2->responsive_image):asset($ad2->image)}}" alt="">
                                    <a href="{{$ad2->link}}" target="_blank"></a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="item">
                            <div class="advertisments-place header" style="height: 100%;">
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
                        @if($ad2->advertising->advertisingOrder->location=='middle1' && isset($ad2->image))

                            <div class="item">
                                <div class="advertisments-place header" style="height: 100%;">
                                    <div class="ad-box medium">
                                        <img src="{{isset($ad2->responsive_image)?asset($ad2->responsive_image):asset($ad2->image)}}" alt="">
                                        <a href="{{$ad2->link}}" target="_blank"></a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="item">
                                <div class="advertisments-place header" style="height: 100%;">
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
                        @if($ad2->advertising->advertisingOrder->location=='middle-left' && isset($ad2->image))

                            <div class="item">
                                <div class="advertisments-place header" style="height: 100%;">
                                    <div class="ad-box medium">
                                        <img src="{{isset($ad2->responsive_image)?asset($ad2->responsive_image):asset($ad2->image)}}" alt="">
                                        <a href="{{$ad2->link}}" target="_blank"></a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="item">
                                <div class="advertisments-place header" style="height: 100%;">
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
                        @if($ad2->advertising->advertisingOrder->location=='middle-right' && isset($ad2->image))

                            <div class="item">
                                <div class="advertisments-place header" style="height: 100%;">
                                    <div class="ad-box medium">
                                        <img src="{{isset($ad2->responsive_image)?asset($ad2->responsive_image):asset($ad2->image)}}" alt="">
                                        <a href="{{$ad2->link}}" target="_blank"></a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="item">
                                <div class="advertisments-place header" style="height: 100%;">
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
                @endforeach
            @else
                @for($i=0; $i<4; $i++)
                    <div class="item">
                        <div class="advertisments-place header" style="height: 100%;">
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

        <section class="show-product" style="margin-top: -60px">
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-xs-12 d-lg-block d-none">
                        <div class="sidebar-wrapper search-sidebar">
                            <div class="box-sidebar">
                                <div class="catalog grouping">
                                    <div class="sidebar-title">
                                        <p>دسته بندی ها</p>
                                    </div>
                                    <ul class="catalog-list">
                                        @foreach($categories->where('depth', 1) as $key=>$cat1)
                                            <li>
                                                <div class="type-category accordion-item">
                                                    <form action="{{route('homePage.user')}}" method="get"
                                                          id="level1{{$cat1->id}}">
                                                        <input hidden name="category"
                                                               value="{{$cat1->id}}">
                                                        <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"
                                                           style="cursor: pointer"> <span
                                                                style="margin-right: 10px">{{$cat1->title}}</span></a>
                                                    </form>
                                                    @if($cat1->categories->count()>0)
                                                        <button type="button"
                                                                class="catalog-link main accordion-button  @if($category1 && $category1->id!=$cat1->id) collapsed @else collapsed @endif"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#panelsStayOpen-collapseOne{{$cat1->id}}"
                                                                aria-expanded=" @if($category1 && $category1->id==$cat1->id) true @elseif($key==0 && !$category1) true @endif"
                                                                aria-controls="panelsStayOpen-collapseOne">
                                                            <i class="fas fa-chevron-down"></i>

                                                        </button>
                                                    @endif
                                                </div>
                                                @if($cat1->categories->count()>0)
                                                    <ul class="show-more accordion-collapse collapse @if($category1 && $category1->id==$cat1->id) show @endif"
                                                        id="panelsStayOpen-collapseOne{{$cat1->id}}"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        @foreach($cat1->categories()->where('active', 1)->orderBy('order', 'asc')->get() as $cat_sub_1)
                                                            <li class="catalog-cat-item ">
                                                                <div class="type-category accordion-item">
                                                                    <form action="{{route('homePage.user')}}"
                                                                          method="get"
                                                                          id="level1{{$cat_sub_1->id}}"
                                                                          class="catalog-cat-item">

                                                                        <input hidden name="category"
                                                                               value="{{$cat_sub_1->id}}">
                                                                        <a style="cursor: pointer"
                                                                           onclick="document.getElementById('level1{{$cat_sub_1->id}}').submit()">{{$cat_sub_1->title}}</a>
                                                                    </form>
                                                                    @if($cat_sub_1->categories->count()>0)
                                                                        <button
                                                                            class="middle-div active accordion-button"
                                                                            type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                                                            aria-expanded="true"
                                                                            aria-controls="panelsStayOpen-collapseTwo">
                                                                            <i class="fas fa-chevron-down"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                                @if($cat_sub_1->categories->count()>0)
                                                                    <ul class="catalog-list inner-div accordion-collapse collapse show"
                                                                        id="panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                                                        aria-labelledby="panelsStayOpen-headingTwo">
                                                                        @foreach($cat_sub_1->categories()->where('active', 1)->orderBy('order', 'asc')->get() as $cat_sub_2)
                                                                            <li>
                                                                                <form
                                                                                    action="{{route('homePage.user')}}"
                                                                                    method="get"
                                                                                    id="level1{{$cat_sub_2->id}}">
                                                                                    <input hidden name="category"
                                                                                           value="{{$cat_sub_2->id}}">
                                                                                    <a style="cursor: pointer"
                                                                                       onclick="document.getElementById('level1{{$cat_sub_2->id}}').submit()"
                                                                                       class="catalog-link active">{{$cat_sub_2->title}}</a>
                                                                                </form>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                            <form class="form-horizontal" id="attributes_form_filter_page"
                                  method="post">
                                @csrf
                                @if($category1)

                                    <input hidden name="category" value="{{$category1->id}}">
                                @endif
                                <input hidden name="filter" value="1">
                                <input hidden name="pageNumber" id="pageNumber" value="{{old('pageNumber')}}">
                                <div class="box-sidebar">
                                    <div class="filter-switch">
                                        <div class="switch-box">
                                            <div class="centered hidden-xs">
                                                <div class="">
                                                    <label>
                                                        <input type="checkbox" @if($type=='emergency') checked @endif
                                                        class="emergencyType" value="1"
                                                               name="emergencyType"><span
                                                            class="switch">
                                                                            <h1 class="switch-title">آگهی های فوری</h1></span>
                                                        <span class="toggle"></span>
                                                    </label>
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
                                                    <label>
                                                        <input type="checkbox" value="1"
                                                               class="adWithImage"
                                                               name="adWithImage"><span
                                                            class="switch">
                                                                            <h1 class="switch-title">عکس دار</h1></span>
                                                        <span class="toggle"></span>
                                                    </label>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="sidebar-advertisement">
                                    <div class="advertisments-place">
                                        @if($advertisement->count()>0)
                                            @foreach($advertisement as $key=>$ad3)
                                                @if($ad3->advertising->advertisingOrder->location=='top1' && isset($ad3->image))
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
                                                @if($ad3->advertising->advertisingOrder->location=='middle1' && isset($ad3->image))
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
                                                @if($ad3->advertising->advertisingOrder->location=='middle-left' && isset($ad3->image))
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
                                                @if($ad3->advertising->advertisingOrder->location=='middle-right' && isset($ad3->image))
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

                                <div id="attrFilter">
                                    @if(($attributeGroups))
                                        @foreach($attributeGroups as $attrGroup)
                                            @foreach($attrGroup->attributes->where('isFilterField', 1) as $attr)
                                                @if($attr->attribute_type == 'int')
                                                    <div class="box-sidebar">
                                                <span class="box-header-sidebar "> <i
                                                        class="fa fa-chevron-down arrow"></i>حدود {{$attr->title}}</span>
                                                        <div class="catalog" style="display: none;">
                                                            <div class="price minimum">
                                                                <p>حداقل {{$attr->title}}:</p>
                                                                <input type="text"
                                                                       name="attributeTypeNumber[{{$attr->id}}][min]"
                                                                       class="minimum-price attributeTypeNumber"
                                                                       onkeyup="separateNum(this.value,this);">
                                                            </div>
                                                            <div class="price maximum">
                                                                <p>حداکثر {{$attr->title}}:</p>
                                                                <input type="text"
                                                                       name="attributeTypeNumber[{{$attr->id}}][max]"
                                                                       class="maximum-price attributeTypeNumber"
                                                                       onkeyup="separateNum(this.value,this);">
                                                            </div>
                                                            @if(isset($attr->alt_value))

                                                                <div class="filter-switch">
                                                                    <div class="switch-box">
                                                                        <div
                                                                            class="centered hidden-xs">
                                                                            <div class="">
                                                                                <a>
                                                                                    <label
                                                                                        for="1itch2{{$attr->id}}">
                                                                                        <input
                                                                                            type="checkbox"
                                                                                            class="attributeAlt1"
                                                                                            value="1"
                                                                                            id="1itch2{{$attr->id}}"
                                                                                            name="attributeAlt1[{{$attr->id}}][]"><span
                                                                                            class="switch">
                                                                            <h1 class="switch-title">{{$attr->alt_value}}</h1></span>
                                                                                        <span
                                                                                            class="toggle"></span>
                                                                                    </label>
                                                                                </a>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @elseif($attr->attribute_type == 'bool')
                                                    <div class="box-sidebar">
                                                        <div class="filter-switch">
                                                            <div class="switch-box">
                                                                <div class="centered hidden-xs">
                                                                    <div class="">
                                                                        <label for="switch2{{$attr->id}}">
                                                                            <input type="checkbox"
                                                                                   class="attributeTypeBool"
                                                                                   value="1"
                                                                                   id="switch2{{$attr->id}}"
                                                                                   name="attributeTypeBool[{{$attr->id}}][]"><span
                                                                                class="switch">
                                                                            <h1 class="switch-title">{{$attr->title}}</h1></span>
                                                                            <span class="toggle"></span>
                                                                        </label>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @elseif($attr->attribute_type == 'select')
                                                    <div class="box-sidebar">
                                                <span class="box-header-sidebar activeacc"><i
                                                        class="fa fa-chevron-down arrow"></i>{{$attr->title}}</span>
                                                        <div class="catalog" style="display: none;">
                                                            <div class="select-box">
                                                                <select
                                                                    class="js-example-basic-multiple attributeTypeSelect"
                                                                    style="width: 100%;"
                                                                    name="attributeTypeSelect[{{$attr->id}}][]"
                                                                    multiple="multiple">
                                                                    @foreach($attr->attributeItems as $item)
                                                                        <option
                                                                            value="{{$item->id}}">{{$item->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                </div>
                            </form>

                            <!--   adplacement -------------------->

                        </div>
                    </div>

                    <div class="col-lg-10 col-12">

                        <div class="resent-product">
                            <div class="container">
                                <div class="resent-product-title">

                                    <h4>آخرین آگهی ها</h4>
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
                                                                <div class="catalog grouping">
                                                                    <div class="sidebar-title">
                                                                        <p>دسته بندی ها</p>
                                                                    </div>
                                                                    <ul class="catalog-list">
                                                                        @foreach($categories as $key=>$cat1)
                                                                            <li>
                                                                                <div
                                                                                    class="type-category accordion-item">
                                                                                    <form
                                                                                        action="{{route('homePage.user')}}"
                                                                                        method="get"
                                                                                        id="level1{{$cat1->id}}">
                                                                                        <input hidden name="category"
                                                                                               value="{{$cat1->id}}">
                                                                                        <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"
                                                                                           style="cursor: pointer"><span
                                                                                                style="margin-right: 10px"> {{$cat1->title}}</span></a>
                                                                                    </form>
                                                                                    @if($cat1->categories->count()>0)
                                                                                        <button type="button"
                                                                                                class="catalog-link main accordion-button  @if($category1 && $category1->id!=$cat1->id) collapsed @else collapsed @endif"
                                                                                                data-bs-toggle="collapse"
                                                                                                data-bs-target="#panelsStayOpen-collapseOne{{$cat1->id}}"
                                                                                                aria-expanded=" @if($category1 && $category1->id==$cat1->id) true @elseif($key==0 && !$category1) true @endif"
                                                                                                aria-controls="panelsStayOpen-collapseOne">
                                                                                            <i class="fas fa-chevron-down"></i>

                                                                                        </button>
                                                                                    @endif
                                                                                </div>
                                                                                @if($cat1->categories->count()>0)
                                                                                    <ul class="show-more accordion-collapse collapse @if($category1 && $category1->id==$cat1->id) show @endif"
                                                                                        id="panelsStayOpen-collapseOne{{$cat1->id}}"
                                                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                                                        @foreach($cat1->categories()->where('active', 1)->orderBy('order', 'asc')->get() as $cat_sub_1)
                                                                                            <li class="catalog-cat-item ">
                                                                                                <div
                                                                                                    class="type-category accordion-item">
                                                                                                    <form
                                                                                                        action="{{route('homePage.user')}}"
                                                                                                        method="get"
                                                                                                        id="level1{{$cat_sub_1->id}}"
                                                                                                        class="catalog-cat-item">

                                                                                                        <input hidden
                                                                                                               name="category"
                                                                                                               value="{{$cat_sub_1->id}}">
                                                                                                        <a style="cursor: pointer"
                                                                                                           onclick="document.getElementById('level1{{$cat_sub_1->id}}').submit()">{{$cat_sub_1->title}}</a>
                                                                                                    </form>
                                                                                                    @if($cat_sub_1->categories->count()>0)
                                                                                                        <button
                                                                                                            class="middle-div active accordion-button"
                                                                                                            type="button"
                                                                                                            data-bs-toggle="collapse"
                                                                                                            data-bs-target="#panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                                                                                            aria-expanded="true"
                                                                                                            aria-controls="panelsStayOpen-collapseTwo">
                                                                                                            <i class="fas fa-chevron-down"></i>
                                                                                                        </button>
                                                                                                    @endif
                                                                                                </div>
                                                                                                @if($cat_sub_1->categories->count()>0)
                                                                                                    <ul class="catalog-list inner-div accordion-collapse collapse show"
                                                                                                        id="panelsStayOpen-collapseTwo{{$cat_sub_1->id}}"
                                                                                                        aria-labelledby="panelsStayOpen-headingTwo">
                                                                                                        @foreach($cat_sub_1->categories()->where('active', 1)->orderBy('order', 'asc')->get() as $cat_sub_2)
                                                                                                            <li>
                                                                                                                <form
                                                                                                                    action="{{route('homePage.user')}}"
                                                                                                                    method="get"
                                                                                                                    id="level1{{$cat_sub_2->id}}">
                                                                                                                    <input
                                                                                                                        hidden
                                                                                                                        name="category"
                                                                                                                        value="{{$cat_sub_2->id}}">
                                                                                                                    <a style="cursor: pointer"
                                                                                                                       onclick="document.getElementById('level1{{$cat_sub_2->id}}').submit()"
                                                                                                                       class="catalog-link active">{{$cat_sub_2->title}}</a>
                                                                                                                </form>
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                @endif
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                                {{--                                                                <div class="catalog grouping">--}}
                                                                {{--                                                                    <span class="box-header-sidebar">دسته‌بندی ها</span>--}}
                                                                {{--                                                                    <ul class="catalog-list">--}}
                                                                {{--                                                                        @foreach($categories as $cat1)--}}

                                                                {{--                                                                            <li>--}}
                                                                {{--                                                                                <form--}}
                                                                {{--                                                                                    action="{{route('supplierFilterPage.user')}}"--}}
                                                                {{--                                                                                    method="get"--}}
                                                                {{--                                                                                    id="level1{{$cat1->id}}"--}}
                                                                {{--                                                                                    class="catalog-link main">--}}
                                                                {{--                                                                                    <input hidden name="category"--}}
                                                                {{--                                                                                           value="{{$cat1->id}}">--}}
                                                                {{--                                                                                    <a onclick="document.getElementById('level1{{$cat1->id}}').submit()"--}}
                                                                {{--                                                                                       class="catalog-link main @if($category1) @if($cat1->id==$category1->id) active @endif @endif"--}}
                                                            </div>
                                                            <form class="form-horizontal" id="attributes_form_modal"
                                                                  method="post">
                                                                @csrf
                                                                @if($category1)

                                                                    <input hidden name="category"
                                                                           value="{{$category1->id}}">
                                                                @endif
                                                                <input hidden name="pageNumber" id="pageNumberModal" value="{{old('pageNumber')}}">
                                                                <input hidden name="modalFilter" value="1">

                                                                <div class="box-sidebar">
                                                                    <div class="filter-switch">
                                                                        <div class="switch-box">
                                                                            <div class="centered hidden-xs">
                                                                                <div class="">
                                                                                    {{--                                                                    <a href="#">--}}
                                                                                    <label>
                                                                                        <input type="checkbox"
                                                                                               class="adWithImageModal" value="1"
                                                                                               {{--                                                               value="1"--}}
                                                                                               {{--                                                               id="emergencyType"--}}
                                                                                               name="adWithImageModal"><span
                                                                                            class="switch">
                                                                            <h1 class="switch-title">عکس دار</h1></span>
                                                                                        <span class="toggle"></span>
                                                                                    </label>
                                                                                    {{--                                                                    </a>--}}
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
                                                                                    {{--                                                                    <a href="#">--}}
                                                                                    <label>
                                                                                        <input type="checkbox" value="1"
                                                                                               class="emergencyTypeModal"
                                                                                               {{--                                                               value="1"--}}
                                                                                               {{--                                                               id="emergencyType"--}}
                                                                                               name="emergencyTypeModal"><span
                                                                                            class="switch">
                                                                            <h1 class="switch-title">آگهی های فوری</h1></span>
                                                                                        <span class="toggle"></span>
                                                                                    </label>
                                                                                    {{--                                                                    </a>--}}
                                                                                </div>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                                @if(($attributeGroups))

                                                                    @foreach($attributeGroups as $attrGroup)
                                                                        @foreach($attrGroup->attributes->where('isFilterField', 1) as $attr)
                                                                            @if($attr->attribute_type == 'int')
                                                                                <div class="box-sidebar">
                                                                                <span class="box-header-sidebar "> <i
                                                                                        class="fa fa-chevron-down arrow"></i>حدود {{$attr->title}}</span>
                                                                                    <div class="catalog"
                                                                                         style="display: none;">
                                                                                        <div class="price minimum">
                                                                                            <p>حداقل {{$attr->title}}
                                                                                                :</p>
                                                                                            <input type="text"
                                                                                                   name="attributeTypeNumber2[{{$attr->id}}][min]"
                                                                                                   class="minimum-price attributeTypeNumber2"
                                                                                                   onkeyup="separateNum(this.value,this);">
                                                                                        </div>
                                                                                        <div class="price maximum">
                                                                                            <p>حداکثر {{$attr->title}}
                                                                                                :</p>
                                                                                            <input type="text"
                                                                                                   name="attributeTypeNumber2[{{$attr->id}}][max]"
                                                                                                   class="maximum-price attributeTypeNumber2"
                                                                                                   onkeyup="separateNum(this.value,this);">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @if(isset($attr->alt_value))

                                                                                    <div class="filter-switch">
                                                                                        <div class="switch-box">
                                                                                            <div
                                                                                                class="centered hidden-xs">
                                                                                                <div class="">
                                                                                                    <a>
                                                                                                        <label
                                                                                                            for="1switch2{{$attr->id}}">
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                class="attributeAlt1"
                                                                                                                value="1"
                                                                                                                id="1switch2{{$attr->id}}"
                                                                                                                name="attributeAlt2[{{$attr->id}}][]"><span
                                                                                                                class="switch">
                                                                            <h1 class="switch-title">{{$attr->alt_value}}</h1></span>
                                                                                                            <span
                                                                                                                class="toggle"></span>
                                                                                                        </label>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <br>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif

                                                                            @elseif($attr->attribute_type == 'bool')
                                                                                <div class="box-sidebar">
                                                                                    <div class="filter-switch">
                                                                                        <div class="switch-box">
                                                                                            <div
                                                                                                class="centered hidden-xs">
                                                                                                <div class="">
                                                                                                    <a href="#">
                                                                                                        <label
                                                                                                            for="1switch2{{$attr->id}}">
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                class="attributeTypeBool2"
                                                                                                                value="1"
                                                                                                                id="1switch2{{$attr->id}}"
                                                                                                                name="attributeTypeBool2[{{$attr->id}}][]"><span
                                                                                                                class="switch">
                                                                            <h1 class="switch-title">{{$attr->title}}</h1></span>
                                                                                                            <span
                                                                                                                class="toggle"></span>
                                                                                                        </label>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <br>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            @elseif($attr->attribute_type == 'select')
                                                                                <div class="box-sidebar">
                                                <span class="box-header-sidebar activeacc"><i
                                                        class="fa fa-chevron-down arrow"></i>{{$attr->title}}</span>
                                                                                    <div class="catalog"
                                                                                         style="display: none;">
                                                                                        <div class="select-box">
                                                                                            <select
                                                                                                class="js-example-basic-multiple attributeTypeSelect"
                                                                                                style="width: 100%;"
                                                                                                name="attributeTypeSelect[{{$attr->id}}][]"
                                                                                                multiple="multiple">
                                                                                                @foreach($attr->attributeItems as $item)
                                                                                                    <option
                                                                                                        value="{{$item->id}}">{{$item->title}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                @endif
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

                                <div class="row" id="firstPageFilterAdvertiser1Div">
                                    @foreach($ads_of_filter as $key=>$ad)
                                        <div
                                            class=" col-xl-3 col-sm-6 mb-5 d-flex justify-content-center flex-column align-items-center">
                                            @component('UserMasterNew::components.adCard')
                                                @slot('image')
                                                    {{($ad->adImages->first())?$ad->adImages->first()->image:
                                                                        \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}

                                                @endslot
                                                @slot('golden_hologram')
                                                    @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                                                            && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status=='approved')
                                                        {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->hologram->logo}}
                                                    @else
                                                        {{''}}
                                                    @endif
                                                @endslot
                                                @slot('emergency_label')
                                                    {{$ad->type=='emergency'?\Modules\Setting\Entities\Setting::where('title', 'emergency_label')
                                                    ->first()->str_value:null}}
                                                @endslot
                                                @slot('real_estate')
                                                    {{($ad->user->hasRole('real-state-administrator'))?$ad->user->shop_title:''}}
                                                @endslot
                                                @slot('title')
                                                    {{$ad->title}}
                                                @endslot
                                                @slot('city')
                                                    {{isset($ad->neighborhood_id)?$ad->neighborhood->title:$ad->city->title}}
                                                @endslot
                                                @slot('ad_unique_code')
                                                    {{$ad->uniqueCodeOfAd}}
                                                @endslot
                                                @slot('first_attr')
                                                    @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())
                                                        {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad->attributes->where('isSignificant', 1)
                                                        ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)
                                                                        ->first()->title}}
                                                        {{--                                                            {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->id)->title)}}--}}

                                                        {{--                                                            {{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->title}}--}}
                                                    @else
                                                        {{''}}
                                                    @endif
                                                @endslot
                                                @slot('second_attr')
                                                    @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                        @if(isset($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))
                                                            {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}
                                                            {{--                                                                {{($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->unit)}}--}}
                                                        @else
                                                            {{\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value}}
                                                        @endif
                                                        {{--                                                        {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
                                                    @endif
                                                @endslot
                                                @slot('second_attr_unit')
                                                    @if(isset($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))

                                                        @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                            {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}
                                                        @endif
                                                    @else
                                                        {{''}}
                                                    @endif
                                                @endslot
                                                @slot('id')
                                                    {{$ad->id}}
                                                @endslot
                                            @endcomponent
                                        </div>
                                    @endforeach

                                </div>
                                <div class="justify-content-center align-content-center d-flex" id="pagination">
                                    @if($ads_of_filter->count()>0 && $ads_of_filter->links())
                                        {{$ads_of_filter->links()}}
                                    @endif
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
    <script src="{{asset('files/userMaster/assets/js/select2.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#attributes_form_filter_page').on('submit', function (event) {
                event.preventDefault();
                const list = document.getElementById("preloaderContent").classList;
                list.add("open");
                $.ajax({
                    url: "{{route('post.homePage.user')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        list.remove("open");
                        list.add("close");
                        $('#firstPageFilterAdvertiser1Div').empty();
                        $('#firstPageFilterAdvertiser1Div').append(data.content);
                        $('#pagination').empty();
                        $('#pagination').append(data.pagination);
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#attributes_form_modal').on('submit', function (event) {
                event.preventDefault();
                const list = document.getElementById("preloaderContent").classList;
                list.add("open");
                $.ajax({
                    url: "{{route('post.homePage.user')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        list.remove("open");
                        list.add("close");
                        $('#firstPageFilterAdvertiser1Div').empty();
                        $('#firstPageFilterAdvertiser1Div').append(data.content);
                        $('#pagination').empty();
                        $('#pagination').append(data.pagination);
                    }
                })
            });
        });
    </script>
    <script>
        jQuery(document).ready(function () {
            $('.attributeTypeNumber').on('keypress', function (e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    $("#attributes_form_filter_page").submit();
                }
            });
        })
        $('.adWithImage').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.adWithImageModal').change(function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.emergencyType').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.catInForm').on('click', function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.attributeTypeBool').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.attributeAlt1').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.attributeAlt2').change(function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.city').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.neighborhood').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        $('.attributeTypeSelect').change(function (e) {
            $("#attributes_form_filter_page").submit();
        });
        jQuery(document).ready(function () {
            $('.attributeTypeNumber2').on('keypress', function (e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    $("#attributes_form_modal").submit();
                }
            });
        })
        $('.emergencyTypeModal').change(function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.catModal').on('click', function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.attributeTypeBool2').change(function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.cityModal').change(function (e) {
            $("#attributes_form_modal").submit();
        });
        $('.neighborhoodModal').change(function (e) {
            $("#attributes_form_modal").submit();
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"]').on('change', function () {
                var cityId = jQuery(this).val();
                if (cityId) {
                    console.log(cityId)
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
    <script src="{{asset('files/userMaster/assets/js/owl.carousel.min.js')}}"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            rtl: true,
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            responsive: {
                0: {
                    items: 1,
                },
                400: {
                    items: 1.5,

                },
                600: {
                    items: 2,
                    autoplay: true, autoplaySpeed: 2000,
                    autoplayHoverPause: true,
                    autoplayTimeout: 3000,

                },
                1000: {
                    items: 1,


                }
            }
        })
    </script>
    {{--    <script>--}}
    {{--        var val = $("#homePageInput").val();--}}
    {{--        if (val) {--}}
    {{--            jQuery('div[id="firstPageTop"]').empty();--}}
    {{--            $('div[id="firstPageTop"]').append(`{!! $content !!}`);--}}
    {{--        }--}}
    {{--    </script>--}}

    <!--load all styles -->
    {{--    <script src="{{asset('files/userMaster/src/js/slider2.js')}}"></script>--}}

    {{--    <script src="{{asset('files/userMaster/assets/js/owl.carousel.min.js')}}"></script>--}}
    <script>
        function changePage(pageNumber) {
            $('#attributes_form_filter_page').find('[id="pageNumber"]').val(pageNumber);
            $("#attributes_form_filter_page").submit();
            $('#attributes_form_modal').find('[id="pageNumberModal"]').val(pageNumber);
            $("#attributes_form_modal").submit();   }
    </script>

@endsection

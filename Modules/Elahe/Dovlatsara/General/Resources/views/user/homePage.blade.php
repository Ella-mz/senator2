@extends('UserMasterNew::master')
@section('title_user')خانه
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/contractor.css')}}">
    <style>
        .mainTop {
            background-image: url({{asset($header_image)}});
            /*background-image: url(../img/header2.jpeg);*/
        }

        @media (max-width: 768px) {
            .mainTop {
                background-image: url({{asset($header_image_responsive)}});

            }
        }
    </style>
@endsection
{{--@extends('UserMasterNew::test')--}}

@section('content_userMasterNew')
    <div class="homePage-header">
        <div class="mainTop ">
            <div class="container header">
                {{--                <div class="row">--}}
                <div class="col-12 mt-5">
                    <div class="heading">
                        <div class="title">
                            <h2>{{$header_title}}
                            </h2>
                        </div>
                        <div class="input-box">
                            {{--                                <form action="{{route('supplierFilterPage.user')}}" method="get" id="moreAdsInHomePage" class="catalog-link">--}}

                            {{--                                    <a style="cursor: pointer" onclick="document.getElementById('moreAdsInHomePage').submit()">--}}
                            {{--                                        <span>موارد بیشتر</span>--}}
                            {{--                                        <span><i class="fa fa-angle-left"></i></span>--}}
                            {{--                                    </a>--}}
                            {{--                                </form>--}}
                            <form action="{{route('supplierFilterPage.user')}}" method="get" class="header-search-form">
                                <select name="category">
                                    <option value="">دنبال چی میگردی؟</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                                <input type="input" name="search" value="{{old('search')}}"
                                       class="header-input large" placeholder="عنوان یا شماره آگهی...">
                                <button class="RecBtn red">جستجو</button>
                            </form>
                            <br>

                        </div>
                        @if(session()->has('mm'))
                            <div class="text-danger">{{ session()->get('mm') }}</div>
                        @endif
                    </div>
                </div>
                {{--                </div>--}}
            </div>
        </div>
{{--        <div class="header-circle">--}}
{{--            <div class="circle">--}}
{{--                <div class="second-circle">--}}
{{--                    <img src="{{asset('files/userMaster/assets/img/maps-and-flags.png')}}" alt="">--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
    </div>
    <main>
        <input hidden name="homePageInput" id="homePageInput" value="1">
        <!-- show city -->
        <div class="city-tehran">
            <div class="container">
                <h1>مناطق پرفروش ایران</h1>
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 px-3 my-4">
                            <div class="show-city">
                                <div class="show-city-blue-bg">

                                    <div class="city-logo">
                                        <img src="{{asset('files/userMaster/assets/img/maps-and-flags.png')}}" alt="">
                                    </div>
                                    <div class="city-name">
                                        <h2>شمال تهران</h2>
                                    </div>
                                    <div class="city-desc">
                                        <p>
                                            مناطق 1 و 2 و 3 و 4 و 5
                                        </p>
                                    </div>
                                    <div class="city-icon-down">
                                        <a><i class="fa fa-chevron-down arrow"></i></a>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 px-3 my-4">
                            <div class="show-city">
                                <div class="show-city-blue-bg">

                                    <div class="city-logo">
                                        <img src="{{asset('files/userMaster/assets/img/maps-and-flags.png')}}" alt="">
                                    </div>
                                    <div class="city-name">
                                        <h2>شمال تهران</h2>
                                    </div>
                                    <div class="city-desc">
                                        <p>
                                            مناطق 1 و 2 و 3 و 4 و 5
                                        </p>
                                    </div>
                                    <div class="city-icon-down">
                                        <a><i class="fa fa-chevron-down arrow"></i></a>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 px-3 my-4">
                            <div class="show-city">
                                <div class="show-city-blue-bg">

                                    <div class="city-logo">
                                        <img src="{{asset('files/userMaster/assets/img/maps-and-flags.png')}}" alt="">
                                    </div>
                                    <div class="city-name">
                                        <h2>شمال تهران</h2>
                                    </div>
                                    <div class="city-desc">
                                        <p>
                                            مناطق 1 و 2 و 3 و 4 و 5
                                        </p>
                                    </div>
                                    <div class="city-icon-down">
                                        <a><i class="fa fa-chevron-down arrow"></i></a>
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 px-3 my-4">
                            <div class="show-city">
                                <div class="show-city-blue-bg">

                                    <div class="city-logo">
                                        <img src="{{asset('files/userMaster/assets/img/maps-and-flags.png')}}" alt="">
                                    </div>
                                    <div class="city-name">
                                        <h2>شمال تهران</h2>
                                    </div>
                                    <div class="city-desc">
                                        <p>
                                            مناطق 1 و 2 و 3 و 4 و 5
                                        </p>
                                    </div>
                                    <div class="city-icon-down">
                                        <a><i class="fa fa-chevron-down arrow"></i></a>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 px-3 my-4">
                            <div class="show-city">
                                <div class="show-city-blue-bg">

                                    <div class="city-logo">
                                        <img src="{{asset('files/userMaster/assets/img/maps-and-flags.png')}}" alt="">
                                    </div>
                                    <div class="city-name">
                                        <h2>شمال تهران</h2>
                                    </div>
                                    <div class="city-desc">
                                        <p>
                                            مناطق 1 و 2 و 3 و 4 و 5
                                        </p>
                                    </div>
                                    <div class="city-icon-down">
                                        <a><i class="fa fa-chevron-down arrow"></i></a>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- end of show city -->
    @if($ads->count()>0)
        <!-- quick sale -->
            <div class="quick-sale">
                <div class="quick-sale-tile container">
                    <h2>
                        فروش فوری
                    </h2>
                    <p>
                        آگهی های اکازیون با فرصتی خاص
                    </p>
                </div>


                <div class="quick-sale-product container owl-carousel d-flex ">
                    @foreach($ads as $ad)

                        <div class="item col-lg-3 col-md-6 ">

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
                                            {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}
                                        @endif
                                        {{--                                        {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
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
            </div>
            <div class="product-more">
                <form action="{{route('supplierFilterPage.user')}}" method="get" id="emergencyAdsMore">

                    <input hidden name="type"
                           value="emergency">
                    <a style="cursor: pointer" onclick="document.getElementById('emergencyAdsMore').submit()"> <span>موارد بیشتر</span>
                        <span><i class="fa fa-angle-left"></i></span></a>
                </form>

            </div>

    @endif


    <!-- resent product -->
        @if($four_ads->count()>0)
            <div class="resent-product">
                <div class="container">
                    <div class="resent-product-title" style="text-align: center">

                        <h1>آخرین آگهی ها</h1>
                        <h6>به روزترین آگهی های زمین و ویلا</h6>
                    </div>

                    <div class="row">
                        @foreach($four_ads as $ad)
                            <div
                                class="col-xl-3 col-lg-4 col-md-6 mb-5 d-flex justify-content-center flex-column align-items-center">
                                @component('UserMasterNew::components.adCard')
                                    @slot('image')
                                        {{($ad->adImages->first())?$ad->adImages->first()->image:
                                                        \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}
                                    @endslot
                                    @slot('golden_hologram')
                                        @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                                                && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status=='approved')
                                            {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->hologram->logo}}
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
                                            {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()->pivot->attribute_item_id)
                                                            ->first()->title}}
                                            {{--                                                {{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()->title}}--}}

                                            {{--                                                {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->id)->title)}}--}}

                                            {{--                                                {{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->title}}--}}
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
                                            {{--                                            {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
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
                    <div class="product-more" style="margin-top: 30px">
                        <form action="{{route('supplierFilterPage.user')}}" method="get" id="moreAdsInHomePage"
                              class="catalog-link">

                            <a style="cursor: pointer" onclick="document.getElementById('moreAdsInHomePage').submit()">
                                <span>موارد بیشتر</span>
                                <span><i class="fa fa-angle-left"></i></span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
    @endif
    <!-- end of resent product -->

        <section class="banners-bg">

            <!-- enter product -->
            <div class="enter-product">
                <div class="container">
                    <div class="enter-product-desc">
                        <h2>افزودن ملک</h2>
                        <p>ثبت آگهی های فروش زمین و ویلا</p>
                    </div>
                    <div class="enter-product-link">
                        <a href="{{route('ad.find.cats.user', 'supplier')}}">افزودن</a>
                    </div>
                </div>

            </div>
            <!-- end of enter product -->


        </section>
        <!-- end of quick sale -->

        <!-- buy a product  steps -->
        <div class="product-step">
            <div class="step-title">
                <h3>
                    دولت سرا یک رفیق واقعی
                </h3>
                <p>
                    مدرن ولی پایبند به اصول
                </p>

            </div>
        </div>
        <!-- end of buy a product  steps -->

        <!-- join contractor -->
        <section class="banners-bg-2">

            @if($contractors->count()>0)
                <div class="join-contractor">
                    <div class="container">
                        <div class="join-contractor-title">
                            <h2> پیمانکاران صنعت ساختمان
                            </h2>
                            <p>بدون واسطه از بین متخصصین انتخاب کنید</p>
                        </div>
                        <div class="best-contractore-slider-show">

                            <div class="quick-sale-product  owl-carousel d-flex ">
                                @foreach($contractors as $contractor)

                                    <div class="item col-lg-3 col-md-6 px-3">
                                        @component('UserMasterNew::components.contractorCard')
                                            @slot('userImage')
                                                @if(isset($contractor->userImage))
                                                    {{$contractor->userImage}}
                                                @elseif($contractor->sex==1)
                                                    {{$contractor_women_default_photo}}
                                                @else
                                                    {{$contractor_men_default_photo}}
                                                @endif
                                            @endslot
                                            @slot('user_id')
                                                {{$contractor->user_id}}
                                            @endslot

                                            @slot('name')
                                                {{$contractor->name}}
                                            @endslot
                                            @slot('hologram')
                                                @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $contractor->id)->where('type', 'user')->first()
                                                        && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $contractor->id)->where('type', 'user')->first()->status=='approved')
                                                    {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $contractor->id)->where('type', 'user')->first()->hologram->logo}}
                                                @else
                                                    {{''}}
                                                @endif
                                            @endslot
                                            @slot('sirName')
                                                {{$contractor->sirName}}
                                            @endslot
                                            @slot('numberOfSkills')
                                                {{$contractor->associationSkills->count()}}
                                            @endslot
                                            @slot('numberOfProjects')
                                                {{$contractor->contractorProjects->count()}}
                                            @endslot
                                            @slot('id')
                                                {{$contractor->slug}}

                                            @endslot
                                            @slot('firstLevel1Association')
                                                {{$contractor->associationSkills()->count()>0?$contractor->associationSkills()->first()->title:''}}
                                            @endslot
                                            @slot('secondLevel1Association')
                                                {{$contractor->associationSkills()->count()>1?$contractor->associationSkills()->skip(1)->first()->title:''}}
                                            @endslot
                                        @endcomponent

                                    </div>
                                @endforeach


                            </div>
                        </div>
                        <div class="product-more">
                            <a href="{{route('contractors.index.user')}}">

                                <span>موارد بیشتر</span>
                                <span><i class="fa fa-angle-left"></i></span>
                            </a>
                        </div>
                    </div>
                </div>        <!-- end of join contractor -->
            @endif
        <!-- enter contractore -->
            <div class="enter-product">
                <div class="container">
                    <div class="enter-product-desc">
                        <h2> پیوستن به پیمانکاران</h2>
                        <p>بی واسطه، خود را در دید هزاران کارفرما قرار دهید</p>
                    </div>
                    <div class="enter-product-link">
                        <a href="{{route('auth.realestate.registerForm.user')}}">افزودن</a>
                    </div>
                </div>

            </div>
            <!-- end of enter contractore -->

            <!-- best store -->
            @if($shops->count()>0)
                <div class="best-store">
                    <div class="container">
                        <div class="best-store-title">
                            <h2>
                                کسب و کار های کسب و کار
                            </h2>
                            <p>
                                دسترسی مستقیم به کسب و کار های منطقه خود
                            </p>
                        </div>
                        <div class="row">
                            @foreach($shops as $shop)
                                <div class="col-lg-4 col-md-6 px-3">
                                    <div class="show-store">
                                        <div class="show-store-bg">
                                            <div class="pro-option">
                                                <ul>
                                                    <li class="hologram-img-color">
                                                        @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()
                                                         && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()->status=='approved')
                                                            {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()->hologram->logo}}
                                                            <img
                                                                src="{{asset(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()->hologram->logo)}}"
                                                                alt="">
                                                        @endif
                                                    </li>
                                                    {{--                                                <li>--}}
                                                    {{--                                                    <img src="assets/img/Group 21.png" alt="" class="option-img">--}}
                                                    {{--                                                </li>--}}
                                                </ul>
                                            </div>
                                            <img
                                                src="{{isset($shop_default_photo)?asset($shop_default_photo):asset('files/userMaster/assets/img/images (10).jpg')}}"
                                                alt="">

                                            <a href="{{route('realEstate.show.user', $shop->slug)}}">
                                                <div class="show-store-content-bg">
                                                    <div class="show-store-content">
                                                        <div class="store-img">
                                                            <img
                                                                src="{{isset($shop->shop_logo)?asset($shop->shop_logo):asset($shop_default_logo)}}"
                                                                alt="">
                                                        </div>
                                                        <div class="store-intro">
                                                            <h3>
                                                                {{$shop->shop_title}}
                                                            </h3>
                                                            <p>
                                                                {{$shop->shop_description}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="product-more">
                            <a href="{{route('realEstate.index.user')}}">

                                <span>موارد بیشتر</span>
                                <span><i class="fa fa-angle-left"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
        @endif
        <!-- end of best store -->
        </section>
        <!-- enter  store -->
        <div class="enter-product">
            <div class="container">
                <div class="enter-product-desc">
                    <h2>ثبت کسب و کار های کسب و کار</h2>
                    <p>برای رقابت در بازارهای جدید، در کنارتان هستیم</p>
                </div>
                <div class="enter-product-link yellow-bg">
                    <a href="{{route('auth.realestate.registerForm.user')}}">افزودن</a>
                </div>
            </div>

        </div>


        <!-- news -->
    {{--        <div class="news">--}}
    {{--            <div class="news-title">--}}
    {{--                <h3>--}}
    {{--                    اخرین اخبار دولت سرا--}}
    {{--                </h3>--}}
    {{--                <p>--}}
    {{--                    از اخرین خبر ها در حوزه ملک با خبر شوید--}}
    {{--                </p>--}}

    {{--            </div>--}}
    {{--            <div class="container">--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-lg-6 col-md-12 px-2">--}}
    {{--                        <div class="show-news">--}}
    {{--                            <div class="main-news">--}}
    {{--                                <div class="main-news-img">--}}
    {{--                                    <img src="assets/img/images (13).jpg" alt="">--}}
    {{--                                </div>--}}
    {{--                                <div class="main-news-desc">--}}
    {{--                                    <div class="main-news-info">--}}
    {{--                                        <ul>--}}
    {{--                                            <li class="main-news-info-yellow">اخبار</li>--}}
    {{--                                            <li>1400/4/8</li>--}}
    {{--                                        </ul>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="main-news-intro">--}}
    {{--                                        <h4>--}}
    {{--                                            اتش سوزی در واحد های مجتمع سپهر--}}
    {{--                                        </h4>--}}
    {{--                                        <p>--}}
    {{--                                            اولین مرحله خرید ساخت اکانت کاربری در سایت میباشد.شما به راحتی میتوانید--}}
    {{--                                            با شماره موبایل خود در سی ثانیه اکانت خورد را سازید.--}}
    {{--                                        </p>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="main-news-link">--}}
    {{--                                        <a href="">--}}
    {{--                                            ادامه مطلب--}}
    {{--                                        </a>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-6 col-md-12 my-3 px-2">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col-md-6">--}}
    {{--                                <div class="show-news">--}}
    {{--                                    <div class="sub-news">--}}
    {{--                                        <div class="sub-news-img">--}}
    {{--                                            <img src="assets/img/download (3).jpg" alt="">--}}
    {{--                                        </div>--}}
    {{--                                        <div class="sub-news-desc">--}}
    {{--                                            <h4>--}}
    {{--                                                فروش واحد های مجتمع سپهر--}}
    {{--                                            </h4>--}}
    {{--                                            <p>--}}

    {{--                                                اولین مرحله خرید ساخت اکانت کاربری در سایت میباشد.شما به راحتی--}}
    {{--                                                میتوانید با شماره موبایل خود در سی ثانیه اکانت خورد را سازید.--}}

    {{--                                            </p>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="sub-news-link">--}}
    {{--                                            <a href="">--}}
    {{--                                                ادامه مطلب--}}
    {{--                                            </a>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}

    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <div class="col-md-6">--}}
    {{--                                <div class="show-news">--}}
    {{--                                    <div class="sub-news">--}}
    {{--                                        <div class="sub-news-img">--}}
    {{--                                            <img src="assets/img/download (3).jpg" alt="">--}}
    {{--                                        </div>--}}
    {{--                                        <div class="sub-news-desc">--}}
    {{--                                            <h4>--}}
    {{--                                                فروش واحد های مجتمع سپهر--}}
    {{--                                            </h4>--}}
    {{--                                            <p>--}}

    {{--                                                اولین مرحله خرید ساخت اکانت کاربری در سایت میباشد.شما به راحتی--}}
    {{--                                                میتوانید با شماره موبایل خود در سی ثانیه اکانت خورد را سازید.--}}

    {{--                                            </p>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="sub-news-link">--}}
    {{--                                            <a href="">--}}
    {{--                                                ادامه مطلب--}}
    {{--                                            </a>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}

    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                                <div class="product-more">--}}
    {{--                                    <a href="">--}}
    {{--                                        <span>موارد بیشتر</span>--}}
    {{--                                        <img src="assets/img/Group 18.svg" alt="">--}}
    {{--                                    </a>--}}
    {{--                                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    <!-- end of news -->
    </main>

@endsection
@section('js_user')
    <script>
        var val = $("#homePageInput").val();
        if (val) {
            jQuery('div[id="firstPageTop"]').empty();
            $('div[id="firstPageTop"]').append(`{!! $content !!}`);
        }
    </script>
    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}

    {{--            $(".owl-carousel").owlCarousel({--}}
    {{--                rtl: true,--}}
    {{--                items: 4,--}}
    {{--                nav: true,--}}
    {{--                autoplay: true,--}}
    {{--                loop: true,--}}
    {{--                autoplaySpeed: 2000,--}}
    {{--                autoplayHoverPause: true,--}}
    {{--                autoplayTimeout: 3000,--}}
    {{--                dots: false,--}}
    {{--                responsive: {--}}
    {{--                    0: {--}}
    {{--                        items: 1,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true,--}}

    {{--                    },--}}
    {{--                    370: {--}}
    {{--                        items: 1.05,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true,--}}

    {{--                    },--}}

    {{--                    390: {--}}
    {{--                        items: 1.1,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true,--}}

    {{--                    },--}}
    {{--                    420: {--}}
    {{--                        items: 1.15,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true,--}}

    {{--                    },--}}

    {{--                    450: {--}}
    {{--                        items: 1.2,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true--}}
    {{--                    },--}}
    {{--                    490: {--}}
    {{--                        items: 1.3,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true--}}
    {{--                    },--}}
    {{--                    550: {--}}
    {{--                        items: 1.5,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true--}}
    {{--                    },--}}
    {{--                    768: {--}}
    {{--                        items: 1.9,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true--}}
    {{--                    },--}}
    {{--                    920: {--}}
    {{--                        items: 2.15,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true--}}
    {{--                    },--}}
    {{--                    990: {--}}
    {{--                        items: 2.6,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true--}}
    {{--                    },--}}
    {{--                    1200: {--}}
    {{--                        items: 3.2,--}}
    {{--                        nav: false,--}}
    {{--                        loop: true--}}
    {{--                    },--}}
    {{--                    1320: {--}}
    {{--                        items: 3.3,--}}
    {{--                        nav: true,--}}
    {{--                        loop: true--}}
    {{--                    },--}}
    {{--                    1380: {--}}
    {{--                        items: 3.4,--}}
    {{--                        nav: true,--}}
    {{--                        loop: true--}}
    {{--                    },--}}



    {{--                    1420: {--}}
    {{--                        items: 4,--}}
    {{--                        nav:true,--}}
    {{--                        loop: true--}}
    {{--                    },--}}

    {{--                }--}}

    {{--            });--}}


    {{--        })--}}
    {{--    </script>--}}
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
                        nav: false,
                        loop: true
                    },
                    1200: {
                        items: 3.2,
                        nav: false,
                        loop: true
                    },
                    1320: {
                        items: 3.3,
                        nav: false,
                        loop: true
                    },
                    1380: {
                        items: 3.4,
                        nav: false,
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

@endsection

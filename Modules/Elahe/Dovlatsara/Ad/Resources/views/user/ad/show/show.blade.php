@extends('UserMasterNew::master')
@section('title_user') آگهی {{$ad->title}}
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/singleagahi.css')}}">
    {{--    <script src2="https://kit.fontawesome.com/0cbb892daa.js" crossorigin="anonymous"></script>--}}
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" /> -->

    <!-- Javascript -->
    {{--    <script src2="assets/js/map.js"></script>--}}
    {{--    <script src2="https://kit.fontawesome.com/0cbb892daa.js" crossorigin="anonymous"></script>--}}
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/map.css')}}">--}}

    {{--    <link rel="stylesheet" href="assets/css/map.css">--}}
    {{--    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"--}}
    {{--          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="--}}
    {{--          crossorigin="" />--}}
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" /> -->

    <!-- Javascript -->
    {{--    <script src="{{asset('files/userMaster/assets/js/map.js')}}"></script>--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">
    <script src="https://kit.fontawesome.com/0cbb892daa.js" crossorigin="anonymous"></script>

    {{--        <script src2="assets/js/map.js"></script>--}}
    {{--    <!-- <script src2="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script> -->--}}
    {{--    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">--}}
    {{--    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">--}}
    {{--    <link rel="stylesheet" href="{{asset('files/map/dist/css/mapp.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('files/map/dist/css/fa/style.css')}}">--}}

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/share.css')}}">

    {{--    <style>--}}
    {{--        #app {--}}
    {{--            width: 100%;--}}
    {{--            height: 220px;--}}
    {{--        }--}}
    {{--    </style>--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/test.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/dolatsara.css')}}"/>


    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

    @include('Maps::layouts.neshan-css')

@endsection
@section('content_userMasterNew')
    <main>
        <div class="show-single-agahi">
            <div class="container">
                <div class="show-single-top">
                    <div class="row agahi-image-row">
                        <div class="col-lg-4">
                            <div class="agahi-maintop-info">
                                <div class="head-info">
                                    <div class="agahi-code">کد اگهی: {{$ad->uniqueCodeOfAd}}</div>
                                    <div class="agahi-time">{{verta($ad->startDate)->formatDifference()}}</div>

                                </div>
                                <div class="middle-main-agahi-info">
                                    <div class="main-title-price-info">
                                        @if (\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
      && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status == 'approved')
                                            <div class="hologram-img-color ">
                                                <img src="{{asset(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')
                ->first()->hologram->logo)}}" alt="">
                                            </div>
                                        @endif
                                        <p>{{$ad->title}}</p>
                                    </div>
                                    @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                        <div class="price">
                                            <p class="title">{{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->title}}</p>
                                            @if(isset($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))
                                                <p class="price-num">
                                                    {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}
                                                </p>
                                            @else
                                                {{\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value}}
                                            @endif


                                        </div>
                                    @elseif($ad->attributes->where('attribute_type', 'int')->first())
                                        <div class="price">
                                            <p class="title">{{$ad->attributes->where('attribute_type', 'int')->first()->title}}</p>
                                            @if(isset($ad->attributes->where('attribute_type', 'int')->first()->pivot->value))
                                                <p class="price-num">
                                                    {{number_format($ad->attributes->where('attribute_type', 'int')->first()->pivot->value)}} {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('attribute_type', 'int')->first()->id)->unit)}}
                                                </p>
                                            @else
                                                {{\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('attribute_type', 'int')->first()->id)->alt_value}}
                                            @endif


                                        </div>
                                    @endif

                                </div>
                                @if(isset($ad->description))

                                    <div class="bottom-agahi-info">
                                        <p class="title">توضیحات</p>
                                        <p>{{$ad->description}}</p>
                                    </div>
                                @endif
                                @if($ad->adCatalogs->first())

                                    <div class="catalog-place">
                                        <a href="{{route('catalog.download.user', $ad->adCatalogs->first()->id)}}"
                                           style="    border-radius: 8px;
    background-color: #ddb24f;
    color: #fff;
    padding: 8px 24px;">{{$ad->adCatalogs->first()->description}}</a>
                                    </div>
                                @endif

                            </div>
                            <div class="advertisments-place">
                                @foreach ($advertisement as $adv)
                                    <div class="ad-box medium">
                                        <a href="{{$adv->link}}" target="_blank"><img src="{{asset($adv->image)}}"
                                                                                      alt=""></a>
                                    </div>
                                @endforeach
                                @if($advertisement->count()<=0)
                                    <div class="ad-box medium">
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

                        <div class="col-lg-8 mb-lg-0 mb-md-5 mt-4">
                            <!-- Container for the image gallery -->
                            <div class="show-single-route" style="color: #ddb24f; font-weight: bolder">
                                {{$ad->category->createStringAsParents()}}
                            </div>
                            @if(($ad->adImages()->count()>0) || ($ad->adVideos()->count()>0))

                                <div class="agahi-image-slider">
                                    <!-- Full-width images with number text -->
                                    @if(($ad->adImages()->count()>0))

                                        @foreach($ad->adImages as $key=>$adImage)
                                            <div class="mySlides">

                                                <img src="{{asset($adImage->image)}}" style="width:100%">
                                            </div>
                                        @endforeach
                                    @endif

                                    @if(($ad->adVideos()->count()>0))
                                        @foreach($ad->adVideos as $key=>$adVideo)

                                            <div class="mySlides">

                                                <video width="320" height="240" controls>
                                                    <source src="{{asset($adVideo->video)}}">
                                                    {{--                                                <source src2="movie.ogg" type="video/ogg">--}}
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                    @endforeach
                                @endif
                                <!-- Next and previous buttons -->
                                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                    <!-- Image text -->
                                    <div class="caption-container">
                                        <p id="caption"></p>
                                    </div>

                                    <!-- Thumbnail images -->
                                    <div class="row slider-images">
                                        @foreach($ad->adImages as $key=>$adImage)
                                            <div class="column" onclick="currentSlide({{$key+1}})">
                                                <img class="demo cursor" src="{{asset($adImage->image)}}"
                                                     style="width:100%"
                                                >
                                            </div>
                                        @endforeach
                                        @foreach($ad->adVideos as $key=>$adVideo)
                                            <div class="column" onclick="currentSlide({{$ad->adImages()->count()+1}})">
                                                <img class="demo cursor"
                                                     src="{{asset('files/userMaster/assets/img/video-back-ground.png')}}"
                                                     style="width:100%"
                                                >
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endif
                            <div class="agahi-links mt-3">
                                <div class="right-side">
                                    <div class="btns-box-show contact-num">
                                        <div class="contact-show-btn">
                                            <button class="agahi-link-btn purple" value="{{$ad->id}}" id="contact">
                                                شماره تماس
                                            </button>
                                            <p id="mobileNumber"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="left-side">

                                    {{--                                                                            <div class="btns-box-show">--}}
                                    {{--                                                                                <button class="agahi-link-btn">--}}
                                    {{--                                                                                    <span>گزارش آگهی</span>--}}
                                    {{--                                                                                    <i class="fas fa-exclamation-triangle"></i>--}}
                                    {{--                                                                                </button>--}}
                                    {{--                                                                            </div>--}}
                                    <div class="btns-box-show">
                                        <div class=" share-btn btn_wrap">
                                            <span>اشتراک گذاری<i class="fas fa-share-alt"></i></span>
                                            <div class="containers d-flex">
                                                <i class="fa fa-whatsapp inside-icon"> <a
                                                        href="{{url('https://api.whatsapp.com/send?text='.url(route('ad.show.supplier.user', $ad->id)))}}"
                                                        target="_blank"></a></i>
                                                <i class="fa fa-twitter inside-icon"><a
                                                        href="{{url('https://twitter.com/intent/tweet?text=آگهی '.$ad->title.'&url='.url(route('ad.show.supplier.user', $ad->id)))}}"
                                                        target="_blank"></a></i>
                                                {{--                                                    <i class="fab fa-instagram inside-icon"><a href="#" target="_blank"></a></i>--}}
                                                <i class="fa fa-telegram inside-icon"><a
                                                        href="{{url('https://telegram.me/share/url?url='.url(route('ad.show.supplier.user', $ad->id)).'&text=آگهی '.$ad->title)}}"
                                                        target="_blank"></a></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                        <a target="_blank" href="{{url('https://twitter.com/intent/tweet?text=آگهی '.$ad->title.'&url='.url(route('ad.show.supplier.user', $ad->id)).'&via=YOUR_TWITTER_USERNAME')}}" class="agahi-link-btn">--}}
                                    {{--                                            <span>اشتراک گذاری</span>--}}
                                    {{--                                            <i class="fas fa-share-alt"></i>--}}
                                    {{--                                        </a>
                                     <a target="_blank" href="{{url('https://telegram.me/share/url?url='.url(route('ad.show.supplier.user', $ad->id)).'&text=آگهی '.$ad->title.')}}" class="agahi-link-btn">--}}
                                    {{--                                            <span>اشتراک گذاری</span>--}}
                                    {{--                                            <i class="fas fa-telegra,"></i>--}}
                                    {{--                                        </a>--}}
                                    {{--                                        <a target="_blank" href="{{url('whatsapp://send?text='.url(route('ad.show.supplier.user', $ad->id)))}}" title="آگهی" class="agahi-link-btn">--}}

                                    {{--                                    <a target="_blank" href="{{url('https://api.whatsapp.com/send?text='.url(route('ad.show.supplier.user', $ad->id)))}}" class="agahi-link-btn">--}}
                                    {{--                                                                                <span>اشتراک گذاری</span>--}}
                                    {{--                                                                                <i class="fas fa-whatsapp,"></i>--}}
                                    {{--                                                                            </a>--}}
                                    {{--                                    </div>--}}
                                    <div class="btns-box-show">
                                        <button class="agahi-link-btn">
                                            <span>ذخیره</span>
                                            @if(auth()->check())
                                                @if(isset($ad->bookmarks()->where('ad_id', $ad->id)->where('user_id', auth()->id())->first()->status))
                                                    <i class="fa {{$ad->bookmarks()->where('ad_id', $ad->id)->where('user_id', auth()->id())->first()->status?"fa-bookmark":"fa-bookmark-o"}}"
                                                       onclick="myBookmark123({{$ad->bookmarks()->where('ad_id', $ad->id)->where('user_id', auth()->id())->first()->status}})"
                                                       id="bookmark123" style="cursor: pointer"
                                                       data-toggle="tooltip"
                                                       title="نشان کردن"></i>
                                                @else
                                                    <i class="fa fa-bookmark-o fa-sm" onclick="myBookmark123(0)"
                                                       data-toggle="tooltip" title="نشان کردن"
                                                       id="bookmark123"
                                                       style="cursor: pointer"></i>
                                                @endif
                                            @else
                                                {{--                                    <a href="{{route('auth.loginForm.user')}}">--}}
                                                <i onclick="myBookmark123(0)" class="fa fa-bookmark-o"
                                                   style="cursor: pointer"></i>
                                                {{--                                    </a>--}}
                                            @endif
                                            {{--                                                <i class="far fa-bookmark"></i>--}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($ad->attributes->count()>0)
                    <div class="show-single-desc">
                        <div class="show-single-tag">
                            @foreach($ad->attributes->where('attribute_type', 'bool') as $attribute)
                                <span class="badge bg-secondary" style="font-size: 13px">{{$attribute->title}}</span>

                            @endforeach
                        </div>
                        <div class="show-single-desc-info">
                            {{--                        <div class/="show-single-item">--}}

                            @foreach($ad->attributes as $attribute)
                                @if($attribute->attribute_type=='int')
                                    <div class="show-single-item">

                                        <span>{{$attribute->title}}</span>
                                        <span>
                                             @if(isset($attribute->pivot->value))
                                                {{number_format($attribute->pivot->value)}} {{($attribute->unit)}}
                                            @else
                                                {{$attribute->alt_value}}
                                            @endif
                                            {{--                                                 {{number_format($attribute->pivot->value)}}--}}
                                        </span>
                                    </div>
                                @elseif($attribute->attribute_type=='string')
                                    <div class="show-single-item">

                                        <span>{{$attribute->title}}</span>
                                        <span>{{$attribute->pivot->value}}</span>
                                    </div>
                                @elseif($attribute->attribute_type=='select')
                                    <div class="show-single-item">

                                        <span>{{$attribute->title}}</span>
                                        <span>{{\Modules\AttributeItem\Entities\AttributeItem::where('id',$attribute->pivot->attribute_item_id)
                                                            ->first()->title}}</span>
                                    </div>
                                @endif
                            @endforeach
                            <div class="show-single-item-more-line">

                                @foreach($ad->attributes as $attribute)
                                    @if($attribute->attribute_type=='description')
                                        <div class=" show-single-item-more-line show-single-intro-item-col-box">
                                            <h5>{{$attribute->title}}</h5>
                                            <p>
                                                {{$attribute->pivot->value}}
                                            </p>
                                        </div>

                                    @endif
                                @endforeach
                            </div>


                            {{--                        </div>--}}
                        </div>

                    </div>
                @endif
                <div class="show-single-intro">
                    <div class="row">
                        @if(($ad->user->hasRole('real-state-administrator')
|| $ad->user->hasRole('real-state-agent'))
 && $ad->user->shop_active == 'active')
                            <div class="col-lg-6">
                                <div class="show-single-intro-item">
                                    <div class="show-single-intro-item-row">
                                        <div class="show-single-intro-item-row-box">
                                            <span>آگهی دهنده:</span>
                                            <span>
                                                @if($ad->user->hasRole('real-state-administrator'))
                                                    <a href="{{route('realEstate.show.user', $ad->user->slug)}}"
                                                       target="_blank">{{$ad->user->shop_title}}</a>
                                                @elseif($ad->user->hasRole('real-state-agent'))
                                                    {{\Illuminate\Foundation\Auth\User::find($ad->user->real_estate_admin_id)->shop_title}}
                                                @endif

                                            </span>
                                        </div>
                                        <div class="show-single-intro-item-row-box">
                                            <span>شماره تماس بنگاه:</span>
                                            <span>
                                                @if($ad->user->hasRole('real-state-administrator'))
                                                    {{$ad->user->shop_phone}}
                                                @elseif($ad->user->hasRole('real-state-agent'))
                                                    {{\Illuminate\Foundation\Auth\User::find($ad->user->real_estate_admin_id)->shop_phone}}
                                                @endif

                                            </span>
                                        </div>

                                    </div>
                                    <div class="show-single-intro-item-col">
                                        <div class="show-single-intro-item-col-box">
                                            <h5>آدرس:</h5>
                                            <p>
                                                {{$ad->address}}
                                                {{--                                                @if($ad->user->hasRole('real-state-administrator'))--}}
                                                {{--                                                    {{$ad->user->shop_address}}--}}
                                                {{--                                                @elseif($ad->user->hasRole('real-state-agent'))--}}
                                                {{--                                                    {{\Illuminate\Foundation\Auth\User::find($ad->user->real_estate_admin_id)->shop_address}}--}}
                                                {{--                                                @endif--}}
                                            </p>
                                        </div>
                                        {{--                                        @if(isset($ad->description))--}}

                                        {{--                                            <div class="show-single-intro-item-col-box">--}}
                                        {{--                                                <h5>توضیحات:</h5>--}}
                                        {{--                                                <p>--}}
                                        {{--                                                    {{$ad->description}}--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <div class="show-single-intro-item">
                                    <div class="show-single-intro-item-row">
                                        <div class="show-single-intro-item-row-box">
                                            <span>آگهی دهنده:</span>
                                            <span>{{$ad->user->name}} {{$ad->user->sirName}}</span>
                                        </div>
                                        {{--                                        <div class="show-single-intro-item-row-box">--}}
                                        {{--                                            <span>شماره:</span>--}}
                                        {{--                                            <span> {{$ad->user->phoneNumberForAds}}</span>--}}
                                        {{--                                        </div>--}}

                                    </div>
                                    <div class="show-single-intro-item-col">
                                        <div class="show-single-intro-item-col-box">
                                            <h5>آدرس:</h5>
                                            <p>
                                                {{$ad->address}}
                                            </p>
                                        </div>
                                        {{--                                        @if(isset($ad->description))--}}

                                        {{--                                            <div class="show-single-intro-item-col-box">--}}
                                        {{--                                                <h5>توضیحات:</h5>--}}
                                        {{--                                                <p>--}}
                                        {{--                                                    {{$ad->description}}--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        @endif--}}
                                    </div>
                                </div>


                            </div>
                        @endif
                        @if(isset($ad->longitude) && isset($ad->latitude))

                            <div class="col-lg-6">
                                <div class="show-single-intro-item-map">
                                    <div class="show-single-map">
                                        <div id="myMap" class="my-3"
                                             style=" height: 200px; background: #eee; border: 2px solid #aaa;z-index: 90"></div>

                                        {{--                                        <div id="app" style="z-index: 90"></div>--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @if($adsOfUser->count()>0)
            <section class="single-row-slider">
                <h2 class="single-row-slider__title" style="text-align:start;width:80%"><span>دیگر آگهی های {{$user->name}} {{$user->sirName}}</span></h2>
                <div class="dolatsara-slider">
                    <div class="swiper mySwiper3" style="padding: 5px">
                        <div class="swiper-wrapper">
                            @foreach($adsOfUser as $ad3)
                                <div class="swiper-slide">
                                    @component('UserMasterNew::components.adCard')
                                        @slot('image')
                                            {{($ad3->adImages->first())?$ad3->adImages->first()->image:
                                                            \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}
                                        @endslot
                                        @slot('golden_hologram')
                                            @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad3->id)->where('type', 'ad')->first()
                                                    && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad3->id)->where('type', 'ad')->first()->status=='approved')
                                                {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad3->id)->where('type', 'ad')->first()->hologram->logo}}
                                            @endif
                                        @endslot
                                        @slot('emergency_label')
                                            {{$ad3->type=='emergency'?\Modules\Setting\Entities\Setting::where('title', 'emergency_label')
                                            ->first()->str_value:null}}
                                        @endslot
                                        @slot('real_estate')
                                            {{($ad3->user->hasRole('real-state-administrator'))?$ad3->user->shop_title:''}}
                                        @endslot
                                        @slot('title')
                                            {{$ad3->title}}
                                        @endslot
                                        @slot('city')
                                            {{isset($ad3->neighborhood_id)?$ad3->neighborhood->title:$ad3->city->title}}
                                        @endslot
                                        @slot('ad_unique_code')
                                            {{$ad3->uniqueCodeOfAd}}
                                        @endslot
                                        @slot('first_attr')
                                            @if($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())
                                                {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad3->attributes->where('isSignificant', 1)
                                                ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)
                                                                ->first()->title}}
                                            @endif
                                        @endslot
                                        @slot('second_attr')
                                            @if($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                @if(isset($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))
                                                    {{number_format($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}
                                                @else
                                                    {{\Modules\Attribute\Entities\Attribute::find($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value}}
                                                @endif
                                            @endif

                                        @endslot
                                        @slot('second_attr_unit')
                                            @if(isset($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))

                                                @if($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                    {{(\Modules\Attribute\Entities\Attribute::find($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}
                                                @endif
                                            @else
                                                {{''}}
                                            @endif
                                        @endslot
                                        @slot('id')
                                            {{$ad3->id}}
                                        @endslot
                                    @endcomponent

                                    {{--                                <a href="{{route('ad.show.supplier.user', $ad3->id)}}" class="slide-item-parent" target="_blank">--}}
                                    {{--                                    <div class="image-placeholder">--}}
                                    {{--                                        <img--}}
                                    {{--                                            src="{{asset(($ad3->adImages->first())?$ad3->adImages->first()->image:--}}
                                    {{--                                                            \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value)}}"--}}
                                    {{--                                            alt="couldn`t loaded"--}}
                                    {{--                                        />--}}
                                    {{--                                    </div>--}}

                                    {{--                                    <div class="content-box">--}}
                                    {{--                                        <h3 class="title-item">{{$ad3->title}}</h3>--}}

                                    {{--                                        <div class="code-name-advertising-box">--}}
                                    {{--                                            <p class="code-advertising">کد آگهی:  {{$ad3->uniqueCodeOfAd}}</p>--}}
                                    {{--                                            <p class="name-advertising"> {{($ad3->user->hasRole('real-state-administrator'))?$ad3->user->shop_title:''}}</p>--}}
                                    {{--                                        </div>--}}

                                    {{--                                        <div class="card-footer-slider">--}}
                                    {{--                                            <p class="location-advertising">--}}
                                    {{--                                                <i class="fas fa-map-marker-alt footer-icon"></i>--}}
                                    {{--                                                {{$ad3->city->title}}--}}
                                    {{--                                            </p>--}}

                                    {{--                                            <p class="home-advertising">--}}
                                    {{--                                                @if($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())--}}
                                    {{--                                                    <i class="fas fa-home footer-icon"></i>--}}

                                    {{--                                                    {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad3->attributes->where('isSignificant', 1)--}}
                                    {{--                                                    ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)--}}
                                    {{--                                                                    ->first()->title}}--}}
                                    {{--                                                @endif--}}
                                    {{--                                            </p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </a>--}}
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <a class="view-all" href="{{route('ad.userAds.user', $user->user_id)}}" style="background-color: #ddb24f;
    border: 0; padding: 0.35rem; border-radius: 4px; color: white; margin: 2rem 0; font-size: 15px; width: 167px; height: 36px; display: flex; align-items: center;justify-content: center">مشاهده
                    همه</a>
            </section>

            {{--            <div class="same-agahi">--}}
            {{--                <div class="container">--}}
            {{--                    <div class="same-agahi-show">--}}
            {{--                        <div class="same-agahi-show-title">--}}
            {{--                            <h2>--}}
            {{--                                دیگر آگهی ها--}}
            {{--                            </h2>--}}
            {{--                        </div>--}}
            {{--                        <div class="quick-sale-product  owl-carousel2 d-flex">--}}
            {{--                            @foreach($adsOfUser as $ad3)--}}
            {{--                                <div class="item col-lg-3 col-md-6" style="height: 100%">--}}
            {{--                                    @component('UserMasterNew::components.adCard')--}}
            {{--                                        @slot('image')--}}
            {{--                                            {{($ad3->adImages->first())?$ad3->adImages->first()->image:--}}
            {{--                                                            \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('golden_hologram')--}}
            {{--                                            @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad3->id)->where('type', 'ad')->first()--}}
            {{--                                                    && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad3->id)->where('type', 'ad')->first()->status=='approved')--}}
            {{--                                                {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad3->id)->where('type', 'ad')->first()->hologram->logo}}--}}
            {{--                                            @endif--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('emergency_label')--}}
            {{--                                            {{$ad3->type=='emergency'?\Modules\Setting\Entities\Setting::where('title', 'emergency_label')--}}
            {{--                                            ->first()->str_value:null}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('real_estate')--}}
            {{--                                            {{($ad3->user->hasRole('real-state-administrator'))?$ad3->user->shop_title:''}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('title')--}}
            {{--                                            {{$ad3->title}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('city')--}}
            {{--                                            {{isset($ad3->neighborhood_id)?$ad3->neighborhood->title:$ad3->city->title}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('ad_unique_code')--}}
            {{--                                            {{$ad3->uniqueCodeOfAd}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('first_attr')--}}
            {{--                                            @if($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())--}}
            {{--                                                {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad3->attributes->where('isSignificant', 1)--}}
            {{--                                                ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)--}}
            {{--                                                                ->first()->title}}--}}
            {{--                                                                                                {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->id)->title)}}--}}

            {{--                                                                                                {{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->title}}--}}
            {{--                                            @endif--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('second_attr')--}}
            {{--                                            @if($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())--}}
            {{--                                                @if(isset($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))--}}
            {{--                                                    {{number_format($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
            {{--                                                                                                                    {{($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->unit)}}--}}
            {{--                                                @else--}}
            {{--                                                    {{\Modules\Attribute\Entities\Attribute::find($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value}}--}}
            {{--                                                @endif--}}
            {{--                                                                                                        {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
            {{--                                            @endif--}}
            {{--                                                                                        @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())--}}
            {{--                                                                                            {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
            {{--                                                                                        @endif--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('second_attr_unit')--}}
            {{--                                            @if(isset($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))--}}

            {{--                                                @if($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())--}}
            {{--                                                    {{(\Modules\Attribute\Entities\Attribute::find($ad3->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}--}}
            {{--                                                @endif--}}
            {{--                                            @else--}}
            {{--                                                {{''}}--}}
            {{--                                            @endif--}}
            {{--                                                                                        @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())--}}
            {{--                                                                                            {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}--}}
            {{--                                                                                        @endif--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('id')--}}
            {{--                                            {{$ad3->id}}--}}
            {{--                                        @endslot--}}
            {{--                                    @endcomponent--}}

            {{--                                </div>--}}
            {{--                            @endforeach--}}

            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            {{--            </div>--}}
        @endif

        @if($similarAds->count()>0)
            <section class="single-row-slider">
                <h2 class="single-row-slider__title" style="text-align:start;width:80%"><span>آگهی های مشابه</span></h2>
                <div class="dolatsara-slider">
                    <div class="swiper mySwiper3">
                        <div class="swiper-wrapper">
                            @foreach($similarAds as $ad2)
                                <div class="swiper-slide" style="padding: 5px">
                                    @component('UserMasterNew::components.adCard')
                                        @slot('image')
                                            {{($ad2->adImages->first())?$ad2->adImages->first()->image:
                                                            \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}
                                        @endslot
                                        @slot('golden_hologram')
                                            @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad2->id)->where('type', 'ad')->first()
                                                    && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad2->id)->where('type', 'ad')->first()->status=='approved')
                                                {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad2->id)->where('type', 'ad')->first()->hologram->logo}}
                                            @endif
                                        @endslot
                                        @slot('emergency_label')
                                            {{$ad2->type=='emergency'?\Modules\Setting\Entities\Setting::where('title', 'emergency_label')
                                            ->first()->str_value:null}}
                                        @endslot
                                        @slot('real_estate')
                                            {{($ad2->user->hasRole('real-state-administrator'))?$ad2->user->shop_title:''}}
                                        @endslot
                                        @slot('title')
                                            {{$ad2->title}}
                                        @endslot
                                        @slot('city')
                                            {{isset($ad2->neighborhood_id)?$ad2->neighborhood->title:$ad2->city->title}}
                                        @endslot
                                        @slot('ad_unique_code')
                                            {{$ad2->uniqueCodeOfAd}}
                                        @endslot
                                        @slot('first_attr')
                                            @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())
                                                {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad2->attributes->where('isSignificant', 1)
                                                ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)
                                                                ->first()->title}}
                                            @endif
                                        @endslot
                                        @slot('second_attr')
                                            @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                @if(isset($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))
                                                    {{number_format($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}
                                                @else
                                                    {{\Modules\Attribute\Entities\Attribute::find($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value}}
                                                @endif
                                            @endif

                                        @endslot
                                        @slot('second_attr_unit')
                                            @if(isset($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))

                                                @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                    {{(\Modules\Attribute\Entities\Attribute::find($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}
                                                @endif
                                            @else
                                                {{''}}
                                            @endif
                                        @endslot
                                        @slot('id')
                                            {{$ad2->id}}
                                        @endslot
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

            </section>
            {{--            <div class="same-agahi" style="margin: 120px 0 80px 0">--}}
            {{--                <div class="container">--}}
            {{--                    <div class="same-agahi-show">--}}
            {{--                        <div class="same-agahi-show-title">--}}
            {{--                            <h2>--}}
            {{--                                آگهی های مشابه--}}
            {{--                            </h2>--}}
            {{--                        </div>--}}
            {{--                        <div class="quick-sale-product  owl-carousel d-flex ">--}}
            {{--                            @foreach($similarAds as $ad2)--}}
            {{--                                <div class="item col-lg-3 col-md-6" style="height: 100%">--}}
            {{--                                    @component('UserMasterNew::components.adCard')--}}
            {{--                                        @slot('image')--}}
            {{--                                            {{($ad2->adImages->first())?$ad2->adImages->first()->image:--}}
            {{--                                                            \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('golden_hologram')--}}
            {{--                                            @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad2->id)->where('type', 'ad')->first()--}}
            {{--                                                    && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad2->id)->where('type', 'ad')->first()->status=='approved')--}}
            {{--                                                {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad2->id)->where('type', 'ad')->first()->hologram->logo}}--}}
            {{--                                            @endif--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('emergency_label')--}}
            {{--                                            {{$ad2->type=='emergency'?\Modules\Setting\Entities\Setting::where('title', 'emergency_label')--}}
            {{--                                            ->first()->str_value:null}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('real_estate')--}}
            {{--                                            {{($ad2->user->hasRole('real-state-administrator'))?$ad2->user->shop_title:''}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('title')--}}
            {{--                                            {{$ad2->title}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('city')--}}
            {{--                                            {{isset($ad2->neighborhood_id)?$ad2->neighborhood->title:$ad2->city->title}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('ad_unique_code')--}}
            {{--                                            {{$ad2->uniqueCodeOfAd}}--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('first_attr')--}}
            {{--                                            @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())--}}
            {{--                                                {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad2->attributes->where('isSignificant', 1)--}}
            {{--                                                ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)--}}
            {{--                                                                ->first()->title}}--}}
            {{--                                                --}}{{--                                                {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->id)->title)}}--}}

            {{--                                                --}}{{--                                                {{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->title}}--}}
            {{--                                            @endif--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('second_attr')--}}
            {{--                                            @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())--}}
            {{--                                                @if(isset($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))--}}
            {{--                                                    {{number_format($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
            {{--                                                    --}}{{--                                                                {{($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->unit)}}--}}
            {{--                                                @else--}}
            {{--                                                    {{\Modules\Attribute\Entities\Attribute::find($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value}}--}}
            {{--                                                @endif--}}
            {{--                                                --}}{{--                                                        {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
            {{--                                            @endif--}}
            {{--                                            --}}{{--                                            @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())--}}
            {{--                                            --}}{{--                                                {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
            {{--                                            --}}{{--                                            @endif--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('second_attr_unit')--}}
            {{--                                            @if(isset($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))--}}

            {{--                                                @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())--}}
            {{--                                                    {{(\Modules\Attribute\Entities\Attribute::find($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}--}}
            {{--                                                @endif--}}
            {{--                                            @else--}}
            {{--                                                {{''}}--}}
            {{--                                            @endif--}}
            {{--                                            --}}{{--                                            @if($ad2->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())--}}
            {{--                                            --}}{{--                                                {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}--}}
            {{--                                            --}}{{--                                            @endif--}}
            {{--                                        @endslot--}}
            {{--                                        @slot('id')--}}
            {{--                                            {{$ad2->id}}--}}
            {{--                                        @endslot--}}
            {{--                                    @endcomponent--}}

            {{--                                </div>--}}
            {{--                            @endforeach--}}

            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            {{--            </div>--}}
        @endif
        <input hidden name="adIdInput" id="adIdInput" value="{{$ad->id}}">

    </main>
@endsection
@section('js_user')

    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('button[id="contact"]').on('click', function () {
                var adID = jQuery(this).val();
                {{--str = `<div class="show-single-number-show">--}}
                    {{--                            <span class="show-single-number-show-title">--}}
                    {{--                                شماره تماس--}}
                    {{--                            </span>--}}
                    {{--                            <span class="show-single-number-show-num">--}}
                    {{--                                {{\Modules\Ad\Entities\Ad::find($ad->id)->mobile}}--}}
                    {{--    </span>--}}
                    {{--</div>`;--}}
                    {{--                                        @isset($ad->mobile)--}}
                    str = '{{$ad_phone_number}}';
                $('#mobileNumber').empty();
                $('#mobileNumber').append(str);
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $(".owl-carousel").owlCarousel({
                rtl: true,
                items: 3,
                nav: false,
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
                        loop: true,

                    },
                    // 370: {
                    //     items: 1.05,
                    //     nav: false,
                    //     loop: true,
                    //
                    // },
                    //
                    // 390: {
                    //     items: 1.1,
                    //     nav: false,
                    //     loop: true,
                    //
                    // },
                    // 420: {
                    //     items: 1.15,
                    //     nav: false,
                    //     loop: true,
                    //
                    // },

                    // 450: {
                    //     items: 1.2,
                    //     nav: false,
                    //     loop: true
                    // },
                    480: {
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
    <script>
        $(document).ready(function () {

            $(".owl-carousel2").owlCarousel({
                rtl: true,
                items: 3,
                nav: false,
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
                        loop: true,

                    },
                    // 370: {
                    //     items: 1.05,
                    //     nav: false,
                    //     loop: true,
                    //
                    // },
                    //
                    // 390: {
                    //     items: 1.1,
                    //     nav: false,
                    //     loop: true,
                    //
                    // },
                    // 420: {
                    //     items: 1.15,
                    //     nav: false,
                    //     loop: true,
                    //
                    // },

                    // 450: {
                    //     items: 1.2,
                    //     nav: false,
                    //     loop: true
                    // },
                    480: {
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

    {{--        <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/jquery-3.2.1.min.js"></script>--}}
    {{--    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>--}}
    {{--    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>--}}
    {{--    <script type="text/javascript" src="{{asset('files/map/dist/js/mapp..env.js')}}"></script>--}}
    {{--    <script type="text/javascript" src="{{asset('files/map/dist/js/mapp.min.js')}}"></script>--}}

    {{--    @if(isset($latt) && isset($lngg))--}}
    {{--        <script>--}}
    {{--            $(document).ready(function () {--}}
    {{--                var latt =--}}
    {{--                    {{$latitude}}--}}
    {{--                        var--}}
    {{--                lngg =--}}
    {{--                    {{$longitude}}--}}
    {{--                        var--}}
    {{--                app = new Mapp({--}}
    {{--                    element: "#app",--}}
    {{--                    presets: {--}}
    {{--                        latlng: {--}}
    {{--                            lat: latt,--}}
    {{--                            lng: lngg--}}
    {{--                        },--}}
    {{--                        zoom: 13--}}
    {{--                    },--}}
    {{--                    apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIn0.eyJhdWQiOiIxNDAyMSIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIiwiaWF0IjoxNjIxMjMzMDE1LCJuYmYiOjE2MjEyMzMwMTUsImV4cCI6MTYyMzgyNTAxNSwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.g-oaFkPxTsmJka5HczgcUvJMmuM6HKdrJgEaVyHWzNXu3UmkOjWch_d8nf0OIOQqKSG6I-KpjMYVEfj1KRH9iI4x9HYilH9qSq8epsUElbWuS6OLTCS3i_a-CCgelms3qFvbnik7tkfw_7f41zCZRxO-8w1h-41QkOMVtXLalZF-R7khLb5PShh75lo60Iezy9eEpoIZduQe2GlF_yjHMI8oLC9ZSLeH03Qw5UvjycPyEpYhwBUiqK9THv4mAnsKt89EjwENDcaWxxFS1uymGfbi2tdpE1tiT0QgUkVsFHvwivBCDRIf3eLIVXmY2ryi7LlKNmDfScWqCN11u_ZRMA'--}}
    {{--                });--}}

    {{--                app.addVectorLayers();--}}

    {{--                var crosshairIcon = L.icon({--}}
    {{--                    iconUrl: '{{asset('files/map/dist/assets/images/marker-icon.png')}}',--}}
    {{--                    iconSize: [20, 20],--}}
    {{--                    iconAnchor: [10, 10],--}}
    {{--                });--}}
    {{--                var crosshairMarker = new--}}
    {{--                L.marker(app.map.getCenter(), {--}}
    {{--                    icon: crosshairIcon,--}}
    {{--                    clickable: false--}}
    {{--                });--}}
    {{--                crosshairMarker.addTo(app.map);--}}

    {{--                app.map.on('move', function (e) {--}}
    {{--                    crosshairMarker.setLatLng(app.map.getCenter());--}}
    {{--                });--}}
    {{--                crosshairMarker.on('click', function (event) {--}}
    {{--                    // console.log(event.latlng)--}}
    {{--                })--}}
    {{--            })--}}
    {{--        </script>--}}
    {{--    @endif--}}
    <script>
        function myBookmark123(favorite) {
            @if(\Illuminate\Support\Facades\Auth::check())

            {{--console.log({{$ad->id}})--}}
            var url1 = '{{route('bookmarked.user', ':adId')}}';
            url1 = url1.replace(':adId', document.getElementById("adIdInput").value)

            jQuery.ajax({
                url: url1,
                data: {
                    'id': "{{$ad->id}}",
                    'favorite': favorite,
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    // console.log(data)
                    if (favorite == 1) {
                        $('#bookmark123').removeClass('fa-bookmark');
                        $('#bookmark123').addClass('fa-bookmark-o');

                    } else {
                        $('#bookmark123').removeClass('fa-bookmark-o');
                        $('#bookmark123').addClass('fa-bookmark');

                    }
                }
            })
            @else
            // alert('ss')

            window.location.href = "{{route('bookmarked.user', $ad->id)}}"
            @endif
        }
    </script>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!--load all styles -->
    <script src="{{asset('files/userMaster/src/js/dolatsara.js')}}"></script>
    @include('Maps::layouts.neshan-js')

@endsection

@extends('UserMasterNew::master')
@section('title_user') {{$user->shop_title}}
@endsection
@section('css_user')
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/store.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/amalkiSingle.css')}}">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.theme.default.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/contractor.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css"
          integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/realestate.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/articleShow.css')}}">
    <style>
        .real-estate-page .realstate-header-image {
            background-image: url('{{asset($user->shop_header_image)}}');
        }
    </style>
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2.css')}}">
    <style>
        @media (max-width: 992px) {
            .real-estate-page {
                background-image: url('{{asset($user->shop_header_image)}}');


            }
        }
    </style>
@endsection
@section('content_userMasterNew')
    <main>
        <section class="real-state-page-header">
            <div class="real-estate-page">
                <div class="container">
                    <div class="realstate-header-image">
                        <div class="realstate-header-content">
                            @if(isset($user->shop_header_title))
                                <div class="realstate-header-title">
                                    <p>{{$user->shop_header_title}}</p>
                                </div>
                            @endif
                            <div class="realstate-main-searchBox">
                                <div class="realstate-search-tabs">
                                    <ul>
                                        @if($category)
                                            @foreach($userCategories as $key=>$cat)
                                                <input type="image" src="{{$user->shop_header_image}}"
                                                       @if($key==0) onload="test23({{$cat->id}})" @endif width="0"
                                                       height="0">
                                                <li>
                                                    <button class="tag-btn" id="cat{{$cat->id}}"
                                                            onclick="setChildCats({{$cat->id}})">{{$cat->title}}</button>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="realstate-dark-bg">
                                    <div class="realstate-input-box">

                                        <form class="main-header-search-form" id="attributes_form"
                                              method="post">
                                            @csrf
                                            <div class="inputs">
                                                <input type="text" class="simple-txt" name="search"
                                                       onkeypress="searchFunc(this.val)"
                                                       placeholder="کلمه کلیدی را وارد کنید">
                                                @if($attributeGroups)
                                                    @foreach($attributeGroups as $attrGroup)
                                                        @foreach($attrGroup->attributes->where('isFilterField', 1) as $attr)
                                                            @if($attr->attribute_type == 'select')
                                                                {{--                                                            <input type="image" src="{{$user->shop_header_image}}"--}}
                                                                {{--                                                                   onload="loadImage12({{($attr->id)}})" width="0"--}}
                                                                {{--                                                                   height="0">--}}
                                                                {{--                                                            <img src="{{asset($user->shop_header_image)}}"--}}
                                                                {{--                                                                 onload="loadImage12('{{$attr->placeHolder}}')"--}}
                                                                {{--                                                                 width="0" height="0">--}}
                                                                <div class="form-group">
                                                                    <select class="mul-select attributeTypeSelect"
                                                                            multiple="true"
                                                                            id="attributeTypeSelect{{$attr->id}}"
                                                                            name="attributeTypeSelect[{{$attr->id}}][]"
                                                                    >
                                                                        @foreach($attr->attributeItems as $item)

                                                                            <option
                                                                                value="{{$item->id}}">{{$item->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                {{--                                                        <div class="select-box">--}}
                                                                {{--                                                            <label for="" class="simple-label">محله</label>--}}
                                                                {{--                                                            <select class="js-example-basic-multiple "--}}
                                                                {{--                                                                    name="attributeTypeSelect[{{$attr->id}}][]" multiple="multiple">--}}
                                                                {{--                                                                <option value="" selected>{{$attr->placeHolder}}</option>--}}

                                                                {{--                                                            @foreach($attr->attributeItems as $item)--}}

                                                                {{--                                                                <option value="{{$item->id}}">{{$item->title}}</option>--}}
                                                                {{--                                                                @endforeach--}}
                                                                {{--                                                            </select>--}}
                                                                {{--                                                            <i class="fas fa-chevron-down select-arrow"></i>--}}
                                                                {{--                                                        </div>--}}
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                                {{--                                            <div class="select-box">--}}
                                                {{--                                                <select class="chosen select-box" searchable="Search here..">--}}

                                                {{--                                                    <option value="1">تهران</option>--}}
                                                {{--                                                    <option value="2">شیراز</option>--}}
                                                {{--                                                    <option value="3">مشهد</option>--}}
                                                {{--                                                    <option value="4">اصفهان</option>--}}
                                                {{--                                                    <option value="5">تبریز</option>--}}
                                                {{--                                                    <option value="6">کاشان</option>--}}
                                                {{--                                                    <option value="7">یزد</option>--}}
                                                {{--                                                </select>--}}
                                                {{--                                                <i class="fas fa-chevron-down select-arrow"></i>--}}
                                                {{--                                            </div>--}}

                                            </div>
                                            <button class="search-btn">جستجو</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="realstate-info">
                        <div class="row" style="align-items: self-start;">
                            <div class="col-lg-3" style="z-index: 10;">
                                <div class="realstate-logo-social">
                                    <div class="realstate-logoBox">
                                        <img src="{{asset($user->shop_logo)}}" alt="">
                                    </div>
                                    <div class="realstate-social-medias">

                                        @if(isset($user->shop_description))
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter3">

                                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 656 888" width="24" height="24">
                                                    <title>درباره ما</title>
                                                    <defs>
                                                        <image width="812" height="812" id="img1"
                                                               href="data:image/png;base64,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"/>
                                                        <image width="812" height="812" id="img2"
                                                               href="data:image/png;base64,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"/>
                                                        <image width="587" height="812" id="img3"
                                                               href="data:image/png;base64,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"/>
                                                    </defs>
                                                    <style>
                                                    </style>
                                                    <use id="Layer 1" href="#img1" x="-91" y="1307"/>
                                                    <use id="Layer 2" href="#img2" x="-91" y="2500"/>
                                                    <use id="Layer 3" href="#img3" x="21" y="49"/>
                                                </svg>
                                                {{--                                            <i class="fa fa-info-circle"></i>--}}
                                            </a>
                                        @endif

                                        @foreach($user->socialMedias as $socialMedia)
                                            @if($socialMedia->type=='instagram')
                                                <a href="{{$socialMedia->link}}" target="_blank">
                                                    <i class="fab fa-instagram" title="اینستاگرام"></i>
                                                </a>
                                            @endif
                                            {{--                                            @if($socialMedia->type=='email')--}}
                                            {{--                                                <a href="mailto:{{$socialMedia->link}}" target="_blank">--}}
                                            {{--                                                    <i class="fa fa-envelope"></i>--}}
                                            {{--                                                </a>--}}
                                            {{--                                            @endif--}}
                                            {{--                                            @if($socialMedia->type=='whatsapp')--}}
                                            {{--                                                <a href="{{$socialMedia->link}}" target="_blank">--}}
                                            {{--                                                    <i class="fa fa-whatsapp"></i>--}}
                                            {{--                                                </a>--}}
                                            {{--                                            @endif--}}


                                        @endforeach
                                        @if(isset($user->shop_website))
                                            <a href="{{$user->shop_website}}" target="_blank">


                                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 888 872" width="24" height="41">
                                                    <title>وبسایت</title>
                                                    <defs>
                                                        <image width="812" height="812" id="img1"
                                                               href="data:image/png;base64,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"/>
                                                        <image width="812" height="812" id="img2"
                                                               href="data:image/png;base64,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"/>
                                                        <image width="587" height="812" id="img3"
                                                               href="data:image/png;base64,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"/>
                                                    </defs>
                                                    <style>
                                                    </style>
                                                    <use id="Layer 1" href="#img1" x="37" y="-1157"/>
                                                    <use id="Layer 2" href="#img2" x="37" y="36"/>
                                                    <use id="Layer 3" href="#img3" x="149" y="-2415"/>
                                                </svg>
                                                {{--                                                <i class="fas fa-globe-europe"></i>--}}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="realstate-agency-details">
                                    <div class="realstate-agency-name">
                                        <p>{{$user->shop_title}}</p>
                                        <span>{{$user->slug}}@</span>
                                    </div>
                                    <div class="realstate-address">

                                        <p>{{$user->shop_address}}</p>
                                        <div class="phone-num" style="min-width: 300px;">
                                            <span>{{$user->mobile}}</span>
                                            <span>{{$user->shop_phone}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-lg-none">
                                @if($category)

                                    <div class="responsive-category">
                                        <ul>
                                            @foreach($userCategories as $key=>$cat)
                                                <li>
                                                    <div class="category-icon-circle"
                                                         onclick="setChildCats({{$cat->id}})">
                                                        <i class="fas fa-bahai"></i>
                                                    </div>
                                                    <p>{{$cat->title}}</p>

                                                </li>

                                                {{--                                                <li>--}}
                                                {{--                                                    <button class="tag-btn" id="cat{{$cat->id}}"--}}
                                                {{--                                                            onclick="setChildCats({{$cat->id}})">{{$cat->title}}</button>--}}
                                                {{--                                                </li>--}}
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-2">
                                <div class="realstate-info-buttons">
                                    <div class="Rec-purple-btn">
                                        <span>ارسال آگهی</span>

                                        <a style="cursor: pointer"
                                           data-bs-toggle="modal" data-bs-target="#exampleModalCenter1"></a>
                                        {{--                                        </form>onclick="document.getElementById('createAdForAgency').submit()"--}}
                                    </div>
                                    <div class="Rec-purple-btn">
                                        <span>ارسال درخواست</span>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter2"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section id="s-team" class="realstate-progress-show-section">
            <div class="b-skills realstate-progress-show">
                <div class="container">
                    <div class="row align-items-center justify-content-center" id="childCatChart">
                    </div>
                </div>
            </div>
        </section>
        <section class="realstate-responsive-sec-scroll">
            <div class="container">
                <ul class="sec-scroll-circles">
                    @if($real_estate_agents->count()>0)

                        <li class="circle">
                            <div class="outer-circle">
                                <div class="inner-circle">
                                    <p>تیم ما</p>
                                </div>
                            </div>
                            <a href="#team-members"></a>
                        </li>
                    @endif
                    @if($ads->count()>0)
                        <li class="circle">
                            <div class="outer-circle">
                                <div class="inner-circle">
                                    <p>آگهی ها</p>
                                </div>
                            </div>
                            <a href="#product-box"></a>
                        </li>
                    @endif
                    @if($articles->count()>0)

                        <li class="circle">
                            <div class="outer-circle">
                                <div class="inner-circle">
                                    <p>اطلاعات</p>
                                </div>
                            </div>
                            <a href="#information"></a>
                        </li>
                    @endif
                </ul>
            </div>
        </section>
        <section class="realstates-add-boxes" id="product-box">
            <div class="container">
                <div class="row mt-5">
                    @if($advertisement->count()>0)
                        <div class="ad-slider owl-carousel owl-two owl-theme">
                            @foreach($advertisement as $key=>$ad3)
                                @if($ad3->advertising->advertisingOrder->location=='R1' && ($ad3->user == $user->id))
                                    <div class="item">

                                        <div class="advertisments-place header">
                                            <div class="ad-box short">
                                                <img
                                                    src="{{isset($ad3->responsive_image)?asset($ad3->responsive_image):asset($ad3->image)}}"
                                                    alt="">
                                                <a href="{{$ad3->link}}" target="_blank"></a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="item">
                                        <div class="advertisments-place header">
                                            <div class="ad-box short">
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
                                @if($ad3->advertising->advertisingOrder->location=='R2' && ($ad3->user == $user->id))
                                    <div class="item">

                                        <div class="advertisments-place header">
                                            <div class="ad-box short">
                                                <img
                                                    src="{{isset($ad3->responsive_image)?asset($ad3->responsive_image):asset($ad3->image)}}"
                                                    alt="">
                                                <a href="{{$ad3->link}}" target="_blank"></a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="item">
                                        <div class="advertisments-place header">
                                            <div class="ad-box short">
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
                                @if($ad3->advertising->advertisingOrder->location=='R3' && ($ad3->user == $user->id))
                                    <div class="item">

                                        <div class="advertisments-place header">
                                            <div class="ad-box short">
                                                <img
                                                    src="{{isset($ad3->responsive_image)?asset($ad3->responsive_image):asset($ad3->image)}}"
                                                    alt="">
                                                <a href="{{$ad3->link}}" target="_blank"></a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="item">
                                        <div class="advertisments-place header">
                                            <div class="ad-box short">
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
                                @if($ad3->advertising->advertisingOrder->location=='R4' && ($ad3->user == $user->id))
                                    <div class="item">

                                        <div class="advertisments-place header">
                                            <div class="ad-box short">
                                                <img
                                                    src="{{isset($ad3->responsive_image)?asset($ad3->responsive_image):asset($ad3->image)}}"
                                                    alt="">
                                                <a href="{{$ad3->link}}" target="_blank"></a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="item">
                                        <div class="advertisments-place header">
                                            <div class="ad-box short">
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
                        </div>

                        <div class="col-lg-3">

                            <div class="sidebar-advertisement">
                                <div class="advertisments-place">
                                    @foreach($advertisement as $key=>$ad4)
                                        @if(($ad4->user == $user->id))

                                            @if($ad4->advertising->advertisingOrder->location=='R1')
                                                <div class="ad-box medium"><img src="{{asset($ad4->image)}}"
                                                                                alt="">
                                                    <a href="{{$ad4->link}}" target="_blank"
                                                       style="width: 100%; height: 100%"></a>
                                                </div>
                                            @else
                                                <div class="sidebar-advertisement">
                                                    <div class="advertisments-place">
                                                        <div class="ad-box medium">
                                                            <div class="row">
                                                                <div class="col-1"></div>
                                                                <div class="col-6 py-4">
                                                                    <span
                                                                        style="font-weight: bolder">مکان تبلیغات شما</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                            @if($ad4->advertising->advertisingOrder->location=='R2')
                                                <div class="ad-box medium"><img src="{{asset($ad4->image)}}"
                                                                                alt="">
                                                    <a href="{{$ad4->link}}" target="_blank"
                                                       style="width: 100%; height: 100%"></a>
                                                </div>
                                            @else
                                                <div class="sidebar-advertisement">
                                                    <div class="advertisments-place">
                                                        <div class="ad-box medium">
                                                            <div class="row">
                                                                <div class="col-1"></div>
                                                                <div class="col-6 py-4">
                                                                    <span
                                                                        style="font-weight: bolder">مکان تبلیغات شما</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                            @if($ad4->advertising->advertisingOrder->location=='R3')
                                                <div class="ad-box medium"><img src="{{asset($ad4->image)}}"
                                                                                alt=""
                                                                                style="width: 100%; height: 100%">
                                                    <a href="{{$ad4->link}}" target="_blank"></a>
                                                </div>
                                            @else
                                                <div class="sidebar-advertisement">
                                                    <div class="advertisments-place">
                                                        <div class="ad-box medium">
                                                            <div class="row">
                                                                <div class="col-1"></div>
                                                                <div class="col-6 py-4">
                                                                    <span
                                                                        style="font-weight: bolder">مکان تبلیغات شما</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($ad4->advertising->advertisingOrder->location=='R4')
                                                <div class="ad-box large"><img src="{{asset($ad4->image)}}"
                                                                               alt="" style="width: 100%; height: 100%">
                                                    <a href="{{$ad4->link}}" target="_blank"></a>
                                                </div>
                                            @else
                                                <div class="sidebar-advertisement">
                                                    <div class="advertisments-place">
                                                        <div class="ad-box medium">
                                                            <div class="row">
                                                                <div class="col-1"></div>
                                                                <div class="col-6 py-4">
                                                                    <span
                                                                        style="font-weight: bolder">مکان تبلیغات شما</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="ad-slider owl-carousel owl-two owl-theme">
                            @for($i=0; $i<4; $i++)
                                <div class="item">
                                    <div class="advertisments-place header">
                                        <div class="ad-box short">
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
                        </div>

                        <div class="col-lg-3">

                            <div class="sidebar-advertisement">
                                <div class="advertisments-place">
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
                            <div class="sidebar-advertisement">
                                <div class="advertisments-place">
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
                            <div class="sidebar-advertisement">
                                <div class="advertisments-place">
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
                            <div class="sidebar-advertisement">
                                <div class="advertisments-place">
                                    <div class="ad-box large">
                                        <div class="row">
                                            <div class="col-1"></div>
                                            <div class="col-6 py-4">
                                                <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-9">
                        <div class="row" id="agentAdsFilter">
                            @foreach($ads as $ad)
                                <div
                                    class="col-lg-4 col-sm-6 mb-5 d-flex justify-content-center flex-column align-items-center">
                                    @component('UserMasterNew::components.adCard')
                                        @slot('image')
                                            {{($ad->adImages->first())?$ad->adImages->first()->image:$ad_default_photo}}

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
                                            {{$ad->type=='emergency'?$emergency_label:null}}
                                        @endslot
                                        @slot('real_estate')
                                            {{($ad->user->hasRole('real-state-administrator'))?$ad->user->shop_title:''}}
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
                                            @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first())
                                                {{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->title}}
                                            @endif
                                        @endslot
                                        @slot('second_attr')
                                            @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}
                                            @endif
                                        @endslot
                                        @slot('second_attr_unit')
                                            @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                                {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}
                                            @endif
                                        @endslot
                                        @slot('id')
                                            {{$ad->id}}
                                        @endslot
                                    @endcomponent
                                </div>
                            @endforeach

                        </div>
                        {{--                        <div class="justify-content-center align-content-center d-flex" id="linksOfAds">--}}
                        {{--                            @if($ads->count()>0)--}}
                        {{--                                {{$ads->links()}}--}}
                        {{--                            @endif--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                    </div>
                </div>
            </div>
        </section>
        @if($real_estate_agents->count()>0)

            <section class="team-members">
                <div class="container-fluid d-flex align-items-center">

                    <div class="members-title">
                        <div class="title-txt">
                            <h5>اعضای اصلی تیم ما</h5>
                        </div>
                        <div class="triangle-left">
                            <span class="top"></span>
                            <span class="bottom"></span>
                        </div>
                    </div>
                    <div class="owl-carousel owl-three owl-theme">
                        @foreach($real_estate_agents as $user2)

                            <div class="item ">
                                <div class="team-member-person">
                                    <div class="image-box">
                                        @if(isset($user2->userImage))
                                            <img src="{{asset($user2->userImage)}}" alt="">

                                        @else
                                            <img src="{{asset($user_default_photo)}}" alt="">
                                        @endif
                                    </div>
                                    <div class="member-name">
                                        <p>{{$user2->name}} {{$user2->sirName}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>


            </section>
            <section class="team-members responsive" id="team-members">
                <div class="container">
                    <div class="row">
                        <div class="members-title">

                            <h4><strong>اعضای اصلی تیم ما</strong></h4>
                        </div>
                        @foreach($real_estate_agents as $user3)

                            <div class="col-md-4 col-6 mb-5">
                                <div class="team-member-person">
                                    <div class="image-box">
                                        @if(isset($user3->userImage))
                                            <img src="{{asset($user3->userImage)}}" alt="">

                                        @else
                                            <img src="{{asset($user_default_photo)}}" alt="">
                                        @endif
                                    </div>
                                    <div class="member-name">
                                        <p>{{$user3->name}} {{$user3->sirName}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        {{--        <div class=" d-flex d-lg-none">--}}
        {{--            <div class="ad-slider owl-carousel owl-two owl-theme d-flex d-lg-none">--}}
        {{--                @foreach($advertisement as $key=>$ad)--}}
        {{--                    @if($ad->startDate <= \Hekmatinasser\Verta\Verta::now()->startMonth()--}}
        {{--                                                        && $ad->endDate <= \Hekmatinasser\Verta\Verta::now()->endMonth() && ($ad->user == $user->id))--}}
        {{--                        <div class="item">--}}

        {{--                            <div class="advertisments-place header">--}}
        {{--                                <div class="ad-box short">--}}
        {{--                                    <img src="{{asset($ad->image)}}" alt="">--}}
        {{--                                    <a href="{{$ad->link}}" target="_blank"></a>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    @endif--}}
        {{--                @endforeach--}}
        {{--            </div>--}}
        {{--        </div>--}}
        @if($articles->count()>0)
            <section class="news-show" id="information">
                <div class="container">
                    <div class="row">
                        @if($articles->first())
                            <div class="col-lg-7 mb-3">
                                <a href="{{route('articles.show.user', $articles->first()->slug)}}">
                                    <div class="news-box large">
                                        <img src="{{asset($articles->first()->image)}}" alt="">

                                        <div class="overlay">
                                            <div class="news-title">
                                                <h5>{{$articles->first()->title}}</h5>
                                            </div>
                                            <div class="news-detail">
                                                <p class="author-name">{{$articles->first()->user->name}} {{$articles->first()->user->sirName}}</p>
                                                <span class="space-dot"></span>
                                                <span
                                                    class="news-date">{{verta($articles->first()->created_at)->format('%d %B %Y')}}</span>
                                            </div>
                                        </div>
                                        <div class="top-news-label">
                                            <span>{{$articles->first()->group->title}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($articles->count()>1)
                            <div class="col-lg-5 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{route('articles.show.user', $articles->skip(1)->first()->slug)}}">

                                            <div class="news-box medium">
                                                <img src="{{asset($articles->skip(1)->first()->image)}}" alt="">
                                                <div class="overlay">
                                                    <div class="news-title">
                                                        <h5>{{$articles->skip(1)->first()->title}}</h5>
                                                    </div>
                                                    <div class="news-detail">
                                                        <p class="author-name">{{$articles->skip(1)->first()->user->name}} {{$articles->skip(1)->first()->user->sirName}}</p>
                                                        <span class="space-dot"></span>
                                                        <span
                                                            class="news-date">{{verta($articles->skip(1)->first()->created_at)->format('%d %B %Y')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @if($articles->count()>2)

                                        <div class="col-sm-6 mb-sm-0 mb-3">
                                            <a href="{{route('articles.show.user', $articles->skip(2)->first()->slug)}}">

                                                <div class="news-box small">
                                                    <img src="{{asset($articles->skip(2)->first()->image)}}" alt="">
                                                    <div class="overlay">
                                                        <div class="news-title">
                                                            <h5>{{$articles->skip(2)->first()->title}}</h5>
                                                        </div>
                                                        <div class="news-detail">
                                                            <p class="author-name">{{$articles->skip(2)->first()->user->name}} {{$articles->skip(2)->first()->user->sirName}}</p>
                                                            <span class="space-dot"></span>
                                                            <span
                                                                class="news-date">{{verta($articles->skip(2)->first()->created_at)->format('%d %B %Y')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    @if($articles->count()>3)

                                        <div class="col-sm-6 mb-sm-0 mb-3">
                                            <a href="{{route('articles.show.user', $articles->skip(3)->first()->slug)}}">

                                                <div class="news-box small">
                                                    <img src="{{asset($articles->skip(3)->first()->image)}}" alt="">
                                                    <div class="overlay">
                                                        <div class="news-title">
                                                            <h5>{{$articles->skip(3)->first()->title}}</h5>
                                                        </div>
                                                        <div class="news-detail">
                                                            <p class="author-name">{{$articles->skip(3)->first()->user->name}} {{$articles->skip(3)->first()->user->sirName}}</p>
                                                            <span class="space-dot"></span>
                                                            <span
                                                                class="news-date">{{verta($articles->skip(3)->first()->created_at)->format('%d %B %Y')}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="top-news-label">
                                                        <span>{{$articles->skip(3)->first()->group->title}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            @if($articles->skip(4)->count()>0)

                <section class="articles-show">
                    <div class="container">
                        <div class="row ">
                            <div class="articleShowBox">
                                <div class="row mt-4">
                                    @foreach($articles->skip(4) as $article)
                                        <div class="col-xl-3 col-lg-4 col-md-6 px-sm-3 mb-4">
                                            <div class="articleIntBox">
                                                <div class="imageBox">
                                                    <img src="{{asset($article->image)}}" alt="">
                                                </div>
                                                <div class="articleInfo">
                                                    <div class="articleTitle">
                                                        <h5>
                                                            {{$article->title}}
                                                        </h5>
                                                    </div>
                                                    <div class="articleText">
                                                        <p>{{$article->shortDescription}}</p>
                                                    </div>
                                                    <div class="readMore">
                                                        <a href="{{route('articles.show.user', $article->slug)}}"
                                                           target="_blank">بیشتر بخوانید</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            @endif
        @endif
        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        آگهی شما برای {{$user->shop_title}} ارسال می شود تا درصورت تایید در همین صفحه نمایش داده شود،
                        آیا ادامه می دهید؟
                    </div>
                    <div class="modal-footer">
                        @if($category)
                            <form action="{{route('ad.find.cats.level2.user', 'supplier')}}" method="get"
                                  id="createAdForAgency">
                                <input hidden name="agency_id"
                                       value="{{$user->id}}">
                                <input hidden name="categoryId"
                                       value="{{$category->id}}">
                                <button type="submit" class="btn btn-primary">مرحله بعد</button>
                            </form>
                        @else
                            <form action="{{route('ad.find.cats.user', 'supplier')}}" method="get"
                                  id="createAdForAgency">
                                <input hidden name="agency_id"
                                       value="{{$user->id}}">
                                <button type="submit" class="btn btn-primary">مرحله بعد</button>
                            </form>
                        @endif
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        درخواست شما برای {{$user->shop_title}} ارسال می شود و بقیه ی کسب و کار ها به درخواست شما دسترسی
                        نخواهند داشت، آیا ادامه می دهید؟
                    </div>
                    <div class="modal-footer">
                        @if($category)
                            <form action="{{route('application.find.cats.level2.user', 'supplier')}}" method="get"
                                  id="createAdForAgency">
                                <input hidden name="agency_id"
                                       value="{{$user->id}}">
                                <input hidden name="categoryId"
                                       value="{{$category->id}}">
                                <button type="submit" class="btn btn-primary">مرحله بعد</button>
                            </form>
                        @else
                            <form action="{{route('application.find.cats.user', 'supplier')}}" method="get"
                                  id="createAdForAgency">
                                <input hidden name="agency_id"
                                       value="{{$user->id}}">
                                <button type="submit" class="btn btn-primary">مرحله بعد</button>
                            </form>
                        @endif
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #ddb24f">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff">درباره ما</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: #fff">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{$user->shop_description}}
                    </div>
                    <div class="modal-footer">
                        {{--                        @if($category)--}}
                        {{--                            <form action="{{route('ad.find.cats.level2.user', 'supplier')}}" method="get"--}}
                        {{--                                  id="createAdForAgency">--}}
                        {{--                                <input hidden name="agency_id"--}}
                        {{--                                       value="{{$user->id}}">--}}
                        {{--                                <input hidden name="categoryId"--}}
                        {{--                                       value="{{$category->id}}">--}}
                        {{--                                <button type="submit" class="btn btn-primary">مرحله بعد</button>--}}
                        {{--                            </form>--}}
                        {{--                        @else--}}
                        {{--                            <form action="{{route('ad.find.cats.user', 'supplier')}}" method="get"--}}
                        {{--                                  id="createAdForAgency">--}}
                        {{--                                <input hidden name="agency_id"--}}
                        {{--                                       value="{{$user->id}}">--}}
                        {{--                                <button type="submit" class="btn btn-primary">مرحله بعد</button>--}}
                        {{--                            </form>--}}
                        {{--                        @endif--}}
                        {{--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js_user')

    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"--}}
    {{--            integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ=="--}}
    {{--            crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"--}}
    {{--            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"--}}
    {{--            crossorigin="anonymous"></script>--}}
    {{--    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>--}}
    {{--    <script>--}}
    {{--        function loadImage12(placeH) {--}}
    {{--            console.log(placeH);--}}
    {{--            // $('#attributeTypeSelect' + id).select2({--}}
    {{--            //     placeholder: placeH,--}}
    {{--            //     tags: true,--}}
    {{--            //--}}
    {{--            //     tokenSeparators: ['/', ',',]--}}
    {{--            // })--}}
    {{--        }--}}
    {{--    </script>--}}

    <script>
        $(document).ready(function () {
            $(".mul-select").select2({
                placeholder: "انتخاب کنید",
                tags: true,

                tokenSeparators: ['/', ',',]
            })
        })
    </script>


    <script type="text/javascript">
        $(".chosen").chosen();
    </script>

    @if($category)
        <script>
            function test23(id) {
                $('.tag-btn').removeClass('active');
                $('#cat' + id).addClass('active');
                jQuery.ajax({
                    url: "{{route('realEstate.cats.charts')}}",
                    data: {
                        'cat_id': id,
                        'parent_cat': '{{$category->id}}',
                        'agency_id': '{{$user->id}}'
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.content == 'empty') {
                            $('#childCatChart').empty();

                        } else {
                            $('#childCatChart').empty();
                            $('#childCatChart').append(data.content);
                            run(_chart);
                        }
                    }
                });
            }
        </script>
    @endif

    <script>
        $(document).ready(function () {
            $('#attributes_form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('filter.agency.ads.user', $user->slug)}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#agentAdsFilter').empty();
                        $('#agentAdsFilter').append(data.content);
                    }
                })
            });
        });
    </script>
    <script>
        $('.attributeTypeSelect').change(function (e) {
            $("#attributes_form").submit();
        });

        function searchFunc(val) {
            $("#attributes_form").submit();

        }
    </script>
    @if($category)
        <script>
            function setChildCats(id) {
                $('.tag-btn').removeClass('active');
                $('#cat' + id).addClass('active');
                jQuery.ajax({
                    url: "{{route('realEstate.cats.charts')}}",
                    data: {
                        'cat_id': id,
                        'parent_cat': '{{$category->id}}',
                        'agency_id': '{{$user->id}}'
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.content == 'empty') {
                            $('#childCatChart').empty();

                        } else {
                            $('#childCatChart').empty();
                            $('#childCatChart').append(data.content);
                            run(_chart);
                        }
                    }
                });
            }
        </script>
    @endif
    <script src="{{asset('files/userMaster/assets/js/jquery.appear.min.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/jquery.easypiechart.min.js')}}"></script>
    <script>
        'use strict';
        var $window = $(window);

        function run() {
            var fName = arguments[0],
                aArgs = Array.prototype.slice.call(arguments, 1);
            try {
                fName.apply(window, aArgs);
            } catch (err) {
            }
        }

        /* chart
        ================================================== */
        function _chart() {
            $('.b-skills').appear(function () {
                setTimeout(function () {
                    $('.chart').easyPieChart({
                        easing: 'easeOutElastic',
                        delay: 3000,
                        barColor: '#369670',
                        trackColor: '#fff',
                        scaleColor: false,
                        lineWidth: 21,
                        trackWidth: 21,
                        size: 250,
                        lineCap: 'round',
                        onStep: function (from, to, percent) {
                            this.el.children[0].innerHTML = Math.round(percent);
                        }
                    });
                }, 150);
            });
        }
    </script>

    <script src="{{asset('files/userMaster/assets/js/owl.carousel.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".owl-three").owlCarousel({
                rtl: true,
                items: 3,
                nav: true,
                autoplay: true,
                loop: true,
                autoplaySpeed: 2000,
                autoplayHoverPause: true,
                autoplayTimeout: 3000,
                dots: false,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                        loop: true,
                    },

                    480: {
                        items: 2.5,
                        nav: false,
                        loop: true,

                    },
                    550: {
                        items: 3,
                        nav: false,
                        loop: true,

                    },
                    768: {
                        items: 4,
                        nav: false,
                        loop: true,

                    },

                    990: {
                        items: 5,
                        nav: false,
                        loop: true,

                    },
                    1200: {
                        items: 6,
                        nav: false,
                        loop: true,

                    },

                    1380: {
                        items: 7,
                        nav: false,
                        loop: true
                    },


                    1420: {
                        items: 8,
                        nav: false,
                        loop: true
                    },

                }

            });
        })
    </script>
    <script>
        $('.owl-two').owlCarousel({
            rtl: true,
            items: 3,
            nav: true,
            autoplay: true,
            loop: true,
            autoplaySpeed: 2000,
            autoplayHoverPause: true,
            autoplayTimeout: 3000,
            dots: false,
            margin: 10,
            responsive: {
                0: {
                    items: 1,
                },
                400: {
                    items: 1.5,

                },
                600: {
                    items: 2,
                    autoplayHoverPause: true,

                },
                1000: {
                    items: 1,
                }
            }
        })
    </script>
    <script src="{{asset('files/userMaster/assets/js/select2.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/script.js')}}"></script>

@endsection

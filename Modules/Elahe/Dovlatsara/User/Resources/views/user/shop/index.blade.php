@extends('UserMasterNew::master')
@section('title_user')کسب و کار ها
@endsection
@section('css_user')
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.carousel.min.css')}}" />--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.theme.default.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/contractor.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/store.css')}}">
    {{--    <link rel="stylesheet" href="./assets/css/slick.css">--}}
    {{--    <link rel="stylesheet" href="./assets/css/slick-theme.css">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.carousel2.min.css')}}"/>


@endsection
@section('content_userMasterNew')

    <div class="container">

        <div class="ad-slider owl-carousel2 owl-theme slider d-flex d-lg-none">
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
            @endif
            @if($advertisement->count()<=0)
                @for($i=0; $i<2; $i++)
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
    </div>
    <div class="best-contractor-slider">
        <div class="container">
            <div class="shadeBox">
                <div class="fraworkBg">
                    <div class="best-contractor-slider-title">
                        <h4>
                            کسب و کار ها
                        </h4>
                    </div>
                    <div class="best-contractore-slider-show">
                        <div class="quick-sale-product  owl-carousel d-flex ">
                            @foreach($shops as $shop)
                                <div class="store col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-4">
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
                                            {{isset($shop->shop_neighborhood_id)?$shop->neighborhood->title:''}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="advertisments-place d-flex d-none d-lg-block">
        <div class="container mt-5">
            <div class="row">
                @foreach($advertisement as $ad)
                    @if($ad->advertising->advertisingOrder->location=='R1')
                        <div class="col-6">
                            <div class="ad-box medium">
                                <a href="{{$ad->link}}" target="_blank"><img src="{{asset($ad->image)}}"></a>
                            </div>
                        </div>
                    @else
                        <div class="col-6">
                            <div class="ad-box medium">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-6 py-4">
                                        <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($ad->advertising->advertisingOrder->location=='L1')
                        <div class="col-6">
                            <div class="ad-box medium">
                                <a href="{{$ad->link}}" target="_blank"><img src="{{asset($ad->image)}}"></a>
                            </div>
                        </div>
                    @else
                        <div class="col-6">
                            <div class="ad-box medium">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-6 py-4">
                                        <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                @endforeach
                @if($advertisement->count()<=0)
                    @for($i=0; $i<2; $i++)
                        <div class="col-6">
                            <div class="ad-box medium">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-6 py-4">
                                        <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
    <div class="all-store">
        <div class="container">
            <div class="shadeBox">
                <!-- <div class="polyganBg"> -->
                <div class="all-contractor-header">
                    <form class="form-horizontal" id="shopFilter_form" method="post">
                        @csrf
                        <div class="all-contractor-header-right">
                            <div class="contractor-search-input">
                                {{--                            <form action="{{route('realEstate.index.search.user')}}" id="searchInShop" method="post"  onkeypress="searchFunc(this.val)">--}}
                                {{--                                @csrf--}}
                                <input type="search" placeholder="جستجو" name="search"
                                       onkeypress="searchFunc(this.val)">
                                <div class="contractor-search-input-btn">
                                    <a><i
                                            class="fa fa-search-plus"></i></a>
                                </div>
                                {{--                            </form>--}}

                            </div>
                            <div class="contractor-search-checkbox">

                            </div>
                            <div class="contractor-delete-filter mt-1">
                                <a href="{{route('realEstate.index.user')}}">پاک کردن فیلترها</a>
                            </div>
                        </div>
                        <div class="all-contractor-header-left  ">
                            <div class="contractor-filter-category">
                                <p class="pb-1"> شهر</p>
                                <select class="city" name="city">
                                    <option value=""></option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}"
                                                @if($city->id==old('city')) selected @endif>{{$city->title}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="contractor-filter-arange ">
                                <p class="pb-1">محله</p>
                                <select class="js-example-basic-multiple neighborhood"
                                        style="height: 26px; width: 150px"
                                        name="neighborhood[]" multiple="multiple">

                                </select>
                            </div>


                        </div>
                    </form>

                </div>
                <div class="all-contractor-header-tag" id="shopFilterTag">

                </div>
                <div class="polyganBg" style="height: auto">
                    <div class="all-store-show">
                        <div class="row" id="shopFilterPage">
                            @foreach($shops as $shop)

                                <div class="store col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-4">
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

                            <div class="justify-content-center align-content-center d-flex mt-5">
                                {{--                                @if($shops->count()>0)--}}
                                {{--                                    {{$shops->links()}}--}}
                                {{--                                @endif--}}
                            </div>
                        </div>
                    </div>

                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
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

    @include('UserMasterNew::layouts.getNeighborhoodMulti')
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
                        $('#shopFilterPage').empty();
                        $('#shopFilterPage').append(data.content);
                        $('#shopFilterTag').empty();
                        $('#shopFilterTag').append(data.tags);
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

        function searchFunc(val) {
            $("#shopFilter_form").submit();

        }

        // })
    </script>
@endsection

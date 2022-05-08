@extends('UserMasterNew::master')
@section('title_user')پیمانکاران
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/contractor.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/store.css')}}">

    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/store.css')}}">--}}
    {{--    <link rel="stylesheet" href="./assets/css/slick.css">--}}
    {{--    <link rel="stylesheet" href="./assets/css/slick-theme.css">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.carousel2.min.css')}}" />
{{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/owl.theme.default2.min.css')}}" />--}}

@endsection
@section('content_userMasterNew')
    <div class="container">

        <div class="ad-slider owl-carousel2 owl-theme slider d-flex d-lg-none">
            @foreach($advertisement as $key=>$ad)
                @if($ad->startDate <= \Hekmatinasser\Verta\Verta::now()->startMonth() && $ad->endDate <= \Hekmatinasser\Verta\Verta::now()->endMonth() && $ad->endDate > \Hekmatinasser\Verta\Verta::now()->startMonth())
                    <div class="item">
                        <div class="advertisments-place header">
                            <div class="ad-box medium">
                                <img src="{{asset($ad->image)}}" alt="">
                                <a href="{{$ad->link}}" target="_blank"></a>
                            </div>
                        </div>
                    </div>
                @endif
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

        </div>
    </div>
    @if($contractors->count()>0)
        <div class="best-contractor-slider">
            <div class="container">
                <div class="shadeBox">
                    <div class="fraworkBg">
                        <div class="best-contractor-slider-title">
                            <h4>
                                برترین پیمانکاران
                            </h4>
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
                                            {{--                                    @slot('logo')--}}
                                            {{--                                        {{isset($shop->shop_logo)?$shop->shop_logo:$shop_default_logo}}--}}


                                            {{--                                    @endslot--}}
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
                    </div>

                </div>

            </div>
        </div>
    @endif

    <!-- end of contractor link box -->
    <div class="advertisments-place d-flex d-none d-lg-block">
        <div class="container mt-5">
            <div class="row">
                @foreach($advertisement as $key=>$ad)
                    @if($ad->startDate <= \Hekmatinasser\Verta\Verta::now()->startMonth() && $ad->endDate <= \Hekmatinasser\Verta\Verta::now()->endMonth())
                        @if($ad->advertising->advertisingOrder->location=='R1')
                            <div class="col-6">
                                <div class="ad-box medium">
                                    <a href="{{$ad->link}}" target="_blank"><img src="{{asset($ad->image)}}"></a>
                                </div>
                            </div>
                        @elseif($ad->advertising->advertisingOrder->location!='R1')
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
{{--                            @else--}}
{{--                            <div class="col-6"></div>--}}
                        @endif
                            @if($ad->advertising->advertisingOrder->location=='L1')
                            <div class="col-6">
                                <div class="ad-box medium">
                                    <a href="{{$ad->link}}" target="_blank"><img src="{{asset($ad->image)}}"></a>
                                </div>
                            </div>
                            @elseif($ad->advertising->advertisingOrder->location!='L1')
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
{{--                            @else--}}
{{--                                <div class="col-6"></div>--}}
                        @endif
                    @endif
                @endforeach
                    @if($advertisement->count()<=0)
                        <div class="row">
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
                        </div>
                    @endif

                    {{--                <div class="col-6">--}}
                {{--                    <div class="ad-box medium"></div>--}}
                {{--                </div>--}}

            </div>
        </div>
    </div>

    <div class="all-contractor">

        <div class="container">
            <div class="shadeBox">
                <div class="all-contractor-header">
                    <form class="form-horizontal" id="shopFilter_form" method="post">
                        @csrf
                        <div class="all-contractor-header-right">
                            <div class="contractor-search-input">

                                {{--                            <form action="{{route('contractors.index.search.user')}}" id="searchInContractr" method="post">--}}
                                {{--                                @csrf--}}
                                <input type="search" placeholder="جستجو" name="search"
                                       onkeypress="searchFunc(this.val)">
                                <div class="contractor-search-input-btn">
                                    <a>
                                        <i class="fa fa-search-plus"></i>
                                    </a>
                                </div>
                                {{--                            </form>--}}
                                {{--                            <input type="search" placeholder="جستجو">--}}
                                {{--                            <div class="contractor-search-input-btn">--}}
                                {{--                                <a href=""><i class="fas fa-search-plus"></i></a>--}}
                                {{--                            </div>--}}
                            </div>
                            <div class="contractor-search-checkbox">

                            </div>
                            <div class="contractor-delete-filter mt-1">
                                <a href="{{route('contractors.index.user')}}">پاک کردن فیلترها</a>
                            </div>
                        </div>

                        <div class="all-contractor-header-left">
                            <div class="contractor-filter-category">
                                <p class="pb-1">دسته </p>
                                <select class="associationLevel1" name="associationLevel1">
                                    <option value=""></option>
                                    @foreach($associationLevel1 as $association)
                                        <option value="{{$association->id}}"
                                                @if($association->id==old('associationLevel1')) selected @endif>{{$association->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="contractor-filter-arange ">
                                <p class="pb-1">زیر دسته</p>
                                <select class="js-example-basic-multiple associationlevel2"
                                        style="height: 26px; width: 150px" name="associationlevel2[]"
                                        multiple="multiple">

                                </select>
                            </div>
                            <div class="contractor-filter-arange ">
                                <p class="pb-1">مهارت</p>
                                <select class="js-example-basic-multiple skill" style="height: 26px; width: 150px"
                                        name="skill[]" multiple="multiple">

                                </select>
                            </div>
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
                            {{--                        <div class="contractor-filter-arange ">--}}
                            {{--                            <p class="pb-1">محله</p>--}}
                            {{--                            <select class="js-example-basic-multiple neighborhood" style="width: 230px; " name="neighborhood[]" multiple="multiple">--}}

                            {{--                            </select>--}}
                            {{--                        </div>--}}
                        </div>
                    </form>
                </div>
                <div class="all-contractor-header-tag" id="shopFilterTag">
                    {{--                    <span class="badge bg-primary">Primary</span>--}}
                    {{--                    <span class="badge bg-primary">Primary</span>--}}
                    {{--                    <span class="badge bg-primary">Primary</span>--}}
                    {{--                    <span class="badge bg-primary">Primary</span>--}}
                    {{--                    <span class="badge bg-primary">Primary</span>--}}
                    {{--                    <span class="badge bg-primary">Primary</span>--}}


                </div>
                <div class="polyganBg" style="height: auto">
                    <div class="all-contractor-show">
                        <div class="row" id="shopFilterPage">
                            @foreach($contractors as $contractor)

                                <div class="item col-xl-3 col-lg-4 col-md-6 col-sm-12">
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
                        <div class="justify-content-center align-content-center d-flex">
{{--                            @if($contractors->count()>0)--}}
{{--                                {{$contractors->links()}}--}}
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
@section('js_user')
    <script>
        $('.owl-carousel2').owlCarousel({
            rtl: true,
            loop: false,
            margin: 10,
            nav: false,
            dots: false,
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
                1000: {
                    items: 1,


                }
            }
        })
    </script>

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

    <script src="{{asset('files/userMaster/assets/js/select2.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>
    @include('UserMasterNew::layouts.getNeighborhoodMulti')

    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="associationLevel1"]').on('change', function () {
                var associationId = jQuery(this).val();
                if (associationId) {
                    jQuery.ajax({
                        url: "{{route('gettingAssociation')}}",
                        data: {
                            'association': associationId
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="associationlevel2[]"]').empty();
                            $('select[name="skill[]"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="associationlevel2[]"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="associationlevel2[]"]').empty();
                }
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="associationlevel2[]"]').on('change', function () {
                var associationId2 = jQuery(this).val();
                if (associationId2) {
                    console.log(associationId2)
                    jQuery.ajax({
                        url: "{{route('gettingSkills')}}",
                        data: {
                            'association2': associationId2
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="skill[]"]').empty();
                            $('select[name="skill[]"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="skill[]"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="skill[]"]').empty();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#shopFilter_form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('contractors.index.filter.user')}}",
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
        $('.associationLevel1').change(function (e) {
            $("#shopFilter_form").submit();

        });
        $('.associationlevel2').change(function (e) {
            $("#shopFilter_form").submit();

        });
        $('.skill').change(function (e) {
            $("#shopFilter_form").submit();

        });

        function searchFunc(val) {
            $("#shopFilter_form").submit();

        }

        // })
    </script>
@endsection

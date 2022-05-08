@extends('UserMasterNew::master')
@section('title_user') {{$user->shop_title}}
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/store.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/amalkiSingle.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">

@endsection
@section('content_userMasterNew')
    <header>
        <div class="singlePageTopHeader">
            <div class="container">
                <div class="row header">
                    <div class="col-md-3">
                        <div class="topSingleAmlakInfo">
                            <div class="PicblankSpace"></div>
                            <div class="singleAmlakiPic">
                                @if(isset($user->shop_logo))

                                <img src="{{asset($user->shop_logo)}}" alt="">

                                    @endif
                            </div>
{{--                            <div class="singleAmlakRating">--}}
{{--                                <img src="./assets/img/star (1).svg" alt="">--}}
{{--                                <img src="./assets/img/star.svg" alt="">--}}
{{--                                <img src="./assets/img/star.svg" alt="">--}}
{{--                                <img src="./assets/img/star.svg" alt="">--}}
{{--                                <img src="./assets/img/star.svg" alt="">--}}
{{--                            </div>--}}
                            <div class="singleAmlakName">
                                <p>{{$user->shop_title}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="blankSpace"></div>
                        <ul class="tags-menu">
                            <li><a>کسب و کار<i class="fa fa-angle-left"></i></a></li>
                            <li><a>{{$user->city->title}}<i class="fa fa-angle-left"></i></a></li>

                                    @if(isset($user->shop_neighborhood_id))
                                <li><a>
                                        {{$user->neighborhood->title}}
                                        <i class="fa fa-angle-left"></i></a>
                                        @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="singleAmlakiInfo">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 my-5 px-3">
                        <div class="DetailInfoBox ">
                            <ul class="DetailInfo-title">
                                <li>
                                    <p class="title">مدیر:</p>
                                    <p class="data">{{$user->name}} {{$user->sirName}}</p>
                                </li>
                                <li>
                                    <p class="title">منطقه فعالیت:</p>
                                    <p class="data">{{$user->city->title}}</p>
                                </li>
                                <li>
                                    <p class="title">تلفن:</p>
                                    <p class="data">{{$user->shop_phone}}</p>
                                </li>
                                <li>
                                    <p class="title">نشانی:</p>
                                    <p class="data">{{$user->shop_address}} </p>
                                </li>
                            </ul>

                        </div>
{{--                        <div class="DetailInfoBox d-flex justify-content-between">--}}
{{--                            <ul class="DetailInfo-title">--}}
{{--                                <li>مدیر :</li>--}}
{{--                                <li>منطقه فعالیت :</li>--}}
{{--                                <li>نشانی :</li>--}}
{{--                                <li>تلفن :</li>--}}
{{--                            </ul>--}}
{{--                            <ul class="DetailInfo-info">--}}
{{--                                <li>{{$user->name}} {{$user->sirName}}</li>--}}
{{--                                <li>{{$user->city->title}}</li>--}}
{{--                                <li>{{$user->shop_address}}</li>--}}
{{--                                <li>{{$user->shop_phone}}</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                        <div class="DetailInfoBox explain">
                            @if(isset($user->shop_website))
                            <div class="email">
                                <a href="#">{{$user->shop_website}}</a>
                            </div>
                            @endif
                            <div class="moreExplanation">
                                <div class="title">
                                    <p>درباره ما:</p>
                                    {{$user->shop_description}}
                                </div>

                            </div>
                        </div>
                        <div class="DetailInfoBox activeExperts">
                            <div class="activeExpertsBox">
                                <div class="title">
                                    <p>کارشناسان فعال در بنگاه :</p>
                                </div>
                                <div class="exportslist">
                                    @foreach($real_estate_agents as $user)
                                        <div class="expertBox d-flex align-items-center">
                                            <div class="imageBox">
                                                @if(isset($user->userImage))
                                                    <img src="{{asset($user->userImage)}}" alt="">

                                                @else
                                                <img src="{{asset($user_default_photo)}}" alt="">
                                                    @endif
                                            </div>
                                            <div class="expertName">
                                                <span>{{$user->name}} {{$user->sirName}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 my-5">
                        <div class="row">


                            <div class="row">
                                @foreach($ads as $ad)

                                    <div class="col-xl-4 col-sm-6 mb-5 d-flex justify-content-center flex-column align-items-center">
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
                                                    {{($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}
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




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js_user')
@endsection

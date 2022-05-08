@extends('RealestateMaster::master')
@section('title_realestate')کسب و کاری من
@endsection
@section('content_realestateMaster')
    <div class="col-lg-9 col-md-8 col-xs-12 pull-right">
        <div class="col-lg-12 col-xs-12 pull-right">
            <div class="headline-profile">

                <span>کسب و کاری من</span>
                <img src="{{asset($shop->logo)}}" alt="logo">
            </div>
            <div class="profile-stats">
                <div class="profile-stats-row">
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span> نام فروشگاه :</span>{{$shop->title}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-left" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span> صنف :</span>{{$shop->union->title}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span> شهر و محله :</span>{{$shop->city->title}} @if(isset($shop->neighborhood_id)) - {{$shop->neighborhood->title}} @endif</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-left" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span>تلفن :</span>{{$shop->phone}}</p>
                        </div>
                    </div>
{{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
{{--                        <div class="profile-stats-col">--}}
{{--                            <p><span>لوگو :</span>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span>وضعیت :</span>
                                @if($shop->active=='confirm')
                                    <span style="color: #00B74A">تایید</span>
                                @elseif($shop->active=='disConfirm')
                                    <span style="color: #F93154">عدم تایید</span>
                                @elseif($shop->active=='diActivation')
                                    غیرفعال
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-left" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span>تاریخ شروع فعالیت :</span>{{$shop->yearOfOperation}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span>slug :</span>{{$shop->slug}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-left" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span>وبسایت :</span>{{$shop->website}}</p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 pull-right" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span>توضیحات :</span>{{$shop->description}}</p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 pull-right" style="padding:0;">
                        <div class="profile-stats-col">
                            <p><span>آدرس :</span>{{$shop->address}}</p>
                        </div>
                    </div>
{{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
{{--                        <div class="profile-stats-col">--}}
{{--                            <p><span>شماره تلفن آگهی :</span>{{$user->phoneNumberForAds}}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
{{--                        <div class="profile-stats-col">--}}
{{--                            <p><span>تاریخ تولد :</span>{{$user->birthDate}}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
{{--                        <div class="profile-stats-col">--}}
{{--                            <p><span>slug :</span>{{$user->slug}}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="profile-stats-action">
                        <a href="" class="link-spoiler-edit"><i class="fa fa-pencil"></i>ویرایش کسب و کاری من</a>
                    </div>
                </div>
            </div>
        </div>

        </div>


@endsection
@section('js_realestate')
@endsection

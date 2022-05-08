@extends('UserMasterNew::master')
@section('title_user')کسب و کار ها
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/membershipshow.css')}}">

@endsection
@section('content_userMasterNew')
    <main>
        <section class="OpportunitiesPacakges">
            <div class="container">
                <div class="row">
                    <div class="col-12 my-5">
                        <div class="title">
                            <h1><strong>خرید حق اشتراک</strong></h1>
{{--                            <p>با انتخاب هر یک از بسته های زیر می توانید تعداد خاصی از تبلیغات را در قسمت فرصت های برتر نشان دهید تا افراد بیشتری آنها را ببینند و درخواست کنند.</p>--}}
                        </div>
                    </div>
                    <div class="col-12 my-5 px-5">
                        <div class="row px-xl-5 px-md-1 px-xs-5">
                            @foreach($memberships as $membership)
                            <div class="col-lg-4 col-md-6 px-lg-4 px-md-1 px-xs-5 mb-5 mt-4">
                                <div class="packageBox">
                                    <div class="imageBox">
                                        <img src="{{asset('files/userMaster/assets/img/package.png')}}" alt="">
                                    </div>
                                    <div class="packagesTitle">
                                        <h5><strong>{{$membership->title}}</strong></h5>
                                    </div>
                                    <div class="packageDetail">
                                        <ul class="titles">
                                            <li>میزان امتیاز :</li>
                                            <li>مدت اعتبار حق اشتراک :</li>
                                            <li>قیمت بسته :</li>
                                        </ul>
                                        <ul class="detailInfos">
                                            <li><span>{{$membership->score}}</span></li>
                                            <li><span>{{$membership->duration}} روز</span></li>
                                            <li><span>{{number_format(substr($membership->price, 0, -1))}} تومان</span></li>
                                        </ul>
                                    </div>
                                    @if(isset($membership->description))
                                    <hr style="margin: 0;margin-bottom: 20px">
                                    <div class="packageDetail" style="color: #414141; font-weight: 500">
                                        {{$membership->description}}
                                    </div>
                                    @endif
                                    <div class="buyingBtn">
                                        <a href="{{route('membership.buy.user', $membership->id)}}" class="RecBtn potato-bg">خرید بسته</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
@section('js_user')
@endsection

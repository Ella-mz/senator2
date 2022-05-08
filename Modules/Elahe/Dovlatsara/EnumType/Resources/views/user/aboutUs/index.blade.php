@extends('UserMasterNew::master')
@section('title_user')درباره ما
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/aboutus.css')}}">

@endsection
@section('content_userMasterNew')
    <main>
        <div class="about-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 my-3">
                        <div class="about-item">
                            <div class="about-item-title">
                                <h1>
                                    درباره ما
                                </h1>
                            </div>
                            <div class="about-item-content">
                                @if(isset($aboutUs->description))

                                <p>
                                    {{$aboutUs->description}}
                                </p>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6  my-3">
                        <div class="about-item">
                            <div class="about-item-title">
                                <h1>
                                    اطلاعات تماس
                                </h1>
                            </div>
                            <div class="about-item-content">
                                <div class="about-item-content-call-info">
                                    @if(isset($aboutUs->mobile))
                                    <ul>
                                        <li>موبایل :</li>
                                        <li>{{$aboutUs->mobile}}</li>



                                    </ul>
                                    @endif
                                        @if(isset($aboutUs->phone))

                                        <ul>
                                        <li>
                                            تلفن ثابت :
                                        </li>
                                        <li>
                                            {{$aboutUs->phone}}
                                        </li>
                                    </ul>
                                        @endif
                                        @if(isset($aboutUs->email))

                                        <ul>
                                        <li>ایمیل :</li>
                                        <li>{{$aboutUs->email}}</li>
                                    </ul>
                                        @endif
                                        @if(isset($aboutUs->link))

                                        <ul>
                                        <li>لینک :</li>


                                        <li><a href="">{{$aboutUs->link}}</a></li>
                                    </ul>
                                            @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@extends('UserMasterNew::master')
@section('title_user')خطا-درگاه بانکی
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/error.css')}}">

@endsection
@section('content_userMasterNew')
    <main class="error-page-main">
        <section class="error-page">
            <div class="show-error">
                <div class="error-title">
                    <h2><strong>انصراف!</strong></h2>
                </div>
                <div class="error-image">
                    <img src="{{asset('files/userMaster/assets/img/Group 1.png')}}" alt="">
                </div>
                <div class="error-info-box">
                    <p>برگشت از درگاه.</p>
                </div>
            </div>
            <div class="sub-error-message">
{{--                <p>از صبر و شکیبایی شما متشکریم.</p>--}}
            </div>
        </section>
    </main>

@endsection
@section('js_user')
@endsection

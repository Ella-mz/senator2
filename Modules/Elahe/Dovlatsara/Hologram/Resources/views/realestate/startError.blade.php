@extends('RealestateMaster::master')
@section('title_realestate')خطا-درگاه بانکی
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/error.css')}}">

@endsection
@section('content_realestateMaster')

    <main class="error-page-main">
        <section class="error-page">
            <div class="show-error">
                <div class="error-title">
                    <h2><strong>اتصال به درگاه با خطا مواجه شد!</strong></h2>
                </div>
                <div class="error-image">
                    <img src="{{asset('files/userMaster/assets/img/Group 1.png')}}" alt="">
                </div>
                <div class="error-info-box">
                    <p>اتصال به درگاه با خطا مواجه شد لطفا چند دقیقه دیگر دوباره امتحان کنید.</p>
                </div>
            </div>
            <div class="sub-error-message">
                <p>از صبر و شکیبایی شما متشکریم.</p>
            </div>
        </section>
    </main>
@endsection
@section('js_realestate')

@endsection


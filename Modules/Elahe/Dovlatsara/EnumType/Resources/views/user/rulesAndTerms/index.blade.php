@extends('UserMasterNew::master')
@section('title_user')قوانین و مقررات
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/aboutus.css')}}">

@endsection
@section('content_userMasterNew')
    <main>
        <div class="about-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my-3">
                        <div class="about-item">
                            <div class="about-item-title">
                                <h1>
                                    قوانین و مقررات
                                </h1>
                            </div>
                            <div class="about-item-content">
                                @if(isset($rulesAndTerms->description))

                                    <p>
                                        {{$rulesAndTerms->description}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

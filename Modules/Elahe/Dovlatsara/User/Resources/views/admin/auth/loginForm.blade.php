<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/login.css')}}">
    <title>ورود به پنل</title>
</head>
<body>
<header></header>
<main>
    <section class="login-page">
        <div class="fraworkBg">
            <div class="container">
                <div class="show-login-parent">
                    <div class="show-login">
                        <a href="{{route('homePage.user')}}">
                            <div class="show-login-logo">
                                <img src="{{asset($logo)}}" alt="">
                            </div>
                        </a>
                        <div class="show-login-box">
                            <div class="tabContent show-login-box-white-bg">
                                <div class="show-login-navigationTab">
                                    <nav>
                                        <ul class="tabs">
                                            <li data-content="login-form" class="selected">                پنل ادمین {{$title_of_site}}

                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                                <div class="tabcontent selected" data-content="login-form">
                                    <form action="{{route('admin_login')}}" method="post">
                                        @csrf
                                        @if(session()->has('message'))
                                            <small class="text-danger mb-4">{{ session()->get('message') }}</small>

                                        @endif
                                        {{--                                        @error('mobile')--}}
                                        {{--                                        <small class="text-info mb-4">{{ $message }}</small>--}}
                                        {{--                                        @enderror--}}
                                        {{--                                        @error('password')--}}
                                        {{--                                        <small class="text-info mb-4">{{ $message }}</small>--}}
                                        {{--                                        @enderror--}}
                                        <br>
                                        <br>
                                        <div class="login-input-box">
                                            <div class="login-input-box-item">
                                                <input type="text" name="mobile" placeholder="شماره موبایل" class="login-input-style" value="{{old('mobile')}}">
                                                <br>
                                                @error('mobile')
                                                <small class="text-danger mb-4">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="login-input-box-item">
                                                <input type="password" name="password" placeholder="رمز عبور" class="login-input-style">
                                                <br>
                                                @error('password')
                                                <small class="text-danger mb-4">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="login-input-box-btn">
                                                <button type="submit">
                                                    ورود
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
</main>
<footer style="all: unset"></footer>
<script src="{{asset('files/userMaster/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/jquery.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/script.js')}}"></script>
</body>
</html>

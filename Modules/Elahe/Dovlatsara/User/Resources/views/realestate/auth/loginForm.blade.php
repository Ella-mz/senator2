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
    <link rel="shortcut icon" type="image/jpg" href="{{asset(\Modules\Setting\Entities\Setting::where('title', 'favicon_file')->first()->str_value)}}">

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
                        <div class="show-login-logo">
                            <img src="{{asset('files/userMaster/assets/img/whiteLogo.png')}}" alt="">
                        </div>
                        <div class="show-login-box">
                            <div class="tabContent show-login-box-white-bg">
                                <div class="show-login-navigationTab">
                                    <nav>
                                        <ul class="tabs">
                                            <li data-content="signup-form" class="@if(!old('reg')) selected @endif">ورود <span style="color: rgba(0, 0, 0, 0.726)">|</span></li>
                                            <li data-content="login-form" class="@if(old('reg')) selected @endif">ورود با رمز ثابت</li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="tabcontent @if(!old('reg')) selected @endif" data-content="signup-form">
                                    <form action="{{route('panel_login_OTP')}}" method="post">
                                        @csrf
                                        @if(session()->has('message_OTP'))
                                            <small class="text-danger mb-4">{{ session()->get('message_OTP') }}</small>
                                        @endif
                                        <div class="login-input-box">
                                            <div class="login-input-box-item">
                                                <input type="text" name="OTP_mobile" placeholder="شماره موبایل" value="{{old('OTP_mobile')}}" class="login-input-style">
                                                <br>
                                                @error('OTP_mobile')
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

                                <div class="tabcontent @if(old('reg')) selected @endif" data-content="login-form">
                                    <form action="{{route('realestate_login')}}" method="post">
                                        @csrf
                                        <input type="text" name="reg" hidden value="1">
                                    @if(session()->has('message'))
                                            <small class="text-danger mb-4">{{ session()->get('message') }}</small>
                                        @endif
                                        @if(session()->has('mm'))
                                            <small class="text-danger mb-4">{{ session()->get('mm') }}</small>
                                        @endif
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

                                            <div class="login-input-box-subinput">
                                                <div>
                                                    <p>
                                                        رمز عبور خود را <a href="{{route('realestate_forgot_password_mobile_form')}}">فراموش</a> کردید؟
                                                    </p>
                                                </div>

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

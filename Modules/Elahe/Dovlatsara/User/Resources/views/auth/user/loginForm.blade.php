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
    <link rel="shortcut icon" type="image/jpg"
          href="{{asset(\Modules\Setting\Entities\Setting::where('title', 'favicon_file')->first()->str_value)}}">
    <title>لاگین</title>
</head>

<body>

<header></header>
<main>
    <section class="login-page">
        <div class="fraworkBg">

            <div class="container">
                <div class="show-login-parent">
                    <div class="show-login">
                        <a href="{{route('homePage.user')}}" target="_blank">

                            <div class="show-login-logo">
                                <img src="{{$logo}}" alt="">
                            </div>
                        </a>
                        {{--                        <div class="contractor-login-link">--}}
                        {{--                            <a href="{{route('realestate_login_form')}}" target="_blank">--}}
                        {{--                                <p>برای ورود <span>پیمانکار یا مشاور کسب و کار</span> کلیک کنید.</p>--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="contractor-login-link">--}}
                        {{--                            <a href="{{route('auth.realestate.registerForm.user')}}" target="_blank">--}}
                        {{--                                <p>برای ثبت نام <span>پیمانکار یا مشاور کسب و کار</span> کلیک کنید.</p>--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}
                        <div class="show-login-box">
                            <div class="tabContent show-login-box-white-bg">
                                <div class="show-login-navigationTab">
                                    <nav>
                                        <ul class="tabs">
                                            {{--                                            <li data-content="login-form" class="@if(old('reg')) selected @endif">ورود <span style="color: rgba(0, 0, 0, 0.726)">|</span>--}}
                                            {{--                                            </li>--}}
                                            {{--                                            <li>|</li>--}}
                                            {{--                                            <li data-content="signup-form" class="@if(!old('reg')) selected @endif"> ثبت نام--}}
                                            {{--                                            </li>--}}
                                            {{--                                            <li><a target="_blank" href="{{route('realestate_login_form')}}"> ورود</a> <span style="color: rgba(0, 0, 0, 0.726)">|</span>--}}
                                            {{--                                            </li>--}}
                                            {{--                                            <li>|</li>--}}
                                            <li data-content="signup-form" class="@if(!(old('loginOTP') || old('login') || session()->has('messageLogin') || session()->has('messageOTP'))) selected @endif"> ثبت نام  <span
                                                        style="color: rgba(0, 0, 0, 0.726)">|</span>
                                            </li>
                                            <li data-content="loginOTP-form" class="@if(old('loginOTP') || session()->has('messageOTP')) selected @endif">ورود با پیامک <span
                                                        style="color: rgba(0, 0, 0, 0.726)">|</span>
                                            </li>
                                            <li data-content="login-form" class="@if(old('login') || session()->has('messageLogin')) selected @endif">ورود با رمز ثابت
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                                <div class="tabcontent @if(!(old('loginOTP') || old('login') || session()->has('messageLogin') || session()->has('messageOTP'))) selected @endif" data-content="signup-form">
                                    <form action="{{route('auth.user.register.user')}}" method="post">
                                        @csrf
                                        <input type="text" name="reg" hidden value="1">
                                        <input hidden name="previousUrl" value="{{$previousUrl}}">

                                        <div class="login-input-box">
                                            <div class="login-input-box-item">
                                                <input type="text" name="register_mobile" placeholder="شماره همراه*"
                                                       value="{{old('register_mobile')}}" class="login-input-style">
                                                <br>
                                                @error('register_mobile')
                                                <small class="text-danger mb-4">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="login-input-box-item login-input-box-flex">
                                                <input type="password" name="password" placeholder="رمز عبور*"
                                                       class="login-input-style">
                                                <input type="password" name="confirm_password"
                                                       placeholder="تکرار رمز عبور*" class="login-input-style">

                                            </div>
                                            <div class="login-input-box-item">
                                                <input type="text" name="register_invitedCode" placeholder="کد معرف"
                                                       value="{{old('register_invitedCode')}}" class="login-input-style"
                                                       oninput="validateInvitedCode(this.value, 'user')">
                                                <br>
                                                @error('register_invitedCode')
                                                <small class="text-danger mb-4">{{ $message }}</small>
                                                @enderror
                                                <small class="text-danger mb-4" id="userInputVerifyError"></small>


                                            </div>
                                            @error('password')
                                            <small class="text-danger mb-4">{{ $message }}</small>
                                            <br>
                                            @enderror
                                            @error('confirm_password')
                                            <small class="text-danger mb-4">{{ $message }}</small>
                                            <br>
                                            @enderror
                                            @if(session()->has('message2'))
                                                <small class="text-danger mb-4">{{ session()->get('message2') }}</small>
                                                <br>

                                            @endif

                                            <div class="login-input-box-subinput">
                                                {{--                                            <div>--}}

                                                {{--                                                <input type="checkbox">--}}
                                                {{--                                                <label for="">دریافت خبرنامه</label>--}}
                                                {{--                                            </div>--}}
                                                <div>
                                                    <p>
                                                        ثبت نام به معنی قبول <a
                                                                href="{{route('rulesAndTerms.index.user')}}"
                                                                target="_blank">قوانین و مقررات</a> است
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="login-input-box-btn">
                                                <button type="submit">
                                                    ارسال
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tabcontent @if(old('login') || session()->has('messageLogin')) selected @endif" data-content="login-form">
                                    <form action="{{route('auth.user.login.user')}}" method="post">
                                        @csrf
                                        <input type="text" name="login" hidden value="1">
                                        <input hidden name="previousUrl" value="{{$previousUrl}}">
                                        <div class="login-input-box">
                                            <div class="login-input-box-item">
                                                <input type="text" name="mobile_login" placeholder="شماره همراه*"
                                                       class="login-input-style" value="{{old('mobile_login')}}">
                                                <br>
                                                @error('mobile_login')
                                                <small class="text-danger mb-4">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="login-input-box-item">
                                                <input type="password" name="password_login" placeholder="رمزعبور*"
                                                       value="{{old('password_login')}}" class="login-input-style">
                                                <br>
                                                @error('password_login')
                                                <small class="text-danger mb-4">{{ $message }}</small>
                                                @enderror
                                                @if(session()->has('messageLogin'))
                                                    <small class="text-danger mb-4">{{ session()->get('messageLogin') }}</small>

                                                @endif
                                            </div>

                                            <div class="login-input-box-subinput">

                                            </div>
                                            <div class="login-input-box-btn">
                                                <button type="submit">
                                                    ارسال
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tabcontent @if(old('loginOTP') || session()->has('messageOTP')) selected @endif" data-content="loginOTP-form">
                                    <form action="{{route('auth.user.loginOTP.user')}}" method="post">
                                        @csrf
                                        <input type="text" name="loginOTP" hidden value="1">
                                        <input hidden name="previousUrl" value="{{$previousUrl}}">
                                        <div class="login-input-box">
                                            <div class="login-input-box-item">
                                                <input type="text" name="mobile" placeholder="شماره همراه*"
                                                       class="login-input-style" value="{{old('mobile')}}">
                                                <br>
                                                @error('mobile')
                                                <small class="text-danger mb-4">{{ $message }}</small>
                                                @enderror
                                                @if(session()->has('messageOTP'))
                                                    <small class="text-danger mb-4">{{ session()->get('messageOTP') }}</small>

                                                @endif
                                            </div>

                                            <div class="login-input-box-subinput">

                                            </div>
                                            <div class="login-input-box-btn">
                                                <button type="submit">
                                                    ارسال
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
<script>
    function validateInvitedCode(val, type) {
        if (val.length == 10) {
            jQuery.ajax({
                    url: "{{route('invite.checkInvitedCode')}}",
                    data: {
                        'invitedCode': val,
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.errors) {
                            if (type == 'user') {
                                $('#userInputVerifyError').empty();
                                $('#userInputVerifyError').append(data.errors);
                            }
                        } else {
                            $('#userInputVerifyError').empty();
                        }
                    }
                }
            );
        } else {
            if (type == 'user') {
                $('#userInputVerifyError').empty();
                $('#userInputVerifyError').append('کد معرف صحیح نیست.');
            }
        }
    }
</script>
<script src="{{asset('files/userMaster/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/jquery.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/script.js')}}"></script>
</body>

</html>

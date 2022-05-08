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
                            <img src="{{asset($logo)}}" alt="">
                        </div>
                        <div class="show-login-box">
                            <div class="tabContent show-login-box-white-bg">
                                <div class="show-login-navigationTab">
                                    <nav>
                                        <ul class="tabs">
                                            <li data-content="login-form" class="selected">فراموشی رمز عبور
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                                <div class="tabcontent selected" data-content="login-form">
                                    <form action="{{route('realestate_forgot_password_mobile')}}" method="post">
                                        @csrf
                                        @if(session()->has('message'))
                                            <small class="text-danger mb-4">{{ session()->get('message') }}</small>
                                        @endif
{{--                                        @if(session()->has('mm'))--}}
{{--                                            <small class="text-danger mb-4">{{ session()->get('mm') }}</small>--}}
{{--                                        @endif--}}
                                        <br>
                                        <div class="login-input-box">
{{--                                            <div class="login-input-box-item">--}}
{{--                                                <select name="role" class="login-input-style">--}}
{{--                                                    <option value="">--}}
{{--                                                        رمز عبور کدام پنل را فراموش کرده اید؟--}}

{{--                                                    </option>--}}
{{--                                                    <option value="real-state-administrator"--}}
{{--                                                    @if(old('role')=='real-state-administrator') selected @endif>--}}
{{--                                                        مدیران کسب و کار--}}
{{--                                                    </option>--}}
{{--                                                    <option value="real-state-agent"--}}
{{--                                                            @if(old('role')=='real-state-agent') selected @endif>--}}
{{--                                                        کارشناسان وابسته--}}
{{--                                                    </option>--}}
{{--                                                    <option value="independent-agent"--}}
{{--                                                            @if(old('role')=='independent-agent') selected @endif>--}}
{{--                                                        کارشناسان مستقل--}}
{{--                                                    </option>--}}
{{--                                                    <option value="contractor"--}}
{{--                                                            @if(old('role')=='contractor') selected @endif>--}}
{{--                                                        پیمانکاران--}}
{{--                                                    </option>--}}
{{--                                                    <option value="expert"--}}
{{--                                                            @if(old('role')=='expert') selected @endif>--}}
{{--                                                        کارشناسان--}}
{{--                                                    </option>--}}
{{--                                                    <option value="ordinary-user"--}}
{{--                                                            @if(old('role')=='ordinary-user') selected @endif>--}}
{{--                                                        کاربران عادی--}}
{{--                                                    </option>--}}
{{--                                                </select>--}}
{{--                                                <br>--}}
{{--                                                @error('role')--}}
{{--                                                <small class="text-danger mb-4">{{ $message }}</small>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
                                            <div class="login-input-box-item">
                                                <input type="text" name="mobile" {{old('mobile')}} placeholder="موبایل" class="login-input-style">
                                                <br>
                                                @error('mobile')
                                                <small class="text-danger mb-4">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="login-input-box-subinput">
{{--                                                                                            <div>--}}

{{--                                                                                                <input type="checkbox">--}}
{{--                                                                                                <label for="">دریافت خبرنامه</label>--}}
{{--                                                                                            </div>--}}
{{--                                                <div>--}}
{{--                                                    <p>--}}
{{--                                                        رمز عبور خود را <a href="">فراموش</a> کردید؟--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}

                                            </div>
                                            <div class="login-input-box-btn">
                                                <button type="submit">
                                                    ثبت
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
<footer></footer>
<script src="{{asset('files/userMaster/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/jquery.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/script.js')}}"></script>
</body>

</html>

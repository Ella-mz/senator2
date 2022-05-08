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
                                            <li data-content="login-form" class="selected">رمز عبور جدید
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                                <div class="tabcontent selected" data-content="login-form">
                                    <form method="post" id="changePassword">
                                        @csrf
                                        <input hidden name="mobile" value="{{$user->mobile}}">
                                        @if(session()->has('message'))
                                            <small class="text-danger mb-4">{{ session()->get('message') }}</small>
                                        @endif
{{--                                        @if(session()->has('mm'))--}}
{{--                                            <small class="text-danger mb-4">{{ session()->get('mm') }}</small>--}}
{{--                                        @endif--}}
                                        <br>
                                        <div class="login-input-box">
                                            <div class="login-input-box-item">
                                                <input type="password" name="password" placeholder="رمز عبور جدید" class="login-input-style">
                                                <br>
{{--                                                @error('password')--}}
{{--                                                <small class="text-danger mb-4">{{ $message }}</small>--}}
{{--                                                @enderror--}}
                                            </div>
                                            <div class="login-input-box-item">
                                                <input type="password" name="confirm_password" placeholder="تکرار رمز عبور" class="login-input-style">
                                                <br>
                                                <div id="error"></div>
                                                <div id="success"></div>
{{--                                                @error('confirm_password')--}}
{{--                                                <small class="text-danger mb-4">{{ $message }}</small>--}}
{{--                                                @enderror--}}
                                            </div>

                                            <div class="login-input-box-subinput">
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
<script>
    $(document).ready(function () {
        $('#changePassword').on('submit', function (event) {
            event.preventDefault();
            var formData = {
                'password': $('input[name=password]').val(),
                'confirm_password': $('input[name=confirm_password]').val(),
                'mobile': $('input[name=mobile]').val(),
            };
            var password = formData["password"];
            var confirm_password = formData["confirm_password"]
            var mobile = formData["mobile"]
            $.ajax({
                url: "{{route('realestate_forgot_password_changePassword')}}",
                method: "POST",
                data: new FormData(this),
                //data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.errorValidation) {
                        $('#error').empty();
                        $('#error').append('<small class="text-danger">' + data.errorValidation + '</small>');
                    }
                    if (data.success) {
                        $('#success').empty();
                        $('#success').append(data.success);
                        window.setTimeout(function () {
                            location.href = "{{route('realestate_login_form')}}";
                        }, 2000);
                    }
                }
            })
        });
    });
</script>

</body>

</html>

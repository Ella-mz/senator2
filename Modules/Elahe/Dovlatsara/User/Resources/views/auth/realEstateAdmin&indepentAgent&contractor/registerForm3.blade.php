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
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/registeramlaki.css')}}">
    <title>ثبت نام</title>
</head>

<body>
<header></header>
<main>
    <div class="fraworkBg">
        <div class="afterBg">
            <div class="container px-sm-5 mb-5">
                <div class="show-login-parent px-md-5 ">
                    <div class="show-login px-md-5">
                        <div class="show-login-head">
                            <div class="show-login-logo">
                                <img src="{{asset($logo)}}" alt="">
                            </div>
                            <div class="show-login-navigationTab">
                                <nav>
                                    <ul class="tabs">
                                        <li data-content="AgManagerSignup"
                                            class="@if(old('admin_reg')||(!old('agent_reg')&&!old('contractor_reg')&&!old('admin_reg')))
                                                selected @endif"> مدیر کسب و کار
                                        </li>

                                        <li data-content="AgAdvisorSignup"
                                            class="@if(old('agent_reg')) selected @endif">کارشناس کسب و کار
                                        </li>
                                        <li data-content="AgContractorSignup"
                                            class="@if(old('contractor_reg')) selected @endif">پیمانکار
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="show-login-box mb-5">
                            <div class="tabContent show-login-box-white-bg">

                                <form method="post" action="{{route('auth.realestate.registerAdmin.user')}}">
                                    @csrf
                                    <input hidden name="admin_reg" value="1">
                                    <div
                                        class="tabcontent @if(old('admin_reg')||(!old('agent_reg')&&!old('contractor_reg')&&!old('admin_reg'))) selected @endif"
                                        data-content="AgManagerSignup">

                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="admin_name" value="{{old('admin_name')}}"
                                                           type="text" placeholder="نام*"><br>
                                                    @error('admin_name')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="admin_sirName"
                                                           value="{{old('admin_sirName')}}" type="text"
                                                           placeholder="نام خانوادگی*"><br>
                                                    @error('admin_sirName')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="admin_email"
                                                           value="{{old('admin_email')}}" type="text"
                                                           placeholder="ایمیل*"><br>
                                                    @error('admin_email')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="admin_password"
                                                           value="{{old('admin_password')}}" type="text"
                                                           placeholder="رمز عبور*"><br>
                                                    @error('admin_password')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" type="text" name="admin_confirm_password"
                                                           value="{{old('admin_confirm_password')}}"
                                                           placeholder="تکرار رمز عبور*"><br>
                                                    @error('admin_confirm_password')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                    @if(session()->has('message2'))
                                                        <small
                                                            class="text-danger mb-4">{{ session()->get('message') }}</small>

                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" type="text" placeholder="Dovlatsara.com/"
                                                           value="{{old('admin_slug')}}" name="admin_slug"><br>
                                                    @error('admin_slug')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBoxMixed">
                                                    <div class="mixedInput">
                                                        <input dir="auto" type="text" id="admin_mobile"
                                                               placeholder="موبایل*"
                                                               value="{{old(('admin_mobile'))}}" name="admin_mobile"><br>
                                                        <a onclick="getVerificationCode()">ارسال کد تایید</a><br>

                                                    </div>
                                                    @error('admin_mobile')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6" id="admin_inputVerify">
                                            </div>
                                            <hr>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" type="text" name="admin_shop_title"
                                                           value="{{old('admin_shop_title')}}"
                                                           placeholder="عنوان کسب و کاری*"><br>
                                                    @error('admin_shop_title')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <select class="registerselectbox" name="admin_shop_city">
                                                        <option value="" disabled selected>*شهر</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}"
                                                                    @if($city->id==old('admin_shop_city')) selected @endif>{{$city->title}}</option>
                                                        @endforeach
                                                    </select><br>
                                                    @error('admin_shop_city')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <select class="registerselectbox" name="neighborhood"
                                                            id="neighborhood">
                                                        <option value="" disabled selected>محله</option>
                                                    </select><br>
                                                    @error('neighborhood')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" type="text" name="admin_shop_website"
                                                           value="{{old('admin_shop_website')}}"
                                                           placeholder="وبسایت">
                                                    @error('admin_shop_website')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-xl-6 col-lg-6 mt-3">
                                                <div class="uploadTemInput">
                                                    <div class="uploadTemInput-title">
                                                        <h5>
                                                            عکس پروفایل
                                                        </h5>
                                                    </div>
                                                    <div class="fileUploadFormm">
                                                        <div class="upload-form">
                                                            <div class="file-upload" data-text="انتخاب فایل">
                                                                <input type="file" name="admin_userImage"
                                                                       class="file-upload-field">

                                                            </div>
                                                            @error('admin_userImage')
                                                            <small class="text-danger mb-4">{{ $message }}</small><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 mt-3">
                                                <div class="uploadTemInput">
                                                    <div class="uploadTemInput-title">
                                                        <h5>
                                                            کارت ملی
                                                        </h5>
                                                    </div>
                                                    <div class="fileUploadFormm">
                                                        <div class="upload-form">
                                                            <div class="file-upload" data-text="انتخاب فایل">
                                                                <input type="file" name="admin_national_card_image"
                                                                       class="file-upload-field">

                                                            </div>
                                                            @error('admin_national_card_image')
                                                            <small class="text-danger mb-4">{{ $message }}</small><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 mt-3">
                                                <div class="uploadTemInput">
                                                    <div class="uploadTemInput-title">
                                                        <h5>
                                                            کارت مباشر
                                                        </h5>
                                                    </div>
                                                    <div class="fileUploadFormm">
                                                        <div class="upload-form">
                                                            <div class="file-upload" data-text="انتخاب فایل">
                                                                <input type="file" name="admin_mobasher_card_image"
                                                                       class="file-upload-field">

                                                            </div>
                                                            @error('admin_mobasher_card_image')
                                                            <small class="text-danger mb-4">{{ $message }}</small><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 mt-3">
                                                <div class="uploadTemInput">
                                                    <div class="uploadTemInput-title">
                                                        <h5>
                                                            پروانه کسب
                                                        </h5>
                                                    </div>
                                                    <div class="fileUploadFormm">
                                                        <div class="upload-form">
                                                            <div class="file-upload" data-text="انتخاب فایل">
                                                                <input type="file" name="admin_business_license_card_image"
                                                                       class="file-upload-field"><br>

                                                            </div>
                                                            @error('admin_business_license_card_image')
                                                            <small class="text-danger mb-4">{{ $message }}</small><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="registerBtnBox my-3">
                                            <button class="registerRecBlueBtn">ثبت نام</button>
                                        </div>
                                    </div>
                                </form>
                                <form method="post" action="{{route('auth.realestate.RegisterAgent.user')}}">
                                    @csrf
                                    <input hidden name="agent_reg" value="1">
                                    <div class="tabcontent @if(old('agent_reg')) selected @endif"
                                         data-content="AgAdvisorSignup">
                                        <div class="row">

                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="agent_name" value="{{old('agent_name')}}"
                                                           type="text" placeholder="نام*">
                                                    @error('agent_name')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="admin_sirName"
                                                           value="{{old('agent_sirName')}}" type="text"
                                                           placeholder="نام خانوادگی*">
                                                    @error('agent_sirName')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="agent_email"
                                                           value="{{old('agent_email')}}" type="text"
                                                           placeholder="ایمیل*">
                                                    @error('agent_email')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="agent_password"
                                                           value="{{old('agent_password')}}" type="text"
                                                           placeholder="رمز عبور*">
                                                    @error('agent_password')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" type="text" name="admin_confirm_password"
                                                           value="{{old('agent_confirm_password')}}"
                                                           placeholder="تکرار رمز عبور*">
                                                    @error('agent_confirm_password')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                    @if(session()->has('message'))
                                                        <small
                                                            class="text-danger mb-4">{{ session()->get('message') }}</small>

                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" type="text" placeholder="Dovlatsara.com/"
                                                           value="{{old('agent_slug')}}" name="admin_slug">
                                                    @error('agent_slug')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBoxMixed">
                                                    <div class="mixedInput">
                                                        <input dir="auto" type="text" id="agent_mobile"
                                                               placeholder="موبایل*"
                                                               value="{{old(('agent_mobile'))}}" name="agent_mobile">
                                                        <a onclick="getVerificationCode()">ارسال کد تایید</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6" id="agent_inputVerify">
                                            </div>
                                            <hr>
                                            <div class="col-xl-6 col-lg-6 mt-3">
                                                <div class="uploadTemInput">
                                                    <div class="uploadTemInput-title">
                                                        <h5>
                                                            عکس پروفایل
                                                        </h5>
                                                    </div>
                                                    <div class="fileUploadFormm">
                                                        <div class="upload-form">
                                                            <div class="file-upload" data-text="انتخاب فایل">
                                                                <input type="file" name="agent_userImage"
                                                                       class="file-upload-field">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 mt-3">
                                                <div class="uploadTemInput">
                                                    <div class="uploadTemInput-title">
                                                        <h5>
                                                            کارت ملی
                                                        </h5>
                                                    </div>
                                                    <div class="fileUploadFormm">
                                                        <div class="upload-form">
                                                            <div class="file-upload" data-text="انتخاب فایل">
                                                                <input type="file" name="agent_national_card_image"
                                                                       class="file-upload-field">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="registerBtnBox my-3">
                                            <button class="registerRecBlueBtn">ثبت نام</button>
                                        </div>
                                    </div>
                                </form>
                                <form method="post" action="{{route('auth.realestate.RegisterContractor.user')}}">
                                    @csrf
                                    <input hidden name="contractor_reg" value="1">
                                    <div class="tabcontent @if(old('contractor_reg')) selected @endif"
                                         data-content="AgContractorSignup">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="contractor_name" value="{{old('contractor_name')}}"
                                                           type="text" placeholder="نام*">
                                                    @error('contractor_name')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="contractor_sirName"
                                                           value="{{old('contractor_sirName')}}" type="text"
                                                           placeholder="نام خانوادگی*">
                                                    @error('contractor_sirName')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="contractor_email"
                                                           value="{{old('contractor_email')}}" type="text"
                                                           placeholder="ایمیل*">
                                                    @error('contractor_email')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" name="contractor_password"
                                                           value="{{old('contractor_password')}}" type="text"
                                                           placeholder="رمز عبور*">
                                                    @error('contractor_password')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" type="text" name="contractor_confirm_password"
                                                           value="{{old('contractor_confirm_password')}}"
                                                           placeholder="تکرار رمز عبور*">
                                                    @error('contractor_confirm_password')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                    @if(session()->has('message'))
                                                        <small
                                                            class="text-danger mb-4">{{ session()->get('message') }}</small>

                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBox">
                                                    <input dir="auto" type="text" placeholder="Dovlatsara.com/"
                                                           value="{{old('contractor_slug')}}" name="contractor_slug">
                                                    @error('contractor_slug')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="registerInputBoxMixed">
                                                    <div class="mixedInput">
                                                        <input dir="auto" type="text" id="contractor_mobile"
                                                               placeholder="موبایل*"
                                                               value="{{old(('contractor_mobile'))}}" name="contractor_mobile">
                                                        <a onclick="getVerificationCode()">ارسال کد تایید</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6" id="contractor_inputVerify">
                                            </div>
                                            <hr>
                                            <div class="col-xl-6 col-lg-6 mt-3">
                                                <div class="uploadTemInput">
                                                    <div class="uploadTemInput-title">
                                                        <h5>
                                                            عکس پروفایل
                                                        </h5>
                                                    </div>
                                                    <div class="fileUploadFormm">
                                                        <div class="upload-form">
                                                            <div class="file-upload" data-text="انتخاب فایل">
                                                                <input type="file" name="contractor_userImage"
                                                                       class="file-upload-field">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 mt-3">
                                                <div class="uploadTemInput">
                                                    <div class="uploadTemInput-title">
                                                        <h5>
                                                            کارت ملی
                                                        </h5>
                                                    </div>
                                                    <div class="fileUploadFormm">
                                                        <div class="upload-form">
                                                            <div class="file-upload" data-text="انتخاب فایل">
                                                                <input type="file" name="contractor_national_card_image"
                                                                       class="file-upload-field">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="registerBtnBox my-3">
                                            <button class="registerRecBlueBtn">ثبت نام</button>
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

</main>
<footer></footer>
<script src="{{asset('files/userMaster/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/jquery.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/script.js')}}"></script>

<script>

    $(".upload-form").on("change", ".file-upload-field", function () {
        $(this).parent(".file-upload").attr("data-text", $(this).val().replace(/.*(\/|\\)/, ''));
    })

</script>
<script>
    function getVerificationCode() {
        // jQuery(document).ready(function () {
        jQuery('in[id="admin_mobile"]').ready(function () {
            var admin_mobile = $("#admin_mobile").val();

                jQuery.ajax({
                    url: "{{route('auth.realestate.setVerifyCode.user')}}",
                    data: {
                        'mobile': admin_mobile,
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.errors) {
                            $('#mobileError').empty();
                            $('#mobileError').append(data.errors);
                        } else {
                            var str = '';
                            str += `<div class="registerInputBox">
               <input dir="auto" name="admin_verifyCode" value="{{old('admin_verifyCode')}}"
                                                    type="text" placeholder="کد تایید*"><br>
                                                    @error('admin_verifyCode')
                            <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                            </div>`;
                            $('#mobileSuccess').empty();
                            $('#mobileSuccess').append(data.content);
                            $('#admin_inputVerify').empty();
                            $('#admin_inputVerify').append(str);
                        }
                    }
                });
        })
        // })
    }
    function getVerificationCode() {
        // jQuery(document).ready(function () {
        jQuery('in[id="agent_mobile"]').ready(function () {
            var agent_mobile = $("#agent_mobile").val();

            jQuery.ajax({
                url: "{{route('auth.realestate.setVerifyCode.user')}}",
                data: {
                    'mobile': agent_mobile,
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.errors) {
                        $('#agent_mobileError').empty();
                        $('#agent_mobileError').append(data.errors);
                    } else {
                        var str = '';
                        str += `<div class="registerInputBox">
               <input dir="auto" name="agent_verifyCode" value="{{old('agent_verifyCode')}}"
                                                    type="text" placeholder="کد تایید*"><br>
                                                    @error('agent_verifyCode')
                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                        </div>`;
                        $('#agent_mobileSuccess').empty();
                        $('#agent_mobileSuccess').append(data.content);
                        $('#agent_inputVerify').empty();
                        $('#agent_inputVerify').append(str);
                    }
                }
            });
        })
        // })
    }
    function getVerificationCode() {
        // jQuery(document).ready(function () {
        jQuery('in[id="agent_mobile"]').ready(function () {
            var contractor_mobile = $("#contractor_mobile").val();

            jQuery.ajax({
                url: "{{route('auth.realestate.setVerifyCode.user')}}",
                data: {
                    'mobile': contractor_mobile,
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.errors) {
                        $('#contractor_mobileError').empty();
                        $('#contractor_mobileError').append(data.errors);
                    } else {
                        var str = '';
                        str += `<div class="registerInputBox">
               <input dir="auto" name="contractor_verifyCode" value="{{old('contractor_verifyCode')}}"
                                                    type="text" placeholder="کد تایید*"><br>
                                                    @error('contractor_verifyCode')
                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                        </div>`;
                        $('#contractor_mobileSuccess').empty();
                        $('#contractor_mobileSuccess').append(data.content);
                        $('#contractor_inputVerify').empty();
                        $('#contractor_inputVerify').append(str);
                    }
                }
            });
        })
        // })
    }

</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('select[name="admin_shop_city"]').on('change', function () {
            var cityId = jQuery(this).val();
            if (cityId) {
                jQuery.ajax({
                    url: "{{route('gettingNeighborhood')}}",
                    data: {
                        'city': cityId
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        jQuery('select[name="neighborhood"]').empty();
                        $('select[name="neighborhood"]').append('<option value=""></option>');
                        jQuery.each(data, function (key, value) {
                            $('select[name="neighborhood"]').append('<option value="' + key + '">' + value + '</option>');

                        });
                    }
                });
            } else {
                $('select[name="neighborhood"]').empty();
            }
        });
    });
</script>
</body>

</html>

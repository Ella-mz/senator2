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
    <section class="register-amlaki">

        <div class="fraworkBg">
            <div class="afterBg">
                <div class="container px-sm-5">
                    <div class="show-login-parent px-md-5 ">
                        <div class="show-login px-md-5">
                            <div class="show-login-head">
                                <div class="show-login-logo">
                                    <img src="{{$logo}}" alt="">
                                </div>
                                <div class="show-login-navigationTab">
                                    <nav>
                                        <ul class="tabs">
                                            <li data-content="AgManagerSignup" class="@if(old('admin_reg')||(!old('agent_reg')&&!old('contractor_reg')&&!old('admin_reg')))
                                                selected @endif"> مدیر کسب و کار
                                            </li>

                                            <li data-content="AgAdvisorSignup" class="@if(old('agent_reg')) selected @endif">کارشناس کسب و کار
                                            </li>
                                            <li data-content="AgContractorSignup" class="@if(old('contractor_reg')) selected @endif">پیمانکار
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
                                        <div class="tabcontent  @if(old('admin_reg')||(!old('agent_reg')&&!old('contractor_reg')&&!old('admin_reg'))) selected @endif" data-content="AgManagerSignup">

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input dir="auto" name="admin_name" value="{{old('admin_name')}}" type="text" placeholder="نام*"><br>
                                                        @error('admin_name')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input dir="auto" name="admin_sirName" value="{{old('admin_sirName')}}" type="text"
                                                               placeholder="نام خانوادگی*"><br>
                                                        @error('admin_sirName')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input dir="auto" name="admin_email" value="{{old('admin_email')}}"
                                                               type="email" placeholder="ایمیل*"><br>
                                                        @error('admin_email')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input dir="auto" type="text" name="admin_password" value="{{old('admin_password')}}" placeholder="رمز عبور*">
                                                        <br>
                                                        @error('admin_password')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input dir="auto" type="text" name="admin_confirm_password" value="{{old('admin_confirm_password')}}" placeholder="تکرار رمز عبور*">
                                                        <br>
                                                        @error('admin_confirm_password')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                        @if(session()->has('message2'))
                                                            <small class="text-danger mb-4">{{ session()->get('message') }}</small>

                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input dir="auto" type="text" placeholder="Dovlatsara.com/" value="{{old('admin_slug')}}"><br>
                                                        @error('admin_slug')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBoxMixed">
                                                        <div class="mixedInput">
                                                        <input dir="auto" type="text" class="mobile" placeholder="موبایل*"
                                                               value="{{old(('admin_mobile'))}}" name="admin_mobile">
                                                        <a onclick="getVerificationCode()" style="cursor: pointer">ارسال کد تایید</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6" id="admin_inputVerify">
                                                </div>
                                                <hr>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input dir="auto" type="text" name="admin_shop_title" value="{{old('admin_shop_title')}}"
                                                               placeholder="عنوان کسب و کاری*">
                                                        <br>
                                                        @error('admin_shop_title')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <select class="registerselectbox" name="admin_shop_city">
                                                            <option value="" disabled selected>شهر</option>

                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}" @if($city->id==old('city')) selected @endif>{{$city->title}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('admin_shop_city')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <select class="registerselectbox" name="neighborhood" id="neighborhood">
                                                            <option value="" disabled selected>محله</option>
                                                            {{--                                                        <option value="volvo">شهر</option>--}}
                                                            {{--                                                        <option value="saab">تهران</option>--}}
                                                            {{--                                                        <option value="opel">کرج</option>--}}
                                                            {{--                                                        <option value="audi">قم</option>--}}
                                                        </select>
                                                        @error('neighborhood')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input dir="auto" type="text" name="admin_shop_website" value="{{old('admin_shop_website')}}"
                                                               placeholder="وبسایت*">
                                                        <br>
                                                        @error('admin_shop_website')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="uploadTemInput">
                                                        <form action="/action_page.php" class="fileUploadForm">
                                                            <label for="files" class="upload">آپلود</label>
                                                            <input type="file" class="upload">

                                                        </form>
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
                                        <div class="tabcontent @if(old('agent_reg')) selected @endif" data-content="AgAdvisorSignup">

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input type="text" placeholder="نام*">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input type="text" placeholder="نام*">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input type="text" placeholder="نام*">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input type="text" placeholder="نام*">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input type="text" placeholder="نام*">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input type="text" placeholder="نام*">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input type="text" placeholder="نام*">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="uploadTemInput">
                                                        <form action="/action_page.php" class="fileUploadForm">
                                                            <label for="files" class="upload">آپلود</label>
                                                            <input type="file" class="upload">

                                                        </form>
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
                                        <div class="tabcontent @if(old('contractor_reg')) selected @endif" data-content="AgContractorSignup">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input type="text" placeholder="نام*">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="registerInputBox">
                                                        <input type="text" placeholder="نام*">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="uploadTemInput">
                                                        <form action="/action_page.php" class="fileUploadForm">
                                                            <label for="files" class="upload">آپلود</label>
                                                            <input type="file" class="upload">

                                                        </form>
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

    </section>
</main>
<footer></footer>

<script src="{{asset('files/userMaster/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/jquery.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/script.js')}}"></script>

<script>
    function getVerificationCode() {
        // jQuery(document).ready(function () {
        jQuery('in[class="mobile"]').ready(function () {
            var admin_mobile = $("#admin_mobile").val();
            jQuery.ajax({
                url: "{{route('auth.realestate.setVerifyCode.user')}}",
                data: {
                    'admin_mobile': admin_mobile,
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
                                                    @error('admin_name')
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
</script>
</body>

</html>

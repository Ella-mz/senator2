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
    <link rel="shortcut icon" type="image/jpg"
          href="{{asset(\Modules\Setting\Entities\Setting::where('title', 'favicon_file')->first()->str_value)}}">
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/select2/select2.min.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('files/adminMaster/dist/css/adminlte.min.css')}}">--}}

    <link rel="stylesheet" href="{{asset('files/adminMaster/dist/css/custom-style.css')}}">

    <title>ثبت نام</title>
</head>

<body>
<header></header>
<main>

    <div class="afterBg">
        <div class="container px-sm-5 mb-5">
            <div class="show-login-parent px-md-5 ">
                <div class="show-login px-md-5">
                    <div class="show-login-head">
                        <a href="{{route('homePage.user')}}">
                            <div class="show-login-logo">
                                <img src="{{asset($logo)}}" alt="">
                            </div>
                        </a>
                        <div class="show-login-navigationTab">
                            <nav>
                                <ul class="tabs">
                                    <li data-content="AgManagerSignup"
                                        class="@if(old('admin_reg')||(!old('agent_reg')&&!old('contractor_reg')&&!old('admin_reg')))
                                            selected @endif"> مدیر کسب و کار
                                    </li>

                                    {{--                                    <li data-content="AgAdvisorSignup" class="@if(old('agent_reg')) selected @endif">--}}
                                    {{--                                        کارشناس کسب و کار--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li data-content="AgContractorSignup"--}}
                                    {{--                                        class="@if(old('contractor_reg')) selected @endif">پیمانکار--}}
                                    {{--                                    </li>--}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="show-login-box mb-5">
                        <div class="tabContent show-login-box-white-bg">
                            <form method="post" action="{{route('auth.realestate.registerAdmin.user')}}"
                                  enctype="multipart/form-data" id="adminRegisterForm">
                                @csrf
                                <input hidden name="admin_reg" value="1">
                                <input hidden name="checkForVerificationAdmin">
                                <div
                                    class="tabcontent @if(old('admin_reg')||(!old('agent_reg')&&!old('contractor_reg')&&!old('admin_reg'))) selected @endif"
                                    data-content="AgManagerSignup">

                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">نام مدیر کسب و کار</label>
                                            <div class="registerInputBox">
                                                <input dir="auto" type="text" placeholder="نام*" name="admin_name"
                                                       value="{{old('admin_name')}}"><br>
                                                @error('admin_name')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">نام خانوادگی مدیر کسب و کار</label>
                                            <div class="registerInputBox">
                                                <input dir="auto" type="text" name="admin_sirName"
                                                       value="{{old('admin_sirName')}}" placeholder="نام خانوادگی*"><br>
                                                @error('admin_sirName')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">نام کاربری مدیر کسب و کار</label>
                                            <div class="registerInputBox">
                                                <input dir="auto" type="text" name="admin_userName"
                                                       value="{{old('admin_userName')}}" placeholder="نام کاربری*"><br>
                                                @error('admin_userName')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">ایمیل</label>
                                            <div class="registerInputBox">

                                                <input dir="auto" type="text" name="admin_email"
                                                       value="{{old('admin_email')}}" placeholder="ایمیل"><br>
                                                @error('admin_email')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">رمز عبور</label>
                                            <div class="registerInputBox">

                                                <input dir="auto" name="admin_password"
                                                       value="{{old('admin_password')}}" type="password"
                                                       placeholder="رمز عبور*"><br>
                                                @error('admin_password')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">تکرار رمز عبور</label>
                                            <div class="registerInputBox">

                                                <input dir="auto" type="password" placeholder="تکرار رمز عبور*"
                                                       name="admin_confirm_password"
                                                       value="{{old('admin_confirm_password')}}"><br>
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
                                            <label class="register-box-label">پروفایل شما با آدرس زیر ایجاد می
                                                شود</label>
                                            <div class="registerInputBox">

                                                <input dir="auto" type="text" placeholder="Dovlatsara.com/real-estate/"
                                                       value="{{old('admin_slug')}}" name="admin_slug"><br>
                                                @error('admin_slug')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">تلفن همراه</label>
                                            <div class="registerInputBoxMixed">
                                                <div class="mixedInput">
                                                    <input dir="auto" type="text" id="admin_mobile"
                                                           placeholder="تلفن همراه*" value="{{old(('admin_mobile'))}}"
                                                           name="admin_mobile">
                                                    <a onclick="getVerificationCode()" style="cursor: pointer">ارسال کد
                                                        تایید</a>
                                                </div>
                                                @error('admin_mobile')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6" id="admin_inputVerify">
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">کد معرف</label>
                                            <div class="registerInputBox">

                                                <input dir="auto" type="text" placeholder="کد معرف"
                                                       value="{{old('admin_invitedCode')}}"
                                                       name="admin_invitedCode"
                                                       oninput="validateInvitedCode(this.value, 'admin')"><br>
                                                @error('admin_invitedCode')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                                <small class="text-danger mb-4" id="adminInputVerifyError"></small><br>

                                            </div>
                                        </div>
                                        <hr>

                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">عنوان کسب و کار</label>
                                            <div class="registerInputBox">

                                                <input dir="auto" type="text" placeholder="عنوان کسب و کار*"
                                                       value="{{old('admin_shop_title')}}" name="admin_shop_title"><br>
                                                @error('admin_shop_title')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">شهر</label>
                                            <div class="registerInputBox">
                                                <select class="registerselectbox" name="admin_shop_city">
                                                    <option value="" disabled selected> شهر*</option>
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
                                            <label class="register-box-label">محله</label>
                                            <div class="registerInputBox">
                                                <select class="registerselectbox" name="neighborhood" id="neighborhood">
                                                    <option value="" disabled selected> محله</option>
                                                </select><br>
                                                @error('neighborhood')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">کدملی</label>
                                            <div class="registerInputBox">

                                                <input dir="auto" type="text" placeholder="کدملی*"
                                                       value="{{old('nationalCode')}}"
                                                       name="nationalCode"><br>
                                                @error('nationalCode')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">وبسایت</label>
                                            <div class="registerInputBox">

                                                <input dir="auto" type="text" placeholder="وبسایت"
                                                       value="{{old('admin_shop_website')}}"
                                                       name="admin_shop_website"><br>
                                                @error('admin_shop_website')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">صنف</label>
                                            <div class="registerInputBox">
                                                <select class="registerselectbox" name="category">
                                                    <option value="" disabled selected> صنف*</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}"
                                                                @if($category->id==old('category')) selected @endif>{{$category->title}}</option>
                                                    @endforeach
                                                </select><br>
                                                @error('category')
                                                <small class="text-danger mb-4">{{ $message }}</small><br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <label class="register-box-label">شهر</label>
                                            <div class="registerInputBox">
                                                <select class="form-control select2 select2-hidden-accessible"
                                                        name="admin_shop_city" multiple="multiple"
                                                        style="    border: 0;
    overflow: hidden;
    padding: 0;
    position: absolute;
">
                                                    <option value="" disabled selected> شهر*</option>
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

                                        {{--                                        <hr>--}}
                                        {{--                                        <div class="col-xl-6 col-lg-6 mt-3">--}}
                                        {{--                                            <div class="uploadTemInput">--}}
                                        {{--                                                <label class="register-box-label"> کارت ملی*--}}

                                        {{--                                                </label>--}}
                                        {{--                                                <div class="fileUploadFormm">--}}
                                        {{--                                                    <div class="upload-form">--}}
                                        {{--                                                        <div class="file-upload" data-text="انتخاب فایل">--}}
                                        {{--                                                            <input type="file" name="admin_national_card_image"--}}
                                        {{--                                                                   class="file-upload-field">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                        @error('admin_national_card_image')--}}
                                        {{--                                                        <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                                        {{--                                                        @enderror--}}
                                        {{--                                                    </div>--}}


                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="col-xl-6 col-lg-6 mt-3">--}}
                                        {{--                                            <div class="uploadTemInput">--}}
                                        {{--                                                <label class="register-box-label"> کارت مباشر*--}}

                                        {{--                                                </label>--}}
                                        {{--                                                <div class="fileUploadFormm">--}}
                                        {{--                                                    <div class="upload-form">--}}
                                        {{--                                                        <div class="file-upload" data-text="انتخاب فایل">--}}
                                        {{--                                                            <input type="file" name="admin_mobasher_card_image"--}}
                                        {{--                                                                   class="file-upload-field">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                        @error('admin_mobasher_card_image')--}}
                                        {{--                                                        <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                                        {{--                                                        @enderror--}}
                                        {{--                                                    </div>--}}


                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="col-xl-6 col-lg-6 mt-3">--}}
                                        {{--                                            <div class="uploadTemInput">--}}
                                        {{--                                                <label class="register-box-label"> پروانه کسب*--}}
                                        {{--                                                </label>--}}
                                        {{--                                                <div class="fileUploadFormm">--}}
                                        {{--                                                    <div class="upload-form">--}}
                                        {{--                                                        <div class="file-upload" data-text="انتخاب فایل">--}}
                                        {{--                                                            <input type="file" name="admin_business_license_card_image"--}}
                                        {{--                                                                   class="file-upload-field">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                        @error('admin_business_license_card_image')--}}
                                        {{--                                                        <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                                        {{--                                                        @enderror--}}
                                        {{--                                                    </div>--}}


                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="col-xl-6 col-lg-6 mt-3">--}}
                                        {{--                                            <div class="uploadTemInput">--}}
                                        {{--                                                <label class="register-box-label"> لوگو--}}
                                        {{--                                                </label>--}}
                                        {{--                                                <div class="fileUploadFormm">--}}
                                        {{--                                                    <div class="upload-form">--}}
                                        {{--                                                        <div class="file-upload" data-text="انتخاب فایل">--}}
                                        {{--                                                            <input type="file" name="admin_logo"--}}
                                        {{--                                                                   class="file-upload-field">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                        @error('admin_logo')--}}
                                        {{--                                                        <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                                        {{--                                                        @enderror--}}
                                        {{--                                                    </div>--}}

                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    <div class="registerBtnBox my-3">
                                        <button class="registerRecBlueBtn">ثبت نام</button>
                                    </div>
                                </div>
                            </form>
                            {{--                            <form method="post" id="agentRegisterForm"--}}
                            {{--                                  action="{{route('auth.realestate.RegisterAgent.user')}}"--}}
                            {{--                                  enctype="multipart/form-data">--}}
                            {{--                                @csrf--}}
                            {{--                                <input hidden name="agent_reg" value="1">--}}
                            {{--                                <input hidden name="checkForVerificationAgent">--}}

                            {{--                                <div class="tabcontent @if(old('agent_reg')) selected @endif"--}}
                            {{--                                     data-content="AgAdvisorSignup">--}}

                            {{--                                    <div class="row">--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">نام کارشناس کسب و کار</label>--}}
                            {{--                                            <div class="registerInputBox">--}}
                            {{--                                                <input dir="auto" type="text" placeholder="نام*" name="agent_name"--}}
                            {{--                                                       value="{{old('agent_name')}}"><br>--}}
                            {{--                                                @error('agent_name')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">نام خانوادگی کارشناس کسب و کار</label>--}}
                            {{--                                            <div class="registerInputBox">--}}
                            {{--                                                <input dir="auto" type="text" name="agent_sirName"--}}
                            {{--                                                       value="{{old('agent_sirName')}}" placeholder="نام خانوادگی*"><br>--}}
                            {{--                                                @error('agent_sirName')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">نام کاربری کارشناس کسب و کار</label>--}}
                            {{--                                            <div class="registerInputBox">--}}
                            {{--                                                <input dir="auto" type="text" name="agent_userName"--}}
                            {{--                                                       value="{{old('agent_userName')}}" placeholder="نام کاربری*"><br>--}}
                            {{--                                                @error('agent_userName')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">ایمیل</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" type="text" name="agent_email"--}}
                            {{--                                                       value="{{old('agent_email')}}" placeholder="ایمیل"><br>--}}
                            {{--                                                @error('agent_email')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">رمز عبور</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" name="agent_password"--}}
                            {{--                                                       value="{{old('agent_password')}}" type="password"--}}
                            {{--                                                       placeholder="رمز عبور*"><br>--}}
                            {{--                                                @error('agent_password')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">تکرار رمز عبور</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" type="password" placeholder="تکرار رمز عبور*"--}}
                            {{--                                                       name="agent_confirm_password"--}}
                            {{--                                                       value="{{old('agent_confirm_password')}}"><br>--}}
                            {{--                                                @error('agent_confirm_password')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                                @if(session()->has('message'))--}}
                            {{--                                                    <small--}}
                            {{--                                                        class="text-danger mb-4">{{ session()->get('message') }}</small>--}}

                            {{--                                                @endif--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}

                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">پروفایل شما با آدرس زیر ایجاد می--}}
                            {{--                                                شود</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" type="text" placeholder="Dovlatsara.com/"--}}
                            {{--                                                       value="{{old('agent_slug')}}" name="agent_slug"><br>--}}
                            {{--                                                @error('agent_slug')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">موبایل</label>--}}
                            {{--                                            <div class="registerInputBoxMixed">--}}
                            {{--                                                <div class="mixedInput">--}}
                            {{--                                                    <input dir="auto" type="text" id="agent_mobile"--}}
                            {{--                                                           placeholder="موبایل*" value="{{old(('agent_mobile'))}}"--}}
                            {{--                                                           name="agent_mobile">--}}
                            {{--                                                    <a onclick="getVerificationCode2()" style="cursor: pointer">ارسال کد--}}
                            {{--                                                        تایید</a>--}}
                            {{--                                                </div>--}}
                            {{--                                                @error('agent_mobile')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6" id="agent_inputVerify">--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">کد معرف</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" type="text" placeholder="کد معرف"--}}
                            {{--                                                       value="{{old('agent_invitedCode')}}" oninput="validateInvitedCode(this.value, 'agent')"--}}
                            {{--                                                       name="agent_invitedCode"><br>--}}
                            {{--                                                @error('agent_invitedCode')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                                <small class="text-danger mb-4" id="agentInputVerifyError"></small><br>--}}

                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <hr>--}}
                            {{--                                        <div class="col-xl-6 col-lg-6 mt-3">--}}
                            {{--                                            <div class="uploadTemInput">--}}
                            {{--                                                <label class="register-box-label"> عکس پروفایل--}}
                            {{--                                                </label>--}}
                            {{--                                                <div class="fileUploadFormm">--}}
                            {{--                                                    <div class="upload-form">--}}
                            {{--                                                        <div class="file-upload" data-text="انتخاب فایل">--}}
                            {{--                                                            <input type="file" name="agent_userImage"--}}
                            {{--                                                                   class="file-upload-field">--}}
                            {{--                                                        </div>--}}
                            {{--                                                        @error('agent_userImage')--}}
                            {{--                                                        <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                        @enderror--}}
                            {{--                                                    </div>--}}


                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-6 col-lg-6 mt-3">--}}
                            {{--                                            <div class="uploadTemInput">--}}
                            {{--                                                <label class="register-box-label"> کارت ملی*--}}

                            {{--                                                </label>--}}
                            {{--                                                <div class="fileUploadFormm">--}}
                            {{--                                                    <div class="upload-form">--}}
                            {{--                                                        <div class="file-upload" data-text="انتخاب فایل">--}}
                            {{--                                                            <input type="file" name="agent_national_card_image"--}}
                            {{--                                                                   class="file-upload-field">--}}
                            {{--                                                        </div>--}}
                            {{--                                                        @error('agent_national_card_image')--}}
                            {{--                                                        <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                        @enderror--}}
                            {{--                                                    </div>--}}


                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="registerBtnBox my-3">--}}
                            {{--                                        <button class="registerRecBlueBtn">ثبت نام</button>--}}
                            {{--                                    </div>--}}

                            {{--                                </div>--}}
                            {{--                            </form>--}}
                            {{--                            <form method="post" action="{{route('auth.realestate.RegisterContractor.user')}}"--}}
                            {{--                                  enctype="multipart/form-data" id="contractorRegisterForm">--}}
                            {{--                                @csrf--}}
                            {{--                                <input hidden name="checkForVerificationContractor">--}}

                            {{--                                <input hidden name="contractor_reg" value="1">--}}
                            {{--                                <div class="tabcontent @if(old('contractor_reg')) selected @endif"--}}
                            {{--                                     data-content="AgContractorSignup">--}}

                            {{--                                    <div class="row">--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">نام پیمانکار</label>--}}
                            {{--                                            <div class="registerInputBox">--}}
                            {{--                                                <input dir="auto" type="text" placeholder="نام*" name="contractor_name"--}}
                            {{--                                                       value="{{old('contractor_name')}}"><br>--}}
                            {{--                                                @error('contractor_name')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">نام خانوادگی پیمانکار</label>--}}
                            {{--                                            <div class="registerInputBox">--}}
                            {{--                                                <input dir="auto" type="text" name="contractor_sirName"--}}
                            {{--                                                       value="{{old('contractor_sirName')}}"--}}
                            {{--                                                       placeholder="نام خانوادگی*"><br>--}}
                            {{--                                                @error('contractor_sirName')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">نام کاربری پیمانکار</label>--}}
                            {{--                                            <div class="registerInputBox">--}}
                            {{--                                                <input dir="auto" type="text" name="contractor_userName"--}}
                            {{--                                                       value="{{old('contractor_userName')}}" placeholder="نام کاربری*"><br>--}}
                            {{--                                                @error('contractor_userName')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">ایمیل</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" type="text" name="contractor_email"--}}
                            {{--                                                       value="{{old('contractor_email')}}" placeholder="ایمیل"><br>--}}
                            {{--                                                @error('contractor_email')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">رمز عبور</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" name="contractor_password"--}}
                            {{--                                                       value="{{old('contractor_password')}}" type="password"--}}
                            {{--                                                       placeholder="رمز عبور*"><br>--}}
                            {{--                                                @error('contractor_password')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">تکرار رمز عبور</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" type="password" placeholder="تکرار رمز عبور*"--}}
                            {{--                                                       name="contractor_confirm_password"--}}
                            {{--                                                       value="{{old('contractor_confirm_password')}}"><br>--}}
                            {{--                                                @error('contractor_confirm_password')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                                @if(session()->has('message'))--}}
                            {{--                                                    <small--}}
                            {{--                                                        class="text-danger mb-4">{{ session()->get('message') }}</small>--}}

                            {{--                                                @endif--}}
                            {{--                                                @if(session()->has('message4'))--}}
                            {{--                                                    <small--}}
                            {{--                                                        class="text-danger mb-4">{{ session()->get('message4') }}</small>--}}

                            {{--                                                @endif--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}

                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">پروفایل شما با آدرس زیر ایجاد می--}}
                            {{--                                                شود</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" type="text" placeholder="Dovlatsara.com/contractors/"--}}
                            {{--                                                       value="{{old('contractor_slug')}}"--}}
                            {{--                                                       name="contractor_slug"><br>--}}
                            {{--                                                @error('contractor_slug')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">موبایل</label>--}}
                            {{--                                            <div class="registerInputBoxMixed">--}}
                            {{--                                                <div class="mixedInput">--}}
                            {{--                                                    <input dir="auto" type="text" id="contractor_mobile"--}}
                            {{--                                                           placeholder="موبایل*" value="{{old(('contractor_mobile'))}}"--}}
                            {{--                                                           name="contractor_mobile">--}}
                            {{--                                                    <a onclick="getVerificationCode3()" style="cursor: pointer">ارسال کد--}}
                            {{--                                                        تایید</a>--}}
                            {{--                                                </div>--}}
                            {{--                                                @error('contractor_mobile')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                                @if(session()->has('message3'))--}}
                            {{--                                                    <small--}}
                            {{--                                                        class="text-danger mb-4">{{ session()->get('message3') }}</small>--}}

                            {{--                                                @endif--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6" id="contractor_inputVerify">--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                            {{--                                            <label class="register-box-label">کد معرف</label>--}}
                            {{--                                            <div class="registerInputBox">--}}

                            {{--                                                <input dir="auto" type="text" placeholder="کد معرف"--}}
                            {{--                                                       value="{{old('contractor_invitedCode')}}" oninput="validateInvitedCode(this.value, 'contractor')"--}}
                            {{--                                                       name="contractor_invitedCode"><br>--}}
                            {{--                                                @error('contractor_invitedCode')--}}
                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                @enderror--}}
                            {{--                                                <small class="text-danger mb-4" id="contractorInputVerifyError"></small><br>--}}

                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <hr>--}}
                            {{--                                        <div class="col-xl-6 col-lg-6 mt-3">--}}
                            {{--                                            <div class="uploadTemInput">--}}
                            {{--                                                <label class="register-box-label"> عکس پروفایل--}}
                            {{--                                                </label>--}}
                            {{--                                                <div class="fileUploadFormm">--}}
                            {{--                                                    <div class="upload-form">--}}
                            {{--                                                        <div class="file-upload" data-text="انتخاب فایل">--}}
                            {{--                                                            <input type="file" name="contractor_userImage"--}}
                            {{--                                                                   class="file-upload-field">--}}
                            {{--                                                        </div>--}}
                            {{--                                                        @error('contractor_userImage')--}}
                            {{--                                                        <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                        @enderror--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-xl-6 col-lg-6 mt-3">--}}
                            {{--                                            <div class="uploadTemInput">--}}
                            {{--                                                <label class="register-box-label"> کارت ملی*--}}

                            {{--                                                </label>--}}
                            {{--                                                <div class="fileUploadFormm">--}}
                            {{--                                                    <div class="upload-form">--}}
                            {{--                                                        <div class="file-upload" data-text="انتخاب فایل">--}}
                            {{--                                                            <input type="file" name="contractor_national_card_image"--}}
                            {{--                                                                   class="file-upload-field">--}}
                            {{--                                                        </div>--}}
                            {{--                                                        @error('contractor_national_card_image')--}}
                            {{--                                                        <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                            {{--                                                        @enderror--}}
                            {{--                                                    </div>--}}

                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="registerBtnBox my-3">--}}
                            {{--                                        <button class="registerRecBlueBtn">ثبت نام</button>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer style="all: unset"></footer>
<script src="{{asset('files/adminMaster/plugins/select2/select2.full.min.js')}}"></script>

<script>

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script>
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
                            if (type == 'admin') {
                                $('#adminInputVerifyError').empty();
                                $('#adminInputVerifyError').append(data.errors);
                            } else if (type == 'agent') {
                                $('#agentInputVerifyError').empty();
                                $('#agentInputVerifyError').append(data.errors);
                            } else if (type == 'contractor') {
                                $('#contractorInputVerifyError').empty();
                                $('#contractorInputVerifyError').append(data.errors);

                            }
                        } else {
                            $('#adminInputVerifyError').empty();
                            $('#contractorInputVerifyError').empty();
                            $('#agentInputVerifyError').empty();
                        }
                    }
                }
            );
        } else {
            if (type == 'admin') {
                $('#adminInputVerifyError').empty();
                $('#adminInputVerifyError').append('کد معرف صحیح نیست.');
            } else if (type == 'agent') {
                $('#agentInputVerifyError').empty();
                $('#agentInputVerifyError').append('کد معرف صحیح نیست.');
            } else if (type == 'contractor') {
                $('#contractorInputVerifyError').empty();
                $('#contractorInputVerifyError').append('کد معرف صحیح نیست.');
            }
        }
    }
</script>
<script src="./{{asset('files/userMaster/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/jquery.js')}}"></script>
<script src="{{asset('files/userMaster/assets/js/script.js')}}"></script>
<script>

    $(".upload-form").on("change", ".file-upload-field", function () {
        $(this).parent(".file-upload").attr("data-text", $(this).val().replace(/.*(\/|\\)/, ''));
    })

</script>
<script>
    function getVerificationCode() {
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
                        str += `<label class="register-box-label">کد تایید</label>
                                        <div class="registerInputBox">

                                            <input dir="auto" type="text" placeholder="کد تایید" value="{{old('admin_verifyCode')}}"
                                                   name="admin_verifyCode"><br>
                                            @error('admin_verifyCode')
                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                            @enderror
                        </div>`;
                        $('#adminRegisterForm').find('[name="checkForVerificationAdmin"]').val(1);

                        $('#mobileSuccess').empty();
                        $('#mobileSuccess').append(data.content);
                        $('#admin_inputVerify').empty();
                        $('#admin_inputVerify').append(str);
                    }
                }
            });
        })
    }

    function getVerificationCode2() {
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
                        str += `<label class="register-box-label">کد تایید</label>
                                        <div class="registerInputBox">

                                            <input dir="auto" type="text" placeholder="کد تایید" value="{{old('agent_verifyCode')}}"
                                                   name="agent_verifyCode"><br>
                                            @error('agent_verifyCode')
                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                            @enderror
                        </div>`;
                        $('#agentRegisterForm').find('[name="checkForVerificationAgent"]').val(1);

                        $('#agent_mobileSuccess').empty();
                        $('#agent_mobileSuccess').append(data.content);
                        $('#agent_inputVerify').empty();
                        $('#agent_inputVerify').append(str);
                    }
                }
            });
        })
    }

    function getVerificationCode3() {
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
                        str += `<label class="register-box-label">کد تایید</label>
                                        <div class="registerInputBox">

                                            <input dir="auto" type="text" placeholder="کد تایید" value="{{old('contractor_verifyCode')}}"
                                                   name="contractor_verifyCode"><br>
                                            @error('contractor_verifyCode')
                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                            @enderror
                        </div>`;
                        $('#contractorRegisterForm').find('[name="checkForVerificationContractor"]').val(1);

                        $('#contractor_mobileSuccess').empty();
                        $('#contractor_mobileSuccess').append(data.content);
                        $('#contractor_inputVerify').empty();
                        $('#contractor_inputVerify').append(str);
                    }
                }
            });
        })
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
@if(old('admin_mobile'))
    <script>
        $('#adminRegisterForm').find('[name="checkForVerificationAdmin"]').val(1);

        var str = '';
        str += `<label class="register-box-label">کد تایید</label>
                                        <div class="registerInputBox">

                                            <input dir="auto" type="text" placeholder="کد تایید" value="{{old('admin_verifyCode')}}"
                                                   name="admin_verifyCode"><br>
                                            @error('admin_verifyCode')
        <small class="text-danger mb-4">{{ $message }}</small><br>
                                            @enderror
        </div>`;
        $('#admin_inputVerify').empty();
        $('#admin_inputVerify').append(str);
    </script>
@endif
@if(old('agent_reg') && old('agent_mobile') && old('checkForVerificationAgent'))
    <script>
        $('#agentRegisterForm').find('[name="checkForVerificationAgent"]').val(1);

        var str = '';
        str += `<label class="register-box-label">کد تایید</label>
                                        <div class="registerInputBox">

                                            <input dir="auto" type="text" placeholder="کد تایید" value="{{old('agent_verifyCode')}}"
                                                   name="agent_verifyCode"><br>
                                            @error('agent_verifyCode')
        <small class="text-danger mb-4">{{ $message }}</small><br>
                                            @enderror
        </div>`;
        $('#agent_inputVerify').empty();
        $('#agent_inputVerify').append(str);
    </script>
@endif
@if(old('contractor_reg') && old('contractor_mobile') && old('checkForVerificationContractor'))
    <script>
        $('#contractorRegisterForm').find('[name="checkForVerificationContractor"]').val(1);

        var str = '';
        str += `<label class="register-box-label">کد تایید</label>
                                        <div class="registerInputBox">

                                            <input dir="auto" type="text" placeholder="کد تایید" value="{{old('contractor_verifyCode')}}"
                                                   name="contractor_verifyCode"><br>
                                            @error('contractor_verifyCode')
        <small class="text-danger mb-4">{{ $message }}</small><br>
                                            @enderror
        </div>`;
        $('#contractor_inputVerify').empty();
        $('#contractor_inputVerify').append(str);
    </script>
@endif
</body>

</html>

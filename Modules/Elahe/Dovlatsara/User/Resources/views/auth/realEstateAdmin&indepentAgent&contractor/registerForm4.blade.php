<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/select2/select2.min.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('files/adminMaster/dist/css/adminlte.min.css')}}">--}}

    <link rel="stylesheet" href="{{asset('files/adminMaster/dist/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/registeramlaki.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/font-awesome/css/font-awesome.min.css')}}">

    <link rel="shortcut icon" type="image/jpg"
          href="{{asset(\Modules\Setting\Entities\Setting::where('title', 'favicon_file')->first()->str_value)}}">

    <style>
        .select2-selection.select2-selection--multiple {
            min-height: 41.2px;
            border-radius: 6px;
            border: 1px solid #535353;
        }

        .select2-selection.select2-selection--single {
            min-height: 42px;
            border-radius: 6px;
            border: 1px solid #535353;
        }

        .select2-results__option {
            color: #8e8e8e;
        }
    </style>
    <style>
        .registerInputBoxMixed .admin_slug input {
            min-height: 54px;
        }

        /*.registerInputBoxMixed .admin_slug input ::placeholder {*/
        /*    font-size: 1px;*/
        /*}*/
        .registerInputBoxMixed .admin_slug a {
            background-color: forestgreen;
            border: 1px solid forestgreen;
            cursor: pointer;

        }

        .registerInputBoxMixed .copy_admin_slug a {
            font-size: 22px;
            padding: 10px 11px;
            background-color: gray;
            color: #fff;
            border-radius: 0 6px 6px 0;
            border: 1px solid gray;
            cursor: pointer;
            /*min-height: 54px;*/
        }

        @media (max-width: 450px) {
            .registerInputBoxMixed .copy_admin_slug a{
                font-size: 19px;
            }
        }
        @media (max-width: 422px) {
            .registerInputBoxMixed .copy_admin_slug a{
                font-size: 18px;
            }
        }
        @media (max-width: 414px) {
            .registerInputBoxMixed .copy_admin_slug a{
                font-size: 17px;
            }
        }
        @media (max-width: 405px) {
            .registerInputBoxMixed .copy_admin_slug a{
                font-size: 16px;
            }
        }
        @media (max-width: 381px) {
            .registerInputBoxMixed .copy_admin_slug a{
                font-size: 14px;
            }
        }
        .registerInputBoxMixed .copy_admin_slug input {
            min-height: 54px;
            border: none;
            padding: 8px 2px;
            border-radius: 6px 0 0 6px;
            border: 1px solid #8e8e8e;
            background-color: #ddb24f;
            color: #fff;
        }

        @media (max-width: 992px) {
            .registerInputBoxMixed .admin_slug a {
                width: 29%;
                text-align: center;
                min-height: 54px;
                cursor: pointer;
                /*background-color: forestgreen;*/
            }
        }

    </style>
    <title>ثبت نام</title>
</head>

<body>
<header></header>
<main>

    <div class="afterBg p-5">
        <div class="container px-sm-5 mb-5">
            <div class="show-login-parent px-md-5 ">
                <div class="show-login px-md-5">
                    @if(!auth()->user() && $user_id)
                        <div class="alert alert-danger "
                             style="color:darkred">درصورتی که درحال ارتقاء حساب کاربری هستید، ابتدا در پنل خود وارد شوید
                            و سپس به تکمیل اطلاعات خود بپردازید.
                        </div>
                    @endif
                    {{--                    <div class="show-login-head">--}}
                    {{--                        <a href="{{route('homePage.user')}}">--}}
                    {{--                            <div class="show-login-logo">--}}
                    {{--                                <img src="{{asset($logo)}}" alt="">--}}
                    {{--                            </div>--}}
                    {{--                        </a>--}}
                    {{--                        <div class="show-login-navigationTab">--}}
                    {{--                            <nav>--}}
                    {{--                                <ul class="tabs">--}}
                    {{--                                    <li data-content="AgManagerSignup"--}}
                    {{--                                        class="@if(old('admin_reg')||(!old('agent_reg')&&!old('contractor_reg')&&!old('admin_reg')))--}}
                    {{--                                            selected @endif"> مدیر کسب و کار {{$user->id}}--}}
                    {{--                                    </li>--}}

                    {{--                                    --}}{{--                                    <li data-content="AgAdvisorSignup" class="@if(old('agent_reg')) selected @endif">--}}
                    {{--                                    --}}{{--                                        کارشناس کسب و کار--}}
                    {{--                                    --}}{{--                                    </li>--}}
                    {{--                                    --}}{{--                                    <li data-content="AgContractorSignup"--}}
                    {{--                                    --}}{{--                                        class="@if(old('contractor_reg')) selected @endif">پیمانکار--}}
                    {{--                                    --}}{{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </nav>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="row">
                        <div class="col-md-2 col-sm-2"></div>
                        <div class="col-md-8 col-sm-8">
                            <div class="show-login-box mb-5">
                                <div
                                    class="tabContent show-login-box-white-bg">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{route('homePage.user')}}">
                                            <div class="show-login-logo">
                                                <img src="{{asset($logo)}}" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="row">
                                        {!! $text_of_register->str_value !!}
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                        <div class="show-login-box mb-5">
                            <div class="tabContent show-login-box-white-bg">
                                <form method="post" action="{{route('auth.realestate.registerAdmin.user')}}"
                                      enctype="multipart/form-data" id="adminRegisterForm">
                                    @csrf
                                    <input hidden name="user" value="{{$user_id}}">
                                    <input hidden name="user_id" value="{{$user?$user->id:null}}">
                                    <input hidden name="admin_reg" value="1">
                                    <input hidden name="checkForVerificationAdmin">
                                    <div class="tabcontent selected" data-content="AgManagerSignup">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6">
                                                {{--                                            @if($errors->any())--}}
                                                {{--                                                <div class="alert alert-danger">--}}
                                                {{--                                                    <p><strong>Opps Something went wrong</strong></p>--}}
                                                {{--                                                    <ul>--}}
                                                {{--                                                        @foreach ($errors->all() as $error)--}}
                                                {{--                                                            <li>{{ $error }}</li>--}}
                                                {{--                                                        @endforeach--}}
                                                {{--                                                    </ul>--}}
                                                {{--                                                </div>--}}
                                                {{--                                            @endif--}}

                                                <label class="register-box-label">نام کسب و کار(برند)</label>
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
                                                    <select class="registerselectbox select2" name="admin_shop_city"
                                                            dir="rtl"
                                                            style="border: 1px solid #535353">
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
                                            <div class="col-xl-4 col-lg-6" id="neighborhoodOld">
                                                <label class="register-box-label">محله</label>
                                                <div class="registerInputBox">
                                                    <select class="registerselectbox select2" name="neighborhood"
                                                            id="neighborhood" dir="rtl">
                                                        <option value="" disabled selected> محله</option>
                                                    </select><br>
                                                    @error('neighborhood')
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
                                            <div class="col-xxl-8 col-xl-8 col-lg-6" id="subCategoryOld">
                                                <label class="register-box-label">{{old('subCategory')}}</label>
                                                <div class="registerInputBox">
                                                    <select class="registerselectbox select2" dir="rtl"
                                                            name="subCategory[]" multiple="multiple"
                                                            style="border: 1px solid #535353; width: 100%;">
                                                        <option value="" disabled> حوزه های فعالیت*</option>

                                                    </select><br>
                                                    @if(old('category') && \Modules\Category\Entities\Category::find(old('category'))->subCategories->count()>0)
                                                        <small class="text-danger mb-4">حوزه های فعالیت را دوباره انتخاب کنید</small><br>
                                                    @endif
                                                    @error('subCategory')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <label class="register-box-label">وبسایت(اختیاری)</label>
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
                                                <label class="register-box-label">کد معرف(اختیاری)</label>
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
                                            <div class="col-xl-4 col-lg-6">
                                                <label class="register-box-label">تلفن ثابت کسب و کار(اختیاری)</label>
                                                <div class="registerInputBoxMixed">
                                                    <div class="registerInputBox">
                                                        <input dir="auto" type="text" id="shopPhone"
                                                               placeholder="شماره تماس" value="{{old(('shopPhone'))}}"
                                                               name="shopPhone">
                                                    </div>
                                                    @error('shopPhone')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <label class="register-box-label">ایمیل(اختیاری)</label>
                                                <div class="registerInputBox">

                                                    <input dir="auto" type="text" name="admin_email"
                                                           value="{{old('admin_email')}}" placeholder="ایمیل"><br>
                                                    @error('admin_email')
                                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <label class="register-box-label">رمز عبور<span
                                                        style="font-weight: lighter;font-size: smaller">(برای ورود بدون نیاز به تایید موبایل)</span></label>
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
                                            <hr>
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
                                            @if(!$user)
                                                <div class="col-xl-4 col-lg-6">
                                                    <label class="register-box-label">تلفن همراه</label>
                                                    <div class="registerInputBoxMixed">
                                                        <div class="mixedInput">
                                                            <input dir="auto" type="text" id="admin_mobile"
                                                                   placeholder="تلفن همراه*"
                                                                   value="{{old(('admin_mobile'))}}"
                                                                   name="admin_mobile">
                                                            <a onclick="getVerificationCode()" style="cursor: pointer">ارسال
                                                                کد
                                                                تایید</a>
                                                        </div>
                                                        @error('admin_mobile')
                                                        <small class="text-danger mb-4">{{ $message }}</small><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6" id="admin_inputVerify">
                                                </div>
                                            @else
                                                <input hidden name="admin_mobile" value="{{$user->mobile}}">
                                            @endif
                                            <hr>

                                            {{--                                        <div class="col-xl-4 col-lg-6">--}}
                                            {{--                                            <label class="register-box-label">نام کاربری مدیر کسب و کار</label>--}}
                                            {{--                                            <div class="registerInputBox">--}}
                                            {{--                                                <input dir="auto" type="text" name="admin_userName"--}}
                                            {{--                                                       value="{{old('admin_userName')}}" placeholder="نام کاربری*"><br>--}}
                                            {{--                                                @error('admin_userName')--}}
                                            {{--                                                <small class="text-danger mb-4">{{ $message }}</small><br>--}}
                                            {{--                                                @enderror--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}

                                            <div class="col-xl-4 col-lg-6 copy_slug_html" id="copy_slug_html">
                                                <label class="register-box-label">
                                                    حساب کاربری(ID)</label>
                                                <div class="registerInputBoxMixed">
                                                    <div class="mixedInput admin_slug">
                                                        <input dir="auto" type="text" id="admin_slug"
                                                               placeholder="(آدرس صفحه اختصاصی شما)به انگلیسی درج نمایید"
                                                               value="{{old(('admin_slug'))}}"
                                                               name="admin_slug">
                                                        <a onclick="validateSlug()">تایید حساب
                                                            کاربری</a>
                                                    </div>
                                                    <small class="text-danger mb-4" id="errorSlug"></small><br>
                                                </div>
                                            </div>
                                            {{--                                            <span id="copy_slug_html">--}}

                                            {{--                                            </span>--}}

                                        </div>
                                        <div class="registerBtnBox my-3">
                                            <button class="registerRecBlueBtn">@if($user) ارتقا حساب کاربری @else ثبت
                                                نام @endif</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
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

    function validateSlug() {
        var admin_slug = document.getElementById('admin_slug').value;
        var l = admin_slug.length;
        jQuery.ajax({
                url: "{{route('validate.slug.user')}}",
                data: {
                    'slug': admin_slug,
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.status_code == 403) {
                        $(".remove").remove();
                        $('#errorSlug').empty();
                        $('#errorSlug').append(data.errors);
                    } else {
                        $('#errorSlug').empty();
                        var str = `<div class="col-xl-4 col-lg-6 remove">
                                                <label class="register-box-label">
                                                    آدرس صفحه اختصاصی شما درد {{$title_of_site->str_value}}</label>
                                                <div class="registerInputBoxMixed">
                                                    <div class="mixedInput copy_admin_slug">
                                                        <a onclick="copyText()">کپی<i class="fa fa-copy"></i></a>
                                                        <input dir="auto" type="text" style="opacity: unset;"
                                                               disabled
                                                               id="copyText"
                                                               {{--                                                           placeholder="(آدرس صفحه اختصاصی شما)به انگلیسی درج نمایید"--}}
                        value="dolatsara.com/` + data.slug + `"
                        name="copyText">

             </div>
         </div>
     </div>
     <div
         class="col-xl-4 col-lg-6 d-flex justify-content-center align-items-center text-center remove">
         <br>
         <span style="color: #ddb24f;font-weight: 700;">شما میتوانید این آدرس را روی کارت ویزیت و تبلیغات خود درج نمایید.</span>
     </div>`;
                        var count = document.getElementsByClassName("remove").length
                        if (count < 2) {
                            $(str).insertAfter("#copy_slug_html");
                        }

                    }
                }
            }
        );

    }
</script>
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
@if(old('admin_shop_city'))
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery.ajax({
                url: "{{route('registerBusiness.neighborhoodOld.user')}}",
                data: {
                    'cityId': '{{old('admin_shop_city')}}',
                    'neighborhoodId': '{{old('neighborhood')}}',
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.content) {
                        $('#neighborhoodOld').empty();
                        $('#neighborhoodOld').append(data.content);
                    } else {
                    }
                }
            });
        })
    </script>
@endif

{{--@if(old('category'))--}}
{{--    <script type="text/javascript">--}}
{{--        jQuery(document).ready(function () {--}}
{{--            jQuery.ajax({--}}
{{--                url: "{{route('registerBusiness.subCategoryOld.user')}}",--}}
{{--                data: {--}}
{{--                    'categoryId': '{{old('category')}}',--}}
{{--                    --}}{{--'subCategoryIds': '{{old('subCategory')}}',--}}
{{--                },--}}
{{--                type: "GET",--}}
{{--                dataType: "json",--}}
{{--                success: function (data) {--}}
{{--                    console.log(data)--}}
{{--                    if (data.content) {--}}
{{--                        $('#subCategoryOld').empty();--}}
{{--                        $('#subCategoryOld').append(data.content);--}}
{{--                    } else {--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}
{{--@endif--}}

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
<script src="{{asset('files/adminMaster/plugins/select2/select2.full.min.js')}}"></script>

<script>

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('select[name="category"]').on('change', function () {
            var categoryId = jQuery(this).val();
            if (categoryId) {
                jQuery.ajax({
                    url: "{{route('categories.child.user')}}",
                    data: {
                        'category_id': categoryId
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        jQuery('select[name="subCategory[]"]').empty();
                        jQuery.each(data, function (key, value) {
                            var x = '<option value="' + key + ' ">' + value + '</option>';
                            $('select[name="subCategory[]"]').append(x);

                        });
                    }
                });
            } else {
                $('select[name="subCategory[]"]').empty();
            }
        });
    });
</script>

<script>
    function copyText() {
        /* Get the text field */
        var copyText = document.getElementById("copyText");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        /* Alert the copied text */
        // prompt("Copy to clipboard: Ctrl+C, Enter", copyText.value);

        alert("متن "+copyText.value+" کپی شد. ");
    }
</script>
</body>

</html>

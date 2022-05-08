@extends('UserMasterNew::master')
@section('title_user')ایجاد آگهی
@endsection
@section('css_user')
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/agahi.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/font.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/style.css')}}">--}}
@endsection
@section('content_userMasterNew')
    <div class="agahi-detail">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-3 mb-4">
                    <div class="agahi-detail-tabs">
                        <div class="agahi-detail-tabsHead">
                            <a href="#">ملک خود را آگهی کنید</a>
                        </div>
                        <div class="agahi-detail-navigationTab">
                            <nav>
                                <ul class="tabs">
                                    <li data-content="first-infoform" class="selected">اطلاعات اولیه
                                    </li>
                                    <li data-content="house-info">اطلاعات ملک</li>
                                    <li data-content="house-features">امکانات ملک</li>
                                    <li data-content="finance-featuers">شرایط مالی</li>
                                    <li data-content="ad-gallery">آلبوم تصاویر</li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 mb-4">
                    <form action="" class="form-agahi">
                        <div class="container">
                            <div class="tabContent">
                                <div class="infoform selected" data-content="first-infoform">
                                    <div class="first-info">
                                        <div class="first-info-box">
                                            <div class="row">
                                                <div class="col-lg-6 ">
                                                    <div class="first-info-box-inputs">
                                                        <div>
                                                            <label for="cars">عنوان آگهی</label> <input type="text">
                                                        </div>
                                                        <div>
                                                            <label for="cars">نوع آگهی</label>
                                                            <select name="cars" id="cars" class="full">
                                                                <option value="volvo">اپارتمان</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="opel">Opel</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="cars">نوع ملک </label>
                                                            <select name="cars" id="cars" class="full">
                                                                <option value="volvo">اپارتمان</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="opel">Opel</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="cars"> نوع کاربری</label>
                                                            <select name="cars" id="cars" class="full">
                                                                <option value="volvo">اپارتمان</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="opel">Opel</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="cars"> شهر</label>
                                                            <select name="cars" id="cars" class="full">
                                                                <option value="volvo">اپارتمان</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="opel">Opel</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="cars"> محله</label>
                                                            <select name="cars" id="cars" class="full">
                                                                <option value="volvo">اپارتمان</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="opel">Opel</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                        <div class="box-sidebar">
                                                            <div class="filter-switch">
                                                                <div class="switch-box">
                                                                    <div class="centered hidden-xs">
                                                                        <div class="">
                                                                            <a href="#">
                                                                                <label for="switch2">
                                                                                    <input type="checkbox"
                                                                                           id="switch2"><span
                                                                                        class="switch">
                                                                                        <h1 class="switch-title"> انتشار
                                                                                            فوری
                                                                                            آگهی
                                                                                        </h1>
                                                                                    </span>
                                                                                    <span class="toggle"></span>
                                                                                </label>
                                                                            </a>
                                                                        </div>
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="first-info-box-map">
                                                        <p>
                                                            موقعیت دقیق ملک را مشخص نمایید
                                                        </p>
                                                        <div class="first-info-box-map-show">
                                                            <img src="assets/img/images (14).jpg" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-agahi-btn">
                                            <a href="" class="enseraf">انصراف</a>
                                            <a href="" class="edameh">ادامه</a>
                                        </div>
                                    </div>


                                </div>

                                <div class="infoform" data-content="house-info">

                                    <div class="second-info">
                                        <div class="second-info-box">
                                            <h6>لطفا اطلاعات ملک را وارد نمایید</h6>
                                            <div class="row align-items-center">
                                                @foreach($attributeGroups as $attrGroup)
                                                    @if($attrGroup->attributes->count()>0)

                                                    <div class="col-md-2">
                                                        @foreach($attrGroup->attributes as $attr)
                                                            @if($attr->attribute_type=='bool')

{{--                                                                <div class="second-info-typeofvahed">--}}
                                                                    <p>{{$attrGroup->title}}</p>
{{--                                                                    <div class="row">--}}
{{--                                                                        <div class="col-12">--}}
                                                                            <ul class="ks-cboxtags">
                                                                                <li><input type="checkbox"
                                                                                           id="checkboxOne"
                                                                                           value="Rainbow Dash"><label
                                                                                        for="checkboxOne">{{$attr->title}} </label>
                                                                                </li>
                                                                            </ul>
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}

                                                            @elseif($attr->attribute_type=='select')
                                                                <div class="first-info-box-inputs second-info-input">

                                                                    <div class="row">
                                                                        <div class="col-sm-6 px-4" style="text-align:center">
                                                                            <div>

                                                                                <label class="boldInputLabel" for="cars">نوع
                                                                                    کاربری</label>
                                                                                <select class="selectInputTemp" name="cars"
                                                                                        id="cars">
                                                                                    <option value="volvo">اپارتمان</option>
                                                                                    <option value="saab">Saab</option>
                                                                                    <option value="opel">Opel</option>
                                                                                    <option value="audi">Audi</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 px-4" style="text-align:center">
                                                                            <div>

                                                                                <label class="boldInputLabel" for="cars">شهر</label>
                                                                                <select class="selectInputTemp" name="cars"
                                                                                        id="cars">
                                                                                    <option value="volvo">اپارتمان</option>
                                                                                    <option value="saab">Saab</option>
                                                                                    <option value="opel">Opel</option>
                                                                                    <option value="audi">Audi</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 px-4" style="text-align:center">
                                                                            <div>

                                                                                <label class="boldInputLabel"
                                                                                       for="cars">محله</label>
                                                                                <select class="selectInputTemp" name="cars"
                                                                                        id="cars">
                                                                                    <option value="volvo">اپارتمان</option>
                                                                                    <option value="saab">Saab</option>
                                                                                    <option value="opel">Opel</option>
                                                                                    <option value="audi">Audi</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 px-4" style="text-align:center">
                                                                            <div>

                                                                                <label class="boldInputLabel"
                                                                                       for="cars">محله</label>
                                                                                <select class="selectInputTemp" name="cars"
                                                                                        id="cars">
                                                                                    <option value="volvo">اپارتمان</option>
                                                                                    <option value="saab">Saab</option>
                                                                                    <option value="opel">Opel</option>
                                                                                    <option value="audi">Audi</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @elseif($attr->attribute_type=='int')
                                                                <div class="second-info-second-form">
                                                                    <div class="row">
                                                                        <div class="col-md-4 col-6 mb-4 px-4">
                                                                            <div>
                                                                                <label class="formAgahiLabel" for="cars">
                                                                                    متراژ</label>
                                                                                <input type="text"
                                                                                       class="simpleInput">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($attr->attribute_type=='string')
                                                                <div class="second-info-second-form">
                                                                    <div class="row">
                                                                        <div class="col-md-4 col-6 mb-4 px-4">
                                                                            <div>
                                                                                <label class="formAgahiLabel" for="cars">
                                                                                    متراژ</label>
                                                                                <input type="text"
                                                                                       class="simpleInput">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        @endforeach
                                                    </div>
                                                    <hr>
                                                    @endif

                                                @endforeach
                                            </div>

                                            <div class="form-agahi-btn">
                                                <a href="" class="enseraf">انصراف</a>
                                                <a href="" class="edameh">ادامه</a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="infoform" data-content="house-features">
                                    <div class="second-info third-info">
                                        <div class="second-info-box">
                                            <h6>لطفا اطلاعات مروبط به امکانات ملک را وارد نمایید</h6>
                                            <div class="second-info-typeofvahed">
                                                <p> امکانات ملک</p>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <ul class="ks-cboxtags">
                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxOnea"
                                                                                    value="Rainbow Dasha"><label
                                                                    class="mb-3"
                                                                    for="checkboxOnea">ایفون تصویری </label></li>
                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxTwoa"
                                                                                    value="Cotton Candya"><label
                                                                    class="mb-3"
                                                                    for="checkboxTwoa"> بالکن</label></li>
                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxThreea"
                                                                                    value="Raritya"><label
                                                                    class="mb-3"
                                                                    for="checkboxThreea">پاسیو</label></li>

                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxOneaa"
                                                                                    value="Rainbow Dashaa"><label
                                                                    class="mb-3"
                                                                    for="checkboxOneaa">انتن مرکزی </label></li>
                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxTwoaa"
                                                                                    value="Cotton Candyaa"><label
                                                                    class="mb-3"
                                                                    for="checkboxTwoaa"> کمد دیواری</label></li>
                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxThreeaa"
                                                                                    value="Rarityaa"><label
                                                                    class="mb-3"
                                                                    for="checkboxThreeaa">دوربین مداربسته</label>
                                                            </li>

                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxOneaaa"
                                                                                    value="Rainbow Dashaaa"><label
                                                                    class="mb-3"
                                                                    for="checkboxOneaaa">چاه آب </label></li>
                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxTwoaaa"
                                                                                    value="Cotton Candyaaa"><label
                                                                    class="mb-3"
                                                                    for="checkboxTwoaaa"> انباری</label></li>
                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxThreeaaa"
                                                                                    value="Raritya"><label
                                                                    for="checkboxThreeaaa">سرایدار</label></li>

                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxOneaaaa"
                                                                                    value="Rainbow Dashaaaa"><label
                                                                    class="mb-3"
                                                                    for="checkboxOneaaaa">مبله </label></li>
                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxTwoaaaa"
                                                                                    value="Cotton Candyaaaa"><label
                                                                    class="mb-3"
                                                                    for="checkboxTwoaaaa"> بازسازی شده</label></li>
                                                            <li class="px-1"><input type="checkbox"
                                                                                    id="checkboxThreeaaaa"
                                                                                    value="Rarityaaaa"><label
                                                                    class="mb-3"
                                                                    for="checkboxThreeaaaa">قابله معاوضه</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="second-info-typeofvahed d-flex justify-content-center">
                                                <div>
                                                    <p> تعداد پارکینگ </p>
                                                    <ul class="ks-cboxtags">
                                                        <div>

                                                            <li><input type="checkbox" id="checkboxSixrb"
                                                                       value="Twilight Sparklerb"><label
                                                                    class="px-4"
                                                                    for="checkboxSixrb">3+
                                                                </label></li>
                                                            <li><input type="checkbox" id="checkboxSevenrb"
                                                                       value="Fluttershyrb"><label class="px-4"
                                                                                                   for="checkboxSevenrb">2</label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxEightrb"
                                                                       value="Derpy Hoovesrb"><label class="px-4"
                                                                                                     for="checkboxEightrb">1 </label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxNinerb"
                                                                       value="Princess Celestiarb"><label
                                                                    class="px-4"
                                                                    for="checkboxNinerb">
                                                                    0</label></li>
                                                        </div>

                                                    </ul>
                                                </div>


                                                <div>
                                                    <p> تعداد پارکینگ مهان </p>
                                                    <ul class="ks-cboxtags">
                                                        <div>

                                                            <li><input type="checkbox" id="checkboxSixrb"
                                                                       value="Twilight Sparklerb"><label
                                                                    class="px-4"
                                                                    for="checkboxSixrb">3+
                                                                </label></li>
                                                            <li><input type="checkbox" id="checkboxSevenrb"
                                                                       value="Fluttershyrb"><label class="px-4"
                                                                                                   for="checkboxSevenrb">2</label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxEightrb"
                                                                       value="Derpy Hoovesrb"><label class="px-4"
                                                                                                     for="checkboxEightrb">1 </label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxNinerb"
                                                                       value="Princess Celestiarb"><label
                                                                    class="px-4"
                                                                    for="checkboxNinerb">
                                                                    0</label></li>
                                                        </div>

                                                    </ul>
                                                </div>
                                            </div>


                                            <div class="second-info-typeofvahed d-flex justify-content-center">
                                                <div>
                                                    <p> تعداد اسانسور </p>
                                                    <ul class="ks-cboxtags">
                                                        <div>

                                                            <li><input type="checkbox" id="checkboxSixrbb"
                                                                       value="Twilight Sparklerbb"><label
                                                                    class="px-4"
                                                                    for="checkboxSixrbb">3+
                                                                </label></li>
                                                            <li><input type="checkbox" id="checkboxSevenrbb"
                                                                       value="Fluttershyrbb"><label class="px-4"
                                                                                                    for="checkboxSevenrbb">2</label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxEightrbb"
                                                                       value="Derpy Hoovesrbb"><label class="px-4"
                                                                                                      for="checkboxEightrbb">1 </label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxNinerbb"
                                                                       value="Princess Celestiarbb"><label
                                                                    class="px-4"
                                                                    for="checkboxNinerbb">
                                                                    0</label></li>
                                                        </div>

                                                    </ul>
                                                </div>


                                                <div>
                                                    <p> تعداد اشپزخانه </p>
                                                    <ul class="ks-cboxtags">
                                                        <div>

                                                            <li><input type="checkbox" id="checkboxSixrbbb"
                                                                       value="Twilight Sparklerbbb"><label
                                                                    class="px-4"
                                                                    for="checkboxSixrbbb">3+
                                                                </label></li>
                                                            <li><input type="checkbox" id="checkboxSevenrbbb"
                                                                       value="Fluttershyrbbb"><label class="px-4"
                                                                                                     for="checkboxSevenrbbb">2</label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxEightrbbb"
                                                                       value="Derpy Hoovesrbbb"><label class="px-4"
                                                                                                       for="checkboxEightrbbb">1 </label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxNinerbbb"
                                                                       value="Princess Celestiarbbb"><label
                                                                    class="px-4"
                                                                    for="checkboxNinerbbb">
                                                                    0</label></li>
                                                        </div>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="second-info-typeofvahed d-flex justify-content-center">
                                                <div>
                                                    <p> سرویس ایرانی</p>
                                                    <ul class="ks-cboxtags">
                                                        <div>

                                                            <li><input type="checkbox" id="checkboxSixrbba"
                                                                       value="Twilight Sparklerbba"><label
                                                                    class="px-4"
                                                                    for="checkboxSixrbba">3+
                                                                </label></li>
                                                            <li><input type="checkbox" id="checkboxSevenrbba"
                                                                       value="Fluttershyrbba"><label class="px-4"
                                                                                                     for="checkboxSevenrbba">2</label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxEightrbba"
                                                                       value="Derpy Hoovesrbba"><label class="px-4"
                                                                                                       for="checkboxEightrbba">1 </label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxNinerbba"
                                                                       value="Princess Celestiarbba"><label
                                                                    class="px-4"
                                                                    for="checkboxNinerbba">
                                                                    0</label></li>
                                                        </div>

                                                    </ul>
                                                </div>

                                                <div>
                                                    <p> سرویس فرنگی </p>
                                                    <ul class="ks-cboxtags">
                                                        <div>

                                                            <li><input type="checkbox" id="checkboxSixrbbba"
                                                                       value="Twilight Sparklerbbba"><label
                                                                    class="px-4"
                                                                    for="checkboxSixrbbba">3+
                                                                </label></li>
                                                            <li><input type="checkbox" id="checkboxSevenrbbba"
                                                                       value="Fluttershyrbbba"><label class="px-4"
                                                                                                      for="checkboxSevenrbbba">2</label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxEightrbbba"
                                                                       value="Derpy Hoovesrbbba"><label class="px-4"
                                                                                                        for="checkboxEightrbbba">1 </label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxNinerbbba"
                                                                       value="Princess Celestiarbbba"><label
                                                                    class="px-4"
                                                                    for="checkboxNinerbbba">
                                                                    0</label></li>
                                                        </div>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="second-info-typeofvahed d-flex justify-content-center">
                                                <div>
                                                    <p> تعداد حمام</p>
                                                    <ul class="ks-cboxtags">
                                                        <div>

                                                            <li><input type="checkbox" id="checkboxSixrbbae"
                                                                       value="Twilight Sparklerbbae"><label
                                                                    class="px-4"
                                                                    for="checkboxSixrbbae">3+
                                                                </label></li>
                                                            <li><input type="checkbox" id="checkboxSevenrbbae"
                                                                       value="Fluttershyrbbae"><label class="px-4"
                                                                                                      for="checkboxSevenrbbae">2</label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxEightrbbae"
                                                                       value="Derpy Hoovesrbbae"><label class="px-4"
                                                                                                        for="checkboxEightrbbae">1 </label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxNinerbbae"
                                                                       value="Princess Celestiarbbae"><label
                                                                    class="px-4"
                                                                    for="checkboxNinerbbae">
                                                                    0</label></li>
                                                        </div>

                                                    </ul>
                                                </div>
                                                <div>
                                                    <p> تعداد خط تلفن </p>
                                                    <ul class="ks-cboxtags">
                                                        <div>

                                                            <li><input type="checkbox" id="checkboxSixrbbbae"
                                                                       value="Twilight Sparklerbbbae"><label
                                                                    class="px-4"
                                                                    for="checkboxSixrbbbae">3+
                                                                </label></li>
                                                            <li><input type="checkbox" id="checkboxSevenrbbbae"
                                                                       value="Fluttershyrbbbae"><label class="px-4"
                                                                                                       for="checkboxSevenrbbbae">2</label>
                                                            </li>
                                                            <li><input type="checkbox" id="checkboxEightrbbbae"
                                                                       value="Derpy Hoovesrbbbae"><label
                                                                    class="px-4"
                                                                    for="checkboxEightrbbbae">1 </label></li>
                                                            <li><input type="checkbox" id="checkboxNinerbbbae"
                                                                       value="Princess Celestiarbbbae"><label
                                                                    class="px-4"
                                                                    for="checkboxNinerbbbae">
                                                                    0</label></li>
                                                        </div>

                                                    </ul>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="second-info-typeofvahed">
                                                <p> امکانات ویژه</p>
                                                <ul class="ks-cboxtags">
                                                    <li class="px-1"><input type="checkbox" id="checkboxOneaw"
                                                                            value="Rainbow Dashaw"><label
                                                            class="mb-3"
                                                            for="checkboxOneaw"> لابی </label></li>
                                                    <li class="px-1"><input type="checkbox" id="checkboxTwoaw"
                                                                            value="Cotton Candyaw"><label
                                                            class="mb-3"
                                                            for="checkboxTwoaw"> استخر</label></li>
                                                    <li class="px-1"><input type="checkbox" id="checkboxThreeaw"
                                                                            value="Rarityaw"><label class="mb-3"
                                                                                                    for="checkboxThreeaw">سونا</label>
                                                    </li>

                                                    <li class="px-1"><input type="checkbox" id="checkboxOneaaw"
                                                                            value="Rainbow Dashaaw"><label
                                                            class="mb-3"
                                                            for="checkboxOneaaw"> جکوزی </label></li>
                                                    <li class="px-1"><input type="checkbox" id="checkboxTwoaaw"
                                                                            value="Cotton Candyaaw"><label
                                                            class="mb-3"
                                                            for="checkboxTwoaaw"> وان حمام</label></li>
                                                    <li class="px-1"><input type="checkbox" id="checkboxThreeaaw"
                                                                            value="Rarityaaw"><label class="mb-3"
                                                                                                     for="checkboxThreeaaw">
                                                            روف گاردن</label></li>

                                                    <li class="px-1"><input type="checkbox" id="checkboxOneaaaw"
                                                                            value="Rainbow Dashaaaw"><label
                                                            class="mb-3"
                                                            for="checkboxOneaaaw"> شوتینگ زباله </label></li>
                                                    <li class="px-1"><input type="checkbox" id="checkboxTwoaaaw"
                                                                            value="Cotton Candyaaaw"><label
                                                            class="mb-3"
                                                            for="checkboxTwoaaaw"> اطفا حریق</label></li>
                                                    <li class="px-1"><input type="checkbox" id="checkboxThreeaaaw"
                                                                            value="Rarityaw"><label
                                                            for="checkboxThreeaaaw">برق
                                                            اظطراری</label></li>

                                                    <li class="px-1"><input type="checkbox" id="checkboxOneaaaaw"
                                                                            value="Rainbow Dashaaaaw"><label
                                                            class="mb-3"
                                                            for="checkboxOneaaaaw">سیستم امنیتی </label></li>
                                                    <li class="px-1"><input type="checkbox" id="checkboxTwoaaaaw"
                                                                            value="Cotton Candyaaaaw"><label
                                                            class="mb-3"
                                                            for="checkboxTwoaaaaw"> آلاچیق</label></li>
                                                    <li class="px-1"><input type="checkbox" id="checkboxThreeaaaaw"
                                                                            value="Rarityaaaaw"><label class="mb-3"
                                                                                                       for="checkboxThreeaaaaw">
                                                            سالن اجتماعات</label></li>
                                                </ul>
                                            </div>
                                            <hr>

                                            <div class="second-info-typeofvahed d-flex justify-content-between">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6">
                                                        <div>
                                                            <p> نوع کنتور برق</p>
                                                            <ul class="ks-cboxtags d-flex justify-content-center">


                                                                <li class="px-1"><input type="checkbox"
                                                                                        id="checkboxSixrbbaey"
                                                                                        value="Twilight Sparklerbbaey"><label
                                                                        class="px-3" for="checkboxSixrbbaey">سه فاز
                                                                    </label></li>
                                                                <li class="px-1"><input type="checkbox"
                                                                                        id="checkboxSevenrbbaey"
                                                                                        value="Fluttershyrbbaey"><label
                                                                        class="px-3"
                                                                        for="checkboxSevenrbbaey"> تک فاز</label>
                                                                </li>


                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div>
                                                            <p> نوع کنتور گاز </p>
                                                            <ul class="ks-cboxtags d-flex justify-content-center">


                                                                <li class="px-1"><input type="checkbox"
                                                                                        id="checkboxEightrbbbaet"
                                                                                        value="Derpy Hoovesrbbbaet"><label
                                                                        class="px-3"
                                                                        for="checkboxEightrbbbaet">
                                                                        اشترکی</label></li>
                                                                <li class="px-1"><input type="checkbox"
                                                                                        id="checkboxNinerbbbaet"
                                                                                        value="Princess Celestiarbbbaet"><label
                                                                        class="px-3" for="checkboxNinerbbbaet">
                                                                        اختصاصی </label></li>


                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div>
                                                            <p> نوع کنتور آب</p>
                                                            <ul class="ks-cboxtags d-flex justify-content-center">


                                                                <li class="px-1"><input type="checkbox"
                                                                                        id="checkboxSixrbbbaett"
                                                                                        value="Twilight Sparklerbbbaett"><label
                                                                        class="px-3" for="checkboxSixrbbbaett">اشترکی
                                                                    </label></li>
                                                                <li class="px-1"><input type="checkbox"
                                                                                        id="checkboxSevenrbbbaett"
                                                                                        value="Fluttershyrbbbaett"><label
                                                                        class="px-3"
                                                                        for="checkboxSevenrbbbaett">اختصاصی</label>
                                                                </li>


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="first-info-box-inputs second-info-input"
                                                 style="display: block;">
                                                <div class="row">
                                                    <div class="col-lg-4 col-6 px-2">
                                                        <div>
                                                            <p> نوع کابینت</p>
                                                            <select name="cars" id="cars">
                                                                <option value="volvo">اپارتمان</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="opel">Opel</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-6 px-2">
                                                        <div>
                                                            <p> سیستم گرمایش</p>
                                                            <select name="cars" id="cars">
                                                                <option value="volvo">اپارتمان</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="opel">Opel</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-6 px-2">
                                                        <div>
                                                            <p> سیستم سرمایش</p>
                                                            <select name="cars" id="cars">
                                                                <option value="volvo">اپارتمان</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="opel">Opel</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-agahi-btn">
                                                <a href="" class="enseraf">انصراف</a>
                                                <a href="" class="edameh">ادامه</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="infoform" data-content="finance-featuers">
                                    <div class="first-info">
                                        <div class="first-info-box d-flex justify-content-center">
                                            <div class="first-info-box-inputs d-flex ">
                                                <div>
                                                    <p for="cars" class="my-2"> قیمت کل(ریال)</p> <input
                                                        type="text"
                                                        class="w-75">
                                                </div>
                                                <div>
                                                    <p for="cars" class="my-2">قیمت هر متر مربع(ریال) </p> <input
                                                        type="text" class="w-75">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="second-info-box">
                                            <div class="second-info-typeofvahed">
                                                <p> تعداد دانگ قابل فروش</p>
                                                <ul class="ks-cboxtags">
                                                    <li><input type="checkbox" id="checkboxFourrs"
                                                               value="Moondancerrs"><label for="checkboxFourrs"
                                                                                           class="px-4 mb-2">6</label>
                                                    </li>
                                                    <li><input type="checkbox" id="checkboxFivers"
                                                               value="Surprisers"><label for="checkboxFivers"
                                                                                         class="px-4 mb-2">5/5</label>
                                                    </li>
                                                    <li><input type="checkbox" id="checkboxSixrs"
                                                               value="Twilight Sparklers"><label for="checkboxSixrs"
                                                                                                 class="px-4 mb-2">5
                                                        </label></li>
                                                    <li><input type="checkbox" id="checkboxSevenrss"
                                                               value="Fluttershyrss"><label for="checkboxSevenrss"
                                                                                            class="px-4 mb-2">4/5</label>
                                                    </li>
                                                    <li><input type="checkbox" id="checkboxEightrss"
                                                               value="Derpy Hoovesrss"><label for="checkboxEightrss"
                                                                                              class="px-4 mb-2">4 </label>
                                                    </li>
                                                    <li><input type="checkbox" id="checkboxNinerss"
                                                               value="Princess Celestiarss"><label
                                                            for="checkboxNinerss"
                                                            class="px-4 mb-2">
                                                            3/5</label></li>

                                                    <li><input type="checkbox" id="checkboxFourrsss"
                                                               value="Moondancerrsss"><label for="checkboxFourrsss"
                                                                                             class="px-4 mb-2">3</label>
                                                    </li>
                                                    <li><input type="checkbox" id="checkboxFiversss"
                                                               value="Surprisersss"><label for="checkboxFiversss"
                                                                                           class="px-4 mb-2">2/5</label>
                                                    </li>
                                                    <li><input type="checkbox" id="checkboxSixrsss"
                                                               value="Twilight Sparklersss"><label
                                                            for="checkboxSixrsss"
                                                            class="px-4 mb-2">2
                                                        </label></li>
                                                    <li><input type="checkbox" id="checkboxSevenrssss"
                                                               value="Fluttershyrssss"><label
                                                            for="checkboxSevenrssss"
                                                            class="px-4 mb-2">1/5</label></li>
                                                    <li><input type="checkbox" id="checkboxEightrssss"
                                                               value="Derpy Hoovesrssss"><label
                                                            for="checkboxEightrssss"
                                                            class="px-4 mb-2">1 </label></li>
                                                    <li><input type="checkbox" id="checkboxNinerssss"
                                                               value="Princess Celestiarssss"><label
                                                            for="checkboxNinerssss" class="px-4 mb-2">
                                                            0/5</label></li>
                                                </ul>
                                            </div>
                                            <div class="second-info-typeofvahed">
                                                <p> تعداد مالکین</p>
                                                <ul class="ks-cboxtags">
                                                    <li><input type="checkbox" id="checkboxFourrsssu"
                                                               value="Moondancerrsssu"><label
                                                            for="checkboxFourrsssu"
                                                            class="px-4 mb-2">6+</label></li>
                                                    <li><input type="checkbox" id="checkboxFiversssu"
                                                               value="Surprisersssu"><label for="checkboxFiversssu"
                                                                                            class="px-4 mb-2">5</label>
                                                    </li>
                                                    <li><input type="checkbox" id="checkboxSixrsssu"
                                                               value="Twilight Sparklersssu"><label
                                                            for="checkboxSixrsssu"
                                                            class="px-4 mb-2">4
                                                        </label></li>
                                                    <li><input type="checkbox" id="checkboxSevenrssssu"
                                                               value="Fluttershyrssssu"><label
                                                            for="checkboxSevenrssssu"
                                                            class="px-4 mb-2">3</label></li>
                                                    <li><input type="checkbox" id="checkboxEightrssssu"
                                                               value="Derpy Hoovesrssssu"><label
                                                            for="checkboxEightrssssu"
                                                            class="px-4 mb-2">2 </label></li>
                                                    <li><input type="checkbox" id="checkboxNinerssssu"
                                                               value="Princess Celestiarssssu"><label
                                                            for="checkboxNinerssssu" class="px-4 mb-2">
                                                            1</label></li>
                                                </ul>
                                            </div>
                                            <div
                                                class="first-info-box justify-content-center second-info-typeofvahed">
                                                <div class="first-info-box-inputs d-flex justify-content-center">
                                                    <div>
                                                        <p for="cars" class="my-2"> مقدار قدرالسهم(متر)</p> <input
                                                            type="text" class="w-75">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="second-info-typeofvahed">
                                                <p> وام</p>
                                                <ul class="ks-cboxtags">
                                                    <li><input type="checkbox" id="checkboxFourrrrn"
                                                               value="Moondancerrrrn"><label
                                                            for="checkboxFourrrrn">دارد</label></li>
                                                    <li><input type="checkbox" id="checkboxFiverrrn"
                                                               value="Surpriserrrn"><label
                                                            for="checkboxFiverrrn">ندارد</label></li>
                                                </ul>
                                                <div class="first-info-box ">
                                                    <div
                                                        class="first-info-box-inputs d-flex justify-content-center">
                                                        <div>
                                                            <input type="text" class="w-100"
                                                                   placeholder="مبلغ وام(ریال)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="first-info-box-inputs second-info-input"
                                                 style="text-align: center;">
                                                <div>
                                                    <p> نوع سند</p>
                                                    <select name="cars" id="cars">
                                                        <option value="volvo">اپارتمان</option>
                                                        <option value="saab">آپارتمانی مسکونی</option>
                                                        <option value="opel"> اپارتمان</option>
                                                        <option value="audi">Audi</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div
                                                class="first-info-box  d-flex justify-content-center second-info-typeofvahed">
                                                <div class="first-info-box-inputs d-flex justify-content-center">
                                                    <div>
                                                        <p for="cars" class="my-2"> مبلغ شارژ ماهانه(ریال)</p>
                                                        <input
                                                            type="text" class="w-75">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-agahi-btn">
                                            <a href="" class="enseraf">انصراف</a>
                                            <a href="" class="edameh">ادامه</a>
                                        </div>
                                    </div>


                                </div>
                                <div class="infoform" data-content="ad-gallery">
                                    <div class="img-box second-info">
                                        <h6>لطفا اطلاعات مروبط به امکانات ملک را وارد نمایید</h6>
                                        <div class=" px-3">
                                            <div class="file-input mt-5">
                                                <div>
                                                    <div class="input-file-container">
                                                        <input class="input-filetttt" id="my-filetttt" type="file">
                                                        <label tabindex="0" for="my-filetttt"
                                                               class="input-file-triggertttt"> تصویر اصلی</label>
                                                    </div>
                                                    <p class="file-returntttt"></p>
                                                </div>

                                            </div>
                                            <div class="file-input mt-2">
                                                <div>
                                                    <div class="input-file-container">
                                                        <input class="input-file" id="my-file" type="file">
                                                        <label tabindex="0" for="my-file"
                                                               class="input-file-trigger">
                                                            تصویر فرعی</label>
                                                    </div>
                                                    <p class="file-return"></p>
                                                </div>

                                            </div>
                                            <div class="file-input mt-2">
                                                <div>
                                                    <div class="input-file-container">
                                                        <input class="input-filet" id="my-filet" type="file">
                                                        <label tabindex="0" for="my-filet"
                                                               class="input-file-triggert">
                                                            تصویر فرعی</label>
                                                    </div>
                                                    <p class="file-returnt"></p>
                                                </div>

                                            </div>
                                            <div class="file-input mt-2">
                                                <div>
                                                    <div class="input-file-container">
                                                        <input class="input-filett" id="my-filett" type="file">
                                                        <label tabindex="0" for="my-filett"
                                                               class="input-file-triggertt"> تصویر فرعی</label>
                                                    </div>
                                                    <p class="file-returntt"></p>
                                                </div>

                                            </div>

                                            <div class="file-input mt-2">
                                                <div>
                                                    <div class="input-file-container">
                                                        <input class="input-filettt" id="my-filettt" type="file">
                                                        <label tabindex="0" for="my-filettt"
                                                               class="input-file-triggerttt"> تصویر فرعی</label>
                                                    </div>
                                                    <p class="file-returnttt"></p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_user')
    <script>

        $('.ad-submit-forms').removeClass('selected');
        $('#form-box1').addClass('selected');
        $('#form-box2-cancel-button').click(function (e) {
            e.preventDefault();
            $('.ad-submit-forms').removeClass('selected');
            $('#form-box1').addClass('selected');
            $('.first-infoform-class').addClass('selected');
            $('.house-info-class').removeClass('selected');
            $('.house-info-class').removeClass('selected');
        });
        $('#form-box1-continue-button, #form-box3-cancel-button').click(function (e) {
            e.preventDefault();
            $('.ad-submit-forms').removeClass('selected');
            $('.first-infoform-class').removeClass('selected');
            $('.house-info-class').addClass('selected');
            $('.house-features-class').removeClass('selected');

            $('#form-box2').addClass('selected');
        });

        $('#form-box2-continue-button, #form-box4-cancel-button').click(function (e) {
            e.preventDefault();
            $('.ad-submit-forms').removeClass('selected');
            $('.house-info-class').removeClass('selected');
            $('.house-features-class').addClass('selected');
            $('.finance-featuers-class').removeClass('selected');

            $('#form-box3').addClass('selected');
        });
        $('#form-box3-continue-button, #form-box5-cancel-button').click(function (e) {
            e.preventDefault();
            $('.ad-submit-forms').removeClass('selected');
            $('.house-features-class').removeClass('selected');
            $('.finance-featuers-class').addClass('selected');
            $('.ad-gallery-class').removeClass('selected');

            $('#form-box4').addClass('selected');
        });
        $('#form-box4-continue-button').click(function (e) {
            e.preventDefault();
            $('.ad-submit-forms').removeClass('selected');
            $('.finance-featuers-class').removeClass('selected');
            $('.ad-gallery-class').addClass('selected');
            $('#form-box5').addClass('selected');
        });
    </script>

    <script src="{{asset('files/userMaster/assets/js/script.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"]').on('change', function () {
                var cityId = jQuery(this).val();
                // alert(cityId)
                if (cityId) {
                    // console.log(cityId)
                    jQuery.ajax({
                        url: "{{route('gettingNeighborhood')}}",
                        data: {
                            'city': cityId
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            // console.log(data);
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
@endsection

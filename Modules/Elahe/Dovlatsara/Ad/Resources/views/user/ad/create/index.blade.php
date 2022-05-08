@extends('UserMasterNew::master')
@section('title_user')ایجاد آگهی
@endsection
@section('css_user')
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/agahi.css')}}">
    <link rel="stylesheet" href="{{asset('files/formpage.css')}}">

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
                    <form action="{{route('ad.store.supplier.user', $category->id)}}" method="post" class="form-agahi">
                        @csrf
                        <div class="container">
                            <div class="tabContent">
                                <div class="infoform selected" data-content="first-infoform">
                                    <div class="first-info">
                                        <div class="first-info-box">
                                            <div class="row">
                                                <div class="col-lg-6 ">
                                                    <div class="first-info-box-inputs">
                                                        <div>
                                                            <label>عنوان آگهی</label>
                                                            <input type="text" name="title" value="{{old('title')}}">
                                                        </div>
                                                        <div>
                                                            <label>نوع آگهی</label>
                                                            <select name="type" id="type" class="full">
                                                                <option value=""></option>
                                                                <option value="general"
                                                                        @if('general'==old('type')) selected @endif>عادی</option>
                                                                <option value="scalar"
                                                                        @if('scalar'==old('type')) selected @endif>نردبانی</option>
                                                                <option value="special"
                                                                        @if('special'==old('type')) selected @endif>ویژه</option>
                                                                <option value="emergency"
                                                                        @if('emergency'==old('type')) selected @endif>فوری</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label>شهر</label>
                                                            <select name="city"  class="full">
                                                                <option value=""></option>
                                                                @foreach($cities as $city)
                                                                    <option value="{{$city->id}}"
                                                                    @if($city->id==old('city')) selected @endif>{{$city->title}}</option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label> محله</label>
                                                            <select name="neighborhood" class="full">

                                                            </select>
                                                        </div>
                                                        <div id="paymentCards">
                                                            {!! $content !!}
                                                            {{--                    <div class="row">--}}
                                                            {{--                        <div class="col-md-4 mt-5">--}}
                                                            {{--                            <div class="box-shadow">--}}
                                                            {{--                                قیمت:2500--}}
                                                            {{--                                <div class="d-flex justify-content-end align-content-end ml-2">--}}
                                                            {{--                                    <a class="btn btn-sm btn-outline-dark" id="d" type="button">انتخاب</a>--}}
                                                            {{--                                </div>--}}
                                                            {{--                            </div>--}}
                                                            {{--                        </div>--}}
                                                        </div>
                                                        <small class="text-danger">{{ $errors->first('adPaymentFee') }}</small>

                                                    </div>
{{--                                                        <div class="box-sidebar">--}}
{{--                                                            <div class="filter-switch">--}}
{{--                                                                <div class="switch-box">--}}
{{--                                                                    <div class="centered hidden-xs">--}}
{{--                                                                        <div class="">--}}
{{--                                                                            <a href="#">--}}
{{--                                                                                <label for="switch2">--}}
{{--                                                                                    <input type="checkbox"--}}
{{--                                                                                           id="switch2"><span--}}
{{--                                                                                        class="switch">--}}
{{--                                                                                        <h1 class="switch-title"> انتشار--}}
{{--                                                                                            فوری--}}
{{--                                                                                            آگهی--}}
{{--                                                                                        </h1>--}}
{{--                                                                                    </span>--}}
{{--                                                                                    <span class="toggle"></span>--}}
{{--                                                                                </label>--}}
{{--                                                                            </a>--}}
{{--                                                                        </div>--}}
{{--                                                                        <br>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="first-info-box-map">
                                                        <p>
                                                            موقعیت دقیق ملک را مشخص نمایید
                                                        </p>
                                                        <div class="first-info-box-map-show">
                                                            <img src="{{asset('files/userMaster/assets/img/images (14).jpg')}}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-agahi-btn">
                                            <a href="" class="enseraf" id="form-box1-cancel-button">انصراف</a>
                                            <a href="" class="edameh" id="form-box1-continue-button">ادامه</a>
                                        </div>
                                    </div>


                                </div>

                                <div class="infoform" data-content="house-info">

                                    <div class="first-info">
                                        <h6>لطفا اطلاعات ملک را وارد نمایید</h6>

                                        <div class="row justify-content-center align-items-center">
                                            @foreach($attributeGroups as $attrGroup)
                                                <div class="col-md-12">
                                                    @foreach($attrGroup->attributes as $attr)
                                                        @if($attr->attribute_type=='bool')
{{--                                                            <div class="page__toggle">--}}
{{--                                                                <label class="toggle">--}}
{{--                                                                    <input class="toggle__input" name="attribute[{{$attr->id}}]"--}}
{{--                                                                           type="checkbox" @if(old('attribute.'.$attr->id)=='on')checked @endif>--}}
{{--                                                                    <span class="toggle__label">--}}
{{--                            <span class="toggle__text">{{$attr->title}}</span>--}}
{{--                          </span>--}}
{{--                                                                </label>--}}
{{--                                                            </div>--}}
{{----}}

{{--                                                            <div class="col-12 text-center my-5">--}}
{{--                                                                <div class="boldInputLabel text-center mb-3">--}}
{{--                                                                    <span>نوع واحد </span>--}}
{{--                                                                </div>--}}
                                                                <input class="radio--input full" type="checkbox" name="attribute[{{$attr->id}}]"
{{--                                                                       value="option12"--}}
                                                                       id="tempRadio-12{{$attr->id}}" @if(old('attribute.'.$attr->id)=='on')checked @endif>
                                                                <label class="radio--label full" for="tempRadio-12{{$attr->id}}">

                                                                    {{$attr->title}}
                                                                </label>
{{--                                                                <input class="radio--input full" type="radio" name="tempRadio" value="option13"--}}
{{--                                                                       id="tempRadio-13">--}}
{{--                                                                <label class="radio--label full" for="tempRadio-13">--}}

{{--                                                                    فلت--}}
{{--                                                                </label>--}}
{{--                                                                <input class="radio--input full" type="radio" name="tempRadio" value="option14"--}}
{{--                                                                       id="tempRadio-14">--}}
{{--                                                                <label class="radio--label  full" for="tempRadio-14">--}}

{{--                                                                    سوبلکس--}}
{{--                                                                </label>--}}
{{--                                                                <input class="radio--input full" type="radio" name="tempRadio" value="option15"--}}
{{--                                                                       id="tempRadio-15">--}}
{{--                                                                <label class="radio--label full" for="tempRadio-15">--}}

{{--                                                                    سوبلکس--}}
{{--                                                                </label>--}}
{{--                                                                <input class="radio--input full" type="radio" name="tempRadio" value="option16"--}}
{{--                                                                       id="tempRadio-16">--}}
{{--                                                                <label class="radio--label full" for="tempRadio-16">--}}

{{--                                                                    سوبلکس--}}
{{--                                                                </label>--}}
{{--                                                                <input class="radio--input full" type="radio" name="tempRadio" value="option17"--}}
{{--                                                                       id="tempRadio-17">--}}
{{--                                                                <label class="radio--label full" for="tempRadio-17">--}}

{{--                                                                    سوبلکس--}}
{{--                                                                </label>--}}

{{--                                                            </div>--}}
{{--                                                            <div class="d-flex flex-column align-items-center">--}}
{{--                                                                <ul class="ks-cboxtags">--}}
{{--                                                                    <li><input type="checkbox" id="checkboxOne" name="attribute[{{$attr->id}}]"--}}
{{--                                                                               @if(old('attribute.'.$attr->id)=='on')checked @endif><label--}}
{{--                                                                            for="checkboxOne">{{$attr->title}}</label>--}}
{{--                                                                    </li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
                                                        @elseif($attr->attribute_type=='select')
                                                            @if($attr->input_type=='checkbox')

                                                                {{--                                                        <div class="col-16 text-center my-5">--}}
                                                                <div class="boldInputLabel text-center mb-3">
                                                                    <span>{{$attr->title}} </span>
                                                                </div>
                                                                @foreach($attr->attributeItems as $item)

                                                                    <input class="radio--input half" type="radio" name="attribute[{{$attr->id}}]"
                                                                           value="{{$item->id}}" id="tempRadio-1{{$item->id}}">
                                                                    <label class="radio--label half" for="tempRadio-1{{$item->id}}">

                                                                        {{$item->title}}
                                                                    </label>
                                                                @endforeach


                                                </div>
                                                @elseif($attr->input_type=='select')
                                                    {{--                                                    <div class="col-md-6 col-6 mb-4 ">--}}


                                                    <label class="boldInputLabel">{{$attr->title}}</label>
                                                    <select class="selectInputTemp " name="attribute[{{$attr->id}}]">
                                                        @foreach($attr->attributeItems as $item)
                                                            <option
                                                                value="{{$item->id}}"
                                                                {{$item->id==old('attribute.'.$attr->id)?'selected':''}}>
                                                                {{$item->title}}</option>
                                                        @endforeach
                                                    </select>


                                                    {{--                                                    </div>--}}

                                                @endif
                                                @elseif($attr->attribute_type=='int')
                                                    {{--                                                <div class="col-md-4 col-6 mb-4 ">--}}
                                                <div class="d-flex flex-column">
                                                    <label class="formAgahiLabel">{{$attr->title}}</label>
                                                    <input type="text" class="simpleInput" name="attribute[{{$attr->id}}]"
                                                           onkeyup="separateNum(this.value,this);"
                                                           value="{{old('attribute.'.$attr->id)}}">
                                                </div>
                                                    {{--                                                </div>--}}

                                                @elseif($attr->attribute_type=='string')
                                                    {{--                                                <div class="col-md-4 col-6 mb-4 ">--}}
                                                    <div class="d-flex flex-column">

                                                    <label class="formAgahiLabel">{{$attr->title}}</label>
                                                    <input type="text" class="simpleInput" name="attribute[{{$attr->id}}]"
                                                           value="{{old('attribute.'.$attr->id)}}">
                                                    </div>
                                                    {{--                                                </div>--}}
                                                @elseif($attr->attribute_type=='description')
                                                    {{--                                                <div class="col-md-4 col-6 mb-4 ">--}}

                                                    <label class="formAgahiLabel">{{$attr->title}}</label>
                                                    <textarea type="text"  name="attribute[{{$attr->id}}]" cols="10" rows="5"
                                                    >{{old('attribute.'.$attr->id)}}</textarea>

                                                    {{--                                                </div>--}}
                                                @endif
                                            @endforeach


                                            @endforeach
                                        </div>
                                        <div class="form-agahi-btn">
                                            <a href="" class="enseraf">انصراف</a>
                                            <button type="submit" class="edameh" >ثبت</button>
                                        </div>
                                    </div>

                                </div>
{{--                                <div class="infoform" data-content="house-features">--}}
{{--                                    <div class="s-info">--}}
{{--                                        <h6>لطفا امکانات ملک را وارد نمایید</h6>--}}

{{--                                        <div class="row justify-content-center align-items-center">--}}
{{--                                            @foreach($attributeGroups as $attrGroup)--}}
{{--                                                <div class="col-md-12">--}}
{{--                                                    @foreach($attrGroup->attributes as $attr)--}}
{{--                                                        @if($attr->attribute_type=='bool')--}}
{{--                                                            <div class="d-flex flex-column align-items-center">--}}
{{--                                                                <label class="formAgahiLabel">{{$attrGroup->title}}</label>--}}
{{--                                                                <ul class="ks-cboxtags">--}}
{{--                                                                    <li><input type="checkbox" id="checkboxOne" name="attribute[{{$attr->id}}]"--}}
{{--                                                                               @if(old('attribute.'.$attr->id)=='on')checked @endif><label--}}
{{--                                                                            for="checkboxOne">{{$attr->title}}</label>--}}
{{--                                                                    </li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        @elseif($attr->attribute_type=='select')--}}
{{--                                                            @if($attr->input_type=='checkBox')--}}

{{--                                                                --}}{{--                                                        <div class="col-16 text-center my-5">--}}
{{--                                                                <div class="boldInputLabel text-center mb-3">--}}
{{--                                                                    <span>{{$attr->title}} </span>--}}
{{--                                                                </div>--}}
{{--                                                                @foreach($attr->attributeItems as $item)--}}

{{--                                                                    <input class="radio--input half" type="radio" name="attribute[{{$attribute->id}}]"--}}
{{--                                                                           value="{{$item->id}}" id="tempRadio-1">--}}
{{--                                                                    <label class="radio--label half" for="tempRadio-1">--}}

{{--                                                                        {{$item->title}}--}}
{{--                                                                    </label>--}}
{{--                                                                @endforeach--}}
{{--                                                                <input class="radio--input half" type="radio" name="tempRadio" value="option2"--}}
{{--                                                                       id="tempRadio-2">--}}
{{--                                                                <label class="radio--label half" for="tempRadio-2">--}}

{{--                                                                    فلت--}}
{{--                                                                </label>--}}
{{--                                                                <input class="radio--input half" type="radio" name="tempRadio" value="option3"--}}
{{--                                                                       id="tempRadio-3">--}}
{{--                                                                <label class="radio--label half" for="tempRadio-3">--}}

{{--                                                                    سوبلکس--}}
{{--                                                                </label>--}}


{{--                                                </div>--}}
{{--                                                @elseif($attr->input_type=='select')--}}
{{--                                                    --}}{{--                                                    <div class="col-md-6 col-6 mb-4 ">--}}


{{--                                                    <label class="boldInputLabel">{{$attr->title}}</label>--}}
{{--                                                    <select class="selectInputTemp " name="attribute[{{$attr->id}}]">--}}
{{--                                                        @foreach($attr->attributeItems as $item)--}}
{{--                                                            <option--}}
{{--                                                                value="{{$item->id}}"--}}
{{--                                                                {{$item->id==old('attribute.'.$attr->id)?'selected':''}}>--}}
{{--                                                                {{$item->title}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}


{{--                                                    --}}{{--                                                    </div>--}}

{{--                                                @endif--}}
{{--                                                @elseif($attr->attribute_type=='int')--}}
{{--                                                    --}}{{--                                                <div class="col-md-4 col-6 mb-4 ">--}}

{{--                                                    <label class="formAgahiLabel">{{$attr->title}}</label>--}}
{{--                                                    <input type="text" class="simpleInput" name="attribute[{{$attr->id}}]"--}}
{{--                                                           onkeyup="separateNum(this.value,this);"--}}
{{--                                                           value="{{old('attribute.'.$attr->id)}}">--}}

{{--                                                    --}}{{--                                                </div>--}}

{{--                                                @elseif($attr->attribute_type=='string')--}}
{{--                                                    --}}{{--                                                <div class="col-md-4 col-6 mb-4 ">--}}

{{--                                                    <label class="formAgahiLabel">{{$attr->title}}</label>--}}
{{--                                                    <input type="text" class="simpleInput" name="attribute[{{$attr->id}}]"--}}
{{--                                                           value="{{old('attribute.'.$attr->id)}}">--}}

{{--                                                    --}}{{--                                                </div>--}}
{{--                                                @elseif($attr->attribute_type=='description')--}}
{{--                                                    --}}{{--                                                <div class="col-md-4 col-6 mb-4 ">--}}

{{--                                                    <label class="formAgahiLabel">{{$attr->title}}</label>--}}
{{--                                                    <textarea type="text"  name="attribute[{{$attr->id}}]" cols="10" rows="5"--}}
{{--                                                    >{{old('attribute.'.$attr->id)}}</textarea>--}}

{{--                                                    --}}{{--                                                </div>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}


{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                        <div class="form-agahi-btn">--}}
{{--                                            <a href="" class="enseraf" id="form-box3-cancel-button">انصراف</a>--}}
{{--                                            <a href="" class="edameh" id="form-box3-continue-button">ادامه</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                <div class="infoform" data-content="finance-featuers">--}}
{{--                                    <div class="first-info">--}}
{{--                                        <h6>لطفا اطلاعات ملک را وارد نمایید</h6>--}}

{{--                                        <div class="row justify-content-center align-items-center">--}}
{{--                                            @foreach($attributeGroups as $attrGroup)--}}
{{--                                                <div class="col-md-12">--}}
{{--                                                    @foreach($attrGroup->attributes as $attr)--}}
{{--                                                        @if($attr->attribute_type=='bool')--}}
{{--                                                            <div class="d-flex flex-column align-items-center">--}}
{{--                                                                <label class="formAgahiLabel">{{$attrGroup->title}}</label>--}}
{{--                                                                <ul class="ks-cboxtags">--}}
{{--                                                                    <li><input type="checkbox" id="checkboxOne" name="attribute[{{$attr->id}}]"--}}
{{--                                                                               @if(old('attribute.'.$attr->id)=='on')checked @endif><label--}}
{{--                                                                            for="checkboxOne">{{$attr->title}}</label>--}}
{{--                                                                    </li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        @elseif($attr->attribute_type=='select')--}}
{{--                                                            @if($attr->input_type=='checkBox')--}}

{{--                                                                --}}{{--                                                        <div class="col-16 text-center my-5">--}}
{{--                                                                <div class="boldInputLabel text-center mb-3">--}}
{{--                                                                    <span>{{$attr->title}} </span>--}}
{{--                                                                </div>--}}
{{--                                                                @foreach($attr->attributeItems as $item)--}}

{{--                                                                    <input class="radio--input half" type="radio" name="attribute[{{$attribute->id}}]"--}}
{{--                                                                           value="{{$item->id}}" id="tempRadio-1">--}}
{{--                                                                    <label class="radio--label half" for="tempRadio-1">--}}

{{--                                                                        {{$item->title}}--}}
{{--                                                                    </label>--}}
{{--                                                                @endforeach--}}
{{--                                                                <input class="radio--input half" type="radio" name="tempRadio" value="option2"--}}
{{--                                                                       id="tempRadio-2">--}}
{{--                                                                <label class="radio--label half" for="tempRadio-2">--}}

{{--                                                                    فلت--}}
{{--                                                                </label>--}}
{{--                                                                <input class="radio--input half" type="radio" name="tempRadio" value="option3"--}}
{{--                                                                       id="tempRadio-3">--}}
{{--                                                                <label class="radio--label half" for="tempRadio-3">--}}

{{--                                                                    سوبلکس--}}
{{--                                                                </label>--}}


{{--                                                </div>--}}
{{--                                                @elseif($attr->input_type=='select')--}}
{{--                                                    --}}{{--                                                    <div class="col-md-6 col-6 mb-4 ">--}}


{{--                                                    <label class="boldInputLabel">{{$attr->title}}</label>--}}
{{--                                                    <select class="selectInputTemp " name="attribute[{{$attr->id}}]">--}}
{{--                                                        @foreach($attr->attributeItems as $item)--}}
{{--                                                            <option--}}
{{--                                                                value="{{$item->id}}"--}}
{{--                                                                {{$item->id==old('attribute.'.$attr->id)?'selected':''}}>--}}
{{--                                                                {{$item->title}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}


{{--                                                    --}}{{--                                                    </div>--}}

{{--                                                @endif--}}
{{--                                                @elseif($attr->attribute_type=='int')--}}
{{--                                                    --}}{{--                                                <div class="col-md-4 col-6 mb-4 ">--}}

{{--                                                    <label class="formAgahiLabel">{{$attr->title}}</label>--}}
{{--                                                    <input type="text" class="simpleInput" name="attribute[{{$attr->id}}]"--}}
{{--                                                           onkeyup="separateNum(this.value,this);"--}}
{{--                                                           value="{{old('attribute.'.$attr->id)}}">--}}

{{--                                                    --}}{{--                                                </div>--}}

{{--                                                @elseif($attr->attribute_type=='string')--}}
{{--                                                    --}}{{--                                                <div class="col-md-4 col-6 mb-4 ">--}}

{{--                                                    <label class="formAgahiLabel">{{$attr->title}}</label>--}}
{{--                                                    <input type="text" class="simpleInput" name="attribute[{{$attr->id}}]"--}}
{{--                                                           value="{{old('attribute.'.$attr->id)}}">--}}

{{--                                                    --}}{{--                                                </div>--}}
{{--                                                @elseif($attr->attribute_type=='description')--}}
{{--                                                    --}}{{--                                                <div class="col-md-4 col-6 mb-4 ">--}}

{{--                                                    <label class="formAgahiLabel">{{$attr->title}}</label>--}}
{{--                                                    <textarea type="text"  name="attribute[{{$attr->id}}]" cols="10" rows="5"--}}
{{--                                                    >{{old('attribute.'.$attr->id)}}</textarea>--}}

{{--                                                    --}}{{--                                                </div>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}


{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                        <div class="form-agahi-btn">--}}
{{--                                            <a href="" class="enseraf" id="form-box4-cancel-button">انصراف</a>--}}
{{--                                            <a href="" class="edameh" id="form-box4-continue-button">ادامه</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                <div class="infoform" data-content="ad-gallery">--}}
{{--                                    <div class="img-box second-info">--}}
{{--                                        <h6>لطفا اطلاعات مروبط به امکانات ملک را وارد نمایید</h6>--}}
{{--                                        <div class=" px-3">--}}
{{--                                            <div class="file-input mt-5">--}}
{{--                                                <div>--}}
{{--                                                    <div class="input-file-container">--}}
{{--                                                        <input class="input-filetttt" id="my-filetttt" type="file">--}}
{{--                                                        <label tabindex="0" for="my-filetttt"--}}
{{--                                                               class="input-file-triggertttt"> تصویر اصلی</label>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="file-returntttt"></p>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                            <div class="file-input mt-2">--}}
{{--                                                <div>--}}
{{--                                                    <div class="input-file-container">--}}
{{--                                                        <input class="input-file" id="my-file" type="file">--}}
{{--                                                        <label tabindex="0" for="my-file" class="input-file-trigger">--}}
{{--                                                            تصویر فرعی</label>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="file-return"></p>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                            <div class="file-input mt-2">--}}
{{--                                                <div>--}}
{{--                                                    <div class="input-file-container">--}}
{{--                                                        <input class="input-filet" id="my-filet" type="file">--}}
{{--                                                        <label tabindex="0" for="my-filet" class="input-file-triggert">--}}
{{--                                                            تصویر فرعی</label>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="file-returnt"></p>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                            <div class="file-input mt-2">--}}
{{--                                                <div>--}}
{{--                                                    <div class="input-file-container">--}}
{{--                                                        <input class="input-filett" id="my-filett" type="file">--}}
{{--                                                        <label tabindex="0" for="my-filett"--}}
{{--                                                               class="input-file-triggertt"> تصویر فرعی</label>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="file-returntt"></p>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}

{{--                                            <div class="file-input mt-2">--}}
{{--                                                <div>--}}
{{--                                                    <div class="input-file-container">--}}
{{--                                                        <input class="input-filettt" id="my-filettt" type="file">--}}
{{--                                                        <label tabindex="0" for="my-filettt"--}}
{{--                                                               class="input-file-triggerttt"> تصویر فرعی</label>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="file-returnttt"></p>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                        <div class="form-agahi-btn">--}}
{{--                                            <a href="" class="enseraf" id="form-box5-cancel-button">انصراف</a>--}}
{{--                                            <a href="" class="edameh" id="form-box5-continue-button">ادامه</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

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
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('select[id="type"]').on('change', function () {
            var type = jQuery('select[name="type"]').val();
            // console.log(adType)
            jQuery.ajax({
                url: "{{route('checkAdFee.user')}}",
                data: {
                    'cat_id': '{{$category->id}}',
                    'user_id': '{{\Illuminate\Support\Facades\Auth::id()}}',
                    'type': type,
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.content) {
                        console.log(data.content)

                        $('#paymentCards').empty();
                        $('#paymentCards').append(data.content);
                        // console.log('1')
                        {{--window.location.href = "{{route('find.cats', 2)}}"--}}
                    } else {
                        // console.log('2')
                        // $(document).ready(function () {
                        //     $('#supplier').find('[name="mobile"]').val(mobile);
                        //     $('#id01').modal('show');
                        //     $(function () {
                        //         $('[data-toggle="tooltip"]').tooltip()
                        //     })
                        // });
                    }
                }
            });
        });
    });
</script>
@endsection
<div class="first-info">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12 col-6 mb-4 ">
            <div class="d-flex flex-column align-items-center">
                <label class="formAgahiLabel"> نوع واحد</label>
                <ul class="ks-cboxtags">
                    <li><input type="checkbox" id="checkboxOne" value="Rainbow Dash"><label
                            for="checkboxOne">فلت </label>
                    </li>
                    <li><input type="checkbox" id="checkboxTwo" value="Cotton Candy"><label
                            for="checkboxTwo">
                            دوبلکس</label></li>
                    <li><input type="checkbox" id="checkboxThree" value="Rarity"><label
                            for="checkboxThree">تریپلکس</label></li>

                </ul>
            </div>
        </div>
        <div class="col-md-4 col-6 mb-4 ">

            <label class="formAgahiLabel" for="cars"> متراژ</label>
            <input type="text" class="simpleInput">

        </div>
        <div class="col-md-4 col-6 mb-4 ">

            <label class="formAgahiLabel" for="cars"> متراژ</label>
            <input type="text" class="simpleInput">

        </div>
        <div class="col-md-4 col-6 mb-4 ">

            <label class="formAgahiLabel" for="cars"> متراژ</label>
            <input type="text" class="simpleInput">

        </div>
        <div class="col-md-6 col-6 mb-4 ">

            <label class="formAgahiLabel" for="cars"> متراژ</label>
            <input type="text" class="simpleInput">

        </div>
        <div class="col-md-6 col-6 mb-4 ">

            <label class="formAgahiLabel" for="cars"> متراژ</label>
            <input type="text" class="simpleInput">

        </div>
        <div class="col-12 text-center my-5">
            <div class="boldInputLabel text-center mb-3">
                <span>تعداد خواب</span>
            </div>
            <input class="radio--input half" type="radio" name="tempRadio" value="option1"
                   id="tempRadio-1">
            <label class="radio--label half" for="tempRadio-1">

                0
            </label>
            <input class="radio--input half" type="radio" name="tempRadio" value="option2"
                   id="tempRadio-2">
            <label class="radio--label half" for="tempRadio-2">

                1
            </label>
            <input class="radio--input half" type="radio" name="tempRadio" value="option3"
                   id="tempRadio-3">
            <label class="radio--label half" for="tempRadio-3">

                2
            </label>
            <input class="radio--input half" type="radio" name="tempRadio" value="option4"
                   id="tempRadio-4">
            <label class="radio--label half" for="tempRadio-4">

                3
            </label>
            <input class="radio--input half" type="radio" name="tempRadio" value="option5"
                   id="tempRadio-5">
            <label class="radio--label half" for="tempRadio-5">

                4
            </label>
            <input class="radio--input half" type="radio" name="tempRadio" value="option6"
                   id="tempRadio-6">
            <label class="radio--label half" for="tempRadio-6">

                5+
            </label>




        </div>
        <div class="col-md-4 col-6 mb-4 ">

            <label class="formAgahiLabel" for="cars"> طبقه</label>
            <input type="text" class="simpleInput">

        </div>
        <div class="col-md-4 col-6 mb-4 ">

            <label class="formAgahiLabel" for="cars"> تعداد طبقات</label>
            <input type="text" class="simpleInput">

        </div>
        <div class="col-md-4 col-6 mb-4 ">

            <label class="formAgahiLabel" for="cars"> واحد در طبقات</label>
            <input type="text" class="simpleInput">

        </div>
        <div class="col-12 text-center my-5">
            <div class="boldInputLabel text-center mb-3">
                <span>موقعیت جغرافیایی</span>
            </div>
            <input class="radio--input half" type="radio" name="tempRadio" value="option7"
                   id="tempRadio-7">
            <label class="radio--label half" for="tempRadio-7">

                شمال
            </label>
            <input class="radio--input half" type="radio" name="tempRadio" value="option8"
                   id="tempRadio-8">
            <label class="radio--label half" for="tempRadio-8">

                شرق
            </label>
            <input class="radio--input half" type="radio" name="tempRadio" value="option9"
                   id="tempRadio-9">
            <label class="radio--label half" for="tempRadio-9">

                غرب
            </label>
            <input class="radio--input half" type="radio" name="tempRadio" value="option10"
                   id="tempRadio-10">
            <label class="radio--label half" for="tempRadio-10">

                جنوب
            </label>
        </div>
        <div class="col-md-12 col-6 mb-4 ">
            <div class="d-flex flex-column align-items-center">
                <label class="formAgahiLabel"> نوع سازه</label>
                <ul class="ks-cboxtags">
                    <li><input type="checkbox" id="checkboxFour" value="Rainbow Dash"><label
                            for="checkboxFour">بتن </label>
                    </li>
                    <li><input type="checkbox" id="checkboxFive" value="Cotton Candy"><label
                            for="checkboxFive">
                            پیچ مهره</label></li>
                    <li><input type="checkbox" id="checkboxSix" value="Rarity"><label
                            for="checkboxSix">فلزی</label></li>

                </ul>
            </div>
        </div>
        <div class="col-md-4 col-6 mb-4 ">
            <div class="text-center">
                <label class="boldInputLabel" for="cars" id="exampleFormControlSelect1">محله</label>
                <select class="selectInputTemp " name="cars" id="cars">
                    <option value="volvo">اپارتمان</option>
                    <option value="saab">Saab</option>
                    <option value="opel">Opel</option>
                    <option value="audi">Audi</option>
                </select>
            </div>


        </div>
        <div class="col-md-4 col-6 mb-4 ">
            <div class="text-center">
                <label class="boldInputLabel" for="cars">محله</label>
                <select class="selectInputTemp " name="cars" id="cars">
                    <option value="volvo">اپارتمان</option>
                    <option value="saab">Saab</option>
                    <option value="opel">Opel</option>
                    <option value="audi">Audi</option>
                </select>
            </div>

        </div>
        <div class="col-md-4 col-6 mb-4 ">
            <div class="text-center">
                <label class="boldInputLabel" for="cars">محله</label>
                <select class="selectInputTemp" name="cars" id="cars">
                    <option value="volvo">اپارتمان</option>
                    <option value="saab">Saab</option>
                    <option value="opel">Opel</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 col-6 mb-4 ">
            <div class="text-center">
                <label class="boldInputLabel" for="cars">محله</label>
                <select class="selectInputTemp" name="cars" id="cars">
                    <option value="volvo">اپارتمان</option>
                    <option value="saab">Saab</option>
                    <option value="opel">Opel</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 col-6 mb-4 ">
            <div class="text-center">
                <label class="boldInputLabel" for="sth1">متن</label>
                <textarea name="sth" id="sth1"  rows="10"></textarea>
            </div>
        </div>
        <div class="form-agahi-btn">
            <button type="submit" class="enseraf">انصراف</button>
                <button type="submit" class="edameh">ادامه</button>
        </div>

    </div>
</div>

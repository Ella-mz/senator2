@extends('UserMasterNew::master')
@section('title_user')ایجاد آگهی
@endsection
@section('css_user')
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/agahi.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('files/formpage.css')}}">--}}

    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"--}}
    {{--          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
    {{--    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"--}}
    {{--          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="--}}
    {{--          crossorigin=""/>--}}

    {{--    <!-- Javascript -->--}}
    {{--    <script src2="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"--}}
    {{--            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"--}}
    {{--            crossorigin="anonymous"></script>--}}
    {{--    <script src2="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"--}}
    {{--            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="--}}
    {{--            crossorigin=""></script>--}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin="" />
    <style>
        #mapid {
            height: 280px;
        }
    </style>
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
                                    <li data-content="first-infoform" class="first-infoform-class selected">اطلاعات
                                        اولیه
                                    </li>
                                    <li data-content="house-info" class="house-info-class">اطلاعات ملک</li>
                                    <li data-content="house-features" class="house-features-class">امکانات ملک</li>
                                    <li data-content="finance-featuers" class="finance-featuers-class">شرایط مالی</li>
                                    <li data-content="ad-gallery" class="ad-gallery-class">آلبوم تصاویر</li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 mb-4">
                    <div class="polyganBg">
                        <form action="{{route('ad.store.supplier.user', $category->id)}}" method="post"
                              class="form-agahi" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="tabContent">
                                    <div class="infoform ad-submit-forms" id="form-box1" data-content="first-infoform">
                                        @if($errors->count()>0)
                                            <div class="alert alert-danger ">
                                                @foreach($errors->all() as $error)
                                                    {{ $error}}<br>

                                                @endforeach
                                            </div>
                                        @endif
                                        @if(session()->has('message3'))
                                            <div class="alert alert-danger "
                                                 style="color:darkred">{{ session()->get('message3') }}</div>
                                        @endif
                                        @if(session()->has('message2'))
                                            <div class="alert alert-danger "
                                                 style="color:darkred">{{ session()->get('message2') }}</div>
                                        @endif
                                        {{--                                    <small class="text-danger">{{ $errors->first('title') }}</small>--}}
                                        {{--                                    <small class="text-danger">{{ $errors->first('type') }}</small>--}}

                                        <div class="first-info">
                                            <div class="first-info-box">
                                                <div class="row">
                                                    <div class="col-lg-6 ">
                                                        <div class="first-info-box-inputs">

                                                            <div>
                                                                <label for="cars">عنوان آگهی</label>
                                                                <input type="text" name="title"
                                                                       value="{{old('title')}}">

                                                            </div>
                                                            <div>
                                                                <label for="cars">نوع آگهی</label>
                                                                <select name="adType" id="adType" class="full">
                                                                    <option value=""></option>
                                                                    <option value="general"
                                                                            @if('general'==old('adType')) selected @endif>
                                                                        عادی
                                                                    </option>
                                                                    <option value="scalar"
                                                                            @if('scalar'==old('adType')) selected @endif>
                                                                        نردبانی
                                                                    </option>
                                                                    <option value="special"
                                                                            @if('special'==old('adType')) selected @endif>
                                                                        ویژه
                                                                    </option>
                                                                    <option value="emergency"
                                                                            @if('emergency'==old('adType')) selected @endif>
                                                                        فوری
                                                                    </option>
                                                                </select>

                                                            </div>
                                                            <div>
                                                                <label for="cars">شهر </label>
                                                                <select name="city" class="full">
                                                                    <option value=""></option>
                                                                    @foreach($cities as $city)
                                                                        <option value="{{$city->id}}"
                                                                                @if($city->id==old('city')) selected @endif>{{$city->title}}</option>

                                                                    @endforeach
                                                                </select>
                                                                {{--                                                            <small--}}
                                                                {{--                                                                class="text-danger">{{ $errors->first('city') }}</small>--}}
                                                            </div>
                                                            <div>
                                                                <label> محله</label>
                                                                <select name="neighborhood" class="full">

                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label>نشانی</label>
                                                                <input type="text" name="address"
                                                                       value="{{old('address')}}">
                                                                {{--                                                            <small--}}
                                                                {{--                                                                class="text-danger">{{ $errors->first('address') }}</small>--}}

                                                            </div>
                                                            <div id="paymentCards">
                                                                {!! $content !!}
                                                            </div>
                                                            {{--                                                        <small--}}
                                                            {{--                                                            class="text-danger">{{ $errors->first('adPaymentFee') }}</small>--}}

                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="first-info-box-map text-center">
                                                            <p>
                                                                موقعیت دقیق ملک را مشخص نمایید
                                                            </p>
                                                            <div class="first-info-box-map-show">
                                                                <!-- <img src2="assets/img/images (14).jpg" alt=""> -->
                                                                <div
                                                                    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                                                                    <div
                                                                        class="row justify-content-center align-item-center">

                                                                        <div id="mapid"></div>

                                                                    </div>


                                                                    <div class="card-body">
                                                                        <div class="col-md-12">
                                                                            <input name="latt" id="lat" hidden>
                                                                            <input name="longg" id="lng" hidden>
                                                                            {{--                                                                        <input type="hidden" id="lat" value=""--}}
                                                                            {{--                                                                               name="lat" />--}}
                                                                            {{--                                                                        <input type="hidden" id="lng" value=""--}}
                                                                            {{--                                                                               name="lng" />--}}
                                                                        </div>
                                                                    </div>

                                                                    {{--                                                                <button type="submit"--}}
                                                                    {{--                                                                        class="btn btn-success float-right">ثبت--}}
                                                                    {{--                                                                    موقعیت</button>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-agahi-btn">
                                                <button type="submit" class="enseraf">انصراف</button>
                                                <a type="submit" class="edameh" id="form-box1-continue-button">ادامه</a>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="infoform ad-submit-forms" id="form-box2" data-content="house-info">
                                        <div class="first-info">
                                            @foreach($attributeGroups->where('type', 'estate-information') as $attrGroup)
                                                <div class="row justify-content-center align-items-center">
                                                    @if($attrGroup->hidden==0)
                                                    <h5 class="formAgahiLabel boldInputLabel"
                                                        style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                    @endif
                                                    @foreach($attrGroup->attributes as $attr)
                                                        <div
                                                            class="col-md-{{$attrGroup->numberOfColumnsForDisplay}} col-6 mb-4 ">
                                                            @if($attr->attribute_type=='bool')
                                                                <div class="d-flex flex-column align-items-center">

                                                                    <ul class="ks-cboxtags">
                                                                        <li><input type="checkbox"
                                                                                   id="checkboxOne{{$attr->id}}"
                                                                                   name="attribute[{{$attr->id}}]"
                                                                                   @if(old('attribute.'.$attr->id)=='on')checked @endif><label
                                                                                for="checkboxOne{{$attr->id}}">{{$attr->title}}  </label>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @elseif($attr->attribute_type=='select')
                                                                @if($attr->input_type=='checkbox')
                                                                    <div class="boldInputLabel text-center mb-3">
                                                                        <span>{{$attr->title}}</span>
                                                                    </div>
                                                                    <div class="text-center">
                                                                        <input class="radio--input half" type="radio"
                                                                               name="attribute[{{$attr->id}}]"
                                                                               value="" hidden
                                                                               checked
                                                                        >
                                                                        @foreach($attr->attributeItems as $item)

                                                                            <input class="radio--input half"
                                                                                   type="radio"
                                                                                   name="attribute[{{$attr->id}}]"
                                                                                   value="{{$item->id}}"
                                                                                   @if(old('attribute.'.$attr->id)==$item->id)checked
                                                                                   @endif
                                                                                   id="tempRadio-1{{$item->id}}">
                                                                            <label class="radio--label half"
                                                                                   for="tempRadio-1{{$item->id}}">

                                                                                {{$item->title}}
                                                                            </label>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <div class="text-center">
                                                                        <label class="boldInputLabel"
                                                                               id="exampleFormControlSelect1">{{$attr->title}}</label>
                                                                        <select class="selectInputTemp "
                                                                                name="attribute[{{$attr->id}}]">
                                                                            <option value=""></option>
                                                                            @foreach($attr->attributeItems as $item)

                                                                                <option value="{{$item->id}}"
                                                                                    {{$item->id==old('attribute.'.$attr->id)?'selected':''}}>{{$item->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            @elseif($attr->attribute_type=='int')
                                                                <div class="text-center">
                                                                    <label
                                                                        class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <input type="text"
                                                                           onkeyup="separateNum(this.value,this);"
                                                                           name="attribute[{{$attr->id}}]"
                                                                           class="simpleInput"
                                                                           value="{{old('attribute.'.$attr->id)}}">
                                                                </div>
                                                            @elseif($attr->attribute_type=='string')
                                                                <div class="text-center">

                                                                    <label
                                                                        class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">

                                                                    <input type="text" name="attribute[{{$attr->id}}]"
                                                                           class="simpleInput"
                                                                           value="{{old('attribute.'.$attr->id)}}">
                                                                </div>
                                                            @elseif($attr->attribute_type=='description')
                                                                <div class="text-center">
                                                                    <label class="boldInputLabel"
                                                                           for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                    <textarea style="width: 100%"
                                                                              name="attribute[{{$attr->id}}]"
                                                                              id="sth1{{$attr->id}}" placeholder="{{$attr->placeHolder}}"
                                                                              rows="5">{{old('attribute.'.$attr->id)}}</textarea>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>

                                            @endforeach
                                            <div class="form-agahi-btn">
                                                <button type="submit" class="enseraf"
                                                        id="form-box2-cancel-button">
                                                    انصراف
                                                </button>
                                                <button type="submit" class="edameh"
                                                        id="form-box2-continue-button">
                                                    ادامه
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="infoform ad-submit-forms" id="form-box3"
                                         data-content="house-features">
                                        <div class="second-info third-info">
                                            <div class="first-info">
                                                {{--                                                <div class="row justify-content-center align-items-center">--}}
                                                @foreach($attributeGroups->where('type', 'estate-features') as $attrGroup)
                                                    <div class="row justify-content-center align-items-center">
                                                        @if($attrGroup->hidden==0)

                                                        <h5 class="formAgahiLabel boldInputLabel"
                                                            style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                        @endif
                                                        @foreach($attrGroup->attributes as $attr)
                                                            <div
                                                                class="col-md-{{$attrGroup->numberOfColumnsForDisplay}} col-6 mb-4 ">
                                                                @if($attr->attribute_type=='bool')
                                                                    <div
                                                                        class="d-flex flex-column align-items-center">

                                                                        <ul class="ks-cboxtags">
                                                                            <li><input type="checkbox"
                                                                                       id="checkboxOne{{$attr->id}}"
                                                                                       name="attribute[{{$attr->id}}]"
                                                                                       @if(old('attribute.'.$attr->id)=='on')checked @endif><label
                                                                                    for="checkboxOne{{$attr->id}}">{{$attr->title}}  </label>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @elseif($attr->attribute_type=='select')
                                                                    @if($attr->input_type=='checkbox')
                                                                        <div
                                                                            class="boldInputLabel text-center mb-3">
                                                                            <span>{{$attr->title}}</span>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            @foreach($attr->attributeItems as $item)

                                                                                <input class="radio--input half"
                                                                                       type="radio"
                                                                                       name="attribute[{{$attr->id}}]"
                                                                                       value="{{$item->id}}"
                                                                                       @if(old('attribute.'.$attr->id)==$item->id)checked
                                                                                       @endif
                                                                                       id="tempRadio-1{{$item->id}}">
                                                                                <label class="radio--label half"
                                                                                       for="tempRadio-1{{$item->id}}">

                                                                                    {{$item->title}}
                                                                                </label>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <div class="text-center">
                                                                            <label class="boldInputLabel"
                                                                                   id="exampleFormControlSelect1">{{$attr->title}}</label>
                                                                            <select class="selectInputTemp "
                                                                                    name="attribute[{{$attr->id}}]">
                                                                                <option value=""></option>
                                                                                @foreach($attr->attributeItems as $item)

                                                                                    <option
                                                                                        value="{{$item->id}}"
                                                                                        {{$item->id==old('attribute.'.$attr->id)?'selected':''}}>{{$item->title}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                @elseif($attr->attribute_type=='int')
                                                                    <div class="text-center">
                                                                        <label
                                                                            class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center">
                                                                        <input type="text"
                                                                               onkeyup="separateNum(this.value,this);"
                                                                               name="attribute[{{$attr->id}}]"
                                                                               class="simpleInput"
                                                                               value="{{old('attribute.'.$attr->id)}}">
                                                                    </div>
                                                                @elseif($attr->attribute_type=='string')
                                                                    <div class="text-center">

                                                                        <label
                                                                            class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center">

                                                                        <input type="text"
                                                                               name="attribute[{{$attr->id}}]"
                                                                               class="simpleInput"
                                                                               value="{{old('attribute.'.$attr->id)}}">
                                                                    </div>
                                                                @elseif($attr->attribute_type=='description')
                                                                    <div class="text-center">
                                                                        <label class="boldInputLabel"
                                                                               for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                        <textarea style="width: 100%"
                                                                                  name="attribute[{{$attr->id}}]"
                                                                                  id="sth1{{$attr->id}}" placeholder="{{$attr->placeHolder}}"
                                                                                  rows="5">{{old('attribute.'.$attr->id)}}</textarea>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <hr>

                                                @endforeach
                                                {{--                                                </div>--}}

                                                <div class="form-agahi-btn">
                                                    <button type="submit" class="enseraf"
                                                            id="form-box3-cancel-button">
                                                        انصراف
                                                    </button>
                                                    <button type="submit" class="edameh"
                                                            id="form-box3-continue-button">
                                                        ادامه
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="infoform ad-submit-forms" id="form-box4"
                                         data-content="finance-featuers">
                                        <div class="first-info">
                                            {{--                                            <div class="row justify-content-center align-items-center">--}}
                                            @foreach($attributeGroups->where('type', 'financial-situation') as $attrGroup)
                                                <div class="row justify-content-center align-items-center">
                                                    @if($attrGroup->hidden==0)
                                                    <h5 class="formAgahiLabel boldInputLabel"
                                                        style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                    @endif
                                                    @foreach($attrGroup->attributes as $attr)
                                                        <div
                                                            class="col-md-{{$attrGroup->numberOfColumnsForDisplay}} col-6 mb-4 ">
                                                            @if($attr->attribute_type=='bool')
                                                                <div
                                                                    class="d-flex flex-column align-items-center">

                                                                    <ul class="ks-cboxtags">
                                                                        <li><input type="checkbox"
                                                                                   id="checkboxOne{{$attr->id}}"
                                                                                   name="attribute[{{$attr->id}}]"
                                                                                   @if(old('attribute.'.$attr->id)=='on')checked @endif><label
                                                                                for="checkboxOne{{$attr->id}}">{{$attr->title}}  </label>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @elseif($attr->attribute_type=='select')
                                                                @if($attr->input_type=='checkbox')
                                                                    <div
                                                                        class="boldInputLabel text-center mb-3">
                                                                        <span>{{$attr->title}}</span>
                                                                    </div>
                                                                    <div class="text-center">
                                                                        @foreach($attr->attributeItems as $item)

                                                                            <input class="radio--input half"
                                                                                   type="radio"
                                                                                   name="attribute[{{$attr->id}}]"
                                                                                   value="{{$item->id}}"
                                                                                   @if(old('attribute.'.$attr->id)==$item->id)checked
                                                                                   @endif
                                                                                   id="tempRadio-1{{$item->id}}">
                                                                            <label class="radio--label half"
                                                                                   for="tempRadio-1{{$item->id}}">

                                                                                {{$item->title}}
                                                                            </label>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <div class="text-center">
                                                                        <label class="boldInputLabel"
                                                                               id="exampleFormControlSelect1">{{$attr->title}}</label>
                                                                        <select class="selectInputTemp "
                                                                                name="attribute[{{$attr->id}}]">
                                                                            <option value=""></option>
                                                                            @foreach($attr->attributeItems as $item)

                                                                                <option
                                                                                    value="{{$item->id}}"
                                                                                    {{$item->id==old('attribute.'.$attr->id)?'selected':''}}>{{$item->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            @elseif($attr->attribute_type=='int')
                                                                <div class="text-center">
                                                                    <label
                                                                        class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <input type="text"
                                                                           onkeyup="separateNum(this.value,this);"
                                                                           name="attribute[{{$attr->id}}]"
                                                                           class="simpleInput"
                                                                           value="{{old('attribute.'.$attr->id)}}">
                                                                </div>
                                                            @elseif($attr->attribute_type=='string')
                                                                <div class="text-center">

                                                                    <label
                                                                        class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">

                                                                    <input type="text"
                                                                           name="attribute[{{$attr->id}}]"
                                                                           class="simpleInput"
                                                                           value="{{old('attribute.'.$attr->id)}}">
                                                                </div>
                                                            @elseif($attr->attribute_type=='description')
                                                                <div class="text-center">
                                                                    <label class="boldInputLabel"
                                                                           for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                    <textarea style="width: 100%"
                                                                              name="attribute[{{$attr->id}}]"
                                                                              id="sth1{{$attr->id}}" placeholder="{{$attr->placeHolder}}"
                                                                              rows="5">{{old('attribute.'.$attr->id)}}</textarea>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>

                                            @endforeach
                                            {{--                                            </div>--}}

                                            <div class="form-agahi-btn">
                                                <button type="submit" class="enseraf"
                                                        id="form-box4-cancel-button">انصراف
                                                </button>
                                                <button type="submit" class="edameh"
                                                        id="form-box4-continue-button">ادامه
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="infoform ad-submit-forms" id="form-box5" data-content="ad-gallery">
                                        <div class="img-box second-info">
                                            <h6>لطفا تصاویر مربوط به ملک را وارد نمایید</h6>
                                            <div class=" px-3">
                                                <div class="file-input mt-5">
                                                    <div>
                                                        <div class="input-file-container">
                                                            <input class="input-filetttt" name="adImage[1]"
                                                                   id="my-filetttt"
                                                                   type="file">
                                                            <label tabindex="0" for="my-filetttt"
                                                                   class="input-file-triggertttt"> تصویر
                                                                اصلی</label>
                                                        </div>
                                                        <p class="file-returntttt"></p>
                                                    </div>

                                                </div>
                                                <div class="file-input mt-2">
                                                    <div>
                                                        <div class="input-file-container">
                                                            <input class="input-file" id="my-file"
                                                                   name="adImage[2]"
                                                                   type="file">
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
                                                            <input class="input-filet" id="my-filet"
                                                                   name="adImage[3]"
                                                                   type="file">
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
                                                            <input class="input-filett" id="my-filett"
                                                                   name="adImage[4]"
                                                                   type="file">
                                                            <label tabindex="0" for="my-filett"
                                                                   class="input-file-triggertt"> تصویر
                                                                فرعی</label>
                                                        </div>
                                                        <p class="file-returntt"></p>
                                                    </div>

                                                </div>

                                                <div class="file-input mt-2">
                                                    <div>
                                                        <div class="input-file-container">
                                                            <input class="input-filettt" id="my-filettt"
                                                                   name="adImage[5]"
                                                                   type="file">
                                                            <label tabindex="0" for="my-filettt"
                                                                   class="input-file-triggerttt"> تصویر
                                                                فرعی</label>
                                                        </div>
                                                        <p class="file-returnttt"></p>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="form-agahi-btn">
                                                <button type="submit" class="enseraf"
                                                        id="form-box5-cancel-button">
                                                    انصراف
                                                </button>
                                                <button type="submit" class="edameh">ادامه</button>
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
    </div>
    </div>
@endsection
@section('js_user')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <script>
        // set default map view {Which country do you want to use it for?}
        var mymap = L.map('mapid').setView([35.7236208989089, 51.401504873148596], 13);

        var lat = document.getElementById("latt");
        var long = document.getElementById("longg");

        var accessToken = 'pk.eyJ1IjoibWlsYWRjbGljayIsImEiOiJja3JtNmRmYjYwOHQ1Mm5ycTBoOTFraW9tIn0.j47CLuc5OhKzSgL8RsolsA';

        // create Official Account in mapbox and get accessToken
        // mapbox فقط یک انتخاب هست و میتوانیم از سرویس هایی دیگر نیز استفاده کنیم
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: accessToken
        }).addTo(mymap);


        var popup = L.popup();
        var theMarker = {};

        function onMapClick(e) {

            // Optional popup or Marker
            // popup
            //     .setLatLng(e.latlng)
            //     .setContent("You clicked the map at " + e.latlng.toString())
            //     .openOn(mymap);`
            if (theMarker != undefined) {
                mymap.removeLayer(theMarker);
            }
            ;
            lat.value = e.latlng.lat;
            long.value = e.latlng.lng;

            theMarker = L.marker([lat.value, long.value]).addTo(mymap)


        }

        mymap.on('click', onMapClick);

    </script>
    {{--    <script>--}}
    {{--        // set default map view {Which country do you want to use it for?}--}}
    {{--        var mymap = L.map('mapid').setView([51.505, -0.09], 13);--}}

    {{--        var lat = document.getElementById("latt");--}}
    {{--        var long = document.getElementById("longg");--}}

    {{--        var accessToken = 'pk.eyJ1IjoibWlsYWRjbGljayIsImEiOiJja3JtNmRmYjYwOHQ1Mm5ycTBoOTFraW9tIn0.j47CLuc5OhKzSgL8RsolsA';--}}

    {{--        // create Official Account in mapbox and get accessToken--}}
    {{--        // mapbox فقط یک انتخاب هست و میتوانیم از سرویس هایی دیگر نیز استفاده کنیم--}}
    {{--        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {--}}
    {{--            // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',--}}
    {{--            maxZoom: 18,--}}
    {{--            id: 'mapbox/streets-v11',--}}
    {{--            tileSize: 512,--}}
    {{--            zoomOffset: -1,--}}
    {{--            accessToken: accessToken--}}
    {{--        }).addTo(mymap);--}}

    {{--        var popup = L.popup();--}}

    {{--        function onMapClick(e) {--}}
    {{--            popup--}}
    {{--                .setLatLng(e.latlng)--}}
    {{--                .setContent("You clicked the map at " + e.latlng.toString())--}}
    {{--                .openOn(mymap);--}}
    {{--            document.getElementById("latt").value = e.latlng.lat;--}}
    {{--            document.getElementById("longg").value = e.latlng.lng;--}}
    {{--        }--}}

    {{--        mymap.on('click', onMapClick);--}}

    {{--    </script>--}}

    <script>

        $('.ad-submit-forms').removeClass('selected');
        $('#form-box1').addClass('selected');
        $('#form-box2-cancel-button').click(function (e) {
            e.preventDefault();
            $('.ad-submit-forms').removeClass('selected');
            $('#form-box1').addClass('selected');
            $('.first-infoform-class').addClass('selected');
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
    @include('UserMasterNew::layouts.getNeighborhood')

    {{--    <script type="text/javascript">--}}
    {{--        jQuery(document).ready(function () {--}}
    {{--            jQuery('select[name="city"]').on('change', function () {--}}
    {{--                var cityId = jQuery(this).val();--}}
    {{--                // alert(cityId)--}}
    {{--                if (cityId) {--}}
    {{--                    // console.log(cityId)--}}
    {{--                    jQuery.ajax({--}}
    {{--                        url: "{{route('gettingNeighborhood')}}",--}}
    {{--                        data: {--}}
    {{--                            'city': cityId--}}
    {{--                        },--}}
    {{--                        type: "GET",--}}
    {{--                        dataType: "json",--}}
    {{--                        success: function (data) {--}}
    {{--                            // console.log(data);--}}
    {{--                            jQuery('select[name="neighborhood"]').empty();--}}
    {{--                            $('select[name="neighborhood"]').append('<option value=""></option>');--}}
    {{--                            jQuery.each(data, function (key, value) {--}}
    {{--                                $('select[name="neighborhood"]').append('<option value="' + key + '">' + value + '</option>');--}}

    {{--                            });--}}
    {{--                        }--}}
    {{--                    });--}}
    {{--                } else {--}}
    {{--                    $('select[name="neighborhood"]').empty();--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[id="adType"]').on('change', function () {
                var type = jQuery('select[name="adType"]').val();
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

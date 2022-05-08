@extends('UserMasterNew::master')
@section('title_user')ایجاد آگهی
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/agahi.css')}}">

    <style>
        #app {
            height: 280px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">
    <link rel="stylesheet" href="{{asset('files/map/dist/css/mapp.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/map/dist/css/fa/style.css')}}">
@endsection
@section('content_userMasterNew')
    <div class="agahi-detail">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-3 mb-4">
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
{{--                                    <li data-content="finance-featuers" class="finance-featuers-class">شرایط مالی</li>--}}
                                    <li data-content="ad-gallery" class="ad-gallery-class">آلبوم تصاویر</li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 mb-4">
                    <div class="polyganBg">
                        <form action="{{route('ad.store.supplier.user', $category->id)}}" method="post" id="supplierStore"
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
                                                                    @if($hasScalar)
                                                                        <option value="scalar"
                                                                                @if('scalar'==old('adType')) selected @endif>
                                                                            نردبانی
                                                                        </option>
                                                                    @endif
                                                                    @if($hasSpecial)
                                                                        <option value="special"
                                                                                @if('special'==old('adType')) selected @endif>
                                                                            ویژه
                                                                        </option>
                                                                    @endif
                                                                    @if($hasEmergency)
                                                                        <option value="emergency"
                                                                                @if('emergency'==old('adType')) selected @endif>
                                                                            فوری
                                                                        </option>
                                                                    @endif
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
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="first-info-box-map text-center">
                                                            <p>
                                                                موقعیت دقیق ملک را مشخص نمایید
                                                            </p>
                                                            <div class="first-info-box-map-show">
                                                                <!-- <img src="assets/img/images (14).jpg" alt=""> -->
                                                                <div
                                                                    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                                                                    <div
                                                                        class="row justify-content-center align-item-center">
                                                                        <div id="app" ></div>

{{--                                                                        <div id="mapid"></div>--}}

                                                                    </div>

                                                                            <input name="latt" id="lat" hidden>
                                                                            <input name="longg" id="lng" hidden>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="explain-textarea">
                                                        <label>توضیحات ملک</label>
                                                        <br>
                                                        <textarea name="description">{{old('description')}}</textarea>
                                                    </div>
                                                    <div class="account-choice">
                                                        <div class="row" id="paymentCards">

                                                                {!! $content !!}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-agahi-btn">
                                                <a href="{{route('ad.find.cats.user', 'supplier')}}" class="enseraf">تغییر دسته بندی</a>
                                                <a type="submit" class="edameh" id="form-box1-continue-button">ادامه</a>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="infoform ad-submit-forms" id="form-box2" data-content="house-info">
                                        <div class="first-info">
                                            @foreach($attributeGroups->where('type', 'estate-information') as $attrGroup)
                                                @if($attrGroup->attributes->count() > 0)
                                                <div class="row justify-content-center align-items-center">
                                                    @if($attrGroup->hidden==0)

                                                    <h5 class="formAgahiLabel boldInputLabel"
                                                        style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                    @endif
                                                    @foreach($attrGroup->attributes as $attr)
                                                        <div
                                                            class="col-md-{{$attrGroup->numberOfColumnsForDisplay}} col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center" >
                                                            @if($attr->attribute_type=='bool')
                                                                <div class="d-flex flex-column align-items-center">

                                                                    <ul class="ks-cboxtags">
                                                                        <li><input type="checkbox"
                                                                                   id="checkboxOne{{$attr->id}}"
                                                                                   name="attribute[{{$attr->id}}][main]"
                                                                                   @if(old('attribute.'.$attr->id.'.main')=='on')checked @endif><label
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
                                                                               name="attribute[{{$attr->id}}][main]"
                                                                               value="" hidden
                                                                               checked
                                                                        >
                                                                        @foreach($attr->attributeItems as $item)

                                                                            <input class="radio--input half"
                                                                                   type="radio"
                                                                                   name="attribute[{{$attr->id}}][main]"
                                                                                   value="{{$item->id}}"
                                                                                   @if(old('attribute.'.$attr->id.'.main')==$item->id)checked
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
                                                                                name="attribute[{{$attr->id}}][main]">
                                                                            <option value="">{{$attr->placeHolder}}</option>
                                                                            @foreach($attr->attributeItems as $item)

                                                                                <option value="{{$item->id}}"
                                                                                    {{$item->id==old('attribute.'.$attr->id.'.main')?'selected':''}}>{{$item->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            @elseif($attr->attribute_type=='int')
                                                                <div class="d-sm-block d-flex flex-column align-items-center mb-2">
                                                                    <label class="formAgahiLabel"> {{$attr->title}}</label>
                                                                    <input type="text" class="simpleInput"
                                                                           placeholder="{{$attr->placeHolder}}"
                                                                           onkeyup="separateNum(this.value,this);"
                                                                           name="attribute[{{$attr->id}}][main]"
                                                                           value="{{old('attribute.'.$attr->id.'.main')}}"
                                                                           @if(old('attribute.'.$attr->id.'.alt')== 'on') disabled @endif>
                                                                </div>
                                                                @if(isset($attr->alt_value))

                                                                    <div class="checkbox-place">
                                                                        <input class="form-check-input simple-checkbox" type="checkbox"
                                                                               name="attribute[{{$attr->id}}][alt]"
                                                                               onchange="clearTextInput(this)" @if(old('attribute.'.$attr->id.'.alt') == 'on') checked @endif
                                                                               id="attribute[{{$attr->id}}][alt]"
                                                                               style="margin-right: unset;margin-left: 4px; position: unset"
                                                                        >
                                                                        <label class="form-check-label" for="attribute[{{$attr->id}}][alt]"
                                                                               style="outline: none;">
                                                                            {{$attr->alt_value}}
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @elseif($attr->attribute_type=='string')
                                                                <div class="text-center">

                                                                    <label
                                                                        class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">

                                                                    <input type="text" name="attribute[{{$attr->id}}][main]"
                                                                           class="simpleInput" placeholder="{{$attr->placeHolder}}"
                                                                           value="{{old('attribute.'.$attr->id.'.main')}}">
                                                                </div>
                                                            @elseif($attr->attribute_type=='description')
                                                                <div class="text-center">
                                                                    <label class="boldInputLabel"
                                                                           for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                    <textarea name="attribute[{{$attr->id}}][main]" placeholder="{{$attr->placeHolder}}"
                                                                              id="sth1{{$attr->id}}"
                                                                              rows="5">{{old('attribute.'.$attr->id.'.main')}}</textarea>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
                                                @endif
                                            @endforeach
                                            <div class="form-agahi-btn">
                                                <button type="submit" class="enseraf"
                                                        id="form-box2-cancel-button">
                                                    بازگشت
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
                                                @foreach($attributeGroups->where('type', 'estate-features') as $attrGroup)
                                                    @if($attrGroup->attributes->count() > 0)

                                                    <div class="row justify-content-center align-items-center">
                                                        @if($attrGroup->hidden==0)

                                                        <h5 class="formAgahiLabel boldInputLabel"
                                                            style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                        @endif
                                                        @foreach($attrGroup->attributes as $attr)
                                                            <div
                                                                class="col-md-{{$attrGroup->numberOfColumnsForDisplay}} col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center">
                                                                @if($attr->attribute_type=='bool')
                                                                    <div
                                                                        class="d-flex flex-column align-items-center">

                                                                        <ul class="ks-cboxtags">
                                                                            <li><input type="checkbox"
                                                                                       id="checkboxOne{{$attr->id}}"
                                                                                       name="attribute[{{$attr->id}}][main]"
                                                                                       @if(old('attribute.'.$attr->id.'.main')=='on')checked @endif><label
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
                                                                                       name="attribute[{{$attr->id}}][main]"
                                                                                       value="{{$item->id}}"
                                                                                       @if(old('attribute.'.$attr->id.'.main')==$item->id)checked
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
                                                                            <select class="selectInputTemp"
                                                                                    name="attribute[{{$attr->id}}][main]">
                                                                                <option value="">{{$attr->placeHolder}}</option>
                                                                                @foreach($attr->attributeItems as $item)

                                                                                    <option
                                                                                        value="{{$item->id}}"
                                                                                        {{$item->id==old('attribute.'.$attr->id.'.main')?'selected':''}}>{{$item->title}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                @elseif($attr->attribute_type=='int')
                                                                    <div class="d-sm-block d-flex flex-column align-items-center mb-2">
                                                                        <label class="formAgahiLabel"> {{$attr->title}}</label>
                                                                        <input type="text" class="simpleInput"
                                                                               placeholder="{{$attr->placeHolder}}"
                                                                               onkeyup="separateNum(this.value,this);"
                                                                               name="attribute[{{$attr->id}}][main]"
                                                                               value="{{old('attribute.'.$attr->id.'.main')}}"
                                                                               @if(old('attribute.'.$attr->id.'.alt')== 'on') disabled @endif>
                                                                    </div>
                                                                    @if(isset($attr->alt_value))

                                                                        <div class="checkbox-place">
                                                                            <input class="form-check-input simple-checkbox" type="checkbox"
                                                                                   name="attribute[{{$attr->id}}][alt]"
                                                                                   onchange="clearTextInput(this)" @if(old('attribute.'.$attr->id.'.alt') == 'on') checked @endif
                                                                                   id="attribute[{{$attr->id}}][alt]"
                                                                                   style="margin-right: unset;margin-left: 4px; position: unset"
                                                                            >
                                                                            <label class="form-check-label" for="attribute[{{$attr->id}}][alt]"
                                                                                   style="outline: none;">
                                                                                {{$attr->alt_value}}
                                                                            </label>
                                                                        </div>
                                                                    @endif
                                                                @elseif($attr->attribute_type=='string')
                                                                    <div class="text-center">

                                                                        <label
                                                                            class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center">

                                                                        <input type="text" placeholder="{{$attr->placeHolder}}"
                                                                               name="attribute[{{$attr->id}}][main]"
                                                                               class="simpleInput"
                                                                               value="{{old('attribute.'.$attr->id.'.main')}}">
                                                                    </div>
                                                                @elseif($attr->attribute_type=='description')
                                                                    <div class="text-center">
                                                                        <label class="boldInputLabel"
                                                                               for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                        <textarea style="width: 100%"
                                                                            name="attribute[{{$attr->id}}][main]"
                                                                            id="sth1{{$attr->id}}" placeholder="{{$attr->placeHolder}}"
                                                                            rows="5">{{old('attribute.'.$attr->id.'.main')}}</textarea>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <hr>
                                                    @endif
                                                @endforeach

                                                <div class="form-agahi-btn">
                                                    <button type="submit" class="enseraf"
                                                            id="form-box3-cancel-button">
                                                        بازگشت
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
                                            @foreach($attributeGroups->where('type', 'financial-situation') as $attrGroup)
                                                @if($attrGroup->attributes->count() > 0)

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
                                                                                   name="attribute[{{$attr->id}}][main]"
                                                                                   @if(old('attribute.'.$attr->id.'.main')=='on')checked @endif><label
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
                                                                                   name="attribute[{{$attr->id}}][main]"
                                                                                   value="{{$item->id}}"
                                                                                   @if(old('attribute.'.$attr->id.'.main')==$item->id)checked
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
                                                                                name="attribute[{{$attr->id}}][main]">
                                                                            <option value="">{{$attr->placeHolder}}</option>
                                                                            @foreach($attr->attributeItems as $item)

                                                                                <option
                                                                                    value="{{$item->id}}"
                                                                                    {{$item->id==old('attribute.'.$attr->id.'main')?'selected':''}}>{{$item->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            @elseif($attr->attribute_type=='int')
                                                                <div class="d-sm-block d-flex flex-column align-items-center mb-2">
                                                                    <label class="formAgahiLabel"> {{$attr->title}}</label>
                                                                    <input type="text" class="simpleInput"
                                                                           placeholder="{{$attr->placeHolder}}"
                                                                           onkeyup="separateNum(this.value,this);"
                                                                           name="attribute[{{$attr->id}}][main]"
                                                                           value="{{old('attribute.'.$attr->id.'.main')}}"
                                                                           @if(old('attribute.'.$attr->id.'.alt')== 'on') disabled @endif>
                                                                </div>
                                                                @if(isset($attr->alt_value))

                                                                    <div class="checkbox-place">
                                                                        <input class="form-check-input simple-checkbox" type="checkbox"
                                                                               name="attribute[{{$attr->id}}][alt]"
                                                                               onchange="clearTextInput(this)" @if(old('attribute.'.$attr->id.'.alt') == 'on') checked @endif
                                                                               id="attribute[{{$attr->id}}][alt]"
                                                                               style="margin-right: unset;margin-left: 4px; position: unset"
                                                                        >
                                                                        <label class="form-check-label" for="attribute[{{$attr->id}}][alt]"
                                                                               style="outline: none;">
                                                                            {{$attr->alt_value}}
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @elseif($attr->attribute_type=='string')
                                                                <div class="text-center">

                                                                    <label
                                                                        class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">

                                                                    <input type="text" placeholder="{{$attr->placeHolder}}"
                                                                           name="attribute[{{$attr->id}}][main]"
                                                                           class="simpleInput"
                                                                           value="{{old('attribute.'.$attr->id.'.main')}}">
                                                                </div>
                                                            @elseif($attr->attribute_type=='description')
                                                                <div class="text-center">
                                                                    <label class="boldInputLabel"
                                                                           for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                    <textarea style="width: 100%"
                                                                              name="attribute[{{$attr->id}}][main]"
                                                                              id="sth1{{$attr->id}}" placeholder="{{$attr->placeHolder}}"
                                                                              rows="5">{{old('attribute.'.$attr->id.'.main')}}</textarea>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
                                                @endif
                                            @endforeach
                                            <div class="form-agahi-btn">
                                                <button type="submit" class="enseraf"
                                                        id="form-box4-cancel-button">بازگشت
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
                                                    بازگشت
                                                </button>
                                                <button type="submit" class="edameh">ثبت</button>
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
<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>
<script type="text/javascript" src="{{asset('files/map/dist/js/mapp..env.js')}}"></script>
<script type="text/javascript" src="{{asset('files/map/dist/js/mapp.min.js')}}"></script>
<script>

    $(document).ready(function () {
        var app = new Mapp({
            element: '#app',
            presets: {
                latlng: {
                    lat: 35.73249,
                    lng: 51.42268,
                },
                zoom: 10
            },
            apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIn0.eyJhdWQiOiIxNDAyMSIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIiwiaWF0IjoxNjIxMjMzMDE1LCJuYmYiOjE2MjEyMzMwMTUsImV4cCI6MTYyMzgyNTAxNSwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.g-oaFkPxTsmJka5HczgcUvJMmuM6HKdrJgEaVyHWzNXu3UmkOjWch_d8nf0OIOQqKSG6I-KpjMYVEfj1KRH9iI4x9HYilH9qSq8epsUElbWuS6OLTCS3i_a-CCgelms3qFvbnik7tkfw_7f41zCZRxO-8w1h-41QkOMVtXLalZF-R7khLb5PShh75lo60Iezy9eEpoIZduQe2GlF_yjHMI8oLC9ZSLeH03Qw5UvjycPyEpYhwBUiqK9THv4mAnsKt89EjwENDcaWxxFS1uymGfbi2tdpE1tiT0QgUkVsFHvwivBCDRIf3eLIVXmY2ryi7LlKNmDfScWqCN11u_ZRMA'
        });
        app.addLayers();
        app.map.on('click', function (e) {

            var marker = app.addMarker({
                name: 'advanced-marker',
                latlng: {
                    lat: e.latlng.lat,
                    lng: e.latlng.lng,
                },
                icon: app.icons.red,
                popup: {
                    title: {
                        i18n: 'marker-title',
                    },
                    description: {
                        i18n: 'marker-description',
                    },
                    class: 'marker-class',
                    open: true,
                },
                pan: false,
                draggable: true,
                history: false,
                on: {
                    click: function () {
                    },
                    contextmenu: function () {
                    },
                },
            });
            app.showReverseGeocode({
                state: {
                    latlng: {
                        lat: e.latlng.lat,
                        lng: e.latlng.lng,
                    },
                    zoom: 16,
                },
            });

            var lat1 = e.latlng.lat;
            var lng1 = e.latlng.lng;

            $('#supplierStore').find('[name="latt"]').val(lat1);
            $('#supplierStore').find('[name="longg"]').val(lng1);

            if (lat1 && lng1) {
                jQuery.ajax({
                    url: "{{route('sendLatlngToApi')}}",
                    data: {
                        'lat1': lat1,
                        'lng1': lng1,
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#supplierStore').find('[name="address"]').val(data.address);
                    }
                });
            } else {
            }
        })
    });
</script>

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

        $('#form-box2-continue-button, #form-box5-cancel-button').click(function (e) {
            e.preventDefault();
            $('.ad-submit-forms').removeClass('selected');
            $('.house-info-class').removeClass('selected');
            $('.house-features-class').addClass('selected');
            $('.finance-featuers-class').removeClass('selected');
            $('.ad-gallery-class').removeClass('selected');

            $('#form-box3').addClass('selected');
        });
        $('#form-box3-continue-button').click(function (e) {
            e.preventDefault();
            $('.ad-submit-forms').removeClass('selected');
            $('.house-features-class').removeClass('selected');
            // $('.finance-featuers-class').addClass('selected');
            // $('.ad-gallery-class').removeClass('selected');
            // $('.ad-submit-forms').removeClass('selected');
            $('.finance-featuers-class').removeClass('selected');
            $('.ad-gallery-class').addClass('selected');
            $('#form-box5').addClass('selected');

            // $('#form-box4').addClass('selected');
        });
        // $('#form-box4-continue-button').click(function (e) {
        //     e.preventDefault();
        //     $('.ad-submit-forms').removeClass('selected');
        //     $('.finance-featuers-class').removeClass('selected');
        //     $('.ad-gallery-class').addClass('selected');
        //     $('#form-box5').addClass('selected');
        // });
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
                            // console.log(data.content)

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

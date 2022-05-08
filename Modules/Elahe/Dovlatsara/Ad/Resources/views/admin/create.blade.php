@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد آگهی جدید
@endsection
@section('header')
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/agahi.css')}}">
    <style>
        li {
            list-style: none;
        }
    </style>
    <style>
        #app {
            /*width: 100%;*/
            height: 360px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">
    <link rel="stylesheet" href="{{asset('files/map/dist/css/mapp.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/map/dist/css/fa/style.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .document-gallery {
            width: 100%;
            border: 1px solid #EEE;
            padding: 2%;
        }

        .document-placeholder {
            width: 48%;
            margin: 1%;
            float: left;
        }

        .document-placeholder img {
            border: 1px solid #EEEEEE;
            width: 100%;
            padding: 1%;
            min-height: 300px;
            max-height: 600px;
        }

        .document-gallery-images {
            width: 48%;
            margin: 1%;
            float: left;
        }

        .document-image img {
            width: 31.333%;
            min-height: 125px;
            float: left;
            margin: 1%;
            cursor: pointer;
        }

        .imagePreview {
            width: 100%;
            height: 180px;
            background-position: center center;
            background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
            background-color: #fff;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
        }

        .btn-upImg {
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;
        }

        .btn-success {
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;

        }

        .imgUp {
            margin-bottom: 15px;
            position: relative;
        }

        .del {
            position: absolute;
            top: 0px;
            right: 15px;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            background-color: transparent;
            /*rgba(255, 255, 255, 0.6)*/
            cursor: pointer;
        }

        .imgAdd {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #FFF4B8;
            color: #fff;
            box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
            text-align: center;
            line-height: 30px;
            margin-top: 0px;
            cursor: pointer;
            font-size: 15px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/colorpicker/bootstrap-colorpicker.min.css')}}">

    <style>
        .select2-selection.select2-selection--single {
            min-height: 45px;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected]{
            background-color: #ddb24f;
        }
    </style>
@endsection
@section('content')

    <div class="agahi-detail">
        <div class="container">
            <div class="row mt-5">
                <div class="col-xl-3 mb-4">
                    <div class="agahi-detail-tabs">
                        <div class="agahi-detail-tabsHead">
                            <a>آگهی خود را ثبت کنید</a>
                        </div>
                        <div class="agahi-detail-navigationTab">
                            <nav>
                                <ul class="tabs">
                                    <li data-content="first-infoform" class="first-infoform-class selected">مکان آگهی
                                    </li>
{{--                                    @if(\Modules\Attribute\Entities\Attribute::whereIn('id', $attributeGroups->where('type', '!=', 'financial-situation')--}}
{{--->pluck('id')->toArray())->get()->count() > 0)--}}
                                    <li data-content="house-info" class="house-info-class">اطلاعات و امکانات</li>
{{--                                    @endif--}}

                                    <li data-content="house-features" class="house-features-class">قیمت و شرایط</li>
                                    {{--                                    <li data-content="finance-featuers" class="finance-featuers-class">شرایط مالی</li>--}}
                                    <li data-content="ad-gallery" class="ad-gallery-class">ثبت نهایی</li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 mb-4">
                    <div style="background-color: #fff">
                        <form action="{{route('ad.store.supplier.admin', $category->id)}}" method="post"
                              class="form-agahi" enctype="multipart/form-data" id="supplierStore">
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
                                                    <div class="col-lg-12 ">
                                                        <div class="first-info-box-inputs">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div>
                                                                        <label for="cars">شهر </label>
                                                                        <select name="city" class="full select2" dir="rtl"
                                                                                style="height: 45px;width: 80%">
                                                                            <option value=""></option>
                                                                            @foreach($cities as $city)
                                                                                <option value="{{$city->id}}"
                                                                                        @if($city->id==old('city')) selected @endif>{{$city->title}}</option>

                                                                            @endforeach
                                                                        </select>
                                                                        {{--                                                            <small--}}
                                                                        {{--                                                                class="text-danger">{{ $errors->first('city') }}</small>--}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6" id="neighborhoodOld">
                                                                    <div>
                                                                        <label> محله</label>
                                                                        <select name="neighborhood" class="full select2" dir="rtl"
                                                                                style="height: 45px;width: 80%">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                {{--                                                            <div id="paymentCards">--}}
                                                                {{--                                                                {!! $content !!}--}}
                                                                {{--                                                            </div>--}}
                                                                {{--                                                        <small--}}
                                                                {{--                                                            class="text-danger">{{ $errors->first('adPaymentFee') }}</small>--}}

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="first-info-box-map text-center">
                                                                <p>
                                                                    موقعیت دقیق ملک را مشخص نمایید
                                                                </p>
                                                                <div class="first-info-box-map-show">
                                                                    <!-- <img src="assets/img/images (14).jpg" alt=""> -->
                                                                    <div
                                                                        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                                                                        {{--                                                                    <div--}}
                                                                        {{--                                                                        class="row justify-content-center align-item-center">--}}

                                                                        <div id="app"></div>

                                                                        {{--                                                                    </div>--}}


                                                                        {{--                                                                    <div class="card-body">--}}
                                                                        {{--                                                                        <div class="col-md-12">--}}
                                                                        <input name="latt" id="lat" hidden>
                                                                        <input name="longg" id="lng" hidden>
                                                                        {{--                                                                        <input type="hidden" id="lat" value=""--}}
                                                                        {{--                                                                               name="lat" />--}}
                                                                        {{--                                                                        <input type="hidden" id="lng" value=""--}}
                                                                        {{--                                                                               name="lng" />--}}
                                                                        {{--                                                                        </div>--}}
                                                                        {{--                                                                    </div>--}}

                                                                        {{--                                                                <button type="submit"--}}
                                                                        {{--                                                                        class="btn btn-success float-right">ثبت--}}
                                                                        {{--                                                                    موقعیت</button>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 explain-textarea">
                                                            <label>نشانی</label>
                                                            <br>
                                                            <textarea name="address">{{old('address')}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-agahi-btn">
                                                    <a href="{{route('ad.find.cats.admin', 'supplier')}}"
                                                       class="enseraf">تغییر دسته بندی</a>
                                                    <a type="submit" class="edameh" id="form-box1-continue-button"
                                                       style="cursor: pointer">ادامه</a>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
{{--                                    @if(\Modules\Attribute\Entities\Attribute::whereIn('id', $attributeGroups->where('type', '!=', 'financial-situation')--}}
{{--->pluck('id')->toArray())->get()->count() > 0)--}}

                                    <div class="infoform ad-submit-forms" id="form-box2" data-content="house-info">
                                        <div class="first-info">
                                            @foreach($attributeGroups->where('type', '!=', 'financial-situation') as $attrGroup)

                                                @if($attrGroup->hidden==0)

                                                    <h5 class="formAgahiLabel boldInputLabel"
                                                        style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                @endif
                                                <div class="row justify-content-center align-items-baseline">
                                                    @if($attrGroup->attributes->where('attribute_type', 'bool')->count()>0)
                                                        <div
                                                            class="col-md-12 col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <label class="formAgahiLabel boldInputLabel"></label>
                                                                <ul class="ks-cboxtags">
                                                                    @foreach($attrGroup->attributes->where('attribute_type', 'bool') as $attr)

                                                                        <li><input type="checkbox" id="checkboxOne{{$attr->id}}"
                                                                                   name="attribute[{{$attr->id}}][main]"
                                                                                   @if(old('attribute.'.$attr->id.'.main')=='on')checked @endif
                                                                            ><label for="checkboxOne{{$attr->id}}">{{$attr->title}}</label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @foreach($attrGroup->attributes as $attr)
                                                        <div
                                                            class="col-lg-{{$attrGroup->numberOfColumnsForDisplay}} col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center ">
{{--                                                            @if($attr->attribute_type=='bool')--}}
{{--                                                                <div class="d-flex flex-column align-items-center">--}}

{{--                                                                    <ul class="ks-cboxtags">--}}
{{--                                                                        <li><input type="checkbox"--}}
{{--                                                                                   id="checkboxOne{{$attr->id}}"--}}
{{--                                                                                   name="attribute[{{$attr->id}}][main]"--}}
{{--                                                                                   @if(old('attribute.'.$attr->id.'.main')=='on')checked @endif><label--}}
{{--                                                                                for="checkboxOne{{$attr->id}}">{{$attr->title}}  </label>--}}
{{--                                                                        </li>--}}
{{--                                                                    </ul>--}}
{{--                                                                </div>--}}
                                                            @if($attr->attribute_type=='select')
                                                                @if($attr->input_type=='checkbox')
                                                                    <div class="boldInputLabel text-center mb-3">
                                                                        <span>{{$attr->title}}</span>
                                                                    </div>
                                                                    <div class="text-center">
                                                                        <input class="radio--input half"
                                                                               type="radio"
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
                                                                    <div class="mb-2">
                                                                        <label class="boldInputLabel"
                                                                               id="exampleFormControlSelect1">{{$attr->title}}</label>
                                                                        <select class="selectInputTemp "
                                                                                name="attribute[{{$attr->id}}][main]">
                                                                            <option
                                                                                value="">{{$attr->placeHolder}}</option>
                                                                            @foreach($attr->attributeItems as $item)

                                                                                <option value="{{$item->id}}"
                                                                                    {{$item->id==old('attribute.'.$attr->id.'.main')?'selected':''}}>{{$item->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            @elseif($attr->attribute_type=='int')
                                                                <div
                                                                    class="d-sm-block d-flex flex-column align-items-center mb-2">
                                                                    <label
                                                                        class="formAgahiLabel"> {{$attr->title}}</label>
                                                                    <input type="text" class="simpleInput"
                                                                           placeholder="{{$attr->placeHolder}}"

                                                                           @if(isset($attr->alt_value)) onkeyup="document.getElementById('demo_out{{$attr->id}}').innerHTML = Num2persian(this.value)"
                                                                           @else onkeyup="separateNum(this.value,this);"
                                                                           @endif
                                                                           name="attribute[{{$attr->id}}][main]"
                                                                           value="{{old('attribute.'.$attr->id.'.main')}}"
                                                                           @if(old('attribute.'.$attr->id.'.alt')== 'on') disabled @endif>
                                                                </div>

                                                                @if(isset($attr->alt_value))

                                                                    <div class="checkbox-place">
                                                                        <input
                                                                            class="form-check-input simple-checkbox"
                                                                            type="checkbox"
                                                                            name="attribute[{{$attr->id}}][alt]"
                                                                            onchange="clearTextInput(this)"
                                                                            @if(old('attribute.'.$attr->id.'.alt') == 'on') checked
                                                                            @endif
                                                                            id="attribute[{{$attr->id}}][alt]"
                                                                            style="margin-right: unset;margin-left: 4px; position: unset"
                                                                        >
                                                                        <label class="form-check-label"
                                                                               for="attribute[{{$attr->id}}][alt]"
                                                                               style="outline: none;">
                                                                            {{$attr->alt_value}}
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                                <small id="demo_out{{$attr->id}}"></small>

                                                            @elseif($attr->attribute_type=='string')
                                                                <div
                                                                    class="d-sm-block d-flex flex-column align-items-center mb-2">

                                                                    <label
                                                                        class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
{{--                                                                </div>--}}
{{--                                                                <div--}}
{{--                                                                    class="d-flex justify-content-center align-items-center">--}}

                                                                    <input type="text"
                                                                           name="attribute[{{$attr->id}}][main]"
                                                                           class="simpleInput"
                                                                           placeholder="{{$attr->placeHolder}}"
                                                                           value="{{old('attribute.'.$attr->id.'.main')}}">
                                                                </div>
                                                            @elseif($attr->attribute_type=='description')
                                                                <div class="">
                                                                    <label class="boldInputLabel"
                                                                           for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                    <textarea style="width: 100%"
                                                                              name="attribute[{{$attr->id}}][main]"
                                                                              id="sth1{{$attr->id}}"
                                                                              placeholder="{{$attr->placeHolder}}"
                                                                              rows="5">{{old('attribute.'.$attr->id.'.main')}}</textarea>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
                                            @endforeach

                                                <div class="form-agahi-btn">
                                                <button type="submit" class="enseraf"
                                                        id="form-box2-cancel-button" style="cursor: pointer">
                                                    بازگشت
                                                </button>
                                                <button type="submit" class="edameh"
                                                        id="form-box2-continue-button" style="cursor: pointer">
                                                    ادامه
                                                </button>
                                            </div>
                                        </div>

                                    </div>
{{--                                    @endif--}}

                                    <div class="infoform ad-submit-forms" id="form-box3"
                                         data-content="house-features">
                                        <div class="second-info third-info">
                                            <div class="first-info">
                                                {{--                                                <div class="row justify-content-center align-items-center">--}}
                                                @foreach($attributeGroups->where('type', 'financial-situation') as $attrGroup)
                                                    @if($attrGroup->hidden==0)

                                                        <h5 class="formAgahiLabel boldInputLabel"
                                                            style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                    @endif
                                                    <div class="row justify-content-center align-items-baseline">
                                                        @if($attrGroup->attributes->where('attribute_type', 'bool')->count()>0)
                                                            <div
                                                                class="col-md-12 col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center">
                                                                <div class="d-flex flex-column align-items-center">
                                                                    <label class="formAgahiLabel boldInputLabel"></label>
                                                                    <ul class="ks-cboxtags">
                                                                        @foreach($attrGroup->attributes->where('attribute_type', 'bool') as $attr)

                                                                            <li><input type="checkbox" id="checkboxOne{{$attr->id}}"
                                                                                       name="attribute[{{$attr->id}}][main]"
                                                                                       @if(old('attribute.'.$attr->id.'.main')=='on')checked @endif
                                                                                ><label for="checkboxOne{{$attr->id}}">{{$attr->title}}</label>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @foreach($attrGroup->attributes as $attr)
                                                            <div
                                                                class="col-lg-{{$attrGroup->numberOfColumnsForDisplay}} col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center ">
                                                                {{--                                                            @if($attr->attribute_type=='bool')--}}
                                                                {{--                                                                <div class="d-flex flex-column align-items-center">--}}

                                                                {{--                                                                    <ul class="ks-cboxtags">--}}
                                                                {{--                                                                        <li><input type="checkbox"--}}
                                                                {{--                                                                                   id="checkboxOne{{$attr->id}}"--}}
                                                                {{--                                                                                   name="attribute[{{$attr->id}}][main]"--}}
                                                                {{--                                                                                   @if(old('attribute.'.$attr->id.'.main')=='on')checked @endif><label--}}
                                                                {{--                                                                                for="checkboxOne{{$attr->id}}">{{$attr->title}}  </label>--}}
                                                                {{--                                                                        </li>--}}
                                                                {{--                                                                    </ul>--}}
                                                                {{--                                                                </div>--}}
                                                                @if($attr->attribute_type=='select')
                                                                    @if($attr->input_type=='checkbox')
                                                                        <div class="boldInputLabel text-center mb-3">
                                                                            <span>{{$attr->title}}</span>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <input class="radio--input half"
                                                                                   type="radio"
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
                                                                        <div class="mb-2">
                                                                            <label class="boldInputLabel"
                                                                                   id="exampleFormControlSelect1">{{$attr->title}}</label>
                                                                            <select class="selectInputTemp "
                                                                                    name="attribute[{{$attr->id}}][main]">
                                                                                <option
                                                                                    value="">{{$attr->placeHolder}}</option>
                                                                                @foreach($attr->attributeItems as $item)

                                                                                    <option value="{{$item->id}}"
                                                                                        {{$item->id==old('attribute.'.$attr->id.'.main')?'selected':''}}>{{$item->title}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                @elseif($attr->attribute_type=='int')
                                                                    <div
                                                                        class="d-sm-block d-flex flex-column align-items-center mb-2">
                                                                        <label
                                                                            class="formAgahiLabel"> {{$attr->title}}</label>
                                                                        <input type="text" class="simpleInput"
                                                                               placeholder="{{$attr->placeHolder}}"

                                                                               @if(isset($attr->alt_value)) onkeyup="document.getElementById('demo_out{{$attr->id}}').innerHTML = Num2persian(this.value)"
                                                                               @else onkeyup="separateNum(this.value,this);"
                                                                               @endif
                                                                               name="attribute[{{$attr->id}}][main]"
                                                                               value="{{old('attribute.'.$attr->id.'.main')}}"
                                                                               @if(old('attribute.'.$attr->id.'.alt')== 'on') disabled @endif>
                                                                    </div>

                                                                    @if(isset($attr->alt_value))

                                                                        <div class="checkbox-place">
                                                                            <input
                                                                                class="form-check-input simple-checkbox"
                                                                                type="checkbox"
                                                                                name="attribute[{{$attr->id}}][alt]"
                                                                                onchange="clearTextInput(this)"
                                                                                @if(old('attribute.'.$attr->id.'.alt') == 'on') checked
                                                                                @endif
                                                                                id="attribute[{{$attr->id}}][alt]"
                                                                                style="margin-right: unset;margin-left: 4px; position: unset"
                                                                            >
                                                                            <label class="form-check-label"
                                                                                   for="attribute[{{$attr->id}}][alt]"
                                                                                   style="outline: none;">
                                                                                {{$attr->alt_value}}
                                                                            </label>
                                                                        </div>
                                                                    @endif
                                                                    <small id="demo_out{{$attr->id}}"></small>

                                                                @elseif($attr->attribute_type=='string')
                                                                    <div
                                                                        class="d-sm-block d-flex flex-column align-items-center mb-2">

                                                                        <label
                                                                            class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                        {{--                                                                </div>--}}
                                                                        {{--                                                                <div--}}
                                                                        {{--                                                                    class="d-flex justify-content-center align-items-center">--}}

                                                                        <input type="text"
                                                                               name="attribute[{{$attr->id}}][main]"
                                                                               class="simpleInput"
                                                                               placeholder="{{$attr->placeHolder}}"
                                                                               value="{{old('attribute.'.$attr->id.'.main')}}">
                                                                    </div>
                                                                @elseif($attr->attribute_type=='description')
                                                                    <div class="">
                                                                        <label class="boldInputLabel"
                                                                               for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                        <textarea style="width: 100%"
                                                                                  name="attribute[{{$attr->id}}][main]"
                                                                                  id="sth1{{$attr->id}}"
                                                                                  placeholder="{{$attr->placeHolder}}"
                                                                                  rows="5">{{old('attribute.'.$attr->id.'.main')}}</textarea>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <hr>

                                                @endforeach

                                                <div class="form-agahi-btn">
                                                    <button type="submit" class="enseraf"
                                                            id="form-box3-cancel-button" style="cursor: pointer">
                                                        بازگشت
                                                    </button>
                                                    <button type="submit" class="edameh"
                                                            id="form-box3-continue-button" style="cursor: pointer">
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
                                                @if($attrGroup->hidden==0)
                                                    <h5 class="formAgahiLabel boldInputLabel"
                                                        style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                @endif
                                                <div class="row justify-content-center align-items-center">

                                                    @foreach($attrGroup->attributes as $attr)
                                                        <div
                                                            class="col-lg-{{$attrGroup->numberOfColumnsForDisplay}} col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center ">
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
                                                                                   @if(old('attribute.'.$attr->id.'main')==$item->id)checked
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
                                                                            <option
                                                                                value="">{{$attr->placeHolder}}</option>
                                                                            @foreach($attr->attributeItems as $item)

                                                                                <option
                                                                                    value="{{$item->id}}"
                                                                                    {{$item->id==old('attribute.'.$attr->id.'main')?'selected':''}}>{{$item->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            @elseif($attr->attribute_type=='int')
                                                                <div
                                                                    class="d-sm-block d-flex flex-column align-items-center mb-2">
                                                                    <label
                                                                        class="formAgahiLabel"> {{$attr->title}}</label>
                                                                    <input type="text" class="simpleInput"
                                                                           placeholder="{{$attr->placeHolder}}"
                                                                           @if(isset($attr->alt_value)) onkeyup="document.getElementById('demo_out{{$attr->id}}').innerHTML = Num2persian(this.value)"
                                                                           @else onkeyup="separateNum(this.value,this);"
                                                                           @endif
                                                                           name="attribute[{{$attr->id}}][main]"
                                                                           value="{{old('attribute.'.$attr->id.'.main')}}"
                                                                           @if(old('attribute.'.$attr->id.'.alt')== 'on') disabled @endif>
                                                                </div>
                                                                @if(isset($attr->alt_value))

                                                                    <div class="checkbox-place">
                                                                        <input
                                                                            class="form-check-input simple-checkbox"
                                                                            type="checkbox"
                                                                            name="attribute[{{$attr->id}}][alt]"
                                                                            onchange="clearTextInput(this)"
                                                                            @if(old('attribute.'.$attr->id.'.alt') == 'on') checked
                                                                            @endif
                                                                            id="attribute[{{$attr->id}}][alt]"
                                                                            style="margin-right: unset;margin-left: 4px; position: unset"
                                                                        >
                                                                        <label class="form-check-label"
                                                                               for="attribute[{{$attr->id}}][alt]"
                                                                               style="outline: none;">
                                                                            {{$attr->alt_value}}
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                                <small id="demo_out{{$attr->id}}"></small>

                                                            @elseif($attr->attribute_type=='string')
                                                                <div class="text-center">

                                                                    <label
                                                                        class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">

                                                                    <input type="text"
                                                                           placeholder="{{$attr->placeHolder}}"
                                                                           name="attribute[{{$attr->id}}][main]"
                                                                           class="simpleInput"
                                                                           value="{{old('attribute.'.$attr->id.'main')}}">
                                                                </div>
                                                            @elseif($attr->attribute_type=='description')
                                                                <div class="text-center">
                                                                    <label class="boldInputLabel"
                                                                           for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                    <textarea
                                                                        name="attribute[{{$attr->id}}][msin]"
                                                                        id="sth1{{$attr->id}}"
                                                                        placeholder="{{$attr->placeHolder}}"
                                                                        rows="5">{{old('attribute.'.$attr->id.'main')}}</textarea>
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
                                                        id="form-box4-cancel-button" style="cursor: pointer">بازگشت
                                                </button>
                                                <button type="submit" class="edameh"
                                                        id="form-box4-continue-button" style="cursor: pointer">ادامه
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="infoform ad-submit-forms" id="form-box5" data-content="ad-gallery">
                                        <div class="img-box second-info">
                                            <div class="col-lg-12 ">
                                                <div class="first-info-box-inputs">

                                                    <div>
                                                        <label for="cars">عنوان آگهی</label>
                                                        <input type="text" name="title" style="height: 45px"
                                                               value="{{old('title')}}">

                                                    </div>
                                                    <div>
                                                        <label for="cars">نوع آگهی</label>
                                                        <select name="adType" id="adType" class="full"
                                                                style="height: 45px">
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
                                                </div>
                                            </div>
                                            <p class="boldInputLabel">
                                                نمایش عکس های مرتبط با آگهی بازدید را تا پنج برابر بالا میبرد:
                                            </p>
                                            <div class="row p-5 d-flex" id="numberOfImages">
                                                <div class="col-md-4 imgUp">
                                                    <div class="imagePreview"></div>
                                                    <label class="btn btn-upImg"
                                                           style="color: #fff; background: #2a2929">
                                                        انتخاب<input name="adImage[]" type="file"
                                                                     class="uploadFile img"
                                                                     value="Upload Photo"
                                                                     style="width: 0px;height: 0px;overflow: hidden;">
                                                    </label>
                                                </div>
                                                <i class="fa fa-plus imgAdd"></i>
                                            </div>
{{--                                            <div class="col-md-10">--}}

{{--                                                <div class="form-group">--}}
{{--                                                    <label>انتخاب رنگ برای واترمارک اسم کسب و کار شما برای تصاویر:</label>--}}
{{--                                                    <input type="text" name="color" value="{{old('color')}}" class="form-control my-colorpicker1">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="explain-textarea">
                                                <label>توضیحات تکمیلی</label>
                                                <br>
                                                <textarea name="description"
                                                          placeholder="توضیحات تکمیلی شما برای بازدیدکنندگان نمایش میگردد، بنابراین هرچه جزییات بیشتری را درج کنید، شانس دیده شدن را افزایش می دهد">{{old('description')}}</textarea>
                                            </div>
                                            <div class="form-agahi-btn">
                                                <button type="submit" class="enseraf"
                                                        id="form-box5-cancel-button" style="cursor: pointer">
                                                    بازگشت
                                                </button>
                                                <button type="submit" class="edameh" style="cursor: pointer">ثبت
                                                </button>
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
@section('js')

    <script>
        jQuery(document).ready(function ($) {
            $('.document-image img').click(function (event) {
                // detect data-id for later
                var id = $(this).data('id');
                // grab src to replace #featured
                var src = $(this).attr('src');
                // set featured image
                var img = $('#featured img');

                img.fadeOut('fast', function () {
                    $(this).attr({src: src,});
                    $(this).fadeIn('fast');
                });
            });
            let numberOfImages = $('#numberOfImages');
            $(".imgAdd").click(function () {
                let fileCount = numberOfImages.children().length;
                if (fileCount > 5) {
                    alert('تعداد فایل ها بیش از حد مجاز است')
                } else {
                    $(this).closest(".row").find('.imgAdd').before('<div class="col-md-4 imgUp"><div class="imagePreview"></div>' +
                        '<label class="btn btn-upImg" style="color: #fff; background: #2a2929">انتخاب<input name="adImage[]" type="file" class="uploadFile img"' +
                        ' value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del p-2"></i></div>');
                }
            });
            $(document).on("click", "i.del", function () {
                $(this).parent().remove();
                let fileCount = numberOfImages.children().length;
            });
            $(function () {
                $(document).on("change", ".uploadFile", function () {
                    var uploadFile = $(this);
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                    if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file
                        reader.onloadend = function () { // set image data as background of div
                            uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                        }
                    }
                    var videoCount = document.getElementsByClassName("videoAdd");
                    if (/^video/.test(files[0].type)) { // only video file
                        if (videoCount.length >= 1) {
                            alert('تنها مجاز به آپلود یک فایل ویدیو هستید')
                        } else {
                            $(this).closest(".row").find('.imgAdd').prepend('<i class="videoAdd" style="display: contents"></i>');
                            var reader = new FileReader(); // instance of the FileReader
                            reader.readAsDataURL(files[0]); // read the local file
                            reader.onloadend = function () { // set image data as background of div
                                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url({{asset($imageOfUploadVideo)}})");
                            }
                        }
                    }
                });
            });
        });

    </script>

    <script>
        function clearTextInput(test) {
            let length = test.name.length;
            if (test.checked == true) {
                $(`input[name="${test.name.substr(0, length - 5).concat('[main]')}"]`).attr('disabled', 'disabled')
            } else {
                $(`input[name="${test.name.substr(0, length - 5).concat('[main]')}"]`).removeAttr('disabled')
            }
        }
    </script>
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
                    pan: false,
// draggable: true,
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
                        zoom: 13,
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
    {{--        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"--}}
    {{--                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="--}}
    {{--                crossorigin=""></script>--}}
    <script>
        // set default map view {Which country do you want to use it for?}
        var mymap = L.map('mapid').setView([35.7236208989089, 51.401504873148596], 13);

        var lat = document.getElementById("latt");
        var long = document.getElementById("longg");

        var accessToken = 'pk.eyJ1IjoiZWxsYTEyMzQ1NiIsImEiOiJja3R2OGptZTIyN21lMm5tcG5saXVsZm52In0.FIsNS4upWWykCSNuV4vB9w';

        // create Official Account in mapbox and get accessToken
        // mapbox فقط یک انتخاب هست و میتوانیم از سرویس هایی دیگر نیز استفاده کنیم
        // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        //     maxZoom: 18,
        //     id: 'mapbox/streets-v11',
        //     tileSize: 512,
        //     zoomOffset: -1,
        //     accessToken: accessToken
        // }).addTo(mymap);


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
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"]').on('change', function () {
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
    @if(old('city'))
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery.ajax({
                    url: "{{route('neighborhoodOld.admin')}}",
                    data: {
                        'cityId': '{{old('city')}}',
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
    <script src="{{asset('files/userMaster/assets/js/numtostr.js')}}"></script>
    <script src="{{asset('files/adminMaster/plugins/select2/select2.full.min.js')}}"></script>

    <script src="{{asset('files/adminMaster/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script>
        // var element = document.getElementsByClassName('select2-container--default');
        //
        // element.style.width = 80%;
        // $('.select2.select2-container.select2-container--default').style.removeAttribute('width');
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //Initialize Select2 Elements
        $('.select2').select2()
    </script>
@endsection

@extends('UserMasterNew::master')
@section('title_user')ایجاد آگهی
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/select2/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/agahi.css')}}">

    {{--    <style>--}}
    {{--        #app {--}}
    {{--            height: 360px;--}}
    {{--        }--}}
    {{--    </style>--}}
    {{--    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">--}}
    {{--    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">--}}
    {{--    <link rel="stylesheet" href="{{asset('files/map/dist/css/mapp.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('files/map/dist/css/fa/style.css')}}">--}}
    @include('Maps::layouts.neshan-css')
    {{--    <link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">--}}
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
    {{--    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/colorpicker/bootstrap-colorpicker.min.css')}}">--}}
    <style>
        .select2-selection.select2-selection--single {
            min-height: 45px;
        }

    </style>
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2-color.css')}}">

@endsection
@section('content_userMasterNew')
    @include('UserMasterNew::layouts.preloader')

    <div class="agahi-detail">
        <div class="container">
            <div class="row pt-5">
                <div class="col-lg-2 mb-4">
                </div>
                <div class="col-lg-9 mb-4">
                    <div style="background-color: #fff">
                        <form action="{{route('ad.store.supplier.user', $category->id)}}" method="post"
                              id="supplierStore"
                              class="form-agahi" enctype="multipart/form-data">
                            @csrf
                            <input hidden name="category_id" value="{{$category->id}}">
                            <input hidden name="agency_id" value="{{$agency_id}}">
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
                                                 style="color:darkred">
                                                @foreach(session()->get('message2') as $message2)
                                                    {{$message2}}
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="first-info">
                                            <div class="first-info-box">
                                                <div class="row">
                                                    <div class="col-lg-12 ">
                                                        <span
                                                            style="font-size: x-large;color: #ddb24f;font-weight: bolder">{{$category->createStringAsParents()}}</span>
                                                        <div class="first-info-box-inputs">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div>
                                                                        <label>شهر </label>
                                                                        <select name="city" class="full select2"
                                                                                dir="rtl"
                                                                                style="height: 45px;width: 80%">
                                                                            <option value=""></option>
                                                                            @foreach($cities as $city)
                                                                                <option value="{{$city->id}}"
                                                                                        @if($city->id==old('city') || ($inputSession&&($category->id==$inputSession['category_id'])?($city->id == $inputSession['city']?$city->id:null):null)) selected @endif
                                                                                >{{$city->title}}</option>

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6" id="neighborhoodOld">

                                                                    <div>
                                                                        <label> محله</label>
                                                                        <select name="neighborhood" class="full select2"
                                                                                dir="rtl"
                                                                                style="height: 45px;width: 80%">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="first-info-box-map text-center">
                                                            <p>
                                                                موقعیت دقیق ملک را مشخص نمایید
                                                            </p>
                                                            <div class="first-info-box-map-show">
                                                                <div
                                                                    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                                                                    <div
                                                                        class="row justify-content-center align-item-center">
                                                                        <div id="map" class="my-3"
                                                                             style=" height: 350px; background: #eee; border: 2px solid #aaa;"></div>
                                                                        {{--                                                                        <div id="app" style="z-index: 90"></div>--}}

                                                                    </div>

                                                                    <input name="latt" id="latt" hidden
                                                                           value="{{old('latt')}}">
                                                                    <input name="longg" id="longg" hidden
                                                                           value="{{old('longg')}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="explain-textarea">
                                                        <label>نشانی</label>
                                                        <br>
                                                        <textarea
                                                            name="address">{{old('address')??(($inputSession&&$category->id==$inputSession['category_id'])?$inputSession['address']:null)}}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @if($attributeGroups->where('type', '!=', 'financial-situation')->count()>0)
                                            <div class="first-info">
                                                @foreach($attributeGroups->where('type', '!=', 'financial-situation') as $key2=>$attrGroup)
                                                    @if($attrGroup->attributes->count() > 0)
                                                        <div class="row justify-content-center align-items-baseline">
                                                            @if($attrGroup->hidden==0)

                                                                <h5 class="formAgahiLabel boldInputLabel"
                                                                    style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                            @endif
                                                            @if($attrGroup->attributes->where('attribute_type', 'bool')->count()>0)
                                                                <div
                                                                    class="col-md-12 col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center">
                                                                    <div class="d-flex flex-column align-items-center">
                                                                        <label
                                                                            class="formAgahiLabel boldInputLabel"></label>
                                                                        <ul class="ks-cboxtags">
                                                                            @foreach($attrGroup->attributes->where('attribute_type', 'bool') as $attr)

                                                                                <li><input type="checkbox"
                                                                                           id="checkboxOne{{$attr->id}}"
                                                                                           name="attribute[{{$attr->id}}][main]"
                                                                                           @if(old('attribute.'.$attr->id.'.main')=='on' || (($inputSession&&$category->id==$inputSession['category_id'])?array_key_exists($attr->id, $inputSession['attribute']):false))checked @endif
                                                                                    ><label
                                                                                        for="checkboxOne{{$attr->id}}">{{$attr->title}}</label>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @foreach($attrGroup->attributes as $attr)

                                                                <div
                                                                    class="col-md-{{$attrGroup->numberOfColumnsForDisplay}} col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center">
                                                                    {{--                                                                @if($attr->attribute_type=='bool')--}}
                                                                    {{--                                                                    <div class="d-flex flex-column align-items-center">--}}

                                                                    {{--                                                                        <ul class="ks-cboxtags">--}}
                                                                    {{--                                                                            <li><input type="checkbox"--}}
                                                                    {{--                                                                                       id="checkboxOne{{$attr->id}}"--}}
                                                                    {{--                                                                                       name="attribute[{{$attr->id}}][main]"--}}
                                                                    {{--                                                                                       @if(old('attribute.'.$attr->id.'.main')=='on' || (($inputSession&&$category->id==$inputSession['category_id'])?array_key_exists($attr->id, $inputSession['attribute']):false))checked @endif><label--}}
                                                                    {{--                                                                                    for="checkboxOne{{$attr->id}}">{{$attr->title}}  </label>--}}
                                                                    {{--                                                                            </li>--}}
                                                                    {{--                                                                        </ul>--}}
                                                                    {{--                                                                    </div>--}}
                                                                    {{--                                                                @else--}}
                                                                    @if($attr->attribute_type=='select')
                                                                        @if($attr->input_type=='checkbox')
                                                                            <div
                                                                                class="boldInputLabel text-center mb-3">
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
                                                                                           @if(old('attribute.'.$attr->id.'.main')==$item->id || ($inputSession&&($category->id==$inputSession['category_id'])?($inputSession['attribute'][$attr->id]['main']==$item->id?$item->id:null):null))checked
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
                                                                                            {{($item->id==old('attribute.'.$attr->id.'.main')?'selected':'') || ($inputSession&&($category->id==$inputSession['category_id']))?(isset($inputSession['attribute'][$attr->id]['main'])?(($inputSession['attribute'][$attr->id]['main'])==$item->id?'selected':null):null):null}}>{{$item->title}}</option>

                                                                                        {{--                                                                                    {{$item->id==old('attribute.'.$attr->id.'.main')?'selected':'' || ($category->id==$inputSession['category_id']&&$inputSession)?(isset($inputSession['attribute'][$attr->id]['main'])?($inputSession['attribute'][$attr->id]['main'])==$item->id?'selected':'':''):null}}>{{$item->title}}</option>--}}
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @elseif($attr->attribute_type=='int')
                                                                        <div
                                                                            class="d-sm-block d-flex flex-column align-items-baseline mb-2">
                                                                            <label
                                                                                class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                            <input type="text" class="simpleInput"
                                                                                   placeholder="{{$attr->placeHolder}}"
                                                                                   @if(isset($attr->alt_value)) onkeyup="document.getElementById('demo_out{{$attr->id}}').innerHTML = Num2persian(this.value)"
                                                                                   @else onkeyup="separateNum(this.value,this);"
                                                                                   @endif
                                                                                   name="attribute[{{$attr->id}}][main]"
                                                                                   value="{{old('attribute.'.$attr->id.'.main') || ($inputSession&&($category->id==$inputSession['category_id']))?(isset($inputSession['attribute'][$attr->id]['main'])?$inputSession['attribute'][$attr->id]['main']:null):null}}"
                                                                                   @if(old('attribute.'.$attr->id.'.alt')== 'on' || ($inputSession&&($category->id==$inputSession['category_id']))?($inputSession?array_search('on',$inputSession['attribute'][$attr->id])=='alt':false):false) disabled @endif>
                                                                        </div>
                                                                        @if(isset($attr->alt_value))

                                                                            <div class="checkbox-place">
                                                                                <input
                                                                                    class="form-check-input simple-checkbox"
                                                                                    type="checkbox"
                                                                                    name="attribute[{{$attr->id}}][alt]"
                                                                                    onchange="clearTextInput(this)"
                                                                                    @if(old('attribute.'.$attr->id.'.alt') == 'on' || ($inputSession&&$category->id==$inputSession['category_id'])?is_array($inputSession['attribute'][$attr->id])?array_search('on',$inputSession['attribute'][$attr->id])=='alt':false:false) checked
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
                                                                            class="d-sm-block d-flex flex-column align-items-baseline mb-2">
                                                                            <label
                                                                                class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>

                                                                            <input type="text"
                                                                                   name="attribute[{{$attr->id}}][main]"
                                                                                   class="simpleInput"
                                                                                   placeholder="{{$attr->placeHolder}}"
                                                                                   value="{{old('attribute.'.$attr->id.'.main')?old('attribute.'.$attr->id.'.main'):($inputSession&&($category->id==$inputSession['category_id'])?($inputSession['attribute'][$attr->id]['main']):null)}}">
                                                                        </div>
                                                                    @elseif($attr->attribute_type=='description')
                                                                        <div class="text-center">
                                                                            <label class="boldInputLabel"
                                                                                   for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                            <textarea
                                                                                name="attribute[{{$attr->id}}][main]"
                                                                                placeholder="{{$attr->placeHolder}}"
                                                                                id="sth1{{$attr->id}}"
                                                                                rows="5">{{old('attribute.'.$attr->id.'.main')?old('attribute.'.$attr->id.'.main'):(($inputSession&&$category->id==$inputSession['category_id'])?($inputSession['attribute'][$attr->id]['main']):null)}}</textarea>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @if($attributeGroups->where('type', '!=', 'financial-situation')->count()!=($key2+1))
                                                            <hr>
                                                        @endif
                                                    @endif

                                                @endforeach
                                            </div>
                                        @endif
                                        @if($attributeGroups->where('type', 'financial-situation')->count()>0)
                                                <div class="first-info">
                                                    @foreach($attributeGroups->where('type', 'financial-situation') as $key=>$attrGroup)
                                                        @if($attrGroup->attributes->count() > 0)
                                                            <div
                                                                class="row justify-content-center align-items-baseline">
                                                                @if($attrGroup->hidden==0)

                                                                    <h5 class="formAgahiLabel boldInputLabel"
                                                                        style="text-align: center;margin-bottom: 20px">{{$attrGroup->title}}</h5>
                                                                @endif
                                                                @if($attrGroup->attributes->where('attribute_type', 'bool')->count()>0)
                                                                    <div
                                                                        class="col-md-12 col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center">
                                                                        <div
                                                                            class="d-flex flex-column align-items-center">
                                                                            <label
                                                                                class="formAgahiLabel boldInputLabel"></label>
                                                                            <ul class="ks-cboxtags">
                                                                                @foreach($attrGroup->attributes->where('attribute_type', 'bool') as $attr)

                                                                                    <li><input type="checkbox"
                                                                                               id="checkboxOne{{$attr->id}}"
                                                                                               name="attribute[{{$attr->id}}][main]"
                                                                                               @if(old('attribute.'.$attr->id.'.main')=='on' || (($inputSession&&$category->id==$inputSession['category_id'])?array_key_exists($attr->id, $inputSession['attribute']):false))checked @endif
                                                                                        ><label
                                                                                            for="checkboxOne{{$attr->id}}">{{$attr->title}}</label>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @foreach($attrGroup->attributes as $attr)

                                                                    <div
                                                                        class="col-md-{{$attrGroup->numberOfColumnsForDisplay}} col-sm-6 mb-4 d-sm-block d-flex flex-column align-items-center">
                                                                        {{--                                                                @if($attr->attribute_type=='bool')--}}
                                                                        {{--                                                                    <div class="d-flex flex-column align-items-center">--}}

                                                                        {{--                                                                        <ul class="ks-cboxtags">--}}
                                                                        {{--                                                                            <li><input type="checkbox"--}}
                                                                        {{--                                                                                       id="checkboxOne{{$attr->id}}"--}}
                                                                        {{--                                                                                       name="attribute[{{$attr->id}}][main]"--}}
                                                                        {{--                                                                                       @if(old('attribute.'.$attr->id.'.main')=='on' || (($inputSession&&$category->id==$inputSession['category_id'])?array_key_exists($attr->id, $inputSession['attribute']):false))checked @endif><label--}}
                                                                        {{--                                                                                    for="checkboxOne{{$attr->id}}">{{$attr->title}}  </label>--}}
                                                                        {{--                                                                            </li>--}}
                                                                        {{--                                                                        </ul>--}}
                                                                        {{--                                                                    </div>--}}
                                                                        {{--                                                                @else--}}
                                                                        @if($attr->attribute_type=='select')
                                                                            @if($attr->input_type=='checkbox')
                                                                                <div
                                                                                    class="boldInputLabel text-center mb-3">
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
                                                                                               @if(old('attribute.'.$attr->id.'.main')==$item->id || ($inputSession&&($category->id==$inputSession['category_id'])?($inputSession['attribute'][$attr->id]['main']==$item->id?$item->id:null):null))checked
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

                                                                                            <option
                                                                                                value="{{$item->id}}"
                                                                                                {{($item->id==old('attribute.'.$attr->id.'.main')?'selected':'') || ($inputSession&&($category->id==$inputSession['category_id']))?(isset($inputSession['attribute'][$attr->id]['main'])?(($inputSession['attribute'][$attr->id]['main'])==$item->id?'selected':null):null):null}}>{{$item->title}}</option>

                                                                                            {{--                                                                                    {{$item->id==old('attribute.'.$attr->id.'.main')?'selected':'' || ($category->id==$inputSession['category_id']&&$inputSession)?(isset($inputSession['attribute'][$attr->id]['main'])?($inputSession['attribute'][$attr->id]['main'])==$item->id?'selected':'':''):null}}>{{$item->title}}</option>--}}
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            @endif
                                                                        @elseif($attr->attribute_type=='int')
                                                                            <div
                                                                                class="d-sm-block d-flex flex-column align-items-baseline mb-2">
                                                                                <label
                                                                                    class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>
                                                                                <input type="text" class="simpleInput"
                                                                                       placeholder="{{$attr->placeHolder}}"
                                                                                       @if(isset($attr->alt_value)) onkeyup="document.getElementById('demo_out{{$attr->id}}').innerHTML = Num2persian(this.value)"
                                                                                       @else onkeyup="separateNum(this.value,this);"
                                                                                       @endif
                                                                                       name="attribute[{{$attr->id}}][main]"
                                                                                       value="{{old('attribute.'.$attr->id.'.main') || ($inputSession&&($category->id==$inputSession['category_id']))?(isset($inputSession['attribute'][$attr->id]['main'])?$inputSession['attribute'][$attr->id]['main']:null):null}}"
                                                                                       @if(old('attribute.'.$attr->id.'.alt')== 'on' || ($inputSession&&($category->id==$inputSession['category_id']))?($inputSession?array_search('on',$inputSession['attribute'][$attr->id])=='alt':false):false) disabled @endif>
                                                                            </div>
                                                                            @if(isset($attr->alt_value))

                                                                                <div class="checkbox-place">
                                                                                    <input
                                                                                        class="form-check-input simple-checkbox"
                                                                                        type="checkbox"
                                                                                        name="attribute[{{$attr->id}}][alt]"
                                                                                        onchange="clearTextInput(this)"
                                                                                        @if(old('attribute.'.$attr->id.'.alt') == 'on' || ($inputSession&&($category->id==$inputSession['category_id']))?is_array($inputSession['attribute'][$attr->id])?array_search('on',$inputSession['attribute'][$attr->id])=='alt':false:false) checked
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
                                                                                class="d-sm-block d-flex flex-column align-items-baseline mb-2">
                                                                                <label
                                                                                    class="formAgahiLabel boldInputLabel"> {{$attr->title}}</label>

                                                                                <input type="text"
                                                                                       name="attribute[{{$attr->id}}][main]"
                                                                                       class="simpleInput"
                                                                                       placeholder="{{$attr->placeHolder}}"
                                                                                       value="{{old('attribute.'.$attr->id.'.main')?old('attribute.'.$attr->id.'.main'):(($inputSession&&($category->id==$inputSession['category_id']))?($inputSession['attribute'][$attr->id]['main']):null)}}">
                                                                            </div>
                                                                        @elseif($attr->attribute_type=='description')
                                                                            <div class="text-center">
                                                                                <label class="boldInputLabel"
                                                                                       for="sth1{{$attr->id}}">{{$attr->title}}</label>
                                                                                <textarea
                                                                                    name="attribute[{{$attr->id}}][main]"
                                                                                    placeholder="{{$attr->placeHolder}}"
                                                                                    id="sth1{{$attr->id}}"
                                                                                    rows="5">
                                            {{old('attribute.'.$attr->id.'.main')?old('attribute.'.$attr->id.'.main'):(($inputSession&&($category->id==$inputSession['category_id']))?($inputSession['attribute'][$attr->id]['main']):null)}}</textarea>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @if($attributeGroups->where('type', 'financial-situation')->count()!=($key+1))
                                                            <hr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                        @endif
                                        <div class="first-info">
                                            <div class="col-lg-12 ">
                                                <div class="first-info-box-inputs">

                                                    <div>
                                                        <label for="cars">عنوان آگهی</label>
                                                        <input type="text" name="title" style="height: 45px"
                                                               value="{{old('title')??(($inputSession&&($category->id==$inputSession['category_id']))?$inputSession['title']:null)}}">

                                                    </div>
                                                    <div>
                                                        <label for="cars">نوع آگهی</label>
                                                        <select name="adType" id="adType" class="full"
                                                                style="height: 45px">
                                                            <option value=""></option>
                                                            <option value="general"
                                                                    @if('general'==old('adType') || (($inputSession&&($category->id==$inputSession['category_id']))?'general'==$inputSession['adType']:null)) selected @endif>
                                                                عادی
                                                            </option>
                                                            @if($hasScalar)
                                                                <option value="scalar"
                                                                        @if('scalar'==old('adType') || ($inputSession&&$category->id==$inputSession['category_id']?'scalar'==$inputSession['adType']:null)) selected @endif>
                                                                    نردبانی
                                                                </option>
                                                            @endif
                                                            @if($hasSpecial)
                                                                <option value="special"
                                                                        @if('special'==old('adType') || ($inputSession&&$category->id==$inputSession['category_id']?'special'==$inputSession['adType']:null)) selected @endif>
                                                                    ویژه
                                                                </option>
                                                            @endif
                                                            @if($hasEmergency)
                                                                <option value="emergency"
                                                                        @if('emergency'==old('adType') || ($inputSession&&$category->id==$inputSession['category_id']?'emergency'==$inputSession['adType']:null)) selected @endif>
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
                                                <i class="imgAdd d-flex justify-content-center align-content-center">
                                                    <p style="font-weight: 900;font-size: 1.5rem;margin-top: 2px;color: #2a2929">+</p>
                                                </i>
                                            </div>
                                            <div class="col-md-10 mb-3">

                                                <div class="form-group">
                                                    <label>انتخاب رنگ برای واترمارک اسم کسب و کار شما برای
                                                        تصاویر:</label>
                                                    <input type="color" name="color" value="{{old('color')}}" readonly
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <p class="boldInputLabel">
                                                کاتالوگ محصول:
                                            </p>
                                            <div class="row p-5 d-flex">
                                                <div class="col-md-4 imgUp">
                                                    <div class="imagePreview"></div>
                                                    <label class="btn btn-upImg"
                                                           style="color: #fff; background: #2a2929">
                                                        انتخاب<input name="catalog" type="file"
                                                                     class="uploadFile img"
                                                                     value="Upload Catalog"
                                                                     style="width: 0px;height: 0px;overflow: hidden;">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 ">
                                                <div class="first-info-box-inputs">

                                                    <div>
                                                        <label for="catalogDescription">توضیحات کاتالوگ</label>
                                                        <input type="text" name="catalogDescription"
                                                               style="height: 45px"
                                                               value="{{old('catalogDescription')??(($inputSession&&($category->id==$inputSession['category_id']))?$inputSession['catalogDescription']:null)}}">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="explain-textarea">
                                                <label>توضیحات تکمیلی</label>
                                                <br>
                                                <textarea name="description"
                                                          placeholder="توضیحات تکمیلی شما برای بازدیدکنندگان نمایش میگردد، بنابراین هرچه جزییات بیشتری را درج کنید، شانس دیده شدن را افزایش می دهد">{{old('description')??(($inputSession&&($category->id==$inputSession['category_id']))?$inputSession['description']:null)}}</textarea>
                                            </div>
{{--                                            @if(auth()->check())--}}
{{--                                                @if(auth()->user()->hasRole('ordinary-user') )--}}
{{--                                                    <div class="checkbox-place text">--}}
{{--                                                        <input class="form-check-input simple-checkbox" type="checkbox"--}}
{{--                                                               name="request_to_agency"--}}
{{--                                                               @if(old('request_to_agency') == 'on'||($inputSession&&($category->id==$inputSession['category_id'])&&isset($inputSession['request_to_agency']))) checked--}}
{{--                                                               @endif--}}
{{--                                                               id="request_to_agency">--}}
{{--                                                        <label class="form-check-label" for="flexCheckDefault"--}}
{{--                                                               style="outline: none;">--}}
{{--                                                            آگهی خود را به یک کسب و کار واگذار می کنید؟--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            @else--}}
{{--                                                <div class="checkbox-place text">--}}
{{--                                                    <input class="form-check-input simple-checkbox" type="checkbox"--}}
{{--                                                           name="request_to_agency"--}}
{{--                                                           @if(old('request_to_agency') == 'on'||($inputSession&&$category->id==$inputSession['category_id']&&isset($inputSession['request_to_agency']))) checked--}}
{{--                                                           @endif--}}
{{--                                                           id="request_to_agency">--}}
{{--                                                    <label class="form-check-label" for="flexCheckDefault"--}}
{{--                                                           style="outline: none;">--}}
{{--                                                        آگهی خود را به یک کسب و کار واگذار می کنید؟--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}

{{--                                            @endif--}}
                                            <div class="agahi-price-box" id="paymentCards">
                                                {!! $content !!}

                                            </div>
                                            {{--                                <div class="account-choice">--}}
                                            {{--                                    <div class="row" id="paymentCards">--}}
                                            {{--                                        {!! $content !!}--}}
                                            {{--                                    </div>--}}
                                            {{--                                </div>--}}

                                            <div class="form-agahi-btn">
                                                <a onclick="testtt({{$agency_id}})" class="enseraf"
                                                   style="cursor: pointer">تغییر
                                                    دسته بندی</a>
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
@endsection

@section('js_user')


    {{--    <script src2="{{asset('files/adminMaster/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>--}}
    {{--    <script>--}}
    {{--        //Colorpicker--}}
    {{--        $('.my-colorpicker1').colorpicker()--}}
    {{--    </script>--}}
    <script>
        jQuery(document).ready(function ($) {
            $('.document-image img').click(function (event) {
// detect data-id for later
                var id = $(this).data('id');
// grab src2 to replace #featured
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
                    const list = document.getElementById("preloaderContent").classList;

                    var uploadFile = $(this);
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                    if (/^image/.test(files[0].type)) { // only image file
                        list.remove("close");
                        list.add("open");
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
                            list.remove("close");
                            list.add("open");
                            $(this).closest(".row").find('.imgAdd').prepend('<i class="videoAdd" style="display: contents"></i>');
                            var reader = new FileReader(); // instance of the FileReader

                            reader.readAsDataURL(files[0]); // read the local file
                            reader.onloadend = function () { // set image data as background of div

                                var s = uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url({{asset($video_image_for_display_in_upload)}})");
                            }
                        }
                    }
                    // if (!(/^image/.test(files[0].type) || /^video/.test(files[0].type))){
                    //     alert('فقط مجاز یه آپلود عکس یا ویدیو هستید.')
                    // }
                    list.remove("open");
                    list.add("close");
                });
            });
        });

    </script>
    <script>
        function testtt(agencyId) {
            if (agencyId) {
                var url = '{{route('ad.find.cats.level2.user', 'supplier')}}';
                var form = document.createElement("form");
                form.setAttribute("id", "form1");
                form.setAttribute("method", "GET");
                form.setAttribute("action", url);
                form.setAttribute("target", "_self");
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("name", "agency_id");
                hiddenField.setAttribute("value", agencyId);
                form.appendChild(hiddenField);
                var hiddenField2 = document.createElement("input");
                hiddenField2.setAttribute("name", "categoryId");
                hiddenField2.setAttribute("value", '{{$category->getGrandParent()}}');
                form.appendChild(hiddenField2);
                document.body.appendChild(form);
                form.submit();
            } else {
                var url = '{{route('categories.find.cats', ['type'=>'supplier', 'panel'=>'user'])}}';
                var form = document.createElement("form");
                form.setAttribute("id", "form1");
                form.setAttribute("method", "GET");
                form.setAttribute("action", url);
                form.setAttribute("target", "_self");
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("name", "agency_id");
                hiddenField.setAttribute("value", agencyId);
                form.appendChild(hiddenField);
                document.body.appendChild(form);
                form.submit();
            }
        }
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
    {{--    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/jquery-3.2.1.min.js"></script>--}}
    {{--    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>--}}
    {{--    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>--}}
    {{--    <script type="text/javascript" src="{{asset('files/map/dist/js/mapp..env.js')}}"></script>--}}
    {{--    <script type="text/javascript" src="{{asset('files/map/dist/js/mapp.min.js')}}"></script>--}}
    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            var app = new Mapp({--}}
    {{--                element: '#app',--}}
    {{--                presets: {--}}
    {{--                    latlng: {--}}
    {{--                        lat: 35.72422098694338,--}}
    {{--                        lng: 51.4022610865622,--}}
    {{--                    },--}}
    {{--                    zoom: 10--}}
    {{--                },--}}
    {{--                apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIn0.eyJhdWQiOiIxNDAyMSIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIiwiaWF0IjoxNjIxMjMzMDE1LCJuYmYiOjE2MjEyMzMwMTUsImV4cCI6MTYyMzgyNTAxNSwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.g-oaFkPxTsmJka5HczgcUvJMmuM6HKdrJgEaVyHWzNXu3UmkOjWch_d8nf0OIOQqKSG6I-KpjMYVEfj1KRH9iI4x9HYilH9qSq8epsUElbWuS6OLTCS3i_a-CCgelms3qFvbnik7tkfw_7f41zCZRxO-8w1h-41QkOMVtXLalZF-R7khLb5PShh75lo60Iezy9eEpoIZduQe2GlF_yjHMI8oLC9ZSLeH03Qw5UvjycPyEpYhwBUiqK9THv4mAnsKt89EjwENDcaWxxFS1uymGfbi2tdpE1tiT0QgUkVsFHvwivBCDRIf3eLIVXmY2ryi7LlKNmDfScWqCN11u_ZRMA'--}}
    {{--            });--}}
    {{--            app.addLayers();--}}
    {{--            app.map.on('click', function (e) {--}}
    {{--                var marker = app.addMarker({--}}
    {{--                    name: 'advanced-marker',--}}
    {{--                    latlng: {--}}
    {{--                        lat: e.latlng.lat,--}}
    {{--                        lng: e.latlng.lng,--}}
    {{--                    },--}}
    {{--                    icon: app.icons.red,--}}
    {{--                    popup: {--}}
    {{--                        title: {--}}
    {{--                            i18n: 'marker-title',--}}
    {{--                        },--}}
    {{--                        description: {--}}
    {{--                            i18n: 'marker-description',--}}
    {{--                        },--}}
    {{--                        class: 'marker-class',--}}
    {{--                        open: true,--}}
    {{--                    },--}}
    {{--                    pan: false,--}}
    {{--                    draggable: true,--}}
    {{--                    history: false,--}}
    {{--                    on: {--}}
    {{--                        click: function () {--}}
    {{--                        },--}}
    {{--                        contextmenu: function () {--}}
    {{--                        },--}}
    {{--                    },--}}
    {{--                });--}}
    {{--                var lat1 = e.latlng.lat;--}}
    {{--                var lng1 = e.latlng.lng;--}}
    {{--                $('#supplierStore').find('[name="latt"]').val(lat1);--}}
    {{--                $('#supplierStore').find('[name="longg"]').val(lng1);--}}

    {{--                if (lat1 && lng1) {--}}
    {{--                    jQuery.ajax({--}}
    {{--                        url: "{{route('sendLatlngToApi')}}",--}}
    {{--                        data: {--}}
    {{--                            'lat1': lat1,--}}
    {{--                            'lng1': lng1,--}}
    {{--                        },--}}
    {{--                        type: "GET",--}}
    {{--                        dataType: "json",--}}
    {{--                        success: function (data) {--}}
    {{--                            $('#supplierStore').find('[name="address"]').val(data.address);--}}
    {{--                        }--}}
    {{--                    });--}}
    {{--                } else {--}}
    {{--                }--}}
    {{--                app.showReverseGeocode({--}}
    {{--                    state: {--}}
    {{--                        latlng: {--}}
    {{--                            lat: e.latlng.lat,--}}
    {{--                            lng: e.latlng.lng,--}}
    {{--                        },--}}
    {{--                        zoom: 16,--}}
    {{--                    },--}}
    {{--                });--}}


    {{--            })--}}
    {{--        });--}}
    {{--    </script>--}}
    <script>
        {{--if({{isset($inputSession)}}) {--}}
        {{--    if ({{$inputSession['longg']}} && {{$inputSession['latt']}} && {{$category->id == $inputSession['category_id']}})--}}
        {{--    {--}}
        {{--        $('#supplierStore').find('[name="latt"]').val({{$inputSession['latt']}});--}}
        {{--        $('#supplierStore').find('[name="longg"]').val({{$inputSession['longg']}});--}}
        {{--    }--}}
        {{--}--}}
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
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[id="adType"]').on('change', function () {
                var type = jQuery('select[name="adType"]').val();
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
                            $('#paymentCards').empty();
                            $('#paymentCards').append(data.content);
                        } else {
                        }
                    }
                });
            });
        });
    </script>
    @if((old('adPaymentFee')||$inputSession && ($category->id == $inputSession['category_id'])?($inputSession?array_key_exists('adPaymentFee', $inputSession):false):false))
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery.ajax({
                    url: "{{route('show.chosen.AdFeeCard.user')}}",
                    data: {
                        'adFeeId': '{{old('adPaymentFee')?old('adPaymentFee'):$inputSession['adPaymentFee']}}',
                        'cat_id': '{{$category->id}}',
                        'type': jQuery('select[name="adType"]').val(),
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.content) {
                            $('#paymentCards').empty();
                            $('#paymentCards').append(data.content);
                        } else {
                        }
                    }
                })
            });
        </script>
    @endif
    @if((old('city')) || ($inputSession && ($category->id == $inputSession['category_id'])))
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery.ajax({
                    url: "{{route('neighborhoodOld.user')}}",
                    data: {
                        'cityId': '{{old('city')?old('city'):$inputSession['city']}}',
                        'neighborhoodId': '{{old('neighborhood')?old('neighborhood'):($inputSession?($inputSession['neighborhood']??null):null)}}',
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
    <script>

        $(function () {
//Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
    @include('Maps::layouts.neshan-js')

@endsection

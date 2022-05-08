@extends('UserMasterNew::master')
@section('title_user')انتخاب دسته بندی
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/agahi.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/request-register.css')}}">
    <style>
        .select2-selection.select2-selection--single {
            min-height: 38px;
        }

        .select2-selection.select2-selection--multiple {
            min-height: 38px;
        }


    </style>
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2-color.css')}}">

@endsection
@section('content_userMasterNew')
    <div class="agahi-detail">
        <div class="container">
            <div class="request-register-form my-5 py-5">
                <div class="category-order">
                    {{$category->createStringAsParents()}}
                </div>
                <div class="request-register-form-title">
                    <span></span>
                    <h5>ثبت درخواست</h5>
                </div>
                <div class="req-category-txtbox">
                    <p>{{$warnText}}</p>
                </div>
                @if(session()->has('message3'))
                    <div class="alert alert-danger "
                         style="color:darkred">{{ session()->get('message3') }}</div>
                @endif
                @if(session()->has('message2'))
                    <div class="alert alert-danger "
                         style="color:darkred">{{ session()->get('message2') }}</div>
                @endif
                <form action="{{route('application.store.user', $category->id)}}" class="request-form" method="post">
                    @csrf
                    <input hidden name="agency_id" value="{{$agency_id}}">
                    <input hidden name="category_id" value="{{$category->id}}">
                    <div class="main-topsearchboxes">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 d-flex flex-column  align-items-center">
                                    <div>
                                        <label for="" class="simple-label">عنوان درخواست</label>
                                        <textarea class="simple-txt-input large" type="text" name="title"
                                                  placeholder="این عنوان را فروشندگان خواهند دید"
                                                  rows="3">{{old('title')??($inputSession&&$category->id==$inputSession['category_id']?$inputSession['title']:null)}}</textarea>
                                    </div>
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                </div>
                                <div class="col-md-6 d-flex flex-column  align-items-md-baseline  align-items-center">
                                    <div class="mb-3">
                                        <label class="simple-label" for="city">شهر</label>
                                        <select class="chosen select-box select2" searchable="Search here.." name="city"
                                                dir="rtl">

                                            <option value=""></option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}"
                                                        @if($city->id==old('city') || ($inputSession&&($category->id==$inputSession['category_id'])?($city->id == $inputSession['city']?$city->id:null):null)) selected @endif>{{$city->title}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('city') }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <div class="select-box">
                                            <label for="" class="simple-label">محله</label>
                                            <select class="js-example-basic-multiple select2" style="width: 100%"
                                                    dir="rtl"
                                                    name="neighborhood[]" multiple="multiple" id="neighborhoodOld">
                                            </select>
                                            <small class="text-danger">{{ $errors->first('neighborhood') }}</small>
                                            <i class="fas fa-caret-down select-arrow"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                     <div class="add-new-link">--}}
                    {{--                        <p>در صورتی که به دنبال خرید یا اجاره ملکی هستید، تقاضای خود را ثبت نمایید. جهت فروش یا--}}
                    {{--                            اجاره ملک خود را از قسمت <a href="#">افزودن ملک</a> اقدام نمایید.</p>--}}
                    {{--                    </div>--}}
                    <div class="main-inputs-form">
                        <div class="container">
                            <div class="row align-items-center justify-content-center">
                                @foreach($attributeGroups as $attrGroup)
                                    @if($attrGroup->hidden==0)
                                        <div class="row justify-content-center align-items-center">
                                            <h5 style="text-align: center;margin-bottom: 20px;margin-top: 20px; font-weight: bold"
                                                class="text-bold">{{$attrGroup->title}}</h5>
                                            @foreach($attrGroup->attributes as $attr)
                                                @if($attr->attribute_type=='int')
                                                    @if($attr->hasScale==1)
                                                        <div
                                                            class="col-xl-4 col-md-6 my-3 d-flex flex-column align-items-center">
                                                            <label for=""
                                                                   class="simple-label">{{$attr->title}} @if($attr->isFilterField==1)
                                                                    <small class="text-danger">*</small> @endif</label>
                                                            <div class="double-inputs">
                                                                <div class="minimum">
                                                                    <label for="">از</label>
                                                                    <input type="text" class="double-txt-input"
                                                                           name="attribute[{{$attr->id}}][min]"
                                                                           placeholder="{{$attr->placeHolder}}"
                                                                           onkeyup="separateNum(this.value,this);"
                                                                           value="{{old('attribute.'.$attr->id.'.min') || ($inputSession&&($category->id==$inputSession['category_id']))?(isset($inputSession['attribute'][$attr->id]['min'])?$inputSession['attribute'][$attr->id]['min']:''):null}}"
                                                                    >
                                                                </div>
                                                                <div class="maximum">
                                                                    <label for="">تا</label>
                                                                    <input type="text" class="double-txt-input"
                                                                           name="attribute[{{$attr->id}}][max]"
                                                                           placeholder="{{$attr->placeHolder}}"
                                                                           onkeyup="separateNum(this.value,this);"
                                                                           value="{{old('attribute.'.$attr->id.'.max') || ($inputSession&&($category->id==$inputSession['category_id']))?(isset($inputSession['attribute'][$attr->id]['max'])?$inputSession['attribute'][$attr->id]['max']:''):null}}"
                                                                    >
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @else
                                                        <div
                                                            class="col-xl-4 col-md-6 mb-3 d-flex flex-column align-items-center">
                                                            <label for=""
                                                                   class="simple-label">{{$attr->title}} @if($attr->isFilterField==1)
                                                                    <small class="text-danger">*</small> @endif</label>
                                                            <input class="simple-txt-input" type="text"
                                                                   placeholder="{{$attr->placeHolder}}"
                                                                   name="attribute[{{$attr->id}}]"
                                                                   onkeyup="separateNum(this.value,this);"
                                                                   value="{{old('attribute.'.$attr->id) || ($inputSession&&($category->id==$inputSession['category_id']))?(isset($inputSession['attribute'][$attr->id])?$inputSession['attribute'][$attr->id]:''):null}}">
                                                        </div>
                                                    @endif
                                                @elseif($attr->attribute_type=='string')
                                                    <div
                                                        class="col-xl-4 col-md-6 mb-3 d-flex flex-column align-items-center">
                                                        <label for=""
                                                               class="simple-label">{{$attr->title}} @if($attr->isFilterField==1)
                                                                <small class="text-danger">*</small> @endif</label>
                                                        <input class="simple-txt-input" type="text"
                                                               name="attribute[{{$attr->id}}]"
                                                               placeholder="{{$attr->placeHolder}}"
                                                               value="{{(old('attribute.'.$attr->id)?old('attribute.'.$attr->id):(($category->id==$inputSession['category_id'])&&$inputSession))
                                                                                ?$inputSession['attribute'][$attr->id]:null}}">
                                                    </div>
                                                @elseif($attr->attribute_type=='select')
                                                    @if($attr->hasScale==1)
                                                        <div
                                                            class="col-xl-4 col-md-6 my-3 d-flex flex-column align-items-center">
                                                            <label for=""
                                                                   class="simple-label">{{$attr->title}} @if($attr->isFilterField==1)
                                                                    <small class="text-danger">*</small> @endif</label>
                                                            <div class="double-inputs">
                                                                <div class="minimum">
                                                                    <label for="">از</label>
                                                                    <select class="double-select-input"
                                                                            name="attribute[{{$attr->id}}][min]">
                                                                        <option
                                                                            value="">{{$attr->placeHolder}}</option>
                                                                        @foreach($attr->attributeItems as $item)

                                                                            <option value="{{$item->id}}"
                                                                                {{($item->id==old('attribute.'.$attr->id.'.min')?'selected':'') || ($inputSession&&$category->id==$inputSession['category_id'])?(isset($inputSession['attribute'][$attr->id]['min'])?(($inputSession['attribute'][$attr->id]['min'])==$item->id?'selected':''):''):null}}>{{$item->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="maximum">
                                                                    <label for="">تا</label>
                                                                    <select class="double-select-input"
                                                                            name="attribute[{{$attr->id}}][max]">
                                                                        <option
                                                                            value="">{{$attr->placeHolder}}</option>
                                                                        @foreach($attr->attributeItems as $item)

                                                                            <option value="{{$item->id}}"
                                                                                {{($item->id==old('attribute.'.$attr->id.'.max')?'selected':'') || ($inputSession && ($category->id==$inputSession['category_id']))?(isset($inputSession['attribute'][$attr->id]['max'])?(($inputSession['attribute'][$attr->id]['max'])==$item->id?'selected':''):''):null}}>{{$item->title}}</option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
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
                                                                           @if(old('attribute.'.$attr->id)==$item->id || ($inputSession&&($category->id==$inputSession['category_id'])?(isset($inputSession['attribute'][$attr->id])?($inputSession['attribute'][$attr->id]==$item->id?$item->id:null):null):null))checked
                                                                           @endif
                                                                           id="tempRadio-1{{$item->id}}">
                                                                    <label class="radio--label half"
                                                                           for="tempRadio-1{{$item->id}}">

                                                                        {{$item->title}}
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <div
                                                                class="col-xl-4 col-sm-6 mb-4 d-flex flex-column align-items-center">
                                                                <label class="simple-label"
                                                                       for="">{{$attr->title}} @if($attr->isFilterField==1)
                                                                        <small class="text-danger">*</small> @endif
                                                                </label>
                                                                <select class="simple-select-input"
                                                                        name="attribute[{{$attr->id}}]">
                                                                    <option
                                                                        value="">{{$attr->placeHolder}}</option>
                                                                    @foreach($attr->attributeItems as $item)

                                                                        <option value="{{$item->id}}"
                                                                            {{($item->id==old('attribute.'.$attr->id)?'selected':'') || ($inputSession&&($category->id==$inputSession['category_id']))?(isset($inputSession['attribute'][$attr->id])?(($inputSession['attribute'][$attr->id])==$item->id?'selected':''):''):null}}>{{$item->title}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @elseif($attr->attribute_type=='bool')
                                                    <div
                                                        class="col-md-2 col-sm-6 mb-4 d-sm-block d-flex align-items-center justify justify-content-center">
                                                        <div class="d-flex ">
                                                            <ul class="ks-cboxtags">
                                                                <li>
                                                                    <input type="checkbox"
                                                                           id="checkboxOne{{$attr->id}}"
                                                                           name="attribute[{{$attr->id}}]"
                                                                           @if(old('attribute.'.$attr->id)=='on' || (($inputSession&&$category->id==$inputSession['category_id'])?array_key_exists($attr->id, $inputSession['attribute']):false))checked @endif><label
                                                                        for="checkboxOne{{$attr->id}}">{{$attr->title}}  </label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @elseif($attr->attribute_type=='description')
                                                    <div
                                                        class="col-xl-4 col-md-6 mb-3 d-flex flex-column align-items-center">
                                                        <div class="text-center">
                                                            <label
                                                                class="simple-label">{{$attr->title}} @if($attr->isFilterField==1)
                                                                    <small class="text-danger">*</small> @endif</label>
                                                            <textarea rows="5" class="simple-text-area"
                                                                      name="attribute[{{$attr->id}}]">{{old('attribute.'.$attr->id)?old('attribute.'.$attr->id):(($category->id==$inputSession['category_id']&&$inputSession)?($inputSession['attribute'][$attr->id]):null)}}</textarea>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                                <div class="col-12 my-4 ">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8">
                                            <div class="">
                                                <label class="simple-label">توضیحات تکمیلی</label>
                                                <textarea rows="10" name="description"
                                                          class="simple-text-area">{{old('description')??($inputSession&&$category->id==$inputSession['category_id']?$inputSession['description']:null)}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 my-4">
                                            <div class="phone-numbers">
                                                <label for="" class="simple-label">شماره تلفن پاسخگویی به
                                                    فروشندگان</label>
                                                <input class="simple-txt-input" type="text" name="phone"
                                                       value="{{old('phone')??($inputSession&&$category->id==$inputSession['category_id']?$inputSession['phone']:null)}}"
                                                       placeholder="02122445689">
                                            </div>
                                            <small class="text-danger mb-2">{{ $errors->first('phone') }}</small>

                                            <div class="phone-numbers">
                                                <label for="" class="simple-label">شماره موبایل پاسخگویی به
                                                    فروشندگان</label>
                                                <input class="simple-txt-input" type="text" placeholder="09121234567"
                                                       name="mobile"
                                                       value="{{old('mobile')??($inputSession&&$category->id==$inputSession['category_id']?$inputSession['mobile']:null)}}">
                                            </div>
                                            <small class="text-danger mb-2">{{ $errors->first('mobile') }}</small>

                                            {{--                                            <button type="submit-mobile-btn" class="submit-mobile-btn">تایید موبایل--}}
                                            {{--                                            </button>--}}
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12  text-center ">
                                    <div class="form-agahi-btn">

                                        <button type="submit" class="save-rq">ثبت درخواست</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if($advertisement->count()>0)
                    @foreach($advertisement as $ad)
                        @if($ad->startDate <= \Hekmatinasser\Verta\Verta::now()->startMonth() && $ad->endDate <= \Hekmatinasser\Verta\Verta::now()->endMonth()
                        && ($ad->checkCategory($category)))
                            <div class="advertisments-place">
                                <div class="ad-box medium"><img src="{{asset($ad->image)}}"
                                                                alt="">
                                    <a href="{{$ad->link}}" target="_blank"
                                       style="width: 100%; height: 100%"></a>
                                </div>
                            </div>
                        @else
                            <div class="advertisments-place">
                                <div class="ad-box medium">
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-6 py-4">
                                            <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="advertisments-place">
                        <div class="ad-box medium">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-6 py-4">
                                    <span style="font-weight: bolder">مکان تبلیغات شما</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
@section('js_user')
    <script src="{{asset('files/userMaster/assets/js/select2.js')}}"></script>
    <script src="{{asset('files/userMaster/assets/js/main.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"]').on('change', function () {
                var cityId = jQuery(this).val();
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
                            jQuery('select[name="neighborhood[]"]').empty();
                            $('select[name="neighborhood[]"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhood[]"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="neighborhood[]"]').empty();
                }
            });
        });
    </script>

    @if((old('city')) || ($inputSession && $category->id == $inputSession['category_id']))
        <script type="text/javascript">
            jQuery(document).ready(function () {
                var neigh = [];
                @if ($isNeighborhood == 1)
                    neigh = @json($inputSession['neighborhood']);
                @endif

                jQuery.ajax({
                    url: "{{route('neighborhood.neighborhoodOld.user')}}",
                    data: {
                        'cityId': '{{old('city')?old('city'):$inputSession['city']}}',
                        // 'neighborhoodIds':  neigh,
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
    <script src="{{asset('files/adminMaster/plugins/select2/select2.full.min.js')}}"></script>
    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
@endsection

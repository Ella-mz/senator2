@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد درخواست جدید
@endsection
@section('header')
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/adminMaster/dist/css/agahi.css')}}">
    <style>
        .select2-selection.select2-selection--single {
            min-height: 42px;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                @if(session()->has('message3'))
                    <div class="alert alert-danger "
                         style="color:darkred">{{ session()->get('message3') }}</div>
                @endif
                @if(session()->has('message2'))
                    <div class="alert alert-danger "
                         style="color:darkred">{{ session()->get('message2') }}</div>
                @endif

                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title"> درخواست جدید</h1>
                    </div>
                    <form action="{{route('application.store.admin', $category->id)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">عنوان درخواست</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="city">شهر</label>
                                        <select class="form-control select2" name="city" style="width: 100%;" dir="rtl">
                                            <option value=""></option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}"
                                                        @if($city->id==old('city')) selected @endif>{{$city->title}}</option>

                                            @endforeach
                                        </select>
                                        {{--                                <input type="text" name="numberOfColumnsForDisplay" class="form-control" value="{{old('numberOfColumnsForDisplay')}}"--}}
                                        {{--                                       autofocus required>--}}
                                        <small class="text-danger">{{ $errors->first('city') }}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="neighborhood">محله ها</label>
                                        <select class="form-control select2" name="neighborhood[]" style="width: 100%;"
                                                dir="rtl"
                                                multiple="multiple">
                                        </select>
                                        {{--                                <input type="text" name="numberOfColumnsForDisplay" class="form-control" value="{{old('numberOfColumnsForDisplay')}}"--}}
                                        {{--                                       autofocus required>--}}
                                        <small class="text-danger">{{ $errors->first('neighborhood') }}</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="phone">شماره تلفن</label><br>
                                            <input type="text" name="phone" class="form-control"
                                                   value="{{old('phone')}}"
                                                   autofocus>
                                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="phone">شماره موبایل</label><br>
                                            <small class="text-secondary">در صورت وارد نکردن شماره موبایل، شماره موبایلی
                                                که با آن ورود کرده اید برای درخواست شما ثبت می شود.</small>
                                            <input type="text" name="mobile" class="form-control"
                                                   value="{{old('mobile')}}"
                                                   autofocus>
                                            <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">توضیحات شما</label>
                                    <textarea name="description" rows="5"
                                              class="form-control">{{old('description')}}</textarea>
                                    <small class="text-danger">{{ $errors->first('description') }}</small>
                                </div>
                            </div>
                            @foreach($attributeGroups as $attrGroup)
                                @if($attrGroup->hidden==0)
                                    <h5 style="text-align: center;margin-bottom: 20px;margin-top: 20px">{{$attrGroup->title}}</h5>
                                @endif
                                <div class="row">

                                    @foreach($attrGroup->attributes as $attr)
                                        @if($attr->attribute_type=='int')
                                            @if($attr->hasScale==1)

                                                <div class="col-md-3">
                                                    <label style="margin-bottom: 0rem"> {{$attr->title}}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mb-2">از</span>
                                                        </div>
                                                        <input type="text" name="attribute[{{$attr->id}}][min]"
                                                               class="form-control mb-2"
                                                               placeholder="{{$attr->placeHolder}}"
                                                               onkeyup="separateNum(this.value,this);"
                                                               value="{{old('attribute.'.$attr->id.'.min')}}"
                                                               autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label style="margin-bottom: 0rem"> </label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mb-2">تا</span>
                                                        </div>
                                                        <input type="text" name="attribute[{{$attr->id}}][max]"
                                                               class="form-control mb-2"
                                                               placeholder="{{$attr->placeHolder}}"
                                                               onkeyup="separateNum(this.value,this);"
                                                               value="{{old('attribute.'.$attr->id.'.max')}}"
                                                               autofocus>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-6">

                                                    <label style="margin-bottom: 0rem"> {{$attr->title}}</label>
                                                    <input type="text" name="attribute[{{$attr->id}}]"
                                                           class="form-control mb-2"
                                                           placeholder="{{$attr->placeHolder}}"
                                                           onkeyup="separateNum(this.value,this);"
                                                           value="{{old('attribute.'.$attr->id)}}"
                                                           autofocus>
                                                </div>
                                            @endif
                                        @elseif($attr->attribute_type=='string')
                                            <div class="col-md-6">

                                                <label style="margin-bottom: 0rem"> {{$attr->title}}</label>
                                                <input type="text" name="attribute[{{$attr->id}}]"
                                                       class="form-control mb-2"
                                                       placeholder="{{$attr->placeHolder}}"
                                                       value="{{old('attribute.'.$attr->id)}}"
                                                       autofocus>
                                            </div>
                                        @elseif($attr->attribute_type=='select')
                                            @if($attr->hasScale==1)
                                                <div class="col-md-3">

                                                    <label style="margin-bottom: 0rem">{{$attr->title}}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend mb-2">
                                                            <span class="input-group-text">از</span>
                                                        </div>
                                                        <select class="form-control"
                                                                name="attribute[{{$attr->id}}][min]">

                                                            <option
                                                                value="">{{$attr->placeHolder}}</option>
                                                            @foreach($attr->attributeItems as $item)

                                                                <option value="{{$item->id}}"
                                                                    {{$item->id==old('attribute.'.$attr->id.'.min')?'selected':''}}>{{$item->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">

                                                    <label style="margin-bottom: 0rem"></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mb-2">تا</span>
                                                        </div>
                                                        <select class="form-control"
                                                                name="attribute[{{$attr->id}}][max]">
                                                            <option
                                                                value="">{{$attr->placeHolder}}</option>
                                                            @foreach($attr->attributeItems as $item)

                                                                <option value="{{$item->id}}"
                                                                    {{$item->id==old('attribute.'.$attr->id.'.max')?'selected':''}}>{{$item->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-6">

                                                    <label style="margin-bottom: 0rem">{{$attr->title}}</label>
                                                    <select class="form-control"
                                                            name="attribute[{{$attr->id}}]">
                                                        <option
                                                            value="">{{$attr->placeHolder}}</option>
                                                        @foreach($attr->attributeItems as $item)

                                                            <option value="{{$item->id}}"
                                                                {{$item->id==old('attribute.'.$attr->id)?'selected':''}}>{{$item->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @elseif($attr->attribute_type=='bool')
                                            <div class="d-flex flex-column align-items-center justify-content-center">

                                                <ul class="ks-cboxtags">
                                                    <li><input type="checkbox"
                                                               id="checkboxOne{{$attr->id}}"
                                                               name="attribute[{{$attr->id}}]"
                                                               @if(old('attribute.'.$attr->id)=='on')checked @endif><label
                                                            for="checkboxOne{{$attr->id}}">{{$attr->title}}  </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        @elseif($attr->attribute_type=='description')

                                            <div class="col-md-6">
                                                <label for="title">توضیحات شما</label>
                                                <textarea name="attribute[{{$attr->id}}]" rows="5"
                                                          class="form-control">{{old('attribute.'.$attr->id)}}</textarea>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <hr>

                            @endforeach
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد درخواست</button>
                            <a href="{{route('application.index.admin')}}" class="btn btn-secondary"
                               style="margin-left:1%">لغو</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
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
@endsection

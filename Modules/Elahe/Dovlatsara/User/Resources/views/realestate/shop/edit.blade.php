@extends('RealestateMaster::master')
@section('title_realestate')ویرایش کسب و کار من
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/select2/select2.min.css')}}">
    <style>
        .select2-selection.select2-selection--single {
            min-height: 42px;
        }
        .select2-selection.select2-selection--multiple {
            min-height: 42px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/select2-color.css')}}">

@endsection
@section('content_realestateMaster')

    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات کسب و کار</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('user.shop.update.realestate', $user->id)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input hidden name="id" value="{{$user->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">نام کسب و کار</label>

                                        <input type="text" name="name" class="form-control"
                                               value="{{$user->shop_title}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('name') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">شماره تلفن</label>

                                        <input type="text" name="phone" class="form-control"
                                               value="{{$user->shop_phone}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('phone') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">نام کاربری(صفحه اختصاصی شما)</label>

                                        <input type="text" name="slug" class="form-control"
                                               value="{{$user->slug}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('slug') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="city">شهر </label>
                                        <select name="city" id="city"
                                                class="form-control select2" dir="rtl">
                                            <option value="date-desc" disabled selected="selected">شهر</option>
                                            @foreach($cities as $city)
                                                <option
                                                    value="{{$city->id}}" {{$city->id==$user->shop_city_id?"selected":""}}>{{$city->title}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('city') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="neighborhood">محله</label>
                                        <select name="neighborhood" id="neighborhood"  dir="rtl"
                                                class="form-control select2">
                                            @foreach($neighborhoods as $neighborhood)
                                                <option
                                                    value="{{$neighborhood->id}}" {{$neighborhood->id==$user->shop_neighborhood_id?"selected":""}}>{{$neighborhood->title}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('neighborhood') }}</small>

                                    </div>
                                </div>
                                @can('categoryForUserInPanel')
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="category">صنف</label>
                                            <select class="form-control" name="category"
                                                    style="width: 100%;text-align: right">
                                                <option value="" disabled selected class="form-control">صنف
                                                </option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}"
                                                            @if($category->id == $user->category_id??old('category'))
                                                            selected @endif >{{$category->title}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('category') }}</small>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="category">حوزه های فعالیت</label>
                                            <select class="form-control select2" name="subCategory[]"
                                                    style="width: 100%;text-align: right" multiple="multiple">
                                                <option value="" disabled class="form-control">حوزه های فعالیت
                                                </option>
                                                @foreach($userCategory->subCategories as $subCat)
                                                    <option value="{{$subCat->id}}"
                                                    @foreach($user->level2CategoryOfAgencies as $subCategory)
                                                        {{$subCategory->category_id==$subCat->id??old('subCategory') ?"selected":""}}
                                                        @endforeach
                                                    >{{$subCat->title}}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('subCategory') }}</small>

                                        </div>
                                    </div>
                                @endcan
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="yearOfOperation">سال شروع فعالیت</label>

                                        <input type="text" name="yearOfOperation" class="form-control"
                                               value="{{$user->yearOfOperation}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('yearOfOperation') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="header_title">عنوان هدر در پنل شما در سایت</label>

                                        <input type="text" name="header_title" class="form-control"
                                               value="{{$user->shop_header_title}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('header_title') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="header_image">عکس هدر پنل شما در سایت</label>

                                        <input class="form-control filestyle"
                                               name="header_image"
                                               type="file" data-classbutton="btn btn-secondary"
                                               data-classinput="form-control inline"
                                               data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                               value="{{old('header_image')}}">
                                        <small class="text-danger">{{ $errors->first('header_image') }}</small>
                                        <div id="header_image" style="margin-top: 2%">
                                            @if(isset($user->shop_header_image))
                                                <img src="{{asset($user->shop_header_image)}}" width="80">
                                                <i class="fa fa-trash"
                                                   onclick="deleteFiles('{{$user->id}}', 'header_image')"
                                                   style="cursor: pointer"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">آدرس</label>
                                        <input type="text" name="address" class="form-control"
                                               value="{{$user->shop_address}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('address') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">وبسایت</label>

                                        <input type="text" name="website" class="form-control"
                                               placeholder="https://www.example.com"
                                               value="{{$user->shop_website}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('website') }}</small>

                                    </div>
                                </div>
                                @foreach(\Modules\User\Entities\SocialMedia::$enumType as $key=>$type)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="{{$type}}">لینک {{$type}}</label>

                                            <input type="text" name="{{$type}}" class="form-control"
                                                   @if($type=='whatsapp')
                                                   placeholder="https://wa.me/989121234567"
                                                   @elseif($type=='instagram')
                                                   placeholder="https://www.instagram.com/username"

                                                   @endif
                                                   value="{{$user->socialMedias()->where('type', $type)->first()?$user->socialMedias()->where('type', $type)->first()->link:old($type)}}"
                                                   autofocus>
                                            <small class="text-danger">{{ $errors->first($type) }}</small>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo">لوگو</label>

                                        <input class="form-control filestyle"
                                               name="logo"
                                               type="file" data-classbutton="btn btn-secondary"
                                               data-classinput="form-control inline"
                                               data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                               value="{{old('logo')}}">
                                        <small class="text-danger">{{ $errors->first('logo') }}</small>
                                        <div id="userImage" style="margin-top: 2%">
                                            @if(isset($user->shop_logo))
                                                <img src="{{asset($user->shop_logo)}}" width="80">
                                                <i class="fa fa-trash" onclick="deleteFiles('{{$user->id}}', 'logo')"
                                                   style="cursor: pointer"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthDate">محله های تحت پوشش</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="city_in_activity_range">شهر</label>

                                                <select class="form-control select2" name="city_in_activity_range" dir="rtl"
                                                        style="width: 100%;text-align: right">
                                                    @if($user->activityRanges->count()>0)
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}"
                                                                    @if($city->id == $user->activityRanges->first()->city_id) selected @endif>{{$city->title}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="" selected class="form-control">شهر
                                                        </option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}"
                                                                    @if($city->id == old('city_in_activity_range')) selected @endif>{{$city->title}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="neighborhood_in_activity_range">محله ها</label>

                                                <select class="form-control select2" name="neighborhood_in_activity_range[]" dir="rtl"
                                                        style="width: 100%;text-align: right" multiple="multiple">
                                                    @if($user->activityRanges->count()>0)
                                                        @if($user->activityRanges->first()->allNeighborhoods==0)
                                                            @foreach(\Modules\City\Entities\City::find($user->activityRanges->first()->city_id)->neighborhoods as $neighborhood)
                                                                <option value="{{$neighborhood->id}}"
                                                                @foreach($user->activityRanges as $activityRange)
                                                                    {{$activityRange->neighborhood_id==$neighborhood->id??old('neighborhood_in_activity_range') ?"selected":""}}
                                                                    @endforeach
                                                                >{{$neighborhood->title}}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="" disabled class="form-control">
                                                            </option>
                                                        @endif
                                                    @else
                                                        <option value="" disabled class="form-control">
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <small class="text-danger">{{ $errors->first('city_in_activity_range') }}</small>
                                        <small class="text-danger">{{ $errors->first('neighborhood_in_activity_range') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">درباره ما</label>
                                        <div>
                                            @if(isset($user->shop_description))
                                                <textarea class="form-control" rows="10" type="text" name="description"
                                                          placeholder="توضیحات مربوط به کسب و کاری خود را وارد کنید.">{{$user->shop_description}}</textarea>
                                            @else
                                                <textarea class="form-control" rows="10" type="text" name="description"
                                                          placeholder="توضیحات مربوط به کسب و کاری خود را وارد کنید.">{{old('description')}}</textarea>
                                            @endif
                                            <small class="text-danger">{{ $errors->first('description') }}</small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn float-right" style="background-color: #3c3cce;color: #fff">
                                ذخیره تغییرات
                            </button>
                            <a href="{{route('user.shop.index.realestate', $user->id)}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>


                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js_realestate')
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
                            // $('select[name="neighborhood"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                var x = '<option value="' + key + ' ">' + value + '</option>';
                                $('select[name="neighborhood"]').append(x);

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
        function deleteFiles(id, card) {
            jQuery(document).ready(function () {
                if (id) {
                    jQuery.ajax({
                        url: "{{route('user.shop.deleteFiles.realestate')}}",
                        data: {
                            'id': id,
                            'card': card
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            if (data.success == true) {
                                window.setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }
                        }
                    });
                }
            });
        }
    </script>
    <script src="{{asset('files/realestateMaster/plugins/select2/select2.full.min.js')}}"></script>
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
                            console.log(data)
                            jQuery('select[name="subCategory[]"]').empty();
                            $('select[name="subCategory[]"]').append('<option value=""></option>');
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
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city_in_activity_range"]').on('change', function () {
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
                            jQuery('select[name="neighborhood_in_activity_range[]"]').empty();
                            if (Object.keys(data).length)
                                $('select[name="neighborhood_in_activity_range[]"]').append('<option value="0" selected>تمام محله ها</option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhood_in_activity_range[]"]').append('<option value="' + key + '">' + value + '</option>');

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

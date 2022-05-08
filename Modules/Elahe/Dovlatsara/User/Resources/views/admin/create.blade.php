@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد کاربر {{$role->name}} جدید
@endsection
@section('header')
    {{--    <a type="button" class="btn btn-info btn-sm" href="{{route('category.index.admin', $category->parent_id)}}" style="float: left">--}}
    {{--        <i class="fa fa-arrow-left text-white"></i></a>--}}
    {{--    <ol class="breadcrumb float-sm-right">--}}
    {{--        <li class="breadcrumb-item active"><a href="{{ route('category.index.admin',$parentId)}}">دسته بندی ها</a></li>--}}
    {{--        <li class="breadcrumb-item"><a href={{ route('cities.add',$state_id)}}>Create</a></li>--}}
    {{--    </ol>--}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/select2/select2.min.css')}}">

    <style>
    .select2-selection.select2-selection--single{
        height: 42px;
    }

    </style>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title">کاربر {{$role->name}} جدید</h1>
                    </div>
                    <form action="{{ route('users.store.admin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input hidden name="role_id" value="{{$role->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام</label>

                                        <input type="text" name="name" class="form-control" value="{{old('name')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('name') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام خانوادگی</label>

                                        <input type="text" name="sirName" class="form-control"
                                               value="{{old('sirName')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('sirName') }}</small>

                                    </div>
                                </div>
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">نام کاربری</label>--}}

{{--                                        <input type="text" name="userName" class="form-control"--}}
{{--                                               value="{{old('userName')}}"--}}
{{--                                               autofocus>--}}
{{--                                        <small class="text-danger">{{ $errors->first('userName') }}</small>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">موبایل</label>

                                        <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('mobile') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">ایمیل</label>

                                        <input type="text" name="email" class="form-control"
                                               value="{{old('email')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('email') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sex">جنسیت</label>
                                        <select class="form-control" name="sex" style="width: 100%;text-align: right">
                                            <option value="" disabled selected class="form-control"></option>
                                            <option value="1" @if('1' == old('sex'))
                                            selected @endif >زن
                                            </option>
                                            <option value="0" @if('0' == old('sex'))
                                            selected @endif >مرد
                                            </option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('sex') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthDate">تاریخ تولد</label>
                                        <div class="row">
                                            <div class="col-md-4">

                                                <select class="form-control" name="day"
                                                        style="width: 100%;text-align: right">
                                                    <option value="" disabled selected class="form-control">روز</option>
                                                    @for($i=1;$i<=31;$i++)
                                                        <option value="{{$i>9?$i:'0'.$i}}"
                                                                @if($i==old('day')) selected @endif>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-4">

                                                <select class="form-control" name="month"
                                                        style="width: 100%;text-align: right">
                                                    <option value="" disabled selected class="form-control">ماه</option>
                                                    <option value="01" @if('01'==old('month')) selected @endif>فروردین
                                                    </option>
                                                    <option value="02" @if('02'==old('month')) selected @endif>
                                                        اردیبهشت
                                                    </option>
                                                    <option value="03" @if('03'==old('month')) selected @endif>خرداد
                                                    </option>
                                                    <option value="04" @if('04'==old('month')) selected @endif>تیر
                                                    </option>
                                                    <option value="05" @if('05'==old('month')) selected @endif>مرداد
                                                    </option>
                                                    <option value="06" @if('06'==old('month')) selected @endif>شهریور
                                                    </option>
                                                    <option value="07" @if('07'==old('month')) selected @endif>مهر
                                                    </option>
                                                    <option value="08" @if('08'==old('month')) selected @endif>آبان
                                                    </option>
                                                    <option value="09" @if('09'==old('month')) selected @endif>آذر
                                                    </option>
                                                    <option value="10" @if('10'==old('month')) selected @endif>دی
                                                    </option>
                                                    <option value="11" @if('11'==old('month')) selected @endif>بهمن
                                                    </option>
                                                    <option value="12" @if('12'==old('month')) selected @endif>اسفند
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">

                                                <select class="form-control" name="year"
                                                        style="width: 100%;text-align: right">
                                                    <option value="" disabled selected class="form-control">سال</option>
                                                    @for($i=1320;$i<=1390;$i++)
                                                        <option value="{{$i>9?$i:'0'.$i}}"
                                                                @if($i==old('year')) selected @endif>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        {{--                                    <input type="text" name="birthDate" class="form-control"--}}
                                        {{--                                           value="{{$user->birthDate}}"--}}
                                        {{--                                           autofocus required>--}}
                                        <small class="text-danger">{{ $errors->first('day') }}</small>
                                        <small class="text-danger">{{ $errors->first('month') }}</small>
                                        <small class="text-danger">{{ $errors->first('year') }}</small>
                                    </div>
                                </div>
                                @if($type==('real-state-administrator'))
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="category">صنف</label>
                                            <select class="form-control select2" name="category" dir="rtl"
                                                    style="width: 100%;text-align: right">
                                                <option value="" disabled selected class="form-control">صنف
                                                </option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}"
                                                            @if($category->id ==old('category'))
                                                            selected @endif >{{$category->title}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('category') }}</small>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="category">زیرمجموعه صنف</label>
                                            <select class="form-control select2" name="subCategory[]" dir="rtl"
                                                    style="width: 100%;text-align: right" multiple="multiple">
                                                <option value="" disabled  class="form-control">صنف
                                                </option>
                                            </select>
                                            <small class="text-danger">{{ $errors->first('subCategory') }}</small>

                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="yearOfOperation">تاریخ شروع فعالیت</label>

                                        <input type="text" name="yearOfOperation" class="form-control"
                                               value="{{old('yearOfOperation')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('yearOfOperation') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumberForAds">شماره تلفن آگهی</label>

                                        <input type="text" name="phoneNumberForAds" class="form-control"
                                               value="{{old('phoneNumberForAds')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('phoneNumberForAds') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">اسلاگ</label>

                                        <input type="text" name="slug" class="form-control"
                                               value="{{old('slug')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('slug') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">رمز عبور</label>

                                        <input type="password" name="password" class="form-control"
                                               value="{{old('password')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('password') }}</small>

                                    </div>
                                </div>
                                @if($type==('contractor'))
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="association[]">اصناف سطح 1</label>
                                            <select class="form-control select2" name="association[]" dir="rtl"
                                                    style="width: 100%;text-align: right"
                                                    multiple="multiple">
                                                <option value="" disabled class="form-control">صنف</option>

                                                @foreach($associations as $association)

                                                    <option value="{{$association->id}}"
                                                        {{in_array($association->id, old('association') ?: []) ? "selected": ""}}
                                                    >{{$association->title}}</option>
                                                @endforeach
                                            </select>
                                            <small
                                                class="text-danger">{{ $errors->first('association') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="associationL2[]">اصناف سطح 2</label>
                                            <select class="form-control select2" name="associationL2[]" dir="rtl"
                                                    style="width: 100%;text-align: right"
                                                    multiple="multiple">
                                                <option value="" disabled class="form-control">صنف</option>

                                                @foreach($associations as $association)

                                                    <option value="{{$association->id}}"
                                                        {{in_array($association->id, old('association') ?: []) ? "selected": ""}}
                                                    >{{$association->title}}</option>
                                                @endforeach
                                            </select>
                                            <small
                                                class="text-danger">{{ $errors->first('association') }}</small>
                                        </div>
                                    </div>

                                @endif
                                @if($type==('real-state-agent'))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="real_estate">کسب و کار</label>
                                            <select class="form-control select2" name="real_estate">
                                                <option value="" disabled selected class="form-control"></option>
                                                @foreach($real_estates as $user)
                                                    <option value="{{$user->id}}"
                                                            @if(old('real_estate')==$user->id) selected @endif>{{$user->shop_title}}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('real_estate') }}</small>
                                        </div>
                                    </div>

                                @endif

                            </div>
                            @if($type==('real-state-administrator'))

                                <hr>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="shop_title">نام کسب و کار</label>
                                            <input type="text" name="shop_title" class="form-control"
                                                   value="{{old('shop_title')}}"
                                                   autofocus>
                                            <small
                                                class="text-danger">{{ $errors->first('shop_title') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="shop_title">وبسایت</label>
                                            <input type="text" name="shop_website" class="form-control"
                                                   value="{{old('shop_website')}}"
                                                   autofocus>
                                            <small
                                                class="text-danger">{{ $errors->first('shop_website') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>شهر</label>
                                            <select class="form-control select2" name="shop_city" dir="rtl"
                                                    style="width: 100%;text-align: right">
                                                <option value="" disabled selected class="form-control"></option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}"
                                                            @if($city->id==old('shop_city')) selected @endif>{{$city->title}}</option>
                                                @endforeach
                                            </select>
                                            <small
                                                class="text-danger">{{ $errors->first('shop_city') }}</small>
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>محله</label>
                                            <select class="form-control select2" name="neighborhood" dir="rtl"
                                                    style="width: 100%;text-align: right">
                                                <option value="" disabled selected class="form-control"></option>
                                            </select>
                                            <small
                                                class="text-danger">{{ $errors->first('neighborhood') }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <hr>
                            <div class="row">
                                @if($type==('real-state-administrator'))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logo">لوگو کسب و کاری</label>
                                            <input class="form-control filestyle"
                                                   name="logo"
                                                   type="file" data-classbutton="btn btn-secondary"
                                                   data-classinput="form-control inline"
                                                   data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                                   value="{{old('logo')}}">
                                            <small class="text-danger">{{ $errors->first('logo') }}</small>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userImage">عکس کاربر</label>
                                            <input class="form-control filestyle"
                                                   name="userImage"
                                                   type="file" data-classbutton="btn btn-secondary"
                                                   data-classinput="form-control inline"
                                                   data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                                   value="{{old('userImage')}}">
                                            <small class="text-danger">{{ $errors->first('userImage') }}</small>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nationalCardImage">عکس کارت ملی</label>

                                        <input class="form-control filestyle"
                                               name="nationalCardImage"
                                               type="file" data-classbutton="btn btn-secondary"
                                               data-classinput="form-control inline"
                                               data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                               value="{{old('nationalCardImage')}}">
                                        <small class="text-danger">{{ $errors->first('nationalCardImage') }}</small>

                                    </div>
                                </div>
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label for="shenasnamehImage">عکس شناسنامه</label>--}}

                                {{--                                        <input class="form-control filestyle"--}}
                                {{--                                               name="shenasnamehImage"--}}
                                {{--                                               type="file" data-classbutton="btn btn-secondary"--}}
                                {{--                                               data-classinput="form-control inline"--}}
                                {{--                                               data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"--}}
                                {{--                                               value="{{old('shenasnamehImage')}}">--}}
                                {{--                                        <small class="text-danger">{{ $errors->first('shenasnamehImage') }}</small>--}}
                                {{--                                        <div id="shenasnamehImage" style="margin-top: 2%">--}}
                                {{--                                            @if(isset($user->shenasnamehImage))--}}
                                {{--                                                <img src="{{asset($user->shenasnamehImage)}}" width="80">--}}
                                {{--                                                <i class="fa fa-trash" onclick="deleteFiles('{{$user->id}}', 'shenasnamehImage')"></i>--}}
                                {{--                                            @endif--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                @if($type==('real-state-administrator'))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobasherCardImage">عکس کارت مباشر</label>

                                            <input class="form-control filestyle"
                                                   name="mobasherCardImage"
                                                   type="file" data-classbutton="btn btn-secondary"
                                                   data-classinput="form-control inline"
                                                   data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                                   value="{{old('mobasherCardImage')}}">
                                            <small
                                                class="text-danger">{{ $errors->first('mobasherCardImage') }}</small>

                                        </div>
                                    </div>
                                @endif
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label for="unionCardImage">عکس کارت اتحادیه</label>--}}

                                {{--                                        <input class="form-control filestyle"--}}
                                {{--                                               name="unionCardImage"--}}
                                {{--                                               type="file" data-classbutton="btn btn-secondary"--}}
                                {{--                                               data-classinput="form-control inline"--}}
                                {{--                                               data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"--}}
                                {{--                                               value="{{old('unionCardImage')}}">--}}
                                {{--                                        <small class="text-danger">{{ $errors->first('unionCardImage') }}</small>--}}
                                {{--                                        <div id="unionCardImage" style="margin-top: 2%">--}}
                                {{--                                            @if(isset($user->unionCardImage))--}}
                                {{--                                                <img src="{{asset($user->unionCardImage)}}" width="80">--}}
                                {{--                                                <i class="fa fa-trash" onclick="deleteFiles('{{$user->id}}', 'unionCardImage')"></i>--}}
                                {{--                                            @endif--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                @if($type==('real-state-administrator'))
                                    {{--                                    @can('businessLicenseImage')--}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="businessLicenseImage">عکس پروانه کسب</label>

                                            <input class="form-control filestyle"
                                                   name="businessLicenseImage"
                                                   type="file" data-classbutton="btn btn-secondary"
                                                   data-classinput="form-control inline"
                                                   data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                                   value="{{old('businessLicenseImage')}}">
                                            <small
                                                class="text-danger">{{ $errors->first('businessLicenseImage') }}</small>
                                        </div>
                                    </div>
                                    {{--                                    @endcan--}}
                                @endif
                            </div>

                        </div>
                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ثبت</button>
                            <a href="{{route('users.index.admin', $type)}}" class="btn btn-secondary"
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
            jQuery('select[name="shop_city"]').on('change', function () {
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
@endsection

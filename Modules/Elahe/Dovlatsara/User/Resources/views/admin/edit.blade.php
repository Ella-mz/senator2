@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش کاربر
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/select2/select2.min.css')}}">
    <style>
        .select2-selection.select2-selection--single {
            min-height: 42px;
        }

    </style>
    {{--    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/select2/select2.min.css')}}">--}}
@endsection
@section('header')
    <ol class="breadcrumb float-sm-right">
        {{--        <li class="breadcrumb-item"><a href="{{ route('category.index.admin',$category->parent_id)}}">دسته بندی ها</a></li>--}}
        {{--        <li class="breadcrumb-item"><a href="{{ route('category.edit.admin',$category->id)}}">ویرایش</a></li>--}}
    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title">ویرایش کاربر</h1>
                    </div>
                    <form action="{{ route('users.update.admin', $user->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        <input hidden name="id" value="{{$user->id}}">
                        {{--                        @method('patch')--}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام</label>

                                        <input type="text" name="name" class="form-control" value="{{$user->name}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('name') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sirName">نام خانوادگی</label>

                                        <input type="text" name="sirName" class="form-control"
                                               value="{{$user->sirName}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('sirName') }}</small>

                                    </div>
                                </div>
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="sirName">نام کاربری</label>--}}

{{--                                        <input type="text" name="userName" class="form-control"--}}
{{--                                               value="{{$user->userName}}"--}}
{{--                                               autofocus>--}}
{{--                                        <small class="text-danger">{{ $errors->first('userName') }}</small>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">موبایل</label>

                                        <input type="text" name="mobile" class="form-control" value="{{$user->mobile}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('mobile') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">ایمیل</label>

                                        <input type="text" name="email" class="form-control"
                                               value="{{$user->email}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('email') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sex">جنسیت</label>
                                        <select class="form-control" name="sex" style="width: 100%;text-align: right">
                                            <option value="" disabled selected class="form-control">جنسیت</option>
                                            <option value="1" @if('1' == $user->sex)
                                            selected @endif >زن
                                            </option>
                                            <option value="0" @if('0' == $user->sex)
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
                                                    @if(isset($user->birthDate))
                                                        @for($i=1;$i<=31;$i++)
                                                            <option value="{{$i>9?$i:'0'.$i}}"
                                                                    @if($i>9?$i:'0'.$i == explode('-',$user->birthDate)[0]) selected @endif>{{$i}}</option>
                                                        @endfor
                                                    @else
                                                        @for($i=1;$i<=31;$i++)
                                                            <option value="{{$i>9?$i:'0'.$i}}">{{$i}}</option>
                                                        @endfor
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4">

                                                <select class="form-control" name="month"
                                                        style="width: 100%;text-align: right">
                                                    <option value="" disabled selected class="form-control">ماه</option>
                                                    @if(isset($user->birthDate))

                                                        <option value="01"
                                                                @if('01' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            فروردین
                                                        </option>
                                                        <option value="02"
                                                                @if('02' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            اردیبهشت
                                                        </option>
                                                        <option value="03"
                                                                @if('03' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            خرداد
                                                        </option>
                                                        <option value="04"
                                                                @if('04' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            تیر
                                                        </option>
                                                        <option value="05"
                                                                @if('05' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            مرداد
                                                        </option>
                                                        <option value="06"
                                                                @if('06' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            شهریور
                                                        </option>
                                                        <option value="07"
                                                                @if('07' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            مهر
                                                        </option>
                                                        <option value="08"
                                                                @if('08' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            آبان
                                                        </option>
                                                        <option value="09"
                                                                @if('09' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            آذر
                                                        </option>
                                                        <option value="10"
                                                                @if('10' == explode('-',$user->birthDate)[1]) selected @endif >
                                                            دی
                                                        </option>
                                                        <option value="11"
                                                                @if('11' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            بهمن
                                                        </option>
                                                        <option value="12"
                                                                @if('12' == explode('-',$user->birthDate)[1]) selected @endif>
                                                            اسفند
                                                        </option>
                                                    @else
                                                        <option value="01">فروردین</option>
                                                        <option value="02">اردیبهشت</option>
                                                        <option value="03">خرداد</option>
                                                        <option value="04">تیر</option>
                                                        <option value="05">مرداد</option>
                                                        <option value="06">شهریور</option>
                                                        <option value="07">مهر</option>
                                                        <option value="08">آبان</option>
                                                        <option value="09">آذر</option>
                                                        <option value="10">دی</option>
                                                        <option value="11">بهمن</option>
                                                        <option value="12">اسفند</option>

                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4">

                                                <select class="form-control" name="year"
                                                        style="width: 100%;text-align: right">
                                                    <option value="" disabled selected class="form-control">سال</option>
                                                    @if(isset($user->birthDate))
                                                        @for($i=1320;$i<=1390;$i++)
                                                            <option value="{{$i>9?$i:'0'.$i}}"
                                                                    @if($i>9?$i:'0'.$i == explode('-',$user->birthDate)[2]) selected @endif>{{$i}}</option>
                                                        @endfor
                                                    @else
                                                        @for($i=1320;$i<=1390;$i++)
                                                            <option value="{{$i>9?$i:'0'.$i}}">{{$i}}</option>
                                                        @endfor
                                                    @endif

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
                                @if($user->hasRole('real-state-administrator'))
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="category">صنف</label>
                                            <select class="form-control select2" name="category" dir="rtl"
                                                    style="width: 100%;text-align: right">
                                                <option value="" disabled selected class="form-control">صنف
                                                </option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}"
                                                            @if($category->id ==$user->category_id??old('category'))
                                                            selected @endif >{{$category->title}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('category') }}</small>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="subCategory">زیرمجموعه صنف</label>
                                            <select class="form-control select2" name="subCategory[]" dir="rtl"
                                                    style="width: 100%;text-align: right" multiple="multiple">
                                                <option value="" disabled class="form-control">صنف
                                                </option>
                                                @if($userCategory)
                                                    @foreach($userCategory->subCategories as $subCat)
                                                        <option value="{{$subCat->id}}"
                                                        @foreach($user->level2CategoryOfAgencies as $subCategory)
                                                            {{$subCategory->category_id==$subCat->id??old('subCategory') ?"selected":""}}
                                                            @endforeach
                                                        >{{$subCat->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="text-danger">{{ $errors->first('subCategory') }}</small>

                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="yearOfOperation">تاریخ شروع فعالیت</label>

                                        <input type="text" name="yearOfOperation" class="form-control"
                                               value="{{$user->yearOfOperation}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('yearOfOperation') }}</small>

                                    </div>
                                </div>
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label for="identifierCodeFromRealEstate">کد فعالسازی کارشناس</label>--}}

                                {{--                                        <input type="text" name="identifierCodeFromRealEstate" class="form-control"--}}
                                {{--                                               value="{{$user->identifierCodeFromRealEstate}}"--}}
                                {{--                                               autofocus required>--}}
                                {{--                                        <small class="text-danger">{{ $errors->first('identifierCodeFromRealEstate') }}</small>--}}

                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumberForAds">شماره تلفن آگهی</label>

                                        <input type="text" name="phoneNumberForAds" class="form-control"
                                               value="{{$user->phoneNumberForAds}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('phoneNumberForAds') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">اسلاگ</label>

                                        <input type="text" name="slug" class="form-control"
                                               value="{{$user->slug}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('slug') }}</small>

                                    </div>
                                </div>
                                @if($user->hasRole('contractor'))

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="associationL1[]">اصناف</label>
                                            <select class="form-control select2" name="associationL1[]" dir="rtl"
                                                    style="width: 100%;text-align: right"
                                                    multiple="multiple">
                                                <option value="" disabled class="form-control">صنف</option>

                                                @foreach($associationsLevel1 as $associationL1)

                                                    <option value="{{$associationL1->id}}"
                                                    @foreach($userAssociations as $r)
                                                        {{$r->association->id==$associationL1->id??old('associationL1') ?"selected":""}}
                                                        @endforeach
                                                    >{{$associationL1->title}}</option>
                                                @endforeach
                                            </select>
                                            <small
                                                class="text-danger">{{ $errors->first('association[]') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="association[]">اصناف سطح 2</label>
                                            <select class="form-control select2" name="association[]" dir="rtl"
                                                    style="width: 100%;text-align: right"
                                                    multiple="multiple">
                                                <option value="" disabled class="form-control">صنف</option>
                                                @foreach($userAssociations as $association)

                                                    <option value="{{$association->id}}"
                                                            selected
                                                    >{{$association->title}}</option>
                                                @endforeach
                                                {{--                                                @foreach($associations as $association)--}}

                                                {{--                                                    <option value="{{$association->id}}"--}}
                                                {{--                                                    @foreach($userAssociations as $r)--}}
                                                {{--                                                        {{$r->id==$association->id??old('association') ?"selected":""}}--}}

                                                {{--                                                        @endforeach--}}
                                                {{--                                                    >{{$association->title}}</option>--}}
                                                {{--                                                @endforeach--}}
                                            </select>
                                            <small
                                                class="text-danger">{{ $errors->first('association') }}</small>
                                        </div>
                                    </div>
                                @endif
                                @if($user->hasRole('real-state-administrator'))

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="birthDate">محله های تحت پوشش</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select class="form-control select2" name="city" dir="rtl"
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
                                                                        @if($city->id == old('city')) selected @endif>{{$city->title}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-6">

                                                    <select class="form-control select2" name="neighborhood[]" dir="rtl"
                                                            style="width: 100%;text-align: right" multiple="multiple">
                                                        @if($user->activityRanges->count()>0)
                                                            @if($user->activityRanges->first()->allNeighborhoods==0)
                                                                @foreach(\Modules\City\Entities\City::find($user->activityRanges->first()->city_id)->neighborhoods as $neighborhood)
                                                                    <option value="{{$neighborhood->id}}"
                                                                    @foreach($user->activityRanges as $activityRange)
                                                                        {{$activityRange->neighborhood_id==$neighborhood->id??old('neighborhood') ?"selected":""}}
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
                                            <small class="text-danger">{{ $errors->first('city') }}</small>
                                            <small class="text-danger">{{ $errors->first('neighborhood') }}</small>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <div class="row">
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
                                        <div id="userImage" style="margin-top: 2%">
                                            @if(isset($user->userImage))
                                                <img src="{{asset($user->userImage)}}" width="80" class="rounded">
                                                <i class="fa fa-trash"
                                                   onclick="deleteFiles('{{$user->id}}', 'userImage')"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
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
                                        <div id="nationalCardImage" style="margin-top: 2%">
                                            @if(isset($user->nationalCardImage))
                                                <img src="{{asset($user->nationalCardImage)}}" width="80"
                                                     class="rounded">
                                                <i class="fa fa-trash"
                                                   onclick="deleteFiles('{{$user->id}}', 'nationalCardImage')"></i>
                                            @endif
                                        </div>
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
                                @if($user->hasRole('real-state-administrator'))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobasherCardImage">عکس کارت مباشر</label>

                                            <input class="form-control filestyle"
                                                   name="mobasherCardImage"
                                                   type="file" data-classbutton="btn btn-secondary"
                                                   data-classinput="form-control inline"
                                                   data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                                   value="{{old('mobasherCardImage')}}">
                                            <small class="text-danger">{{ $errors->first('mobasherCardImage') }}</small>
                                            <div id="mobasherCardImage" style="margin-top: 2%">
                                                @if(isset($user->mobasherCardImage))
                                                    <img src="{{asset($user->mobasherCardImage)}}" width="80"
                                                         class="rounded">
                                                    <i class="fa fa-trash"
                                                       onclick="deleteFiles('{{$user->id}}', 'mobasherCardImage')"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($user->hasRole('real-state-administrator'))

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
                                            <div id="businessLicenseImage" style="margin-top: 2%">
                                                @if(isset($user->businessLicenseImage))
                                                    <img src="{{asset($user->businessLicenseImage)}}" width="80"
                                                         class="rounded">
                                                    <i class="fa fa-trash"
                                                       onclick="deleteFiles('{{$user->id}}', 'businessLicenseImage')"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>


                        </div>
                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش کاربر</button>
                            <a href="{{ route('users.index.admin', $user->roles->first()->slug)}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
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
            jQuery('select[name="associationL1[]"]').on('change', function () {
                var association = jQuery(this).val();

                if (association) {
                    jQuery.ajax({
                        url: "{{route('gettingAssociation.panel')}}",
                        data: {
                            'association': association
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="association[]"]').empty();
                            $('select[name="association[]"]').append('<option value="" ></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="association[]"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="association[]"]').empty();
                }
            });
        });
    </script>

    {{--    <script src="{{asset('files/realestateMaster/plugins/select2/select2.full.min.js')}}"></script>--}}
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
                            jQuery('select[name="neighborhood[]"]').empty();
                            if (Object.keys(data).length)
                                $('select[name="neighborhood[]"]').append('<option value="0" selected>تمام محله ها</option>');
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
    <script type="text/javascript">
        function deleteFiles(id, card) {
            jQuery(document).ready(function () {
                if (id) {
                    jQuery.ajax({
                        url: "{{route('users.deleteFiles.admin')}}",
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

@endsection

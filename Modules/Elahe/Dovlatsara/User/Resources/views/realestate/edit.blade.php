@extends('RealestateMaster::master')
@section('title_realestate')ویرایش اطلاعات شخصی
@endsection
@section('card_title')ویرایش اطلاعات شخصی
@endsection
@section('css')
    <style>
        .select2-selection.select2-selection--single {
            min-height: 38px;
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
                        <h3 class="card-title">اطلاعات شخصی</h3>
                    </div>

                    <!-- /.card-header -->
                    <form action="{{route('user.update.realestate', $user->id)}}" method="post"
                          enctype="multipart/form-data">

                        @csrf
                        <input hidden name="id" value="{{$user->id}}">
                        {{--                        @method('patch')--}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام</label>

                                        <input type="text" name="name" class="form-control" value="{{$user->name}}"
                                               autofocus >
                                        <small class="text-danger">{{ $errors->first('name') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sirName">نام خانوادگی</label>

                                        <input type="text" name="sirName" class="form-control"
                                               value="{{$user->sirName}}"
                                               autofocus >
                                        <small class="text-danger">{{ $errors->first('sirName') }}</small>

                                    </div>
                                </div>
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
                                               autofocus >
                                        <small class="text-danger">{{ $errors->first('email') }}</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sex">جنسیت</label>
                                        <select class="form-control" name="sex" style="width: 100%;text-align: right">
                                            <option value="" disabled selected class="form-control">جنسیت</option>
                                            <option value="1" @if('1' == $user->sex??old('sex'))
                                            selected @endif >زن
                                            </option>
                                            <option value="0" @if('0' == $user->sex??old('sex'))
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
                                                                    @if($i>9?$i:'0'.$i == explode('-',$user->birthDate)[2]) selected @endif>{{$i}}</option>
                                                        @endfor
                                                    @else
                                                        @for($i=1;$i<=31;$i++)
                                                            <option value="{{$i>9?$i:'0'.$i}}"
                                                                    @if($i == old('day')) selected @endif>{{$i}}</option>
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
                                                        <option value="01" @if('01' == old('month')) selected @endif>
                                                            فروردین
                                                        </option>
                                                        <option value="02" @if('02' == old('month')) selected @endif>
                                                            اردیبهشت
                                                        </option>
                                                        <option value="03" @if('03' == old('month')) selected @endif>
                                                            خرداد
                                                        </option>
                                                        <option value="04" @if('04' == old('month')) selected @endif>
                                                            تیر
                                                        </option>
                                                        <option value="05" @if('05' == old('month')) selected @endif>
                                                            مرداد
                                                        </option>
                                                        <option value="06" @if('06' == old('month')) selected @endif>
                                                            شهریور
                                                        </option>
                                                        <option value="07" @if('07' == old('month')) selected @endif>
                                                            مهر
                                                        </option>
                                                        <option value="08" @if('08' == old('month')) selected @endif>
                                                            آبان
                                                        </option>
                                                        <option value="09" @if('09' == old('month')) selected @endif>
                                                            آذر
                                                        </option>
                                                        <option value="10" @if('10' == old('month')) selected @endif>
                                                            دی
                                                        </option>
                                                        <option value="11" @if('11' == old('month')) selected @endif>
                                                            بهمن
                                                        </option>
                                                        <option value="12" @if('12' == old('month')) selected @endif>
                                                            اسفند
                                                        </option>

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
                                                                    @if($i>9?$i:'0'.$i == explode('-',$user->birthDate)[0]) selected @endif>{{$i}}</option>
                                                        @endfor
                                                    @else
                                                        @for($i=1320;$i<=1390;$i++)
                                                            <option value="{{$i>9?$i:'0'.$i}}"
                                                                    @if($i == old('year')) selected @endif>{{$i}}</option>
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
                                @can('YearOfOperationInPanel')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="yearOfOperation">تاریخ شروع فعالیت</label>

                                        <input type="text" name="yearOfOperation" class="form-control"
                                               value="{{$user->yearOfOperation??old('yearOfOperation')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('yearOfOperation') }}</small>

                                    </div>
                                </div>
                                @endcan
                                {{--                            <div class="col-md-6">--}}
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="identifierCodeFromRealEstate">کد فعالسازی کارشناس</label>--}}

                                {{--                                    <input type="text" name="identifierCodeFromRealEstate" class="form-control"--}}
                                {{--                                           value="{{$user->identifierCodeFromRealEstate}}"--}}
                                {{--                                           autofocus required>--}}
                                {{--                                    <small class="text-danger">{{ $errors->first('identifierCodeFromRealEstate') }}</small>--}}

                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumberForAds">شماره تلفن آگهی</label>

                                        <input type="text" name="phoneNumberForAds" class="form-control"
                                               value="{{$user->phoneNumberForAds??old('phoneNumberForAds')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('phoneNumberForAds') }}</small>

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
                                @if($user->hasRole('contractor'))

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label for="associationL1[]">اصناف</label>
                                            <select class="form-control select2" name="associationL1[]"
                                                    style="width: 100%;text-align: right"
                                                    multiple="multiple">
                                                <option value="" disabled class="form-control">صنف</option>

                                                @foreach($associationsLevel1 as $association)

                                                    <option value="{{$association->id}}"
                                                    @foreach($userAssociations as $r)
                                                        {{$r->association->id==$association->id??old('association') ?"selected":""}}
                                                        @endforeach
                                                    >{{$association->title}}</option>
                                                @endforeach

                                                {{--                                            @foreach($associations as $association)--}}
                                                {{--                                                <option value="{{$association->id}}"--}}
                                                {{--                                                        @if($association->id == old('association'))--}}
                                                {{--                                                        selected--}}
                                                {{--                                                        @endif class="form-control">{{$association->title}}</option>--}}
                                                {{--                                            @endforeach--}}
                                            </select>
                                            <small
                                                class="text-danger">{{ $errors->first('association[]') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label for="association[]">اصناف</label>
                                            <select class="form-control select2" name="association[]"
                                                    style="width: 100%;text-align: right"
                                                    multiple="multiple">
                                                <option value="" disabled class="form-control">صنف</option>

                                                @foreach($userAssociations as $association)

                                                    <option value="{{$association->id}}"
{{--                                                    @foreach($userAssociations as $r)--}}
                                                        selected
{{--                                                        @endforeach--}}
                                                    >{{$association->title}}</option>
                                                @endforeach

                                                {{--                                            @foreach($associations as $association)--}}
                                                {{--                                                <option value="{{$association->id}}"--}}
                                                {{--                                                        @if($association->id == old('association'))--}}
                                                {{--                                                        selected--}}
                                                {{--                                                        @endif class="form-control">{{$association->title}}</option>--}}
                                                {{--                                            @endforeach--}}
                                            </select>
                                            <small
                                                class="text-danger">{{ $errors->first('association[]') }}</small>
                                        </div>
                                    </div>
                                @endif
                                @can('ActivityRange')
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
                                @endcan

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
                                                <img src="{{asset($user->userImage)}}" width="80">
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
                                                <img src="{{asset($user->nationalCardImage)}}" width="80">
                                                <i class="fa fa-trash"
                                                   onclick="deleteFiles('{{$user->id}}', 'nationalCardImage')"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{--                            <div class="col-md-6">--}}
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="shenasnamehImage">عکس شناسنامه</label>--}}

                                {{--                                    <input class="form-control filestyle"--}}
                                {{--                                           name="shenasnamehImage"--}}
                                {{--                                           type="file" data-classbutton="btn btn-secondary"--}}
                                {{--                                           data-classinput="form-control inline"--}}
                                {{--                                           data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"--}}
                                {{--                                           value="{{old('shenasnamehImage')}}">--}}
                                {{--                                    <small class="text-danger">{{ $errors->first('shenasnamehImage') }}</small>--}}
                                {{--                                    <div id="shenasnamehImage" style="margin-top: 2%">--}}
                                {{--                                        @if(isset($user->shenasnamehImage))--}}
                                {{--                                            <img src="{{asset($user->shenasnamehImage)}}" width="80">--}}
                                {{--                                            <i class="fa fa-trash" onclick="deleteFiles('{{$user->id}}', 'shenasnamehImage')"></i>--}}
                                {{--                                        @endif--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
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
                                                    <img src="{{asset($user->mobasherCardImage)}}" width="80">
                                                    <i class="fa fa-trash"
                                                       onclick="deleteFiles('{{$user->id}}', 'mobasherCardImage')"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{--                            <div class="col-md-6">--}}
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label for="unionCardImage">عکس کارت اتحادیه</label>--}}

                                    {{--                                    <input class="form-control filestyle"--}}
                                    {{--                                           name="unionCardImage"--}}
                                    {{--                                           type="file" data-classbutton="btn btn-secondary"--}}
                                    {{--                                           data-classinput="form-control inline"--}}
                                    {{--                                           data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"--}}
                                    {{--                                           value="{{old('unionCardImage')}}">--}}
                                    {{--                                    <small class="text-danger">{{ $errors->first('unionCardImage') }}</small>--}}
                                    {{--                                    <div id="unionCardImage" style="margin-top: 2%">--}}
                                    {{--                                        @if(isset($user->unionCardImage))--}}
                                    {{--                                            <img src="{{asset($user->unionCardImage)}}" width="80">--}}
                                    {{--                                            <i class="fa fa-trash" onclick="deleteFiles('{{$user->id}}', 'unionCardImage')"></i>--}}
                                    {{--                                        @endif--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                    {{--                            </div>--}}
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
                                                    <img src="{{asset($user->businessLicenseImage)}}" width="80">
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
                            <button type="submit" class="btn float-right" style="background-color: #3c3cce;color: #fff">
                                ذخیره تغییرات
                            </button>
{{--                            <a href="{{route('user.shop.agents.realestate', $user->id)}}"--}}
{{--                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>--}}
                        </div>

                    </form>


                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.card -->

    <!-- /.row -->
@endsection
@section('js_realestate')
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

    <script type="text/javascript">
        function deleteFiles(id, card) {
            jQuery(document).ready(function () {
                if (id) {
                    jQuery.ajax({
                        url: "{{route('user.deleteFiles.realestate')}}",
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

    {{--<script>--}}
    {{--    var y='', x='', i;--}}
    {{--    x = "<option value=''>سال</option>"--}}
    {{--    y = "<option value=''>روز</option>"--}}
    {{--    // for(i=1320;i<1400;i++){--}}
    {{--    //--}}
    {{--    //     x = x+ "<option value='" + i + "'>" + i + "</option>"--}}
    {{--    // }--}}
    {{--    // document.getElementById("year").innerHTML = x;--}}
    {{--    for(i=1;i<32;i++){--}}
    {{--        y = y+ "<option value='" + i + "' >" + i + "</option>"--}}
    {{--    }--}}
    {{--    document.getElementById("day").innerHTML = y;--}}
    {{--</script>--}}
@endsection

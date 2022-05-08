@extends('RealestateMaster::master')
@section('title_realestate')کارشناس جدید
@endsection
@section('card_title')کارشناس جدید
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات کارشناس جدید</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('user.shop.agentStore.realestate')}}" method="post" enctype="multipart/form-data">

                        @csrf
                        <input hidden name="id" value="{{$user->id}}">
                        {{--                        @method('patch')--}}
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
                                        <label for="sirName">نام خانوادگی</label>

                                        <input type="text" name="sirName" class="form-control" value="{{old('sirName')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('sirName') }}</small>

                                    </div>

                                </div>
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="userName">نام کاربری</label>--}}

{{--                                        <input type="text" name="userName" class="form-control" value="{{old('userName')}}"--}}
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
                                                        <option value="{{$i>9?$i:'0'.$i}}" @if($i==old('day')) selected @endif>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-4">

                                                <select class="form-control" name="month"
                                                        style="width: 100%;text-align: right">
                                                    <option value="" disabled selected class="form-control">ماه</option>
                                                    <option value="01" @if('01'==old('month')) selected @endif>فروردین</option>
                                                    <option value="02" @if('02'==old('month')) selected @endif>اردیبهشت</option>
                                                    <option value="03" @if('03'==old('month')) selected @endif>خرداد</option>
                                                    <option value="04" @if('04'==old('month')) selected @endif>تیر</option>
                                                    <option value="05" @if('05'==old('month')) selected @endif>مرداد</option>
                                                    <option value="06" @if('06'==old('month')) selected @endif>شهریور</option>
                                                    <option value="07" @if('07'==old('month')) selected @endif>مهر</option>
                                                    <option value="08" @if('08'==old('month')) selected @endif>آبان</option>
                                                    <option value="09" @if('09'==old('month')) selected @endif>آذر</option>
                                                    <option value="10" @if('10'==old('month')) selected @endif>دی</option>
                                                    <option value="11" @if('11'==old('month')) selected @endif>بهمن</option>
                                                    <option value="12" @if('12'==old('month')) selected @endif>اسفند</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">

                                                <select class="form-control" name="year"
                                                        style="width: 100%;text-align: right">
                                                    <option value="" disabled selected class="form-control">سال</option>
                                                    @for($i=1320;$i<=1390;$i++)
                                                        <option value="{{$i>9?$i:'0'.$i}}" @if($i==old('year')) selected @endif>{{$i}}</option>
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

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn float-right" style="background-color: #3c3cce;color: #fff">ایجاد کارشناس</button>
                            <a href="{{route('user.shop.agents.realestate', $user->id)}}"
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
@endsection

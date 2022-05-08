@extends('RealestateMaster::master')
@section('title_realestate')تکمیل اطلاعات کارشناس
@endsection
@section('card_title')تکمیل اطلاعات کارشناس
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">تکمیل اطلاعات کارشناس</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('user.shop.complete-info-post.panel')}}" method="post" enctype="multipart/form-data">

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

                                        <input type="text" name="sirName" class="form-control" value="{{$user->sirName}}"
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
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="mobile">موبایل</label>--}}

{{--                                        <input type="text" name="mobile" class="form-control" value="{{$user->mobile}}"--}}
{{--                                               autofocus>--}}
{{--                                        <small class="text-danger">{{ $errors->first('mobile') }}</small>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
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
                                            <option value="" disabled selected class="form-control"></option>
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
                                        <label for="yearOfOperation">تاریخ شروع فعالیت</label>

                                        <input type="text" name="yearOfOperation" class="form-control"
                                               value="{{$user->yearOfOperation}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('yearOfOperation') }}</small>

                                    </div>
                                </div>
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
                            <button type="submit" class="btn float-right" style="background-color: #3c3cce;color: #fff">تکمیل اطلاعات</button>
                            <a href="{{route('user.shop.chooseExistAgent.panel', $user->id)}}"
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

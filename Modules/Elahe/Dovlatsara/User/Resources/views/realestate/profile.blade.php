@extends('RealestateMaster::master')
@section('title_realestate')پروفایل
@endsection
@section('card_title')پروفایل
@endsection
@section('content_realestateMaster')
    {{--    <div class="col-lg-9 col-md-8 col-xs-12 pull-right">--}}
    {{--        <div class="col-lg-6 col-xs-12 pull-right">--}}
    {{--            <div class="headline-profile">--}}
    {{--                <span>اطلاعات شخصی</span>--}}
    {{--            </div>--}}
    {{--            <div class="profile-stats">--}}
    {{--                <div class="profile-stats-row">--}}
    {{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
    {{--                        <div class="profile-stats-col">--}}
    {{--                            <p><span> نام و نام خانوادگی :</span>{{$user->name}} {{$user->sirName}}</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
    {{--                        <div class="profile-stats-col">--}}
    {{--                            <p><span>پست الکترونیک :</span>{{$user->email}}</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
    {{--                        <div class="profile-stats-col">--}}
    {{--                            <p><span>شماره تلفن همراه :</span>{{$user->mobile}}</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
    {{--                        <div class="profile-stats-col">--}}
    {{--                            <p><span>جنسیت :</span>@if($user->sex==1)--}}
    {{--                                    زن--}}
    {{--                                @elseif($user->sex==0)--}}
    {{--                                    مرد--}}
    {{--                                @endif--}}
    {{--                            </p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
    {{--                        <div class="profile-stats-col">--}}
    {{--                            <p><span>تاریخ شروع فعالیت :</span>{{$user->yearOfOperation}}</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
    {{--                        <div class="profile-stats-col">--}}
    {{--                            <p><span>کد فعالسازی کارشناس :</span>{{$user->identifierCodeFromRealEstate}}</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
    {{--                        <div class="profile-stats-col">--}}
    {{--                            <p><span>شماره تلفن آگهی :</span>{{$user->phoneNumberForAds}}</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
    {{--                        <div class="profile-stats-col">--}}
    {{--                            <p><span>تاریخ تولد :</span>{{$user->birthDate}}</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding:0;">--}}
    {{--                        <div class="profile-stats-col">--}}
    {{--                            <p><span>slug :</span>{{$user->slug}}</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="profile-stats-action">--}}
    {{--                        <a href="{{route('user.edit.realestate' ,$user->id)}}" class="link-spoiler-edit"><i--}}
    {{--                                class="fa fa-pencil"></i>ویرایش اطلاعات شخصی</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="col-lg-6 col-xs-12 pull-right">--}}
    {{--            <div class="headline-profile headline-profile-favorites">--}}
    {{--                <span>احراز هویت</span>--}}
    {{--            </div>--}}
    {{--            <div class="profile-stats">--}}
    {{--                @if(isset($user->userImage))--}}
    {{--                    <div class="profile-recent-fav">--}}
    {{--                        <a><img src2="{{asset($user->userImage)}}"></a>--}}
    {{--                        <div class="profile-recent-fav-col">--}}
    {{--                            <a class="mr-3">عکس کاربر</a>--}}
    {{--                            <div class="profile-recent-fav-remove">--}}
    {{--                                <a>--}}
    {{--                                    <i class="fa fa-trash" onclick="deleteFiles('{{$user->id}}', 'userImage')"></i>--}}
    {{--                                </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--                @if(isset($user->nationalCardImage))--}}

    {{--                    <div class="profile-recent-fav">--}}
    {{--                        <a><img src2="{{asset($user->nationalCardImage)}}"></a>--}}
    {{--                        <div class="profile-recent-fav-col">--}}
    {{--                            <a class="mr-3">عکس کارت ملی</a>--}}
    {{--                            <div class="profile-recent-fav-remove">--}}
    {{--                                <a>--}}
    {{--                                    <i class="fa fa-trash"--}}
    {{--                                       onclick="deleteFiles('{{$user->id}}', 'nationalCardImage')"></i>--}}
    {{--                                </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--                @if(isset($user->shenasnamehImage))--}}

    {{--                    <div class="profile-recent-fav">--}}
    {{--                        <a><img src2="{{asset($user->shenasnamehImage)}}"></a>--}}
    {{--                        <div class="profile-recent-fav-col">--}}
    {{--                            <a class="mr-3">عکس شناسنامه</a>--}}
    {{--                            <div class="profile-recent-fav-remove">--}}
    {{--                                <a>--}}
    {{--                                    <i class="fa fa-trash"--}}
    {{--                                       onclick="deleteFiles('{{$user->id}}', 'shenasnamehImage')"></i>--}}
    {{--                                </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--                @if(isset($user->mobasherCardImage))--}}

    {{--                    <div class="profile-recent-fav">--}}
    {{--                        <a><img src2="{{asset($user->mobasherCardImage)}}"></a>--}}
    {{--                        <div class="profile-recent-fav-col">--}}
    {{--                            <a class="mr-3">عکس کارت مباشر</a>--}}
    {{--                            <div class="profile-recent-fav-remove">--}}
    {{--                                <a>--}}
    {{--                                    <i class="fa fa-trash"--}}
    {{--                                       onclick="deleteFiles('{{$user->id}}', 'mobasherCardImage')"></i>--}}
    {{--                                </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--                @if(isset($user->unionCardImage))--}}

    {{--                    <div class="profile-recent-fav">--}}
    {{--                        <a><img src2="{{asset($user->unionCardImage)}}"></a>--}}
    {{--                        <div class="profile-recent-fav-col">--}}
    {{--                            <a class="mr-3">عکس کارت اتحادیه</a>--}}
    {{--                            <div class="profile-recent-fav-remove">--}}
    {{--                                <a>--}}
    {{--                                    <i class="fa fa-trash" onclick="deleteFiles('{{$user->id}}', 'unionCardImage')"></i>--}}
    {{--                                </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--                @if(isset($user->unionCardImage))--}}
    {{--                    <div class="profile-recent-fav">--}}
    {{--                        <a><img src2="{{asset($user->unionCardImage)}}"></a>--}}
    {{--                        <div class="profile-recent-fav-col">--}}
    {{--                            <a class="mr-3">عکس پروانه کسب </a>--}}
    {{--                            <div class="profile-recent-fav-remove">--}}
    {{--                                <a>--}}
    {{--                                    <i class="fa fa-trash" onclick="deleteFiles('{{$user->id}}', 'unionCardImage')"></i>--}}
    {{--                                </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--                <div class="profile-stats-action">--}}
    {{--                    <a href="{{route('user.edit.realestate' ,$user->id)}}" class="link-spoiler-edit"><i--}}
    {{--                            class="fa fa-pencil"></i>ویرایش اطلاعات شخصی</a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="headline-profile order-end" style="margin-top:0;">--}}
    {{--            <span>کارشناسان کسب و کاری شما</span>--}}
    {{--        </div>--}}
    {{--        <div class="profile-stats profile-table">--}}
    {{--            <div class="table-orders">--}}
    {{--                <table class="table">--}}
    {{--                    <thead class="thead-light">--}}
    {{--                    <tr>--}}
    {{--                        <th scope="col">#</th>--}}
    {{--                        <th scope="col">تصویر</th>--}}
    {{--                        <th scope="col">نام و نام خانوادگی</th>--}}
    {{--                        <th scope="col">موبایل</th>--}}
    {{--                        <th scope="col">ایمیل</th>--}}
    {{--                        <th scope="col">جنسیت</th>--}}
    {{--                        <th>تاریخ شروع فعالیت</th>--}}
    {{--                        <th scope="col">تاریخ تولد</th>--}}
    {{--                        <th>فعال/غیرفعال</th>--}}

    {{--                    </tr>--}}
    {{--                    </thead>--}}
    {{--                    <tbody>--}}
    {{--                    @foreach($realStateAgents as $key=>$user)--}}
    {{--                        <tr>--}}
    {{--                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>--}}
    {{--                            @if(isset($user->image))--}}
    {{--                                <td width="80" height="40">--}}
    {{--                                    <img src2="{{asset($user->image)}}" width="80" height="40">--}}
    {{--                                </td>--}}
    {{--                            @else--}}
    {{--                                <td width="80" height="40">--}}
    {{--                                    <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80"--}}
    {{--                                         height="40">--}}
    {{--                                </td>--}}
    {{--                            @endif--}}
    {{--                            <td>{{$user->name}} {{$user->sirName}}</td>--}}
    {{--                            <td>{{$user->mobile}}</td>--}}
    {{--                            <td>{{$user->email}}</td>--}}
    {{--                            <td>--}}
    {{--                                @if($user->sex==1)--}}
    {{--                                    زن--}}
    {{--                                @elseif($user->sex==0)--}}
    {{--                                    مرد--}}
    {{--                                @endif--}}
    {{--                            </td>--}}
    {{--                            <td>{{$user->yearOfOperation}}</td>--}}
    {{--                            <td>{{$user->birthDate}}</td>--}}
    {{--                            <td>--}}
    {{--                                <div class="form-legal-item has-diviter-item">--}}
    {{--                                    <div class="form-auth-row">--}}
    {{--                                        <label for="#" class="ui-checkbox has-diviter">--}}
    {{--                                            <input class="activation1" type="checkbox" {{$user->active==1?"checked":""}}--}}
    {{--                                            data-toggle="tooltip" title="فعال/غیرفعال کردن کاربر" id="{{$user->id}}"--}}
    {{--                                                   name="activation">--}}
    {{--                                            <span class="ui-checkbox-check"></span>--}}
    {{--                                        </label>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </td>--}}
    {{--                        </tr>--}}
    {{--                    @endforeach--}}
    {{--                    </tbody>--}}
    {{--                </table>--}}

    {{--                --}}{{--                <a href="#" class="table-orders-show-more">مشاهده لیست سفارش‌ها</a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="page-profile headline-profile-favorites">--}}
    {{--            <div class="page-navigation">--}}
    {{--                <div class="page-navigation-title">کارشناسان کسب و کاری شما</div>--}}
    {{--                <a href="#" class="page-navigation-btn-back">بازگشت <i class="fa fa-angle-left"></i></a>--}}
    {{--            </div>--}}
    {{--            @foreach($realStateAgents as $key=>$user)--}}

    {{--                <div class="profile-orders">--}}
    {{--                    <div class="collapse">--}}
    {{--                        <div class="profile-orders-item">--}}
    {{--                            <div class="profile-orders-header">--}}
    {{--                                --}}{{--                            <a href="profile-order-2.html" class="profile-orders-header-details">--}}
    {{--                                --}}{{--                                <div class="profile-orders-header-summary">--}}
    {{--                                --}}{{--                                    <div class="profile-orders-header-row">--}}
    {{--                                --}}{{--                                        <span class="profile-orders-header-id">تصویر</span>--}}
    {{--                                --}}{{--                                        <span class="profile-orders-header-state"><img src2="{{asset($user->image)}}" width="80" height="40"></span>--}}
    {{--                                --}}{{--                                    </div>--}}
    {{--                                --}}{{--                                </div>--}}
    {{--                                --}}{{--                            </a>--}}
    {{--                                --}}{{--                            <hr class="ui-separator">--}}

    {{--                                <div class="profile-orders-header-data">--}}
    {{--                                    <div class="profile-info-row">--}}
    {{--                                        <div class="profile-info-label">تصویر</div>--}}
    {{--                                        <div class="profile-info-value">--}}
    {{--                                            @if(isset($user->userImage))--}}
    {{--                                                <img src2="{{asset($user->userImage)}}" width="80" class="rounded"--}}
    {{--                                                     height="40">--}}
    {{--                                            @else--}}
    {{--                                                <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80"--}}
    {{--                                                     height="40">--}}
    {{--                                            @endif--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="profile-info-row mt-3">--}}
    {{--                                        <div class="profile-info-label">نام و نام خانوادگی</div>--}}
    {{--                                        <div class="profile-info-value">{{$user->name}} {{$user->sirName}}</div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="profile-info-row">--}}
    {{--                                        <div class="profile-info-label">موبایل</div>--}}
    {{--                                        <div class="profile-info-value">{{$user->mobile}}</div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="profile-info-row">--}}
    {{--                                        <div class="profile-info-label">ایمیل</div>--}}
    {{--                                        <div class="profile-info-value">{{$user->email}}</div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="profile-info-row">--}}
    {{--                                        <div class="profile-info-label">جنسیت</div>--}}
    {{--                                        <div class="profile-info-value">--}}
    {{--                                            @if($user->sex==1)--}}
    {{--                                                زن--}}
    {{--                                            @elseif($user->sex==0)--}}
    {{--                                                مرد--}}
    {{--                                            @endif--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="profile-info-row">--}}
    {{--                                        <div class="profile-info-label">تاریخ شروع فعالیت</div>--}}
    {{--                                        <div class="profile-info-value">{{$user->yearOfOperation}}</div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="profile-info-row">--}}
    {{--                                        <div class="profile-info-label">تاریخ تولد</div>--}}
    {{--                                        <div class="profile-info-value">{{$user->birthDate}}</div>--}}
    {{--                                    </div>--}}
{{--                                        <div class="profile-info-row">--}}
{{--                                            <div class="profile-info-label">فعال/غیرفعال</div>--}}
{{--                                            <div class="profile-info-value">--}}
{{--                                                <div class="form-legal-item has-diviter-item">--}}
{{--                                                    <div class="form-auth-row">--}}
{{--                                                        <label for="#" class="ui-checkbox has-diviter">--}}
{{--                                                            <input class="activation1" type="checkbox"--}}
{{--                                                                   {{$user->active==1?"checked":""}}--}}
{{--                                                                   data-toggle="tooltip" title="فعال/غیرفعال کردن کاربر"--}}
{{--                                                                   id="{{$user->id}}"--}}
{{--                                                                   name="activation">--}}
{{--                                                            <span class="ui-checkbox-check"></span>--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
    {{--                                </div>--}}

    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            @endforeach--}}

    {{--        </div>--}}
    {{--    </div>--}}
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold">اطلاعات شخصی</h3>

                    <div class="card-tools">

                        {{--                        <div class="input-group input-group-sm" style="width: 150px;">--}}
                        {{--                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">--}}

                        <div class="input-group-append">
                            <a href="{{route('user.edit.realestate' ,$user->id)}}" class="btn"
                               style="background-color: #3c3cce;color: #fff">ویرایش اطلاعات</a>
                        </div>
                        {{--                        </div>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">

                        <tr>

                            <th>نام و نام خانوادگی</th>
                            <td>{{$user->name}} {{$user->sirName}}</td>
                        </tr>

                        <tr>

                            <th>موبایل</th>
                            <td>{{$user->mobile}}</td>
                        </tr>
                        <tr>

                            <th>ایمیل</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>

                            <th>جنسیت</th>
                            <td>@if($user->sex==1)
                                    زن
                                @elseif($user->sex==0)
                                    مرد
                                @endif</td>

                        </tr>
                        <tr>

                            <th>تاریخ شروع فعالیت</th>
                            <td>{{$user->yearOfOperation}}</td>

                        </tr>
                        <tr>

                            <th>تاریخ تولد</th>
                            <td>{{$user->birthDate}}</td>

                        </tr>
                        {{--                        <tr>--}}

                        {{--                            <th>فعال/غیرفعال</th>--}}
                        {{--                            <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>--}}

                        {{--                        </tr>--}}
                    </table>
                </div>
                <hr>
                <h3 class="card-title mr-3 text-bold">احراز هویت</h3><br>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tr>
                            <th>عکس کاربر</th>
                            <td>
                                @if(isset($user->userImage))
                                    <img src="{{asset($user->userImage)}}" width="80"
                                         height="40">
                                @endif

                            </td>
                        </tr>
                        @can('nationalCardImage')
                            <tr>

                                <th>عکس کارت ملی</th>
                                <td>
                                    @if(isset($user->nationalCardImage))
                                        <img src="{{asset($user->nationalCardImage)}}" width="80"
                                             height="40">
                                    @endif
                                </td>
                            </tr>
                        @endcan
{{--                        @can('shenasnamehImage')--}}
{{--                            <tr>--}}
{{--                                <th>عکس شناسنامه</th>--}}
{{--                                <td>--}}
{{--                                    @if(isset($user->shenasnamehImage))--}}
{{--                                        <img src2="{{asset($user->shenasnamehImage)}}" width="80"--}}
{{--                                             height="40">--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endcan--}}
                        @can('mobasherCardImage')
                            <tr>
                                <th>عکس کارت مباشر</th>
                                <td>
                                    @if(isset($user->mobasherCardImage))
                                        <img src="{{asset($user->mobasherCardImage)}}" width="80"
                                             height="40">
                                    @endif
                                </td>

                            </tr>
                        @endcan
{{--                        @can('unionCardImage')--}}
{{--                            <tr>--}}
{{--                                <th>عکس کارت اتحادیه</th>--}}
{{--                                <td>--}}
{{--                                    @if(isset($user->unionCardImage))--}}
{{--                                        <img src2="{{asset($user->unionCardImage)}}" width="80"--}}
{{--                                             height="40">--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                            </tr>--}}
{{--                        @endcan--}}
                        @can('businessLicenseImage')

                            <tr>

                                <th>عکس پروانه کسب</th>
                                <td>
                                    @if(isset($user->businessLicenseImage))
                                        <img src="{{asset($user->businessLicenseImage)}}" width="80"
                                             height="40">
                                    @endif
                                </td>

                            </tr>
                        @endcan

                        {{--                        <tr>--}}

                        {{--                            <th>فعال/غیرفعال</th>--}}
                        {{--                            <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>--}}

                        {{--                        </tr>--}}
                    </table>
                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@section('js_realestate')


@endsection

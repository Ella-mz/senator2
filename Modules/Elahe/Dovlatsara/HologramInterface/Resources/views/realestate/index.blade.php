@extends('RealestateMaster::master')
@section('title_realestate')
    @if($type=='pending')
    هولوگرام های در حال بررسی
@else
        هولوگرام های بررسی شده
    @endif
@endsection
@section('card_title')
    @if($type=='pending')
        هولوگرام های در حال بررسی
    @else
        هولوگرام های بررسی شده
    @endif
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">هولوگرام
                                های آگهی</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">
                                هولوگرام ها کاربری</a>
                        </li>
                    {{--                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">تنظیمات</a></li>--}}
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title text-bold">هولوگرام های آگهی</h3>

                                            <div class="card-tools">

                                                {{--                        <div class="input-group input-group-sm" style="width: 150px;">--}}
                                                {{--                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">--}}

                                                <div class="input-group-append">
                                                    {{--                                                                <a href=""--}}
                                                    {{--                                                                   class="btn btn-sm"--}}
                                                    {{--                                                                   style="background-color: #3c3cce;color: #fff">ویرایش--}}
                                                    {{--                                                                    اطلاعات</a>--}}
                                                </div>
                                                {{--                        </div>--}}
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                                                <thead>
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th>عنوان آگهی</th>
                                                    <th> هولوگرام</th>
                                                    <th> تاریخ درخواست</th>
                                                    <th>مبلغ پرداختی</th>
                                                    <th>وضعیت</th>
                                                    <th>جزییات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ad_holograms as $key=>$hologram)
                                                    <tr>
                                                        <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                                                        <td>
                                                            {{$hologram->ad->title}}
                                                        </td>
                                                        @if(isset($hologram->hologram->logo))
                                                            <td width="80" height="40">
                                                                <img
                                                                    src="{{asset($hologram->hologram->logo)}}"
                                                                    width="80" height="40">
                                                            </td>
                                                        @else
                                                            <td width="80" height="40">
                                                                {{--                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                                            </td>
                                                        @endif
                                                        {{--                                                                <td>{{$hologram->hologram->title}}</td>--}}
                                                        <td>
                                                            {{verta($hologram->created_at)->formatJalaliDatetime()}}
                                                        </td>
                                                        <td>
                                                            {{number_format(substr($hologram->hologram_price, 0, -1))}} تومان
                                                        </td>
                                                        <td>
                                                            @if($hologram->status=='pending')
                                                                در انتظار بررسی
                                                            @elseif($hologram->status == 'approved')
                                                                تایید شده
                                                            @elseif($hologram->status == 'notApproved')
                                                                تایید نشده
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <a type="button" href="{{route('hologramInterface.show.realestate', $hologram->id)}}"
                                                               class="btn btn-sm" style="background-color: #3c3cce;color: #fff"><i
                                                                    class="fa fa-plus text-white"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                <!-- /.tab-pane -->

                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-header">
                                            {{--                <a href="{{route('attrs.add.admin', $attribute->id)}}"--}}
                                            {{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد مشخصه آیتم جدید</a>--}}

                                            <h1 class="card-title text-bold" style="float: right">هولوگرام
                                                های
                                                کاربری </h1>

                                        </div>
                                        <div class="card-body p-0">

                                            <table id="example2" class="table table-bordered table-hover table-sm display responsive nowrap">
                                                <thead>
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th>نام و نام خانوادگی</th>
                                                    <th> هولوگرام</th>
                                                    <th> تاریخ درخواست</th>
                                                    <th>مبلغ پرداختی</th>
                                                    <th>وضعیت</th>
                                                    <th>جزییات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($user_holograms as $key=>$hologram)
                                                    <tr>
                                                        <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                                                        <td>
                                                            @if(\Modules\User\Entities\User::find($hologram->type_id)->hasRole('real-state-administrator'))
                                                                {{$hologram->user->shop_title}}
                                                            @else
                                                                {{$hologram->user->name}} {{$hologram->user->sirName}}
                                                            @endif

                                                        </td>
                                                        @if(isset($hologram->hologram->logo))
                                                            <td width="80" height="40">
                                                                <img
                                                                    src="{{asset($hologram->hologram->logo)}}"
                                                                    width="80" height="40">
                                                            </td>
                                                        @else
                                                            <td width="80" height="40">
                                                                {{--                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                                            </td>
                                                        @endif
                                                        {{--                                                                <td>{{$hologram->hologram->title}}</td>--}}
                                                        <td>
                                                            {{verta($hologram->created_at)->formatJalaliDatetime()}}
                                                        </td>
                                                        <td>
                                                            {{number_format($hologram->hologram_price)}}
                                                        </td>
                                                        <td>
                                                            @if($hologram->status=='pending')
                                                                در انتظار بررسی
                                                            @elseif($hologram->status == 'approved')
                                                                تایید شده
                                                            @elseif($hologram->status == 'notApproved')
                                                                تایید نشده
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <a type="button" href="{{route('hologramInterface.show.realestate', $hologram->id)}}"
                                                               class="btn btn-sm" style="background-color: #3c3cce;color: #fff"><i
                                                                    class="fa fa-plus text-white"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <!-- /.tab-pane -->

                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js_realestate')
    @include('RealestateMaster::layouts.data_table')
@endsection

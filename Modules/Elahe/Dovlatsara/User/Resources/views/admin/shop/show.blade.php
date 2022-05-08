@extends('AdminMasterNew::master')
@section('urlHeader')جزییات اطلاعات کسب و کار
@endsection
@section('header')
    {{--    {!! $map !!}--}}
    {{--    @foreach($categories as $category->iteme)--}}
    {{--    <li><a href="{{route('category.index.admin',0)}}" title="categories">Categories</a></li>--}}
    {{--    @endforeach--}}
@endsection
@section('content')
    <section class="content">
        <div class="modal fade" id="disConfirmShop" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="disConfirmShopForm" method="post">
                        @csrf
                        {{--                    <div id="nnn"></div>--}}
                        @if(session()->has('message'))
                            <div class="alert alert-danger " style="color:darkred">{{ session()->get('message') }}</div>
                        @endif
                        {{csrf_field()}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">علت عدم تایید کسب و کار</h5>
                        </div>
                        <div class="modal-body">
                            <div id="success" class="w-100"></div>
                            <div id="error"></div>
                            <div class="row">
                                <input hidden class="form-control" name="shopid" id="modal-Id">
                                <div class="col-md-12 mb-3">
                                <textarea class="form-control" name="shopreason" id="modal-Id"
                                          placeholder="توضیحات خود را برای صاحب کسب و کار در این قسمت بنویسید."></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger text-white btn-sm" data-dismiss="modal">
                                    انصراف
                                </button>
                                <button type="submit" class="btn btn-success btn-sm " id="disConfirmShop">ثبت</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 text-left">

                    {{--                <a href="{{route('memberships.create')}}"--}}
                {{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد حق اشتراک جدید</a>--}}
                <h1 class="card-title" style="float: right"> {{$user->shop_title}}</h1>
                    </div>
                    <div class="col-md-6 text-left">
                        <a type="button" class="btn btn-info btn-sm"
                           href="{{route('users.shops.index.admin')}}"><i
                                class="fa fa-arrow-left text-white"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">

                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-bold" style="color: violet">جزییات کسب و کار</div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-2">

                                        <span class="text-bold">تلفن:</span>
                                        {{$user->shop_phone}}
                                    </div>
                                    <div class="col-md-2">
                                        <span class="text-bold">سال شروع فعالیت:</span>
                                        {{$user->yearOfOperation}}
                                    </div>
                                    <div class="col-md-2">
                                        <span class="text-bold">وضعیت:</span>
                                        @if($user->shop_active=='active')
                                            <span style="color: #00B74A">تایید</span>
                                        @elseif($user->shop_active=='disConfirm')
                                            <span style="color: #F93154">عدم تایید</span>
                                        @elseif($user->shop_active=='inactive')
                                            غیرفعال
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <span class="text-bold">لوگو:</span>
                                        <img src="{{asset($user->shop_logo)}}" alt="logo" class="rounded-circle"
                                             style="height: 60px; width: 60px">
                                    </div>

                                    <div class="col-md-2"></div>
                                    <div class="col-md-6">
                                        <span class="text-bold">آدرس:</span>
                                        {{($user->shop_address)}}


                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group mt-1 d-flex align-content-end justify-content-end">
                                            <div class="left">
{{--                                                <form action="" method="POST">--}}

{{--                                                    <a href=""--}}
{{--                                                       class="btn btn-outline-info btn-sm">ویرایش</a>--}}
{{--                                                    @csrf--}}
{{--                                                    <button type="submit" class="btn btn-outline-danger btn-sm"--}}
{{--                                                            onclick="return confirm('آیا از حذف کسب و کاری {{$user->shop_title}} اطمینان دارید؟')">--}}
{{--                                                        حذف--}}
{{--                                                    </button>--}}
                                                    <a class="btn btn-outline-success btn-sm"
                                                       href="{{ route('users.shops.confirm.admin', $user->id)}}"
                                                    >
                                                        تایید
                                                    </a>
                                                    <a data-toggle="modal" data-target="#disConfirmShop" data-id="{{$user->id}}"
                                                       data-reason="{{$user->shop_reasonOfDeactivation}}"
                                                       class="btn btn-outline-secondary btn-sm">عدم تایید</a>

{{--                                                </form>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-bold" style="color: blue">مدیران کسب و کار</div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>تصویر</th>
                                        <th>نام و نام خانوادگی</th>
                                        <th>موبایل</th>
                                        <th>جنسیت</th>
                                        <th>ایمیل</th>
                                        <th>تاریخ تولد</th>
                                        <th>تاریخ شروع فعالیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($realStateAdmins as $key=>$user)
                                        <tr>
                                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                                            @if(isset($user->userImage))
                                                <td width="80" height="40">
                                                    <img src="{{asset($user->userImage)}}" width="80" height="40">
                                                </td>
                                            @else
                                                <td width="80" height="40">
                                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80"
                                                         height="40">
                                                </td>
                                            @endif
                                            <td>{{$user->name}} {{$user->sirName}}</td>
                                            <td>{{$user->mobile}}</td>
                                            <td>
                                                @if($user->sex==1)
                                                    زن
                                                @elseif($user->sex==0)
                                                    مرد
                                                @endif
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->birthDate}}</td>
                                            <td>{{$user->yearOfOperation}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{--                                <ul class="list-group-flush">--}}
                                {{--                                    @foreach($realStateAgent as $user)--}}
                                {{--                                        <li class="list-group-item">{{$user->name}}</li>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </ul>--}}
                            </div>
                            <div class="card-header text-bold" style="color: blue">کارشناسان کسب و کار</div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>تصویر</th>
                                        <th>نام و نام خانوادگی</th>
                                        <th>موبایل</th>
                                        <th>جنسیت</th>
                                        <th>ایمیل</th>
                                        <th>تاریخ تولد</th>
                                        <th>تاریخ شروع فعالیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($realStateAgents as $key=>$user)
                                        <tr>
                                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                                            @if(isset($user->usereImage))
                                                <td width="80" height="40">
                                                    <img src="{{asset($user->userImage)}}" width="80" height="40">
                                                </td>
                                            @else
                                                <td width="80" height="40">
                                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80"
                                                         height="40">
                                                </td>
                                            @endif
                                            <td>{{$user->name}} {{$user->sirName}}</td>
                                            <td>{{$user->mobile}}</td>
                                            <td>
                                                @if($user->sex)
                                                    زن
                                                @else
                                                    مرد
                                                @endif
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->birthDate}}</td>
                                            <td>{{$user->yearOfOperation}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{--                                <ul class="list-group-flush">--}}
                                {{--                                    @foreach($realStateAgent as $user)--}}
                                {{--                                        <li class="list-group-item">{{$user->name}}</li>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </ul>--}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $('#disConfirmShop').on('show.bs.modal', function (e) {
            var opener = e.relatedTarget;
            var id = $(opener).attr('data-id');
            var reason = $(opener).attr('data-reason');
            $('#disConfirmShopForm').find('[name="shopid"]').val(id);
            $('#disConfirmShopForm').find('[name="shopreason"]').val(reason);
        });

    </script>
    <script>
        $(document).ready(function () {
            $('#disConfirmShopForm').on('submit', function (event) {
                event.preventDefault();
                var formData = {
                    'shopid': $('input[name=shopid]').val(),
                    'shopreason': $('textarea[name=shopreason]').val(),
                };
                var shopid = formData["shopid"];
                var shopreason = formData["shopreason"]
                $.ajax({
                    url: '{{route('users.shops.disconfirm.admin')}}',
                    method: "POST",
                    data: new FormData(this),
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.errorValidation) {
                            $('#error').empty();
                            $('#error').append('<small class="text-danger">' + data.errorValidation + '</small>');
                        }
                        if (data.success) {
                            $('#success').empty();
                            $('#success').append(data.success);
                            window.setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                    },
                })
            });
        });
    </script>
@endsection

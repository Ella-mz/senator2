@extends('AdminMasterNew::master')
@section('urlHeader')جزییات اطلاعات کاربر
@endsection
@section('header')
    {{--    {!! $map !!}--}}
    {{--    @foreach($categories as $category->iteme)--}}
    {{--    <li><a href="{{route('category.index.admin',0)}}" title="categories">Categories</a></li>--}}
    {{--    @endforeach--}}
    <style>
        * {
            box-sizing: border-box;
        }

        .img-zoom-container {
            position: relative;
        }

        .img-zoom-lens {
            position: absolute;
            border: 1px solid #d4d4d4;
            /*set the size of the lens:*/
            width: 40px;
            height: 40px;
        }

        .img-zoom-result {
            border: 1px solid #d4d4d4;
            /*set the size of the result div:*/
            width: 300px;
            height: 300px;
        }
    </style>
@endsection
@section('content')
    <div class="modal fade" id="disConfirmShop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="disConfirmShopForm" method="post">
                    @csrf
                    @if(session()->has('message'))
                        <div class="alert alert-danger " style="color:darkred">{{ session()->get('message') }}</div>
                    @endif
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">علت عدم تایید کسب و کاری</h5>
                    </div>
                    <div class="modal-body">
                        <div id="success" class="w-100"></div>
                        <div id="error"></div>
                        <div class="row">
                            <input hidden class="form-control" name="shopid" id="modal-Id">
                            <div class="col-md-12 mb-3">
                                <textarea class="form-control" name="shopreason" id="modal-Id"
                                          placeholder="توضیحات خود را برای صاحب کسب و کاری در این قسمت بنویسید."></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-white btn-sm" data-dismiss="modal">انصراف
                            </button>
                            <button type="submit" class="btn btn-success btn-sm " id="disConfirmShop">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-1">
                        @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $user->id)->where('type', 'user')->first()
                                                            && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $user->id)->where('type', 'user')->first()->status=='approved')
                            <img src="{{asset(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $user->id)->where('type', 'user')->first()->hologram->logo)}}"
                                 style="width: 50px;height: 40px">
                        @endif
                    </div>
                <div class="col-md-6 text-left">

                {{--                <a href="{{route('memberships.create')}}"--}}
                {{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد حق اشتراک جدید</a>--}}

                <h1 class="card-title" style="float: right">کاربر {{$user->name}} {{$user->sirName}}</h1>

                </div>
                <div class="col-md-5 text-left">
                    <a type="button" class="btn btn-info btn-sm"
                       href="{{route('users.index.admin', $user->roles->first()->slug)}}"><i
                            class="fa fa-arrow-left text-white"></i></a>
                </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row">

                    <div class="col-md-12">
                        @if($user->hasRole('real-state-administrator'))
                            <div class="card">
                                <div class="card-header" style="color: blue"><h3 class="text-bold">اطلاعات کسب و کاری</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span class="text-bold">نام:</span>
                                            {{$user->shop_title}}
                                        </div>
                                        {{--                                        <div class="col-md-2">--}}
                                        {{--                                            <span class="text-bold">صنف:</span>--}}
                                        {{--                                            {{$user->shop->union->title}}--}}
                                        {{--                                        </div>--}}
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
                                                <span
                                                    style="color: #F93154">عدم تایید</span> @if(isset($user->shop_reasonOfDeactivation))
                                                    <span>: {{$user->shop_reasonOfDeactivation}}</span> @endif
                                            @elseif($user->shop_active=='inactive')
                                                غیرفعال
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <span class="text-bold">لوگو:</span>
                                            @if(isset($user->shop_logo))
                                                <img src="{{asset($user->shop_logo)}}" alt="logo" class="rounded-circle"
                                                     style="height: 60px; width: 60px">

                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <span class="text-bold">آدرس:</span>
                                            {{($user->shop_address)}}
                                        </div>

                                        <div class="col-md-6">
                                            <div class="btn-group mt-1 d-flex align-content-end justify-content-end">
                                                <div class="left">
                                                    <form action="" method="POST">

                                                        <a class="btn btn-outline-success btn-sm"
                                                           href="{{ route('users.shops.confirm.admin', $user->id)}}">
                                                            تایید
                                                        </a>
                                                        <a data-toggle="modal" data-target="#disConfirmShop"
                                                           data-id="{{$user->id}}"
                                                           data-reason="{{$user->shop_reasonOfDeactivation}}"
                                                           class="btn btn-outline-secondary btn-sm">عدم تایید</a>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($user->hasRole('contractor'))
                            <div class="card">
                                <div class="card-header" style="color: blue"><h3 class="text-bold">پروژه های
                                        پیمانکار</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($user->contractorProjects as $contractorProject)
                                            <div class="col-md-6 d-flex">
                                                <span class="text-bold">عنوان:</span>
                                                {{$contractorProject->title}}
                                            </div>
                                            <div class="col-md-6 d-flex">
                                                <span class="text-bold">عکس:</span>
                                                @if(($contractorProject->contractorProjectImages->count()>0))
                                                    <img src="{{asset($contractorProject->contractorProjectImages()->first()->image)}}"
                                                    class="rounded" style="height: 60px; width: 80px">
                                                @endif
                                            </div>
                                            <div class="col-md-12 d-flex">
                                                <span class="text-bold">توضیحات:</span>
                                                {{$contractorProject->description}}
                                            </div>
                                            <hr style="border-top: 1px solid rgba(0,0,0,.1);width: 100%">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header" style="color: violet"><h3 class="text-bold">اطلاعات کاربر</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="text-bold">نقش کاربر:</span>
                                        @foreach($user->roles as $role)
                                            {{$role->name}}
                                        @endforeach
                                    </div>
{{--                                    <div class="col-md-2">--}}
{{--                                        <span class="text-bold">نام کاربری:</span>--}}
{{--                                        {{$user->userName}}--}}
{{--                                    </div>--}}
                                    <div class="col-md-2">
                                        <span class="text-bold">موبایل:</span>
                                        {{$user->mobile}}
                                    </div>
                                    <div class="col-md-2">
                                        <span class="text-bold">ایمیل:</span>
                                        {{$user->email}}
                                    </div>
                                    @if(!$user->hasRole('real-state-administrator'))

                                        <div class="col-md-2">
                                            <span class="text-bold">سال شروع فعالیت:</span>
                                            {{$user->yearOfOperation}}
                                        </div>
                                    @endif
                                    <div class="col-md-1">
                                        <span class="text-bold">جنسیت:</span>
                                        @if($user->sex==1)
                                            زن
                                        @elseif($user->sex==0)
                                            مرد
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <span class="text-bold">شماره تلفن آگهی:</span>
                                        {{$user->phoneNumberForAds}}
                                    </div>
                                    <div class="col-md-2">
                                        <span class="text-bold">تاریخ تولد:</span>
                                        {{$user->birthDate}}
                                    </div>

                                </div>
                                <hr>
                                <h4 class="text-bold">احراز هویت:</h4><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="text-bold">تصویر پروفایل کاربر:</span>
                                        @if(isset($user->userImage))

                                            <img src="{{asset($user->userImage)}}" class="rounded" alt="image"
                                                 width="150" height="100">
                                        @else

                                        @endif
                                    </div>
                                    <div class="col-md-6">

                                        <span class="text-bold">تصویر کارت ملی:</span>
                                        @if(isset($user->nationalCardImage))

                                            <img src="{{asset($user->nationalCardImage)}}" class="rounded" alt="image"
                                                 width="150" height="100">
                                        @else

                                        @endif
                                    </div>
                                    {{--                                        </div>--}}
                                    {{--                                    <div class="col-md-6">--}}
                                    {{--                                        <span class="text-bold">تصویر شناسنامه:</span>--}}
                                    {{--                                        <img src2="{{asset($user->userImage)}}" class="rounded" alt="image" width="150" height="100">--}}
                                    {{--                                    </div>--}}
                                    @if($user->hasRole('real-state-administrator'))

                                        <div class="col-md-6">
                                            <span class="text-bold">تصویر کارت مباشر:</span>
                                            @if(isset($user->mobasherCardImage))
                                                <img src="{{asset($user->mobasherCardImage)}}" class="rounded"
                                                     alt="image" width="150" height="100">
                                            @else

                                            @endif
                                        </div>
                                    @endif
                                    @if($user->hasRole('real-state-administrator'))

                                        <div class="col-md-6">
                                            <span class="text-bold">تصویر پروانه کسب:</span>
                                            @if(isset($user->businessLicenseImage))

                                                <img src="{{asset($user->businessLicenseImage)}}" class="rounded"
                                                     alt="image" width="150" height="100">
                                            @else

                                            @endif
                                        </div>
                                    @endif
                                    {{--                                    <div class="col-md-6">--}}
                                    {{--                                        <span class="text-bold">تصویر کارت اتحادیه:</span>--}}
                                    {{--                                        <img src2="{{asset($user->userImage)}}" class="rounded" alt="image" width="150" height="100">--}}
                                    {{--                                    </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group mt-1 d-flex align-content-end justify-content-end">
                                            <div class="left">
                                                <form action="" method="POST">

                                                    <a href="{{route('users.edit.admin', $user->id)}}"
                                                       class="btn btn-outline-info btn-sm">ویرایش</a>
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('آیا از حذف کاربر اطمینان دارید؟')">
                                                        حذف
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

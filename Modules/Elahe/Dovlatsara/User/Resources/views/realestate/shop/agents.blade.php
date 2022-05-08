@extends('RealestateMaster::master')
@section('title_realestate')کارشناسان کسب و کاری من
@endsection
@section('card_title') اطلاعات کارشناسان کسب و کاری
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('user.shop.agentCreate.realestate', $user->id)}}"
                   class="btn btn-sm " style="float: left;background-color: #3c3cce;color: #fff"> کارشناس جدید</a>
                <a href="{{route('user.shop.addExistAgent.panel')}}"
                   class="btn btn-sm " style="float: left;background-color: #fff;color: #3c3cce;border-color: #3c3cce"> افزودن کارشناس ثبت نام شده</a>
                <h1 class="card-title" style="float: right">کارشناسان کسب و کاری</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>تصویر</th>
                        <th>کد کاربر</th>
                        <th>نام و نام خانوادگی</th>
                        <th>موبایل</th>
                        <th>جنسیت</th>
                        <th>ایمیل</th>
                        <th>تاریخ تولد</th>
                        <th>تاریخ شروع فعالیت</th>
                        <th>فعال/غیرفعال</th>
                        <th>جزییات/ویرایش/رهاسازی</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($realStateAgents as $key=>$user)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            @if(isset($user->userImage))
                                <td height="40">
                                    <img src="{{asset($user->userImage)}}" width="80" height="40">
                                </td>
                            @else
                                <td height="40">
                                    {{--                                    <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                </td>
                            @endif
                            <td>{{$user->user_id}}</td>
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
                            <td>
                                <input class="activation1" type="checkbox"
                                       {{$user->agent_active=='active'?"checked":""}}
                                       data-toggle="tooltip" title="فعال/غیرفعال کردن کاربر"
                                       id="{{$user->id}}"
                                       name="activation">
                            </td>
                            <td>
                                {{--                                <form action="{{ route('memberships.destroy' ,$user->id) }}" method="POST">--}}
                                {{--                                    @csrf--}}
                                {{--                                    @method('delete')--}}
                                <a class="btn btn-primary btn-sm"
                                   href="{{ route('user.profile.realestate', $user->id)}}">
                                    <i class="fa fa-info-circle"></i>
                                </a>

                                <a class="btn btn-info btn-sm"
                                   href="{{route('user.edit.realestate', $user->id)}}">
                                    <i class="fa fa-edit text-white"></i>
                                </a>
                                <a class="btn btn-danger btn-sm"
                                        href="{{route('user.release.panel', $user->id)}}">
                                    <i class="fa fa-rocket"></i>
                                </a>
                                {{--                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
@section('js_realestate')
    @include('RealestateMaster::layouts.data_table')

    <script>
        $('.activation1').change(function () {
            var id = $(this).attr('id')
            if ($(this).is(":checked")) {
                var active = 'active';
            } else {
                var active = 'inactive';
            }
            $.ajax({
                url: "{{route('user.activation.realestate')}}",
                data: {
                    'id': id,
                    'active': active,
                },
                method: "get",
                dataType: 'JSON',

                success: function (data) {
                    location.reload();
                }
            })
        });
    </script>
@endsection

@extends('AdminMasterNew::master')
@section('urlHeader'){{$role->name}}
@endsection
@section('header')
    {{$role->name}}
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('users.create.admin', $role->slug)}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد {{$role->name}} جدید</a>
                <h1 class="card-title" style="float: right">{{$role->name}}</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>تصویر</th>
                        <th>نام و نام خانوادگی</th>
                        <th>موبایل</th>
{{--                        <th>نام کاربری</th>--}}
                        <th>جنسیت</th>
                        <th>تاریخ تولد</th>
                        <th>تاریخ شروع فعالیت</th>
                        <th>هولوگرام</th>
                        <th>فعال/غیرفعال</th>
                        <th>جزییات/ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key=>$user)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            @if(isset($user->userImage))
                                <td width="80" height="40">
                                    <img src="{{asset($user->userImage)}}" style="width: 100%; height: 50px">
                                </td>
                            @else
                                <td height="40">
                                    {{--                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                </td>
                            @endif
                            <td>{{$user->name}} {{$user->sirName}}</td>
                            <td>{{$user->mobile}}</td>
{{--                            <td>{{$user->userName}}</td>--}}

                            <td>
                                @if($user->sex)
                                    زن
                                @else
                                    مرد
                                @endif
                            </td>
                            <td>{{$user->birthDate}}</td>
                            <td>{{$user->yearOfOperation}}</td>
                            @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $user->id)->where('type', 'user')->first()
                                                              && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $user->id)->where('type', 'user')->first()->status=='approved')
                                <td width="80" height="40">
                                    <img style="width: 100%; height: 50px"
                                        src="{{asset(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $user->id)->where('type', 'user')->first()->hologram->logo)}}">
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-info">هولوگرام ندارد</span>
                                </td>
                            @endif
                            <td>
                                <input class="activation1" type="checkbox"
                                       {{$user->shop_active=='active'?"checked":""}}
                                       data-toggle="tooltip" title="فعال/غیرفعال کردن کاربر"
                                       id="{{$user->id}}"
                                       name="activation">
                            </td>

                            <td>
                                <form action="{{ route('users.destroy.admin' ,$user->id) }}" method="POST">
                                    @csrf
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('users.detail.admin', $user->id)}}">
                                        <i class="fa fa-info-circle"></i>
                                    </a>

                                    <a class="btn btn-info btn-sm"
                                       href="{{route('users.edit.admin', $user->id)}}">
                                        <i class="fa fa-edit text-white"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف کاربر {{$user->name}} {{$user->sirName}} اطمینان دارید؟ درصورت حذف کاربر آگهی های کاربر نیز حذف میشود.')">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
    <script>
        $('.activation1').change(function () {
            var id = $(this).attr('id')
            if ($(this).is(":checked")) {
                var active = 'active';
            } else {
                var active = 'inactive';
            }
            $.ajax({
                url: "{{route('user.activation.admin')}}",
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

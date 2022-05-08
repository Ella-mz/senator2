@extends('AdminMasterNew::master')
@section('urlHeader')لیست درخواست تبلیغات
@endsection
@section('header')
    لیست درخواست تبلیغات
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">

                <h1 class="card-title" style="float: right">لیست درخواست تبلیغات
                </h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>کاربر</th>
                        <th>بسته</th>
                        <th>تاریخ شروع</th>
                        <th>تاریخ پایان</th>
                        <th>مکان تبلیغ</th>
                        <th>وضعیت پرداخت</th>
                        <th>فعال/غیرفعال</th>
                        <th>
                            جزییات/حذف
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($advertisingApplications as $key=>$application)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$application->userInfo->name}} {{$application->userInfo->sirName}}</td>
                            <td>{{$application->advertising->title}}</td>
                            <td>
                                {{($application->startDate)}}
                            </td>
                            <td>
                                {{$application->endDate}}
                            </td>
                            <td>
                                {{$application->advertising->advertisingOrder->fa_title}} - {{$application->advertising->advertisingOrder->page->fa_title}}
                            </td>
                            <td>
                                @if($application->isPaid==1)
                                    <span class="badge badge-success">موفق</span>
                                @else
                                    <span class="badge badge-danger">ناموفق</span>
                                @endif
                            </td>
                            <td>
                                <input class="activation1" type="checkbox"
                                       {{$application->active==1?"checked":""}}
                                       data-toggle="tooltip" title="فعال/غیرفعال کردن کاربر"
                                       id="{{$application->id}}"
                                       name="activation">
                            </td>
                            <td class="project-actions text-right">
                                <form
                                    action="{{ route('advertisingApplicants.destroy.admin' ,$application->id) }}"
                                    method="POST">
                                    @csrf
                                    <a class="btn btn-primary btn-sm"
                                       href="{{route('advertisingApplicants.show.admin', $application->id)}}"
                                    >
                                        <i class="fa fa-list"></i>
                                    </a>

                                    {{--                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                    <i class="fa fa-trash"></i>--}}
                                    {{--                                </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف درخواست اطمینان دارید؟')">
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
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
    <script>
        $('.activation1').change(function () {
            var id = $(this).attr('id')
            if ($(this).is(":checked")) {
                var active = 1;
            } else {
                var active = 0;
            }
            $.ajax({
                url: "{{route('advertisingApplicants.activation.admin')}}",
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

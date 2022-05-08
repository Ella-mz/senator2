    @extends('RealestateMaster::master')
@section('title_realestate') لیست درخواست تبلیغات شما
@endsection
@section('card_title') لیست درخواست تبلیغات شما
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="card">
            <div class="card-header">
{{--                <a href="{{ route('advertisings.create.admin')}}"--}}
{{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد تبلیغ جدید</a>--}}

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
                            <td class="project-actions text-right">
                                <form
                                    action="{{ route('advertisingApplicants.destroy.admin' ,$application->id) }}"
                                    method="POST">
                                    @csrf
                                    <a class="btn btn-primary btn-sm"
                                       href="{{route('advertisingApplicants.show.realestate', $application->id)}}"
                                    >
                                        <i class="fa fa-list"></i>
                                    </a>

                                    {{--                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                    <i class="fa fa-trash"></i>--}}
                                    {{--                                </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از این حذف درخواست اطمینان دارید؟')">
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
@section('js_realestate')
    @include('RealestateMaster::layouts.data_table')
@endsection

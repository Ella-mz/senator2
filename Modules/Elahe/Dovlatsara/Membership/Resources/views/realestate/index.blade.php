@extends('RealestateMaster::master')
@section('title_realestate')حق اشتراک ها
@endsection
@section('content_realestateMaster')
    @if($memberships->count()>0)
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="alert alert-info">
                    <h3 style="color: #c3191e">میزان کسر امتیاز به ازای هر آگهی:</h3>
                    <ul>
                        <li>
                            ثبت هر آگهی عادی: {{$submit_general_ad_score}}
                        </li>
                        <li>
                            ثبت هر آگهی نردبانی: {{$submit_scalar_ad_score}}
                        </li>
                        <li>
                            ثبت هر آگهی فوری: {{$submit_emergency_ad_score}}
                        </li>
                        <li>
                            مشاهده هر درخواست خرید: {{$see_application_score}}
                        </li>
                    </ul>
                </div>
                <h3 class="card-title text-bold">لیست حق اشتراک ها</h3><br>
                <div class="row">
                    @foreach($memberships as  $membership)
                        <div class="col-6">

                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title text-bold">{{$membership->title}}</h3>
                                    <div class="card-tools">
                                        <a class="btn btn-primary"
                                           href="{{route('membership.buy.realestate', $membership->id)}}">خرید</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tr>

                                            <th>هزینه</th>
                                            <td>{{number_format(substr($membership->price, 0, -1))}} تومان</td>
                                        </tr>

                                        {{--                                    <tr>--}}

                                        {{--                                        <th>نوع حق اشتراک</th>--}}
                                        {{--                                        <td>--}}
                                        {{--                                            @if($membership->package_type=='general')--}}
                                        {{--                                                عادی--}}
                                        {{--                                            @elseif($membership->package_type=='scalar')--}}
                                        {{--                                                نردبانی--}}
                                        {{--                                            @elseif($membership->package_type=='special')--}}
                                        {{--                                                ویژه--}}
                                        {{--                                            @elseif($membership->package_type=='emergency')--}}
                                        {{--                                                فوری--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </td>--}}
                                        {{--                                    </tr>--}}
                                        <tr>

                                            <th>میزان امتیاز</th>
                                            <td>{{$membership->score}}</td>
                                        </tr>
                                        <tr>

                                            <th>مدت اعتبار حق اشتراک</th>
                                            <td>{{$membership->duration}} روز</td>

                                        </tr>
                                    </table>
                                </div>
                                @if(isset($membership->description))
                                    <div class="card-body">
                                        <div class="callout callout-costumBlue">
                                            {{--                                    <h5>توضیحات</h5>--}}
                                            <p>
                                                {{$membership->description}}
                                            </p>
                                        </div>
                                    </div>
                            @endif
                            <!-- /.card-body -->
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.card -->
            </div>
        </div><br>
    @endif
    {{--    @if($applicant_memberships->count()>0)--}}
    {{--    <div class="row">--}}
    {{--        <div class="col-1"></div>--}}
    {{--        <div class="col-10">--}}

    {{--            <h3 class="card-title text-bold">لیست حق اشتراک های درخواست</h3><br>--}}
    {{--            <div class="row">--}}
    {{--                @foreach($applicant_memberships as  $membership)--}}
    {{--                    <div class="col-6">--}}

    {{--                        <div class="card">--}}

    {{--                            <div class="card-header">--}}
    {{--                                <h3 class="card-title text-bold">{{$membership->title}}</h3>--}}
    {{--                                <div class="card-tools">--}}
    {{--                                    <a class="btn btn-primary"--}}
    {{--                                       href="{{route('applicantMembership.buy.realestate', $membership->id)}}">خرید</a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <!-- /.card-header -->--}}
    {{--                            <div class="card-body table-responsive p-0">--}}
    {{--                                <table class="table table-hover">--}}
    {{--                                    <tr>--}}

    {{--                                        <th>هزینه</th>--}}
    {{--                                        <td>{{number_format($membership->price)}} ریال</td>--}}
    {{--                                    </tr>--}}
    {{--                                    <tr>--}}

    {{--                                        <th>مدت دوره</th>--}}
    {{--                                        <td>{{$membership->duration}} روز</td>--}}

    {{--                                    </tr>--}}
    {{--                                    <tr>--}}

    {{--                                        <th>تعداد درخواست های قابل مشاهده</th>--}}
    {{--                                        <td>{{$membership->number_of_applications}} عدد</td>--}}

    {{--                                    </tr>--}}
    {{--                                </table>--}}
    {{--                            </div>--}}
    {{--                            <!-- /.card-body -->--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--            <!-- /.card -->--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    @endif--}}

@endsection
@section('js_realestate')
    @include('RealestateMaster::layouts.data_table')

@endsection

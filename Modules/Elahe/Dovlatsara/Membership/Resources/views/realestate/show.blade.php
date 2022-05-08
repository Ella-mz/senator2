@extends('RealestateMaster::master')
@section('title_realestate')حق اشتراک های من
@endsection
@section('content_realestateMaster')
@if($memberships->count()>0)
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">

            <h3 class="card-title text-bold">لیست حق اشتراک های عرضه</h3><br>
            <div class="row">
                @foreach($memberships as  $membership)
                    <div class="col-6">

                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title text-bold">{{$membership->title}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    {{--                        <tr>--}}

                                    {{--                            <th>عنوان</th>--}}
                                    {{--                            <td>{{$membership->title}}</td>--}}
                                    {{--                        </tr>--}}
                                    <tr>

                                        <th>هزینه</th>
                                        <td>{{number_format($membership->price)}}</td>
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

                                        <th>امتیاز حق اشتراک</th>
                                        <td>{{$membership->pivot->score}}</td>
                                    </tr>
                                    <tr>

                                        <th>امتیاز باقیمانده</th>
                                        <td>{{$membership->pivot->remain_score}}</td>
                                    </tr>
                                    <tr>

                                        <th>از</th>
                                        <td>{{verta($membership->pivot->startDate)->formatJalaliDate()}} </td>

                                    </tr>
                                    <tr>

                                        <th>تا</th>
                                        <td>{{verta($membership->pivot->endDate)->formatJalaliDate()}}</td>

                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.card -->
        </div>
    </div><br>
    @endif
@if($applicant_memberships->count()>0)

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">

            <h3 class="card-title text-bold">لیست حق اشتراک های درخواست</h3><br>
            <div class="row">
                @foreach($applicant_memberships as  $membership)
                    <div class="col-6">

                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title text-bold">{{$membership->title}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    {{--                        <tr>--}}

                                    {{--                            <th>عنوان</th>--}}
                                    {{--                            <td>{{$membership->title}}</td>--}}
                                    {{--                        </tr>--}}
                                    <tr>

                                        <th>هزینه</th>
                                        <td>{{number_format($membership->price)}}</td>
                                    </tr>
                                    <tr>

                                        <th>از</th>
                                        <td> {{verta($membership->pivot->startDate)->formatJalaliDate()}}</td>

                                    </tr>
                                    <tr>

                                        <th>تا</th>
                                        <td> {{verta($membership->pivot->endDate)->formatJalaliDate()}}</td>

                                    </tr>
                                    <tr>

                                        <th>تعداد درخواست قابل مشاهده</th>
                                        <td> {{($membership->pivot->remain_number_of_applications)}}</td>

                                    </tr>
                                    <tr>

                                        <th>تعداد درخواست مشاهده شده</th>
                                        <td> {{($membership->pivot->number_of_applications)-($membership->pivot->remain_number_of_applications)}}</td>

                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.card -->
        </div>
    </div>
    @endif
@endsection
@section('js_realestate')

@endsection

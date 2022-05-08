@extends('RealestateMaster::master')
@section('title_realestate')حق اشتراک ها
@endsection
@section('content_realestateMaster')
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
                                <div class="card-tools">
                                    <a class="btn btn-primary" href="{{route('membership.buy.realestate', $membership->id)}}">خرید</a>
                                </div>
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
                                        <td>{{$membership->price}}</td>
                                    </tr>

                                    <tr>

                                        <th>نوع حق اشتراک</th>
                                        <td>{{$membership->package_type}}</td>
                                    </tr>
                                    <tr>

                                        <th>تعداد آگهی</th>
                                        <td>{{$membership->number_of_allowed_ads}}</td>
                                    </tr>
                                    <tr>

                                        <th>مدت دوره</th>
                                        <td>{{$membership->duration}} روز</td>

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
                                <div class="card-tools">
                                    <a class="btn btn-primary" href="{{route('applicantMembership.buy.realestate', $membership->id)}}">خرید</a>
                                </div>
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
                                        <td>{{$membership->price}}</td>
                                    </tr>
                                    <tr>

                                        <th>مدت دوره</th>
                                        <td>{{$membership->duration}} روز</td>

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

@endsection
@section('js_realestate')

@endsection

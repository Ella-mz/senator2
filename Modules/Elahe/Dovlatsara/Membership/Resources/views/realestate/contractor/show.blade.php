@extends('RealestateMaster::master')
@section('title_realestate')حق اشتراک های من
@endsection
@section('content_realestateMaster')
{{--    <div class="col-lg-9 col-md-8 col-xs-12 pull-right">--}}
{{--        <div class="col-lg-12 col-xs-12 pull-right">--}}
{{--            <div class="headline-profile">--}}
{{--                <span>لیست حق اشتراک های عرضه</span>--}}
{{--            </div>--}}
{{--            <div class="profile-stats">--}}
{{--                @foreach($memberships as  $membership)--}}
{{--                    <div class="profile-recent-fav profile-favorites-fav">--}}
{{--                        --}}{{--                        <a href="#" class="img-profile-favorites"><img src="assets/images/product-slider-2/111472656.jpg"></a>--}}
{{--                        <div class="profile-recent-fav-col">--}}
{{--                            <a style="font-size:16px;">{{$membership->title}}</a>--}}
{{--                            <div class="profile-recent-fav-price">{{$membership->price}}</div>--}}
{{--                            <div class="profile-recent-fav-price">{{$membership->package_type}}</div>--}}
{{--                            <div class="profile-recent-fav-remove" style="width: 18%"><a href="{{route('membership.buy.realestate', $membership->id)}}">خرید</a></div>--}}
{{--                            <a class="profile-wishlist ml-3">تعداد آگهی: {{$membership->pivot->number_of_allowed_ads}}</a>--}}
{{--                            <a class="profile-wishlist ml-3">از: {{verta($membership->pivot->startDate)->formatJalaliDate()}} </a>--}}
{{--                            <a class="profile-wishlist">تا: {{verta($membership->pivot->endDate)->formatJalaliDate()}} </a>--}}


{{--                        </div>--}}
{{--                    </div>--}}

{{--                @endforeach--}}

{{--            </div>--}}
{{--            <div class="headline-profile">--}}
{{--                <span>لیست حق اشتراک های درخواست</span>--}}
{{--            </div>--}}
{{--            <div class="profile-stats">--}}
{{--                @foreach($applicant_memberships as  $membership)--}}
{{--                    <div class="profile-recent-fav profile-favorites-fav">--}}
{{--                        --}}{{--                        <a href="#" class="img-profile-favorites"><img src="assets/images/product-slider-2/111472656.jpg"></a>--}}
{{--                        <div class="profile-recent-fav-col">--}}
{{--                            <a href="#" style="font-size:16px;">{{$membership->title}}</a>--}}
{{--                            <div class="profile-recent-fav-price">{{$membership->price}}</div>--}}
{{--                            <a class="profile-wishlist ml-3">از: {{verta($membership->pivot->startDate)->formatJalaliDate()}} </a>--}}
{{--                            <a class="profile-wishlist">تا: {{verta($membership->pivot->endDate)->formatJalaliDate()}} </a>--}}


{{--                        </div>--}}
{{--                    </div>--}}

{{--                @endforeach--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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
                                        <td>{{$membership->price}}</td>
                                    </tr>

                                    <tr>

                                        <th>نوع حق اشتراک</th>
                                        <td>{{$membership->package_type}}</td>
                                    </tr>
                                    <tr>

                                        <th>تعداد آگهی</th>
                                        <td>{{$membership->pivot->number_of_allowed_ads}}</td>
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
                                        <td>{{$membership->price}}</td>
                                    </tr>
                                    <tr>

                                        <th>از</th>
                                        <td> {{verta($membership->pivot->startDate)->formatJalaliDate()}}</td>

                                    </tr>
                                    <tr>

                                        <th>تا</th>
                                        <td> {{verta($membership->pivot->endDate)->formatJalaliDate()}}</td>

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

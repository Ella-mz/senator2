@extends('UserMasterNew::master')
@section('title_user') هزینه های آگهی
@endsection
@section('content_userMasterNew')
    <div class="py-5">
        <main class="main-product">

            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h5 class="text-bold mb-3">لیست هزینه های آگهی</h5>
                        <div class="row">
                            @foreach($adFees as $adFee)
                                <div class="col-md-4">
                                    <form action="{{route('factorPage.user')}}" method="post">
                                        @csrf
                                        <input hidden name="ad_id" value="{{$ad->id}}">
                                        <input hidden name="adFee_id" value="{{$adFee->id}}">

                                        <div class="card">
                                            <div class="card-title">
                                            </div>
                                            <div class="card-body">
                                                @if($ad->type=='general')
                                                    <h5>هزینه:</h5><br>
                                                    {{$adFee->expireTimeOfAds}} روز<br>
                                                    {{number_format($adFee->generalAdFee)}} ریال
{{--                                                    <hr>--}}
                                                @elseif($ad->type=='scalar')
                                                    <h5>هزینه:</h5><br>
                                                    {{$adFee->expireTimeOfAds}} روز<br>

                                                    {{number_format($adFee->scalarAdFee)}} ریال
{{--                                                    <hr>--}}
                                                @elseif($ad->type=='special')
                                                    <h5>هزینه:</h5><br>
                                                    {{$adFee->expireTimeOfAds}} روز<br>

                                                    {{number_format($adFee->specialAdFee)}} ریال
{{--                                                    <hr>--}}
                                                @elseif($ad->type=='emergency')
                                                    <h5>هزینه:</h5><br>
                                                    {{$adFee->expireTimeOfAds}} روز<br>

                                                    {{number_format($adFee->emergencyAdFee)}} ریال
{{--                                                    <hr>--}}
                                                @endif
                                                <div class="card-footer">
                                                <button class="btn btn-primary btn-sm"
                                                  >انتخاب</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection

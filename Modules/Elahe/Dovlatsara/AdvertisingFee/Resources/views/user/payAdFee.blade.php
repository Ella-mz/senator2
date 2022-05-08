@extends('UserMasterNew::master')
@section('title_user')پرداخت هزینه
@endsection
@section('content_userMasterNew')
    <div class="py-5">
        <main class="main-product">

            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-title">پرداخت هزینه آگهی
                            </div>
                            <div class="card-body">
                                <h5>هزینه:</h5><br>
                                @if($ad->type=='general')
                                    <p>هزینه آگهی عادی:  {{$advertisingFee->generalAdFee}}</p>
                                @elseif($ad->type=='scalar')
                                    <p>هزینه آگهی نردبانی: {{$advertisingFee->scalarAdFee}}</p>
                                @elseif($ad->type=='special')
                                    <p>هزینه آگهی ویژه: {{$advertisingFee->specialAdFee}}</p>
                                @else
                                    <p>هزینه آگهی فوری: {{$advertisingFee->emergencyAdFee}}</p>

                                @endif
                                <hr>

                                <a class="btn btn-primary btn-sm" href="">بازگشت</a>
                                <a class="btn btn-warning btn-sm" href="{{route('payAdFee.user', $ad->id)}}">پرداخت</a>
                                <div class="py-5">
                                    <p>برای اتصال به درگاه بانک</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection

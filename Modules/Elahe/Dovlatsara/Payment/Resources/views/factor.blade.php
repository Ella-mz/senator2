@extends('RealestateMaster::master')
@section('title_realestate')فاکتور
@endsection
@section('content_realestateMaster')
    <div class="py-5">
        <main class="main-product">

            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-title p-2">
                               سفارش شما با موفقیت ثبت شد
                            </div>
                            <form method="post" action="">
{{--                                @csrf--}}
{{--                                <input hidden name="ad_id" value="{{$ad->id}}">--}}

                                <div class="card-body">
                                    <span style="font-weight: bold">هزینه:</span>
                                    {{number_format(\Modules\Membership\Entities\Membership::find($array['id'])->price) }} ریال
                                    @if($array['type']=='membership')
                                    <ul class="list-group-flush">
                                        <li class="list-group-item">
                                            حق اشتراک: {{\Modules\Membership\Entities\Membership::find($array['id'])->title}}
                                        </li>
                                        <li class="list-group-item">
                                            آگهی های:
                                            @if(\Modules\Membership\Entities\Membership::find($array['id'])->package_type=='general')
                                                عادی
                                                @elseif(\Modules\Membership\Entities\Membership::find($array['id'])->package_type=='scalar')
                                            نردبانی
                                                @elseif(\Modules\Membership\Entities\Membership::find($array['id'])->package_type=='special')
                                                ویژه
                                                @elseif(\Modules\Membership\Entities\Membership::find($array['id'])->package_type=='emergency')
                                                فوری
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            تعداد آگهی : {{\Modules\Membership\Entities\Membership::find($array['id'])->number_of_allowed_ads}}
                                        </li>
                                    </ul>
                                    @endif
                                    حق اشتراک شما از تاریخ {{verta($array['startDate'])->formatJalaliDate()}} تا تاریخ {{verta($array['endDate'])->formatJalaliDate()}} معتبر است

                                    <hr>

                                    <a class="btn btn-warning" href="{{url(session('callbackUrlForOrder'))}}">انصراف</a>
                                    <button class="btn btn-primary">پرداخت</button>
                                    {{--                        <div class="py-5">--}}
                                    {{--                        <p>اینجا محلی است که به درگاه متصل می شود.</p>--}}
                                    {{--                        </div>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('js_realestate')

@endsection

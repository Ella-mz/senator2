@extends('UserMasterNew::master')
@section('title_user') آگهی های من
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/myagahi.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">
     <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/pagination-color.css')}}">


@endsection
@section('content_userMasterNew')
    <div class="my-agahi">
        <div class="container">
            <div class="my-agahi-title">
                <h1 style="color: #ddb24f;">
                    آگهی های من
                </h1>
            </div>
            <div class="row">
                @foreach($posts as $ad)
                    <div
                        class="col-xl-3 col-lg-4 col-md-6 mb-5 d-flex justify-content-center flex-column align-items-center">
                        <div class="productShowCard">
                            <div class="productShow-img">
                                @if($ad->adImages->first())
                                    <img src="{{asset($ad->adImages->first()->image)}}" alt="">
                                @else
                                    <img src="{{asset($ad_default_photo)}}" alt="">
                                @endif
                                <div class="pro-option">
                                    <ul>
                                        @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                                                && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status=='approved')
                                            <li>
                                                <img
                                                    src="{{asset(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->hologram->logo)}}"
                                                    alt="">
                                            </li>
                                        @endif

                                        @if($ad->type=='emergency')
                                            <li>
                                                <img src="{{asset($emergency_default_photo)}}" alt=""
                                                     class="option-img">
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="productShow-desc">
                                <div class="product-id">
                                    <span>کد آگهی: <span>{{$ad->uniqueCodeOfAd}}</span></span>
                                </div>
                                <div class="product-viewCount">
                                    <span style="text-align: left"><span>{{$ad->viewCount}}</span><i
                                            class="fa fa-eye"></i> </span>
                                </div>
                                <div class="product-lable my-2">
                                    @if($ad->endDate < \Carbon\Carbon::now())
                                        <span class="badge bg-primary ">منقضی شده </span>
                                    @endif
                                    @if($ad->active == 'delete')
                                        <span class="badge bg-primary ">حذف توسط کاربر</span>
                                    @elseif($ad->active=='inactive')
                                        <span class="badge bg-primary ">در انتظار تایید</span>
                                    @elseif($ad->active=='active')
                                        <span class="badge bg-primary ">تایید شده</span>
                                    @endif
                                    @if($ad->userStatus == 'inactive')
                                        <span class="badge bg-primary ">عدم نمایش در سایت</span>
                                    @endif
                                </div>
                                <a href="{{route('ad.show.supplier.user', $ad->id)}}">
                                    <div class="productShow-desc-name">
                                        <h3>
                                            {{$ad->title}}
                                        </h3>
                                        <p>{{($ad->user->hasRole('real-state-administrator'))?$ad->user->shop_title:''}}</p>
                                    </div>
                                    <div class="productShow-desc-option">
                                        <ul>
                                            <li>
                                                <div>
                                                    <img src="{{asset('files/userMaster/assets/img/placeholder.png')}}"
                                                         alt="">
                                                    <span>{{isset($ad->neighborhood_id)?$ad->neighborhood->title:$ad->city->title}}</span>
                                                </div>
                                            </li>
                                            <li>
                                                @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())

                                                    <div>
                                                        <img src="{{asset('files/userMaster/assets/img/home.png')}}"
                                                             alt="">
                                                        <span>
                                                            @if(\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad->attributes->where('isSignificant', 1)
                                    ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)
                                                    ->first())
                                                                {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad->attributes->where('isSignificant', 1)
                                                                                                    ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)
                                                                                                                    ->first()->title}}
                                                            @endif
                                                            {{--                                                            {{$ad->attributes->where('isSignificant', 1)->where('attribute_type', 'bool')->first()->title}}--}}
                                                        </span>
                                                    </div>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())

                                        <div class="productShow-desc-price">
                                            @if(isset($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))
                                                <p>{{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}} {{($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->unit)}}</p>
                                            @else
                                                {{\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value}}
                                                            @endif
                                            {{--                                            {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}

                                            {{--                                            {{($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->unit)}}--}}
                                        </div>
                                    @endif
                                </a>

                                <div class="agahi-btn">
                                    <div class="agahi-btn-icon d-flex justify-content-center mt-2">
                                        <div>
                                            <a href="{{route('ad.delete.supplier.user', $ad->id)}}" class="">
                                                <i class="fa fa-trash delete" data-bs-toggle="tooltip"
                                                   data-bs-placement="top" title="حذف"></i>
                                            </a>
                                        </div>
                                        @if(\Carbon\Carbon::now()<= $ad->endDate || $ad->isPaid == 'unpaid')

                                            <div>
                                                <a href="{{route('ad.edit.supplier.user', $ad->id)}}"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش">
                                                    <i class="fa fa-pencil "></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="agahi-btn-text d-flex justify-content-between px-2 my-2 ">
{{--                                        @if($ad->isPaid == 'unpaid')--}}
{{--                                            <div class="green-bg mx-1 ">--}}
{{--                                                <a href="{{route('adFeeList.user', $ad->id)}}" class=" ">پرداخت</a>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
                                        @if(!(isset($ad->agency_id) && $ad->request_to_agency=='approved'))
                                            @if($ad->userStatus == 'active')
                                                <div class="edit mx-1">
                                                    <a href="{{route('ad.inactive.user', $ad->id)}}"
                                                       class="">غیرفعال</a>
                                                </div>
                                            @else
                                                <div class="blue-bg mx-1">
                                                    <a href="{{route('ad.active.user', $ad->id)}}" class="">فعال</a>
                                                </div>
                                            @endif
                                        @endif


                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="justify-content-center align-content-center d-flex">
                @if($posts->count()>0)
                    {{$posts->links()}}
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js_user')
    <script src="{{asset('files/userMaster/assets/js/map.js')}}"></script>
@endsection

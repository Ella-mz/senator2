@extends('UserMasterNew::master')
@section('title_user')آگهی های {{$user->name}} {{$user->sirName}}
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/myagahi.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/homePage.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/bookmarkpage.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/pagination-color.css')}}">

@endsection
@section('content_userMasterNew')
    <div class="book-mark">
        <div class="container">
            <div class="book-mark-title">
                <div class="row">
                    <h1>
                        آگهی های @if($user->sex)خانم @else آقای @endif {{$user->name}} {{$user->sirName}}
                    </h1>
                    @if($user->hasRole('real-state-administrator'))
                        <div class="d-flex justify-content-end align-items-end">
                            <a target="_blank" href="{{route('realEstate.show.user', $user->slug)}}" class="" style="background-color: #ddb24f;
    border: 0; padding: 0.35rem; border-radius: 4px; color: white; margin: 2rem 0; font-size: 15px; min-width: 167px; min-height: 38px; display: flex; align-items: center;justify-content: center">صفحه
                                اختصاصی {{$user->shop_title}}</a>
                        </div>
{{--                    @elseif($user->hasRole('real-state-agent'))--}}
{{--                        <div class="d-flex justify-content-end align-items-end">--}}
{{--                            <a class="" style="background-color: #ddb24f;--}}
{{--    border: 0; padding: 0.35rem; border-radius: 4px; color: white; margin: 2rem 0; font-size: 15px; width: 167px; min-height: 36px; display: flex; align-items: center;justify-content: center">صفحه--}}
{{--                                اختصاصی {{$user->agency->shop_title}}</a>--}}
{{--                        </div>--}}
                    @endif
                </div>
            </div>
            <div class="row">
                @foreach($ads as $ad)
                    <div
                        class="col-xl-3 col-lg-4 col-md-6 mb-5 d-flex justify-content-center flex-column align-items-center">

                        @component('UserMasterNew::components.adCard')
                            @slot('image')
                                {{($ad->adImages->first())?$ad->adImages->first()->image:
                                                    \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}

                            @endslot
                            @slot('golden_hologram')
                                @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                                        && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status=='approved')
                                    {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->hologram->logo}}
                                @else
                                    {{''}}
                                @endif
                            @endslot
                            @slot('emergency_label')
                                {{$ad->type=='emergency'?\Modules\Setting\Entities\Setting::where('title', 'emergency_label')
                                ->first()->str_value:null}}
                            @endslot
                            @slot('real_estate')
                                {{($ad->user->hasRole('real-state-administrator'))?$ad->user->shop_title:''}}
                            @endslot
                            @slot('title')
                                {{$ad->title}}
                            @endslot
                            @slot('city')
                                {{isset($ad->neighborhood_id)?$ad->neighborhood->title:$ad->city->title}}
                            @endslot
                            @slot('ad_unique_code')
                                {{$ad->uniqueCodeOfAd}}
                            @endslot
                            @slot('first_attr')
                                @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())
                                    {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$ad->attributes->where('isSignificant', 1)
                                    ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)
                                                    ->first()->title}}
                                @else
                                    {{''}}
                                @endif
                                {{--                            @endif--}}
                            @endslot
                            @slot('second_attr')
                                @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                    @if(isset($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))
                                        {{number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}} {{($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->unit)}}
                                    @else
                                        {{\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value}}
                                    @endif
                                @endif
                            @endslot
                            @slot('id')
                                {{$ad->id}}
                            @endslot
                            @slot('second_attr_unit')
                                @if(isset($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))

                                    @if($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                        {{(\Modules\Attribute\Entities\Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}
                                    @endif
                                @else
                                    {{''}}
                                @endif
                            @endslot
                        @endcomponent
                    </div>
                @endforeach
            </div>
            <div class="justify-content-center align-content-center d-flex">
                @if($ads->count()>0)
                    {{$ads->links()}}
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js_user')
    <script src="{{asset('files/userMaster/assets/js/map.js')}}"></script>
@endsection

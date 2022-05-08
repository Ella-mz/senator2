@extends('UserMasterNew::master')
@section('title_user') بازدیدهای اخیر
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
                <h1 style="color: #ddb24f">
                    بازدیدهای اخیر
                </h1>
            </div>
            <div class="row">
                @foreach($recentseens as $bookmark)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-5 d-flex justify-content-center flex-column align-items-center">

                    @component('UserMasterNew::components.adCard')
                        @slot('image')
                            {{($bookmark->ad->adImages->first())?$bookmark->ad->adImages->first()->image:
                                                \Modules\Setting\Entities\Setting::where('title', 'ad_default_photo')->first()->str_value}}

                        @endslot
                            @slot('golden_hologram')
                                @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $bookmark->ad->id)->where('type', 'ad')->first()
                                        && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $bookmark->ad->id)->where('type', 'ad')->first()->status=='approved')
                                    {{\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $bookmark->ad->id)->where('type', 'ad')->first()->hologram->logo}}
                                @else
                                    {{''}}
                                @endif
                            @endslot
                        @slot('emergency_label')
                            {{$bookmark->ad->type=='emergency'?\Modules\Setting\Entities\Setting::where('title', 'emergency_label')
                            ->first()->str_value:null}}
                        @endslot
                        @slot('real_estate')
                            {{($bookmark->ad->user->hasRole('real-state-administrator'))?$bookmark->ad->user->shop_title:''}}
                        @endslot
                        @slot('title')
                            {{$bookmark->ad->title}}
                        @endslot
                        @slot('city')
                            {{isset($bookmark->ad->neighborhood_id)?$bookmark->ad->neighborhood->title:$bookmark->ad->city->title}}
                        @endslot
                        @slot('ad_unique_code')
                            {{$bookmark->ad->uniqueCodeOfAd}}
                        @endslot
                        @slot('first_attr')
                                @if($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first())
                                    {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$bookmark->ad->attributes->where('isSignificant', 1)
                                    ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)
                                                    ->first()->title}}
                                @else
                                    {{''}}
                                @endif
                        @endslot
                        @slot('second_attr')
                            @if($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                    @if(isset($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))
                                        {{number_format($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}} {{($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->unit)}}
                                    @else
                                        {{\Modules\Attribute\Entities\Attribute::find($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value}}
                                    @endif
{{--                                {{number_format($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)}}--}}
                            @endif
                        @endslot
                        @slot('id')
                            {{$bookmark->ad->id}}
                        @endslot
                            @slot('second_attr_unit')
                                @if(isset($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value))

                                @if($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first())
                                    {{(\Modules\Attribute\Entities\Attribute::find($bookmark->ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit)}}
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
                @if($recentseens->count()>0)
                    {{$recentseens->links()}}
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js_user')
    <script src="{{asset('files/userMaster/assets/js/map.js')}}"></script>

@endsection

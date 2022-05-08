<div class="productShowCard">
    <div class="productShow-img">
        @if(isset($image))
        <img src="{{asset($image)}}" alt="">
        @else
            <img src="{{asset('files/userMaster/assets/img/images.jpg')}}" alt="">
        @endif

        <div class="pro-option">
            <ul>
                <li>
                    @if(isset($golden_hologram))
{{--                        <img src="{{asset($golden_hologram)}}" alt="">--}}

                    @else
{{--                    <img src="{{asset('files/userMaster/assets/img/Group 20.png')}}" alt="">--}}
                        @endif
                </li>
                @if($emergency_label!='')

                <li>

                        <img src="{{asset($emergency_label)}}" alt="" class="option-img">

{{--                    <img src="{{asset('files/userMaster/assets/img/Group 21.png')}}" alt="" class="option-img">--}}

                </li>
                @endif

            </ul>
        </div>
    </div>
    <div class="productShow-desc">
        <div class="product-id">
            <span>کد آگهی: <span>{{$ad_unique_code}}</span></span>
        </div>
        <div class="productShow-desc-name">
            <h3>
                {{$title}}
            </h3>
            <p>{{$real_estate}}</p>
        </div>
        <div class="productShow-desc-option">
            <ul>
                <li>
                    <div>
                        <img src="{{asset('files/userMaster/assets/img/placeholder.png')}}" alt="">
                        <span>{{$city}}</span>

                    </div>
                </li>
                <li>
                    <div>
                        <img src="{{asset('files/userMaster/assets/img/home.png')}}" alt="">
                        <span>{{$first_attr}}</span>
{{--                        <span>خوابه</span>--}}
                    </div>
                </li>
            </ul>
            <a href="{{route('ad.show.supplier.user', $id)}}" class="mainLink"></a>
        </div>
        <div class="productShow-desc-price">
            <p>{{($second_attr)}}</p>
        </div>

    </div>
</div>

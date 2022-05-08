<div class="show-store">
    <div class="store-img">
        @if($image!='')
        <img src="{{asset($image)}}" alt="">
        @else
            <img src="{{asset('files/userMaster/assets/img/download.jpg')}}" alt="">

        @endif
    </div>
    <a href="{{route('realEstate.show.user', $id)}}">
    <div class="store-desc">
        <div class="store-desc-item">
            <div class="store-desc-item-img">
                <div class="store-logo">
                    @if($logo!='')
                        <img src="{{asset($logo)}}" alt="">
                    @else
                    <img src="{{asset('files/userMaster/assets/img/Rectangle 40.png')}}" alt="">
                    @endif
                </div>
{{--                <div class="star">--}}
{{--                    <img src="assets/img/star (1).svg" alt="">--}}
{{--                    <img src="assets/img/star.svg" alt="">--}}
{{--                    <img src="assets/img/star.svg" alt="">--}}
{{--                    <img src="assets/img/star.svg" alt="">--}}
{{--                    <img src="assets/img/star.svg" alt="">--}}

{{--                </div>--}}
            </div>
            <div class="store-desc-item-intro">
                <h3>
                    {{$title}}
                </h3>
                <p class="profile-id">
                    {{$phone}}
                </p>
                <p class="store-place">
                    {{$city}} {{$neighborhood!=''?$neighborhood:''}}
                </p>
            </div>
        </div>
    </div>
    </a>
</div>

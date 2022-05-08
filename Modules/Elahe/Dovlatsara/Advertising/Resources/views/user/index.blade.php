@extends('UserMasterNew::master')
@section('title_user')بسته های تبلیغات
@endsection
@section('css_user')

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/advertisement.css')}}">

@endsection
@section('content_userMasterNew')
    <main>
        <div class="ads-list-page">
            <div class="ads-page-top-header">
                <div class="ads-page-main-title">
                    <h2>بسته های تبلیغاتی</h2>
                </div>
            </div>
            <div class="container">
                <div class="ads-boxes-mainBox">
                    @foreach($pages as $page)
                        {{--                        @foreach($page->advertisingOrders as $order)--}}
                        <div class="row justify-content-center align-items-center">
                            <div class="mainPage-ads">
                                <div class="mainPage-adds-main-title">
                                    <span></span>
                                    <p>{{$page->fa_title}}</p>
                                </div>

                                <div class="row">
                                    @foreach($advertisings as $advertising)
                                        @if($advertising->advertisingOrder->page->title == $page->title)
                                            {{--                                                @if($advertising->advertisingOrder->page->title == $page->title)--}}
                                            <div class="col-lg-4 col-md-6 px-xl-4 px-1 mb-sm-5 mb-4">
                                                <div class="ad-box">
                                                    <div class="ad-page-title">
                                                        <p>{{$page->fa_title}}, {{$advertising->advertisingOrder->fa_title}}</p>
                                                    </div>
                                                    <div class="ad-info">
                                                        <div class="ad-main">
                                                            <div class="ad-name">
                                                                <p>{{$advertising->title}}</p>
                                                                <div class="ad-more-info">
                                                                    <p>{{$advertising->description}} </p>
                                                                </div>
                                                            </div>
                                                            <div class="ad-pic">
                                                                <img
                                                                    src="{{asset($advertising->advertisingOrder->image)}}"
                                                                    alt="">
                                                                <div class="zoom-overlay">
                                                                    <i class="fa fa-search-plus"></i>
                                                                    <a data-bs-toggle="modal"
                                                                       {{--                                                                            value="{{$advertising->id}}"--}}
                                                                       data-bs-target="#exampleModalCenter2"
                                                                       {{--                                                                            name="seeMoreModalButtonInAd"--}}
                                                                       data-adID="{{$advertising->id}}"
                                                                       id="{{$advertising->id}}"
                                                                       class="showModalImage"
                                                                       onclick="showModalImage({{$advertising->id}})"
                                                                    >
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="ad-details">
                                                            <div class="ad-price">
                                                                <p>{{number_format(substr($advertising->price, 0, -1))}} تومان</p>
                                                            </div>
                                                            <div class="seemore">
                                                                <span>مشاهده / رزرو</span>
                                                                <a href="{{route('advertisings.apply.user', $advertising->id)}}"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach


                                </div>

                            </div>
                        </div>
                        {{--                        @endforeach--}}
                    @endforeach

                </div>
            </div>

            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal modal-two fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="ad-pic zoomed" id="advertisementImage">
{{--                        <img src="./assets/img/download (1).jpg" alt="">--}}
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection
@section('js_user')
    <script src="{{asset('files/userMaster/assets/js/modal.js')}}"></script>
    <script type="text/javascript">
        // jQuery(document).ready(function () {
        function showModalImage(advertisingID) {
            // jQuery('button[class="contact123"]').on('click', function () {
            //     var adID = jQuery(this).attr('id');
            $('#advertisementImage').empty();

            jQuery.ajax({
                url: "{{route('getImage.index.user')}}",
                data: {
                    'advertisingID': advertisingID,
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    // $('#advertisementImage').empty();
                    if (data.status == true) {
                        $('#advertisementImage').append(data.content);
                        $('#exampleModalCenter2').modal({show:true});
                    }
                }
            });
        }
    </script>
@endsection

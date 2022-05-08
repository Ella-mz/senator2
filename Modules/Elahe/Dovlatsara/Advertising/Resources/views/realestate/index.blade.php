@extends('RealestateMaster::master')
@section('title_realestate')بسته های تبلیغات
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/advertisement.css')}}">
<style>

</style>
@endsection
@section('content_realestateMaster')
    <div class="row">

    @foreach($pages as $page)
            <div class="col-md-1"></div>
            <div class="col-md-10">

                <h3 class="card-title text-bold">{{$page->fa_title}}</h3><br>
                <div class="row d-flex">
                    @foreach($advertisings as $advertising)
                        @if($advertising->advertisingOrder->page->title == $page->title)
                        <div class="col-md-6 col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title text-bold">{{$advertising->title}}</h3>
                                    <div class="card-tools">
                                        <a class="btn btn-primary"
                                           href="{{route('advertisings.apply.realestate', $advertising->id)}}">رزرو</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tr>

                                            <th>مکان تبلیغ</th>
                                            <td>{{$page->fa_title}}, {{$advertising->advertisingOrder->fa_title}}</td>
                                        </tr>
                                        <tr>

                                            <th>هزینه</th>
                                            <td>{{number_format(substr($advertising->price, 0, -1))}} تومان</td>
                                        </tr>
                                        <tr>

                                            <th>تصویر مکان تبلیغ</th>

                                            <td>
                                                <div style="width: 45%; height: 160px; object-fit: contain; overflow: hidden; position: relative; border-radius: 4px">
                                                    <div class="zoom-overlay">

                                                    <i class="fa fa-search-plus"></i>
                                                    <a data-bs-toggle="modal"
                                                       data-bs-target="#exampleModalCenter2"
                                                       data-adID="{{$advertising->id}}"
                                                       id="{{$advertising->id}}"
                                                       class="showModalImage"
                                                       onclick="showModalImage({{$advertising->id}})"
                                                    >
                                                <img
                                                    src="{{asset($advertising->advertisingOrder->image)}}"
                                                    alt="">

                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <div class="modal modal-two fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="ad-pic zoomed" id="advertisementImage" style="width: 100%">
                            {{--                        <img src2="./assets/img/download (1).jpg" alt="">--}}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-1"></div>

            <br>

    @endforeach
    </div>
@endsection
@section('js_realestate')
    <script src="{{asset('files/userMaster/assets/js/modal.js')}}"></script>

    <script type="text/javascript">
        // jQuery(document).ready(function () {
        function showModalImage(advertisingID) {
            // jQuery('button[class="contact123"]').on('click', function () {
            //     var adID = jQuery(this).attr('id');
            $('#advertisementImage').empty();

            jQuery.ajax({
                url: "{{route('getImage.index.realestate')}}",
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

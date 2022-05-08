@extends('UserMasterNew::master')
@section('title_user')بسته های تبلیغات
@endsection
@section('css_user')

    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/advertisement.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/reserve-ad.css')}}">
    <style>
        .document-gallery {
            width: 100%;
            border: 1px solid #EEE;
            padding: 2%;
        }

        .document-placeholder {
            width: 48%;
            margin: 1%;
            float: left;
        }

        .document-placeholder img {
            border: 1px solid #EEEEEE;
            width: 100%;
            padding: 1%;
            min-height: 300px;
            max-height: 600px;
        }

        .document-gallery-images {
            width: 48%;
            margin: 1%;
            float: left;
        }

        .document-image img {
            width: 31.333%;
            min-height: 125px;
            float: left;
            margin: 1%;
            cursor: pointer;
        }

        .imagePreview {
            width: 100%;
            height: 180px;
            background-position: center center;
            background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
            background-color: #fff;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
        }

        .btn-upImg {
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;
        }

        .btn-success {
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;

        }

        .imgUp {
            margin-bottom: 15px;
            position: relative;
        }

        @media (max-width: 768px) {
            .link-input {
                width: 280px !important;
            }

        }

        @media (max-width: 360px) {
            .link-input {
                width: 250px !important;
            }

        }
    </style>

@endsection
@section('content_userMasterNew')
    <main>
        <div class="ads-list-page">
            <div class="ads-page-top-header">
                <div class="ads-page-main-title">
                    <h2>انتخاب نهایی بسته تبلیغاتی</h2>
                </div>
            </div>
            <div class="container">
                <div class="ads-boxes-mainBox">
                    <div class="final-ad-package-form">
                        <form action="{{route('advertisings.apply.submit.user')}}" method="post"
                              id="advertisementSubmit"
                              enctype="multipart/form-data">
                            @csrf
                            <input name="cat" value="{{$advertising->advertisingOrder->page->hasCategory}}" hidden>
                            <input hidden name="advertising_id" value="{{$advertising->id}}">

                            <div class="package-head">
                                <div class="package-title">
                                    <p class="form-title">عنوان بسته:</p>
                                    <h4>{{$advertising->title}}</h4>
                                </div>
                                @if($advertising->advertisingOrder->page->hasCategory)
                                    <div class="category-select">

                                        <select class="form-select" aria-label="Default select example" name="category">
                                            <option selected value="">دسته بندی</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                        @if($category->id==old('category')) selected @endif>{{$category->createStringAsParents()}}</option>

                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('category') }}</small>

                                    </div>
                                @endif
                                @if($advertising->advertisingOrder->page->hasUser)
                                    <div class="category-select">

                                        <select class="form-select" aria-label="Default select example" name="user">
                                            <option selected value="">کسب و کار ها</option>
                                            @foreach($agencies as $user)
                                                <option value="{{$user->id}}"
                                                        @if($user->id==old('user')) selected @endif>{{$user->shop_title}}
                                                    - {{$user->slug}}</option>

                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('user') }}</small>

                                    </div>
                                @endif
                            </div>
                            <div class="package-monthes">
                                <div class="col-12 my-sm-4 my-3">
                                    <div class="boldInputLabel text-center mb-3">
                                        <p class="form-title">ماه مورد نظر برای تبلیغ:</p>
                                    </div>
                                    <div class="month-selection text-center" id="listOfMonth">

                                        {!! $content !!}
                                    </div>

                                </div>
                                <small class="text-danger">{{ $errors->first('date') }}</small>

                            </div>
                            <div class="package-date my-4">
                                <div class="start-date">
                                    <p class="form-title">از تاریخ:</p>
                                    <span id="fromDate"></span>
                                </div>
                                <div class="finish-date">
                                    <p class="form-title">تا تاریخ :</p>
                                    <span id="toDate"></span>
                                </div>
                            </div>

                            {{--                            <input type="file" name="image" hidden>--}}
                            {{--                            <div class="ad-upload-inputs my-sm-4 my-3">--}}


                            {{--                                <div class="pic-upload">--}}

                            {{--                                    <button class="file-upload-btn" type="button"--}}
                            {{--                                            onclick="$('.file-upload-input').trigger( 'click' )">آپلود عکس</button>--}}

                            {{--                                    <div class="image-upload-wrap">--}}
                            {{--                                        <input class="file-upload-input" name="image" id="image2" type='file' onchange="readURL(this);"--}}
                            {{--                                               accept="image/*" />--}}
                            {{--                                        <div class="drag-text px-2">--}}
                            {{--                                            <h5>می‌توانید عکس مورد نظر را بکشید و در این قسمت رها کنید.</h5>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="file-upload-content">--}}
                            {{--                                        <img class="file-upload-image" src="#" alt="your image" />--}}
                            {{--                                        <div class="image-title-wrap">--}}
                            {{--                                            <button type="button" onclick="removeUpload()" class="remove-image">حذف--}}
                            {{--                                                <span class="image-title">آپلود عکس</span></button>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <small class="text-danger">{{ $errors->first('image') }}</small>--}}

                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="row p-5 d-flex" id="numberOfImages">
                                <div class="col-md-6 imgUp">
                                    <div class="imagePreview" style="height: 300px"></div>
                                    <label class="btn btn-upImg"
                                           style="color: #4a1f61; background: #2a2929">
                                        بارگزاری تصویر
                                        @if($advertising->advertisingOrder->page->title=='homePage' && $advertising->advertisingOrder->location=='top1')
                                            سایز(85*309)
                                        @elseif($advertising->advertisingOrder->page->title=='homePage' && $advertising->advertisingOrder->location=='middle1')
                                            سایز(150*309)

                                        @elseif($advertising->advertisingOrder->page->title=='homePage' && $advertising->advertisingOrder->location=='middle-left')
                                            سایز(300*309)
                                        @elseif($advertising->advertisingOrder->page->title=='homePage' && $advertising->advertisingOrder->location=='middle-right')
                                            سایز(300*309)

                                        @elseif($advertising->advertisingOrder->page->title=='FilterPage' && $advertising->advertisingOrder->location=='R1')
                                            سایز(85*309)
                                        @elseif($advertising->advertisingOrder->page->title=='FilterPage' && $advertising->advertisingOrder->location=='R2')
                                            سایز(150*309)

                                        @elseif($advertising->advertisingOrder->page->title=='FilterPage' && $advertising->advertisingOrder->location=='R3')
                                            سایز(300*309)
                                        @elseif($advertising->advertisingOrder->page->title=='RealestatePage' && $advertising->advertisingOrder->location=='R1')
                                            سایز(175*639)

                                        @elseif($advertising->advertisingOrder->page->title=='RealestatePage' && $advertising->advertisingOrder->location=='L1')
                                            سایز(175*639)
                                        @elseif($advertising->advertisingOrder->page->title=='AgencyPageDetail' && $advertising->advertisingOrder->location=='R1')
                                            سایز(150*309)
                                        @elseif($advertising->advertisingOrder->page->title=='AgencyPageDetail' && $advertising->advertisingOrder->location=='R2')
                                            سایز(150*309)
                                        @elseif($advertising->advertisingOrder->page->title=='AgencyPageDetail' && $advertising->advertisingOrder->location=='R3')
                                            سایز(150*309)
                                        @elseif($advertising->advertisingOrder->page->title=='AgencyPageDetail' && $advertising->advertisingOrder->location=='R4')
                                            سایز(400*309)
                                        @elseif($advertising->advertisingOrder->page->title=='AdDetailPage' && $advertising->advertisingOrder->location=='R1')
                                            سایز(150*372)
                                        @elseif($advertising->advertisingOrder->page->title=='ApplicationFormRequest' && $advertising->advertisingOrder->location=='R1')
                                            سایز(150*1300)
                                        @endif
                                        <input name="image" type="file"
                                               class="uploadFile img"
                                               value="Upload Photo"
                                               style="width: 0px;height: 35px;overflow: hidden;">
                                    </label>
                                    <small class="text-danger mt-5">{{ $errors->first('image') }}</small>
                                </div>
                                @if($advertising->advertisingOrder->page->title!='AdDetailPage' || $advertising->advertisingOrder->page->title!='ApplicationFormRequest')
                                    <div class="col-md-6 imgUp">
                                        <div class="imagePreview" style="height: 300px"></div>
                                        <label class="btn btn-upImg"
                                               style="color: #4a1f61; background: #2a2929">
                                            بارگزاری تصویر ریسپانسیو سایز(301*150)<input name="responsiveImage"
                                                                                         type="file"
                                                                                         class="uploadFile img"
                                                                                         value="Upload Photo"
                                                                                         style="width: 0px;height: 35px;overflow: hidden;">
                                        </label>
                                        <small class="text-danger mt-5">{{ $errors->first('responsiveImage') }}</small>

                                    </div>
                                @endif

                            </div>
                            <div class="package-date my-4" style="justify-content: center">
                                <div>
                                    <label style="display: block; font-size: large;color: #4a1f61">لینک به</label>
                                    <input class="link-input" name="link" value="{{old('link')}}"
                                           style="border: dotted; color: #4a1f61;width: 500px;height: 45px">
                                </div>
                            </div>
                            <div class="package-form-submit">
                                <button>ثبت و پرداخت</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <!-- Button trigger modal -->
        </div>

    </main>
@endsection
@section('js_user')
    <script>
        jQuery(document).ready(function ($) {
            $('.document-image img').click(function (event) {
                // detect data-id for later
                var id = $(this).data('id');
                // grab src2 to replace #featured
                var src = $(this).attr('src');
                // set featured image
                var img = $('#featured img');

                img.fadeOut('fast', function () {
                    $(this).attr({src: src,});
                    $(this).fadeIn('fast');
                });
            });
            // let numberOfImages = $('#numberOfImages');
            // $(".imgAdd").click(function () {
            //     let fileCount = numberOfImages.children().length;
            //     if (fileCount > 5) {
            //         alert('تعداد فایل ها بیش از حد مجاز است')
            //     } else {
            //         $(this).closest(".row").find('.imgAdd').before('<div class="col-md-4 imgUp"><div class="imagePreview"></div>' +
            //             '<label class="btn btn-upImg" style="color: #fff; background: #2a2929">انتخاب<input name="adImage[]" type="file" class="uploadFile img"' +
            //             ' value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del p-2"></i></div>');
            //     }
            // });
            // $(document).on("click", "i.del", function () {
            //     $(this).parent().remove();
            //     let fileCount = numberOfImages.children().length;
            // });
            $(function () {
                $(document).on("change", ".uploadFile", function () {
                    var uploadFile = $(this);
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                    if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file
                        reader.onloadend = function () { // set image data as background of div
                            uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                        }
                    }
                    {{--$(this).closest(".row").find('.imgAdd').prepend('<i class="videoAdd" style="display: contents"></i>');--}}
                    {{--var reader = new FileReader(); // instance of the FileReader--}}
                    {{--reader.readAsDataURL(files[0]); // read the local file--}}
                    {{--reader.onloadend = function () { // set image data as background of div--}}
                    {{--    uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url({{asset('download.jpg')}})");--}}
                    {{--}--}}
                });
            });
        });

    </script>

    <script>
        function dateFunc(val) {

            $('#fromDate').empty();
            $('#toDate').empty();

            jQuery.ajax({
                url: "{{route('setFormatDate.index.user')}}",
                data: {
                    'date': val,
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#fromDate').append(data.from);
                        $('#toDate').append(data.to);
                    }
                }
            });
        }
    </script>
    <script src="{{asset('files/userMaster/assets/js/modal.js')}}"></script>
    <script type="text/javascript">
        function showModalImage(advertisingID) {
            $('#advertisementImage').empty();

            jQuery.ajax({
                url: "{{route('getImage.index.user')}}",
                data: {
                    'advertisingID': advertisingID,
                },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#advertisementImage').append(data.content);
                        $('#exampleModalCenter2').modal({show: true});
                    }
                }
            });
        }
    </script>
    <script src="{{asset('files/userMaster/assets/js/image-input.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="category"]').on('change', function () {
                var categoryId = jQuery(this).val();
                if (categoryId) {
                    jQuery.ajax({
                        url: "{{route('getDates.index.user')}}",
                        data: {
                            'categoryId': categoryId,
                            'advertisingId': '{{$advertising->id}}'
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#listOfMonth').empty();
                            $('#listOfMonth').append(data.content);
                        }
                    });
                } else {
                    $('#listOfMonth').empty();
                }
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="user"]').on('change', function () {
                var userId = jQuery(this).val();
                if (userId) {
                    jQuery.ajax({
                        url: "{{route('getDates.user.index.user')}}",
                        data: {
                            'userId': userId,
                            'advertisingId': '{{$advertising->id}}'
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#listOfMonth').empty();
                            $('#listOfMonth').append(data.content);
                        }
                    });
                } else {
                    $('#listOfMonth').empty();
                }
            });
        });
    </script>

@endsection

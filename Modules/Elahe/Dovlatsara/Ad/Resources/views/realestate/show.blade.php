@extends('RealestateMaster::master')
@section('title_realestate')آگهی
@endsection
@section('card_title')
@endsection
@section('css')
{{--    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">--}}
{{--    <link rel="stylesheet" href="{{asset('files/map/dist/css/mapp.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('files/map/dist/css/fa/style.css')}}">--}}
{{--    <style>--}}
{{--        #app {--}}
{{--            width: 100%;--}}
{{--            height: 280px;--}}
{{--        }--}}
{{--    </style>--}}
    {{--    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/singleagahi.css')}}">--}}

    <style>
        .agahi-image-slider {
            position: relative;
        }

        .mySlides {
            display: none;
            height: 400px;
            overflow: hidden;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .mySlides img {
            height: 100%;
        }

        .mySlides video {
            height: 100%;
            width: 100%;
        }

        /* Add a pointer when hovering over the thumbnail images */
        .cursor {
            cursor: pointer;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            left: 0;
            border-radius: 3px 0 0 3px;
        }

        .next:hover {
            color: #fff;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: #adadeb;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* Container for image text */
        .caption-container {
            display: none;
        }

        .row.slider-images {
            --bs-gutter-x: 0.1rem;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Six columns side by side */
        .column {
            float: left;
            width: 16.66%;
            height: 70px;
            object-fit: cover;
            overflow: hidden;
        }

        .column img {
            height: 100%;
        }

        .column video {
            height: 100%;
        }

        /* Add a transparency effect for thumnbail images */
        .demo {
            opacity: 0.6;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .show-single-agahi .show-single-top .mySlides {
                height: 300px;
            }

            .show-single-agahi .show-single-top .column {
                height: 55px;
            }
        }

        @media (max-width: 468px) {
            .show-single-agahi .show-single-top .mySlides {
                height: 230px;
            }

            .show-single-agahi .show-single-top .column {
                height: 45px;
            }
        }

        @media (max-width: 390px) {
            .show-single-agahi .show-single-top .mySlides {
                height: 200px;
            }

            .show-single-agahi .show-single-top .column {
                height: 40px;
            }
        }

    </style>
@include('Maps::layouts.neshan-css')

@endsection
@section('content_realestateMaster')
    <section class="content">
        <h3 class="text-bold">{{$ad->category->createStringAsParents2($ad->category->path)}}</h3><br>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                @if(($ad->isPaid == 'unpaid') && ($ad->user_id == auth()->id()))
                                    <a href="{{route('adFeeList.realestate', $ad->id)}}"
                                       type="button" class="btn btn-primary btn-sm">پرداخت</a>
                                @endif
                            </div>
                            <div class="col-md-6 text-left"><a type="button" class="btn btn-info btn-sm"
                                                               href="{{route('ad.index.supplier.realestate', auth()->id() )}}"><i
                                        class="fa fa-arrow-left text-white"></i></a></div>
                        </div>

                    </div>
                    <div class="row justify-content-center align-content-center">
                        @if((\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                                                                                          && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status=='approved') || ($ad->type=='emergency'))
                            <div class="col-md-2">
                                @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                                                                                              && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status=='approved')
                                    <img
                                        src="{{asset(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->hologram->logo)}}"
                                        style="width:50px; height:40px; margin-top: 40px">
                                @endif
                                @if($ad->type=='emergency')
                                    <img
                                        src="{{asset(\Modules\Setting\Entities\Setting::where('title', 'emergency_label')
                                                    ->first()->str_value)}}"
                                        style="width:50px; height:40px; margin-top: 40px">
                                @endif
                            </div>
                        @endif
                        <div class="col-md-8">
                            @if(($ad->adImages()->count()>0) || ($ad->adVideos()->count()>0))
                                <div class="agahi-image-slider">
                                    <!-- Full-width images with number text -->
                                    @if(($ad->adImages()->count()>0))

                                        @foreach($ad->adImages as $key=>$adImage)
                                            <div class="mySlides">

                                                <img src="{{asset($adImage->image)}}" style="width:100%">
                                            </div>
                                        @endforeach
                                    @endif

                                    @if(($ad->adVideos()->count()>0))
                                        @foreach($ad->adVideos as $key=>$adVideo)

                                            <div class="mySlides">

                                                <video width="320" height="240" controls>
                                                    <source src="{{asset($adVideo->video)}}">
                                                    {{--                                                <source src="movie.ogg" type="video/ogg">--}}
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                    @endforeach
                                @endif
                                <!-- Next and previous buttons -->
                                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                    <!-- Image text -->
                                    <div class="caption-container">
                                        <p id="caption"></p>
                                    </div>

                                    <!-- Thumbnail images -->
                                    <div class="row slider-images" style="margin-right:0px">
                                        @foreach($ad->adImages as $key=>$adImage)
                                            <div class="column" onclick="currentSlide({{$key+1}})">
                                                <img class="demo cursor" src="{{asset($adImage->image)}}"
                                                     style="width:100%"
                                                >
                                            </div>
                                        @endforeach
                                        @foreach($ad->adVideos as $key=>$adVideo)
                                            <div class="column" onclick="currentSlide({{$ad->adImages()->count()+1}})">
                                                <img class="demo cursor"
                                                     src="{{asset('files/userMaster/assets/img/video-back-ground.png')}}"
                                                     style="width:100%"
                                                >
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                {{--                                <div id="carousel1" class="carousel slide" data-ride="carousel">--}}
                                {{--                                    <ol class="carousel-indicators">--}}
                                {{--                                        @foreach($ad->adImages as $adImage)--}}
                                {{--                                            <li data-target="#carousel1"></li>--}}
                                {{--                                        @endforeach--}}
                                {{--                                        @if(($ad->adVideos()->count()>0))--}}
                                {{--                                            @foreach($ad->adVideos as $key=>$adVideo)--}}
                                {{--                                                <li data-target="#carousel1"></li>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        @endif--}}
                                {{--                                    </ol>--}}
                                {{--                                    <div class="carousel-inner">--}}
                                {{--                                        @foreach($ad->adImages as $adImage)--}}
                                {{--                                            <div class="carousel-item {{$loop->first?'active':''}}">--}}
                                {{--                                                <img class="d-block" style="width: 600px; height: 400px"--}}
                                {{--                                                     src="{{asset($adImage->image)}}">--}}
                                {{--                                            </div>--}}
                                {{--                                        @endforeach--}}
                                {{--                                        @if(($ad->adVideos()->count()>0))--}}
                                {{--                                            @foreach($ad->adVideos as $key=>$adVideo)--}}
                                {{--                                                <div class="carousel-item">--}}
                                {{--                                                    <video style="width: 600px; height: 400px">--}}
                                {{--                                                        <source src="{{asset($adVideo->video)}}" type="video/mp4"/>--}}
                                {{--                                                        Your browser does not support the video tag.--}}
                                {{--                                                    </video>--}}
                                {{--                                                </div>--}}
                                {{--                                                --}}{{--                                                <div class="mySlides">--}}

                                {{--                                                --}}{{--                                                    <video width="320" height="240" controls>--}}
                                {{--                                                --}}{{--                                                        <source src="{{asset($adVideo->video)}}" type="video/mp4">--}}
                                {{--                                                --}}{{--                                                        --}}{{----}}{{--                                                <source src="movie.ogg" type="video/ogg">--}}
                                {{--                                                --}}{{--                                                        Your browser does not support the video tag.--}}
                                {{--                                                --}}{{--                                                    </video>--}}
                                {{--                                                --}}{{--                                                </div>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        @endif--}}
                                {{--                                    </div>--}}
                                {{--                                    <a class="carousel-control-prev" href="#carousel1"--}}
                                {{--                                       role="button" data-slide="prev">--}}
                                {{--                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
                                {{--                                        --}}{{--                                <span class="sr-only">قبلی</span>--}}
                                {{--                                    </a>--}}
                                {{--                                    <a class="carousel-control-next" href="#carousel1"--}}
                                {{--                                       role="button" data-slide="next">--}}
                                {{--                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
                                {{--                                        --}}{{--                                <span class="sr-only">بعدی</span>--}}
                                {{--                                    </a>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="mt-2">--}}
                                {{--                                    <div class="row">--}}
                                {{--                                        @foreach($ad->adImages as $adImage)--}}
                                {{--                                            <img style="width: 60px; height: 60px"--}}
                                {{--                                                 src="{{asset($adImage->image)}}" class="mr-1 rounded">--}}
                                {{--                                            <i class="fa fa-trash nav-icon btn-outline-dark btn-sm"--}}
                                {{--                                               onclick="deleteimageOfAd({{$adImage->id}})"--}}
                                {{--                                               id="imagedelete" style="cursor: pointer"></i>--}}
                                {{--                                        @endforeach--}}
                                {{--                                        @if(($ad->adVideos()->count()>0))--}}
                                {{--                                            @foreach($ad->adVideos as $key=>$adVideo)--}}
                                {{--                                                <img style="width: 60px; height: 60px"--}}
                                {{--                                                     src="{{asset('files/userMaster/assets/img/video-back-ground.png')}}"--}}
                                {{--                                                     class="mr-1 rounded">--}}
                                {{--                                                <i class="fa fa-trash nav-icon btn-outline-dark btn-sm"--}}
                                {{--                                                   onclick="deleteimageOfAd({{$adVideo->id}})"--}}
                                {{--                                                   id="imagedelete" style="cursor: pointer"></i>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        @endif--}}

                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <hr>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        {{--                        <div clas/s="row">--}}
                        <div class="col-md-1"></div>
                        <div class="col-md-10 py-5">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <div class="row p-4">
                                        <div class="col-md-2">
                                            @if($ad->type=='general')
                                                <span class="badge customBlue">عادی</span>
                                            @elseif($ad->type=='scalar')
                                                <span class="badge customBlue">نردبانی</span>

                                            @elseif($ad->type=='special')
                                                <span class="badge customBlue">ویژه</span>

                                            @elseif($ad->type=='emergency')
                                                <span class="badge customBlue">فوری</span>

                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            @if($ad->active=='active')
                                                <span class="badge badge-success">فعال</span>
                                            @elseif($ad->active=='inactive')
                                                <span class="badge badge-secondary">غیرفعال</span>

                                            @elseif($ad->active=='delete')
                                                <span class="badge badge-danger">حذف توسط کاربر</span>
                                            @elseif($ad->active=='notApproved')
                                                <span class="badge badge-danger">عدم تایید</span>

                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            @if($ad->userStatus=='inactive')

                                                <span class="badge badge-danger">غیرفعال توسط کاربر</span>
                                            @elseif($ad->userStatus=='active')
                                                <span class="badge customBlue">نمایش در تمامی صفحات</span>

                                            @elseif($ad->userStatus=='onlyEstatePanel')
                                                <span class="badge customBlue">فقط نمایش در صفحه مشاور کسب و کار</span>
                                            @endif

                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>
                                                آگهی دهنده
                                            </th>
                                            <td>
                                                {{$ad->user->name}} {{$ad->user->sirName}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                عنوان آگهی
                                            </th>
                                            <td>
                                                {{$ad->title}}
                                            </td>
                                        </tr>
                                        <tr>

                                            <th>کد آگهی</th>
                                            <td>{{$ad->uniqueCodeOfAd}}</td>
                                        </tr>
                                        <tr>

                                            <th>شماره تماس آگهی</th>
                                            <td>{{$ad->mobile}}</td>
                                        </tr>
                                        <tr>

                                            <th>شهر و محله</th>
                                            <td>{{$ad->city->title}} @if(isset($ad->neighborhood_id))
                                                    , {{$ad->neighborhood->title}} @endif</td>
                                        </tr>

                                        <tr>

                                            <th>تاریخ ثبت</th>
                                            <td>{{verta($ad->startDate)->formatJalaliDate()}}</td>
                                        </tr>
                                        <tr>

                                            <th>تاریخ اتمام</th>
                                            <td>{{verta($ad->endDate)->formatJalaliDate()}}</td>
                                        </tr>
                                        @if($ad->user->hasRole('real-state-administrator'))

                                            <tr>

                                                <th>ثبت شده توسط</th>
                                                <td>
                                                    @if($ad->user->hasRole('real-state-administrator'))
                                                        مدیر کسب و کار
                                                    @elseif($ad->user->hasRole('real-state-agent'))
                                                        کارشناس وابسته
                                                    @elseif($ad->user->hasRole('admin'))
                                                        ادمین سایت
                                                    @elseif($ad->user->hasRole('independent-agent'))
                                                        کارشناس مستقل

                                                    @elseif($ad->user->hasRole('ordinary-user'))
                                                        کاربران سایت
                                                    @endif
                                                </td>

                                            </tr>
                                        @endif
                                        <tr>

                                            <th>آدرس</th>
                                            <td>{{$ad->address}}</td>

                                        </tr>
                                        <tr>

                                            <th>وضعیت پرداخت</th>
                                            <td>
                                                @if($ad->isPaid=='paid')
                                                    پرداخت شده
                                                @elseif($ad->isPaid=='unpaid')
                                                    پرداخت نشده

                                                @endif
                                            </td>

                                        </tr>
                                        <tr>

                                            <th>نوع پرداخت</th>
                                            <td>
                                                @if($ad->paymentType=='free')
                                                    آگهی رایگان است
                                                @elseif($ad->paymentType=='membership')
                                                    پرداخت با حق اشتراک کاربر
                                                @elseif($ad->paymentType=='adFee')
                                                    پرداخت هزینه آگهی
                                                @endif
                                            </td>

                                        </tr>
                                        @if($ad->adCatalogs->first())
                                            <tr>

                                                <th>کاتالوگ</th>
                                                <td>
                                                    <a href="{{route('catalog.download.panel', $ad->adCatalogs->first()->id)}}">{{$ad->adCatalogs->first()->description}}</a>
                                                </td>

                                            </tr>
                                        @endif
                                        @can('RequestToAgencyStatusInPanel')

                                            <tr>
                                                <th>
                                                    وضعیت درخواست به کسب و کار
                                                </th>
                                                <td>
                                                    @if($ad->request_to_agency=='noRequest')
                                                        درخواستی نفرستاده اید
                                                    @elseif($ad->request_to_agency=='pending')
                                                        در انتظار تایید مدیر کسب و کار @if($ad->isPaid=='unpaid') <span
                                                            class="badge badge-danger">درصورتی که هزینه آگهی را پرداخت نکرده باشید، آگهی شما به مدیر کسب و کار نمایش داده نمی شود.</span> @endif
                                                    @elseif($ad->request_to_agency=='approved')
                                                        تایید شده توسط کسب و کار
                                                    @elseif($ad->request_to_agency=='disapproved')
                                                        عدم تایید توسط کسب و کار
                                                    @endif
                                                </td>
                                            </tr>
                                        @endcan

                                    </table>
                                    @if(isset($ad->description))
                                        <hr>

                                        <div class="row p-4">
                                            <div class="callout callout-costumBlue" style="width: 100%">
                                                <h5>توضیحات</h5>

                                                <p>{{$ad->description}} </p>
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        @if($ad->attributes->count()>0)

                            <div class="col-md-1"></div>

                            <div class="col-md-1"></div>
                            <div class="col-md-10 py-5">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <div class="row p-4">
                                            @foreach($ad->attributes->where('attribute_type', 'bool') as $attribute)
                                                <div class="col-md-2">
                                                    <span class="badge customBlue">{{$attribute->title}}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <table class="table table-hover">
                                            @foreach($ad->attributes as $attribute)
                                                <tr>
                                                    @if($attribute->attribute_type=='int')
                                                        <th>{{$attribute->title}}</th>

                                                        <td>
                                                            @if(isset($attribute->pivot->value))
                                                                {{number_format($attribute->pivot->value)}} {{($attribute->unit)}}
                                                            @else
                                                                {{$attribute->alt_value}}
                                                            @endif
                                                            {{--                                                        {{number_format($attribute->pivot->value)}} {{($attribute->unit)}}--}}
                                                        </td>

                                                    @elseif($attribute->attribute_type=='string')
                                                        <th>{{$attribute->title}}</th>

                                                        <td>{{$attribute->pivot->value}} {{($attribute->unit)}}</td>

                                                    @elseif($attribute->attribute_type=='select')
                                                        <th>{{$attribute->title}}</th>

                                                        <td>
                                                            {{\Modules\AttributeItem\Entities\AttributeItem::where('id',$attribute->pivot->attribute_item_id)
                                                                ->first()->title}} {{($attribute->unit)}}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            {{--                        <tr>--}}

                                            {{--                            <th>فعال/غیرفعال</th>--}}
                                            {{--                            <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>--}}

                                            {{--                        </tr>--}}
                                        </table>
                                        <hr>
                                        <div class="row p-4">
                                            @foreach($ad->attributes->where('attribute_type', 'description') as $attribute)
                                                <div class="callout callout-costumBlue" style="width: 100%">
                                                    <h5>{{$attribute->title}}</h5>

                                                    <p>{{$attribute->pivot->value}} </p>
                                                </div>

                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(isset($latitude) && isset($longitude))

                            <div class="col-md-1"></div>
                            <div class="col-md-1"></div>
                            <div class="col-md-10 py-5">
                                <div class="card">
                                    <div class="card-body table-responsive">
{{--                                        <div class="row p-4">--}}
                                        <div  id="myMap"  class="my-3" style=" height: 350px; background: #eee; border: 2px solid #aaa;z-index: 90"></div>

{{--                                            <div id="app"></div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
@section('js_realestate')
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>

{{--    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/jquery-3.2.1.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>--}}
{{--    <script type="text/javascript" src="{{asset('files/map/dist/js/mapp..env.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('files/map/dist/js/mapp.min.js')}}"></script>--}}
{{--    @if(isset($latt) && isset($lngg))--}}
{{--        <script>--}}
{{--            --}}{{--var l = {{$ad->latitude}}--}}
{{--            --}}{{--alert(l)--}}
{{--            $(document).ready(function () {--}}
{{--                var latt =--}}
{{--                    {{$latt}}--}}
{{--                        var--}}
{{--                lngg =--}}
{{--                    {{$lngg}}--}}
{{--                        var--}}
{{--                app = new Mapp({--}}
{{--                    element: "#app",--}}
{{--                    presets: {--}}
{{--                        latlng: {--}}
{{--                            lat: latt,--}}
{{--                            lng: lngg--}}
{{--                        },--}}
{{--                        zoom: 13--}}
{{--                    },--}}
{{--                    apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIn0.eyJhdWQiOiIxNDAyMSIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIiwiaWF0IjoxNjIxMjMzMDE1LCJuYmYiOjE2MjEyMzMwMTUsImV4cCI6MTYyMzgyNTAxNSwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.g-oaFkPxTsmJka5HczgcUvJMmuM6HKdrJgEaVyHWzNXu3UmkOjWch_d8nf0OIOQqKSG6I-KpjMYVEfj1KRH9iI4x9HYilH9qSq8epsUElbWuS6OLTCS3i_a-CCgelms3qFvbnik7tkfw_7f41zCZRxO-8w1h-41QkOMVtXLalZF-R7khLb5PShh75lo60Iezy9eEpoIZduQe2GlF_yjHMI8oLC9ZSLeH03Qw5UvjycPyEpYhwBUiqK9THv4mAnsKt89EjwENDcaWxxFS1uymGfbi2tdpE1tiT0QgUkVsFHvwivBCDRIf3eLIVXmY2ryi7LlKNmDfScWqCN11u_ZRMA'--}}
{{--                });--}}

{{--                app.addVectorLayers();--}}

{{--                var crosshairIcon = L.icon({--}}
{{--                    iconUrl: '{{asset('files/map/dist/assets/images/marker-icon.png')}}',--}}
{{--                    iconSize: [20, 20],--}}
{{--                    iconAnchor: [10, 10],--}}
{{--                });--}}
{{--                var crosshairMarker = new--}}
{{--                L.marker(app.map.getCenter(), {--}}
{{--                    icon: crosshairIcon,--}}
{{--                    clickable: false--}}
{{--                });--}}
{{--                crosshairMarker.addTo(app.map);--}}

{{--                app.map.on('move', function (e) {--}}
{{--                    crosshairMarker.setLatLng(app.map.getCenter());--}}
{{--                });--}}
{{--                crosshairMarker.on('click', function (event) {--}}
{{--                    console.log(event.latlng)--}}
{{--                })--}}
{{--            })--}}
{{--        </script>--}}
{{--        --}}{{--        <script>--}}
{{--        --}}{{--            var long = {{$ad->longitude}};--}}
{{--        --}}{{--            var lat = {{$ad->latitude}};--}}
{{--        --}}{{--            var mymap = L.map('mapid').setView([long, lat], 13);--}}


{{--        --}}{{--            var accessToken = 'pk.eyJ1IjoibWlsYWRjbGljayIsImEiOiJja3JtNmRmYjYwOHQ1Mm5ycTBoOTFraW9tIn0.j47CLuc5OhKzSgL8RsolsA';--}}

{{--        --}}{{--            // create Official Account in mapbox and get accessToken--}}
{{--        --}}{{--            // mapbox فقط یک انتخاب هست و میتوانیم از سرویس هایی دیگر نیز استفاده کنیم--}}
{{--        --}}{{--            // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {--}}
{{--        --}}{{--            //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',--}}
{{--        --}}{{--            //     maxZoom: 18,--}}
{{--        --}}{{--            //     id: 'mapbox/streets-v11',--}}
{{--        --}}{{--            //     tileSize: 512,--}}
{{--        --}}{{--            //     zoomOffset: -1,--}}
{{--        --}}{{--            //     accessToken: accessToken--}}
{{--        --}}{{--            // }).addTo(mymap);--}}
{{--        --}}{{--            var theMarker = {};--}}
{{--        --}}{{--            theMarker = L.marker([long, lat]).addTo(mymap)--}}

{{--        --}}{{--        </script>--}}
{{--        --}}{{--    <script>--}}
{{--        --}}{{--        --}}
{{--        --}}{{--        var long = {{$ad->longitude}};--}}
{{--        --}}{{--        var lat = {{$ad->latitude}};--}}
{{--        --}}{{--        var mymap = L.map('mapid').setView([long, lat], 13);--}}


{{--        --}}{{--        var accessToken = 'pk.eyJ1IjoibWlsYWRjbGljayIsImEiOiJja3JtNmRmYjYwOHQ1Mm5ycTBoOTFraW9tIn0.j47CLuc5OhKzSgL8RsolsA';--}}

{{--        --}}{{--        // create Official Account in mapbox and get accessToken--}}
{{--        --}}{{--        // mapbox فقط یک انتخاب هست و میتوانیم از سرویس هایی دیگر نیز استفاده کنیم--}}
{{--        --}}{{--        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {--}}
{{--        --}}{{--            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',--}}
{{--        --}}{{--            maxZoom: 18,--}}
{{--        --}}{{--            id: 'mapbox/streets-v11',--}}
{{--        --}}{{--            tileSize: 512,--}}
{{--        --}}{{--            zoomOffset: -1,--}}
{{--        --}}{{--            accessToken: accessToken--}}
{{--        --}}{{--        }).addTo(mymap);--}}

{{--        --}}{{--    </script>--}}
{{--    @endif--}}
    @include('RealestateMaster::layouts.delete_file')
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>
    @include('Maps::layouts.neshan-js')

@endsection

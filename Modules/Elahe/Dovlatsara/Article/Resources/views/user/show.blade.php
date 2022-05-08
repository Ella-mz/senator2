@extends('UserMasterNew::master')
@section('title_user')مقاله {{$article->title}}
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/singleArticlepage.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/articleShow.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/src/css/dolatsara.css')}}"/>


    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
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
            background-color: #8d7af19c;
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

@endsection

@section('content_userMasterNew')
    <main>
        <section class="show-article">

{{--            <div class="fraworkBg">--}}
                <div class="bg-color">
                    <div class="container">

                        <div class="row">
                            <div class="col-12">
                                <div class="container-shadow">
                                    <div class="show-article-header-filter">

                                    </div>

                                    <div class="show-article-item">
                                        <div class="show-article-item-title">
                                            <h1>{{$article->title}}</h1>
                                        </div>
                                        <div class="show-article-item-subtitle">
                                            <ul>
                                                <li><i class="far fa-clock"></i> <span>{{verta($article->created_at)->format('%d %B %Y')}}</span></li>
{{--                                                <li><i class="far fa-user"></i> <span>ارسال شده توسط dolatsara</span>--}}
{{--                                                </li>--}}
                                                <li><i class="far fa-file"></i> <span>{{$article->group->title}}</span></li>
                                                <li><i class="far fa-eye-slash"></i> <span>{{$article->view}}</span></li>
                                            </ul>
                                        </div>

{{--                                        <div class="show-article-item-img">--}}
                                            <div class="agahi-image-slider py-4">
                                                <!-- Full-width images with number text -->
                                                @if(isset($article->image))
                                                    <div class="mySlides">

                                                        <img src="{{asset($article->image)}}" style="width:100%">
                                                    </div>
                                                @endif

                                                @if(isset($article->video))
                                                    <div class="mySlides">
                                                        <video width="320" height="240" controls>
                                                            <source src="{{asset($article->video)}}">
                                                            {{--                                                <source src="movie.ogg" type="video/ogg">--}}
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>
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
                                                    @if(isset($article->image))
                                                        <div class="column" onclick="currentSlide(1)">
                                                            <img class="demo cursor" src="{{asset($article->image)}}"
                                                                 style="width:100%"
                                                            >
                                                        </div>
                                                    @endif
                                                    @if(isset($article->video))
                                                        <div class="column" onclick="currentSlide(2)">
                                                            <img class="demo cursor"
                                                                 src="{{asset('files/userMaster/assets/img/video-back-ground.png')}}"
                                                                 style="width:100%"
                                                            >
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>

{{--                                            <img src="{{asset($article->image)}}" alt="">--}}
{{--                                        </div>--}}
                                        <div class="show-article-item-desc">
                                            <p>
                                                {!! $article->description !!}
                                            </p>
                                        </div>
                                    </div>
                                    @if($similar_articles->count()>0)

                                        <section class="single-row-slider">
                                            <h2 class="single-row-slider__title" style="text-align:start;width:80%">
                                                <span> مقالات مشابه</span></h2>
                                            <div class="dolatsara-slider">
                                                <div class="swiper mySwiper3">
                                                    <div class="swiper-wrapper" style="min-height: 465px;">
                                                        @foreach($similar_articles as $arc)
                                                            <div class="swiper-slide" style="border-radius: 15px;">
                                                                {{--                                                                    <div class="item mx-3">--}}
                                                                <div class="articleShowBox" style="width: 100%">
                                                                    <div class="articleIntBox">
                                                                        <div class="imageBox">
                                                                            <img src="{{asset($arc->image)}}" alt="">
                                                                        </div>
                                                                        <div class="articleInfo">
                                                                            <div class="articleTitle">
                                                                                <h5>
                                                                                    {{$arc->title}}
                                                                                </h5>
                                                                            </div>
                                                                            <div class="articleText">
                                                                                <p>{{$arc->shortDescription}}</p>
                                                                            </div>
                                                                            <div class="readMore">
                                                                                <a href="{{route('articles.show.user', $arc->slug)}}">بیشتر
                                                                                    بخوانید</a>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                {{--                                                                    </div>--}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="swiper-pagination"></div>
                                                </div>
                                            </div>

                                        </section>
                                    @endif
{{--                                @if($similar_articles->count()>0)--}}
{{--                                            <div class="show-article-item-same-article">--}}
{{--                                                <div class="same-article-title">--}}
{{--                                                    <h2>--}}
{{--                                                        مقالات مشابه--}}
{{--                                                    </h2>--}}
{{--                                                </div>--}}
{{--                                                <div class="owl-carousel">--}}
{{--                                                    @foreach($similar_articles as $arc)--}}
{{--                                                        <div class="item mx-3">--}}
{{--                                                            <div class="articleShowBox">--}}
{{--                                                                <div class="articleIntBox">--}}
{{--                                                                    <div class="imageBox">--}}
{{--                                                                        <img src="{{asset($arc->image)}}" alt="">--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="articleInfo">--}}
{{--                                                                        <div class="articleTitle">--}}
{{--                                                                            <h5>--}}
{{--                                                                                {{$arc->title}}--}}
{{--                                                                            </h5>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="articleText">--}}
{{--                                                                            <p>{{$arc->shortDescription}}</p>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="readMore">--}}
{{--                                                                            <a href="{{route('articles.show.user', $arc->slug)}}">بیشتر بخوانید</a>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    @endforeach--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
{{--            </div>--}}
        </section>
    </main>
@endsection
@section('js_user')
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

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('.owl-carousel').owlCarousel({--}}
{{--                rtl: true,--}}
{{--                loop: true,--}}
{{--                margin: 10,--}}
{{--                // autoplay: true,--}}
{{--                autoplaySpeed: 2000,--}}
{{--                autoplayHoverPause: true,--}}
{{--                autoplayTimeout: 3000,--}}
{{--                items: 3,--}}
{{--                responsive: {--}}
{{--                    0: {--}}
{{--                        items: 1,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    320: {--}}
{{--                        items: 1.1,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    370: {--}}
{{--                        items: 1.05,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}

{{--                    390: {--}}
{{--                        items: 1.1,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    420: {--}}
{{--                        items: 1.25,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}

{{--                    450: {--}}
{{--                        items: 1.2,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    490: {--}}
{{--                        items: 1.3,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    550: {--}}
{{--                        items: 1.5,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    768: {--}}
{{--                        items: 1.9,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    920: {--}}
{{--                        items: 2.15,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    990: {--}}
{{--                        items: 2.1,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    1200: {--}}
{{--                        items: 2.2,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    1320: {--}}
{{--                        items: 2.3,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}
{{--                    1380: {--}}
{{--                        items: 2.4,--}}
{{--                        nav: false,--}}
{{--                        loop: true--}}
{{--                    },--}}


{{--                    1420: {--}}
{{--                        items: 3,--}}

{{--                        loop: true--}}
{{--                    },--}}

{{--                }--}}

{{--            })--}}

{{--        });--}}
{{--    </script>--}}
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!--load all styles -->
    <script src="{{asset('files/userMaster/src/js/dolatsara.js')}}"></script>
@endsection

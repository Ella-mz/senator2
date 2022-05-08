    @extends('RealestateMaster::master')
@section('title_realestate')ویرایش مقاله
@endsection
@section('card_title')ویرایش مقاله
@endsection
    @section('css')
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
                background-color: #b3ffff;
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
@section('content_realestateMaster')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-default">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title">ویرایش مقاله</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>

                        <div class="col-md-10">
                            <div class="agahi-image-slider">
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
                        </div>
                    </div>

                    <form action="{{ route('articles.update.panel', $article->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="sex">دسته بندی مقاله</label>
                                <select class="form-control" name="article_group_id"
                                        style="width: 100%;text-align: right">
                                    <option value="" disabled selected class="form-control"></option>
                                    @foreach($articleGroups as $group)
                                        <option value="{{$group->id}}" @if($group->id == $article->article_group_id)
                                        selected @endif >{{$group->title}}
                                        </option>
                                    @endforeach

                                </select>
                                <small class="text-danger">{{ $errors->first('article_group_id') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="inputName">عنوان مقاله</label>
                                <input type="text" name="title" class="form-control" value="{{ $article->title }}">
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="en_title">عنوان انگلیسی مقاله(slug)</label>
                                <input type="text" name="en_title" class="form-control" value="{{$article->en_title}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('en_title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="inputName">عکس</label>
                                <input class="form-control filestyle"
                                       name="image" id="flag"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('image')}}">
                                <small class="text-danger">{{ $errors->first('image') }}</small>
                                <div id="delete" style="margin-top: 2%">
                                    @if(isset($article->image))
                                        <img src="{{asset($article->image)}}" width="80">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"> توضیحات کوتاه </label>
                                <div>
                                    <input class="form-control" type="text" value="{{$article->shortDescription}}"
                                           name="shortDescription">
                                    <small class="text-danger">{{ $errors->first('shortDescription') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"> توضیحات </label>
                                <textarea id="description12" name="description" rows="10"
                                          style="width: 100%">{{$article->description}}</textarea>
                                <small class="text-danger">{{ $errors->first('description') }}</small>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn float-right" style="background-color: #3c3cce;color: #fff">ویرایش مقاله</button>
                            <a href="{{ route('articles.index.admin', $article->group->slug)}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>
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
@endsection

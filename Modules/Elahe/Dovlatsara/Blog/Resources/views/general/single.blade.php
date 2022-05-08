@extends('UserMasterNew::master')
@section('title_user')مقالات
@endsection
@section('css_user')
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="{{asset('files/blog/assets/styles/rtl-theme.css')}}">
    <link rel="stylesheet" href="{{asset('files/blog/assets/styles/rtl-theme-elements.css')}}">
    <link rel="stylesheet" href="{{asset('files/blog/assets/styles/rtl-theme-blog.css')}}">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('files/blog/assets/styles/default.css')}}">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('files/blog/assets/styles/custom.css')}}">

    <!-- Head Libs -->
    <script src="{{asset('files/blog/assets/js/modernizr.min.js')}}"></script>
    <style>
        .main_title_span {
            color: black !important;
        }

        .custom-post-published {
            color: black !important;
        }

        .custom_author {
            color: black !important;
        }
    </style>
@endsection

@section('content_userMasterNew')
    <div role="main" class="main">

        <section class="news">
            <div class="container-wide">
                <div class="container-wrapper inside-wrapper">

                    <div class="side-wrapper">
                        <div class="stickey-side">

                            <div class="mainside">
                                <div class="mainside--popular-news">
                                    <h3 class="main_title"><span>محبوبترین مقالات</span></h3>
                                    <div class="mainside--popular-news__content">
                                        @foreach($similar_articles as $similar_article)
                                            <div class="mainside--popular-news__content--box texthov">
                                                <a href="{{route('general-blog-single_article',$similar_article->id)}}" class="weblog"><img
                                                        src="{{asset($similar_article->image)}}"
                                                        alt="{{$similar_article->title}}"></a>
                                                <a href="{{route('general-blog-single_article',$similar_article->id)}}" class="weblog">
                                                    <h2 class="stnews">{{$similar_article->title}}</h2>
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="main-wrapper">
                        <div class="news-main-inside">
                            <!--content-->

                            <div class="news-main-inside__header">
                                <div class="news-main-inside__header--category"><a class="weblog">{{$article->group->title}}</a></div>
                                <h1 class="news-main-inside__header--title">    {{$article->title}}</h1>
                                <div class="news-main-inside__header--author">
                                    <a href="{{route('general-blog-single_article',$article->id)}}" class="weblog">
                                        <img src="{{asset('files/blog/assets/images/vector-person-icon-0.jpg')}}"
                                             alt="">
                                    </a>
                                    <div>
                                        <p>نویسنده:
                                            <span>{{$article->user->firstName}} {{$article->user->lastName}}</span></p>
                                        <p>{{verta($article->created_at)->format('%d %B  %Y ')}}</p>
                                    </div>
                                </div>
                            </div>

                            @if(!is_null($article->video))

                                <video width="75%" controls>
                                    <source src="{{asset($article->video)}}" type="video/mp4">
                                    <source src="{{asset($article->video)}}" type="video/ogg">
                                    Your browser does not support HTML video.
                                </video>
                            @elseif(!is_null($article->image))
                                <div class="news-main-inside__img mt-15">
                                    <a class="img-thumbnail d-block lightbox weblog" data-plugin-options="{'type':'image'}">
                                        <img class="img-fluid" src="{{asset($article->image)}}"
                                             alt="Project Image">
                                    </a>
                                </div>
                            @endif
                            <div class="news-main-inside__summary">
                                {!! $article->description  !!}
                            </div>

                        </div>

                        <div id="comments" class="post-block mt-5 post-comments">

                            @if(auth()->check())
                                <div class="comments-form">
                                    <form class="create-comment-form">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="0">
                                        <input type="hidden" name="commentable_id" value="{{$article->id}}">
                                        <input type="hidden" name="commentable_type"
                                               value="{{ get_class($article) }}">
                                        <textarea name="comment" id="" rows="10"
                                                  placeholder="دیدگاه خود را وارد کنید..."></textarea>
                                        <p class="text-danger error-danger-add-comment-form"></p>
                                        <p class="text-success error-success-add-comment-form"></p>

                                        <button type="submit"
                                                class="submit-btn add-comment-submit-button btn btn-outline-secondary"
                                                style="width: 100%;">ارسال نظر
                                        </button>
                                    </form>
                                </div>


                            @else
                                <p class="text-center">به منظور ثبت دیدگاه <a
                                        href="{{route('auth.loginForm.user')}}" class="text-success weblog">وارد سایت
                                        شوید!</a></p>


                            @endif


                            <ul id="comments_box" class="comments ">
                                @foreach($comments as $comment)

                                    <li>
                                        <div class="comment">
                                            <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                <img class="avatar" alt=""
                                                     src="{{asset('files/blog/assets/images/vector-person-icon-0.jpg')}}">
                                            </div>
                                            <div class="comment-block">
                                                <div class="comment-arrow"></div>
                                                <div class="comment-by"
                                                     style="display: flex; justify-content: space-between;">
                                                    <strong
                                                        style="font-size: 1rem;">{{$comment->user->firstName}} {{$comment->user->lastName}}</strong>
                                                    <div style="direction: ltr; display: flex; align-items: center;">
                                                    <span class="float-right">
														 <a data-bs-toggle="collapse" class="weblog"
                                                            href="#collapseReply{{$comment->id}}"><i
                                                                 class="fas fa-reply"></i> پاسخ</a></span>
                                                        <a href="{{route('general-dislike-comment',$comment->id)}}" class="weblog">
                                                            <div class="clickBtn dislike-btn" style="
									background-color: #fbcaca;
									color: #d55252;
									width: 50px;
									height: 24px;
									margin: 0 8px;
									display: flex;
									align-items: center;
									justify-content: center;
									border-radius: 4px;
									position: relative;
								  "
                                                            >
                                                                <i
                                                                    class="far fa-thumbs-down"
                                                                    style="font-size: 16px; margin-right: 4px"
                                                                ></i>
                                                                <p class="dislike-num">{{$comment->dislike}}</p>

                                                            </div>
                                                        </a>

                                                        <a
                                                            href="{{route('general-like-comment',$comment->id)}}" class="weblog"
                                                        >
                                                            <div
                                                                class="clickBtn like-btn"
                                                                style="
									width: 50px;
									background-color: #c4f8cd;
									color: #0dd17a;
									height: 24px;
									margin-right: 8px;
									display: flex;
									align-items: center;
									justify-content: center;
									border-radius: 4px;
									position: relative;
								  "
                                                            >
                                                                <i
                                                                    class="far fa-thumbs-up"
                                                                    style="font-size: 16px; margin-right: 4px"
                                                                ></i>
                                                                <p class="liked-num">{{$comment->like}}</p>

                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <p>
                                                    {{$comment->comment}}
                                                </p>
                                                <span
                                                    class="date float-right">{{verta($comment->created_at)->format('%d %B  %Y ')}}</span>
                                            </div>
                                            <div class="collapse" id="collapseReply{{$comment->id}}">
                                                <div class="card card-body">
                                                    @if(auth()->check())
                                                        <div class="comments-form">
                                                            <form class="create-comment-form">
                                                                @csrf
                                                                <input type="hidden" name="parent_id"
                                                                       value="{{$comment->id}}">
                                                                <input type="hidden" name="commentable_id"
                                                                       value="{{$article->id}}">
                                                                <input type="hidden" name="commentable_type"
                                                                       value="{{ get_class($article) }}">
                                                                <textarea name="comment" id="" rows="10"
                                                                          placeholder="پاسخ خود را وارد کنید..."></textarea>
                                                                <p class="text-danger error-danger-add-comment-form"></p>
                                                                <p class="text-success error-success-add-comment-form"></p>

                                                                <button type="submit"
                                                                        class="submit-btn add-comment-submit-button btn btn-outline-secondary"
                                                                        style="width: 100%;">ارسال پاسخ
                                                                </button>
                                                            </form>
                                                        </div>


                                                    @else
                                                        <p class="text-center">به منظور ثبت دیدگاه <a
                                                                href="{{route('login')}}" class="text-success weblog">وارد سایت
                                                                شوید!</a></p>


                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <ul class="comments reply">
                                            @foreach($comment->comments->where('status','active') as $sub)
                                                <li>
                                                    <div class="comment">
                                                        <div
                                                            class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                            <img class="avatar" alt=""
                                                                 src="{{asset('files/blog/assets/images/vector-person-icon-0.jpg')}}">
                                                        </div>
                                                        <div class="comment-block">
                                                            <div class="comment-arrow"></div>
                                                            <div class="comment-by"
                                                                 style="display: flex; justify-content: space-between;">
                                                                <strong>{{$sub->user->firstName}} {{$sub->user->lastName}}
                                                                </strong>
                                                                <div
                                                                    style="direction: ltr; display: flex; align-items: center;">
                                                                    <a class="weblog"
                                                                        href="{{route('general-dislike-comment',$sub->id)}}"
                                                                    >
                                                                        <div
                                                                            class="clickBtn dislike-btn"
                                                                            style="
									background-color: #fbcaca;
									color: #d55252;
									width: 50px;
									height: 24px;
									margin: 0 8px;
									display: flex;
									align-items: center;
									justify-content: center;
									border-radius: 4px;
									position: relative;
								  "
                                                                        >
                                                                            <i
                                                                                class="far fa-thumbs-down"
                                                                                style="font-size: 16px; margin-right: 4px"
                                                                            ></i>
                                                                            <p class="dislike-num">{{$sub->dislike}}</p>
                                                                        </div>
                                                                    </a>
                                                                    <a href="{{route('general-like-comment',$sub->id)}}" class="weblog">
                                                                        <div
                                                                            class="clickBtn like-btn"
                                                                            style="
									width: 50px;
									background-color: #c4f8cd;
									color: #0dd17a;
									height: 24px;
									margin-right: 8px;
									display: flex;
									align-items: center;
									justify-content: center;
									border-radius: 4px;
									position: relative;
								  "
                                                                        >
                                                                            <i
                                                                                class="far fa-thumbs-up"
                                                                                style="font-size: 16px; margin-right: 4px"
                                                                            ></i>
                                                                            <p class="liked-num">{{$sub->like}}</p>


                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                {{$sub->comment}}
                                                            </p>
                                                            <span
                                                                class="date float-right">{{verta($sub->created_at)->format('%d %B  %Y ')}}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>


                        </div>
                    </div>

                </div>
            </div>
        </section>


    </div>

@endsection
@section('js_user')
    <script src="{{asset('files/blog/assets/js/common.min.js')}}"></script>
    <script src="{{asset('files/blog/assets/js/jquery.lazyload.min.js')}}"></script>
    <script src="{{asset('files/blog/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('files/blog/assets/js/jquery.magnific-popup.min.js')}}"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="{{asset('files/blog/assets/js/theme.js')}}"></script>

    <!-- Theme Custom -->
    <script src="{{asset('files/blog/assets/js/custom.js')}}"></script>

    <!-- Theme Initialization Files -->
    <script src="{{asset('files/blog/assets/js/theme.init.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.create-comment-form').on('submit', function (event) {
                event.preventDefault();

                let comment = $(this).children('textarea[name=\'comment\']').val();
                let parent_id =  $(this).children("input[name='parent_id']").val();
                let commentable_id = $("input[name='commentable_id']").val();
                let commentable_type = $("input[name='commentable_type']").val();
                // $(this).children('div.left').children(".add-comment-submit-button").html(spiner_button());
                let that = $(this)

                $.ajax({
                    type: "POST",
                    url: "{{route('general-ajax-add-comment')}}",
                    data: {
                        'comment': comment,
                        'parent_id': parent_id,
                        'commentable_id': commentable_id,
                        'commentable_type': commentable_type,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data)
                        that.children(".error-danger-add-comment-form").empty();
                        that.children(".error-success-add-comment-form").empty();
                        if (data.result) {
                            that.children(".error-success-add-comment-form").append(data.message);

                        } else {
                            that.children(".error-danger-add-comment-form").append(data.message);
                        }
                        that.children('div.left').children(".add-comment-submit-button").html('ارسال دیدگاه');

                    }
                })


            });

        });

    </script>
{{--    @include('generalmaster::layouts.comments')--}}
@endsection

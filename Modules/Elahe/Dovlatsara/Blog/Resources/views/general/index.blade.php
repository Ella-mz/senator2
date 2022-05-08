@extends('UserMasterNew::master')
@section('title_user')مقالات
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/blog/assets/styles/rtl-theme.css')}}">
    <link rel="stylesheet" href="{{asset('files/blog/assets/styles/rtl-theme-elements.css')}}">
    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('files/blog/assets/styles/default.css')}}">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('files/blog/assets/styles/custom.css')}}">

    <!-- Head Libs -->
    <script src="{{asset('files/blog/assets/js/modernizr.min.js')}}"></script>
    <style>
        .main_title_span {
            color: #02015f !important;
        }

        .custom-post-published {
            color: #02015f !important;

        }

        .custom_author {
            color: black !important;
        }


        .square-color {
            background-color: #f37023;
        }
    </style>
@endsection

@section('content_userMasterNew')
    <div role="main" class="main">
        @if(count($articles['row-1']['articles'])>0)
            <section id="slider">
                <div class="container-wide">

                    <div class="slider row">
                        <div class="col-md-6 slider--boxes"
                             style="background-image: url('{{asset($articles['row-1']['articles'][0]->image)}}');">
                            <a href="{{route('general-blog-single_article',$articles['row-1']['articles'][0]->id)}}">
                                <div class="slider--boxes__content">
                                    <div class="row">
                                        <h5>{{$articles['row-1']['articles'][0]->title}}</h5>
                                    </div>
                                    <div class="row">
                                        <div class="post-meta post-meta-dark">

											<span class="post-author custom_author">
                                                {{$articles['row-1']['articles'][0]->user->firstName}} {{$articles['row-1']['articles'][0]->user->lastName}}
											</span>


                                            <time class=" custom-post-published updated"
                                                  datetime="2017-06-04T12:56:00+00:00">
                                                {{verta($articles['row-1']['articles'][0]->created_at)->format('%d %B  %Y ')}}
                                            </time>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <div class="row" style="height: 100%;">
                                @if(isset($articles['row-1']['articles'][1]))

                                    <div class="col-md-12 slider--boxes"
                                         style="background-image: url('{{asset($articles['row-1']['articles'][1]->image)}}')">
                                        <a href="{{route('general-blog-single_article',$articles['row-1']['articles'][1]->id)}}">
                                            <div class="slider--boxes__content">
                                                <div class="row">
                                                    <h5>{{$articles['row-1']['articles'][1]->title}}</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="post-meta post-meta-dark">

													<span class="post-author custom_author">
                                                {{$articles['row-1']['articles'][1]->user->firstName}} {{$articles['row-1']['articles'][1]->user->lastName}}
													</span>

                                                        <time class=" custom-post-published updated"
                                                              datetime="2017-06-04T12:56:00+00:00">
                                                            {{verta($articles['row-1']['articles'][1]->created_at)->format('%d %B  %Y ')}}

                                                        </time>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                @if(isset($articles['row-1']['articles'][2]))

                                    <div class="col-md-6 slider--boxes"
                                         style="background-image: url('{{asset($articles['row-1']['articles'][2]->image)}}')">
                                        <a href="{{route('general-blog-single_article',$articles['row-1']['articles'][2]->id)}}">
                                            <div class="slider--boxes__content">
                                                <div class="row">
                                                    <h5>{{$articles['row-1']['articles'][2]->title}}</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="post-meta post-meta-dark">

													<span class="post-author custom_author">
 {{$articles['row-1']['articles'][2]->user->firstName}} {{$articles['row-1']['articles'][2]->user->lastName}}
                                                    </span>

                                                        <time class=" custom-post-published updated"
                                                              datetime="2017-06-04T12:56:00+00:00">
                                                            {{verta($articles['row-1']['articles'][2]->created_at)->format('%d %B  %Y ')}}

                                                        </time>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                @if(isset($articles['row-1']['articles'][3]))
                                    <div class="col-md-6 slider--boxes"
                                         style="background-image: url('{{asset($articles['row-1']['articles'][3]->image)}}')">
                                        <a href="{{route('general-blog-single_article',$articles['row-1']['articles'][3]->id)}}">
                                            <div class="slider--boxes__content">
                                                <div class="row">
                                                    <h5>{{$articles['row-1']['articles'][3]->title}}</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="post-meta post-meta-dark">

													<span class="post-author custom_author">
                                                        {{$articles['row-1']['articles'][3]->user->firstName}} {{$articles['row-1']['articles'][3]->user->lastName}}
                                                    </span>

                                                        <time class=" custom-post-published updated"
                                                              datetime="2017-06-04T12:56:00+00:00">
                                                            {{verta($articles['row-1']['articles'][3]->created_at)->format('%d %B  %Y ')}}

                                                        </time>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        @endif
        {{--        <section class="editor-choice four-item">--}}
        {{--            <div class="container-wide">--}}
        {{--                <div class="row">--}}
        {{--                    @foreach($groups as $group)--}}
        {{--                        <div class="col-md-2 card p-3  d-flex justify-content-center align-items-center">--}}
        {{--                            <a href="{{route('general-articles-list',$group->id)}}">--}}

        {{--                                @if(!is_null($group->image_id))--}}

        {{--                                    <img src="{{asset($group->image)}}"--}}
        {{--                                         style="height: 70px;width: 70px;border-radius: 40px">--}}
        {{--                                @endif--}}
        {{--                                <h4 class="my-2">{{$group->title}}</h4>--}}
        {{--                            </a>--}}
        {{--                        </div>--}}

        {{--                    @endforeach--}}

        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}
        <section class="article-archive">
            <h4>آرشیو کامل مقالات</h4>
            <div class="grid-boxes-section">
                @foreach($groups as $group)
                    <form action="{{route('articles.filter.user')}}" method="post" id="article_list_filter{{$group->id}}">
                        @csrf
                        <input hidden name="weblog" value="1">
                        <input hidden name="group" value="{{$group->id}}">
                        <a  style="border: none; cursor: pointer" onclick="document.getElementById('article_list_filter{{$group->id}}').submit()">
                        <div class="single-box">
                            <div class="image-placeholder">
                                <img src="{{asset($group->image)}}"/>
                            </div>
                            <p class="box-title">{{$group->title}}</p>
                            <small class="number-card">{{$group->articles->count()}}</small>
                        </div>
                        </a>
                    </form>
                @endforeach

            </div>
        </section>
        @if(count($articles['row-2']['articles'])>0)
            <section class="editor-choice four-item">
                <div class="container-wide">
                    <h3 class="main_title">
                        <a><span class="main_title_span">{{$articles['row-2']['position']->title}}</span></a>
                    </h3>
                    <div class="four-item__boxes">
                        @foreach($articles['row-2']['articles'] as $article)
                            <div class="four-item__boxes--item">
                                <a class="four-item__boxes--item__link"
                                   href="{{route('general-blog-single_article',$article->id)}}">
                                    <div class="four-item__boxes--item__header">
                                        <img src="{{asset($article->image)}}"
                                             alt="{{$article->title}}">
                                    </div>
                                    <div class="four-item__boxes--item__title">
                                        <P>{{$article->title}}</P>
                                        <div class="post-meta">

										<span class="post-author custom_author">
                                            {{$article->user->firstName}} {{$article->user->lastName}}
										</span>
                                            <time class=" custom-post-published updated"
                                                  datetime="2017-06-04T12:56:00+00:00">

                                                {{verta($article->created_at)->format('%d %B  %Y ')}}

                                            </time>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        @if(count($articles['row-3']['articles'])>0)
            <section class="ads-first">
                <div class="container-wide">
                    <a href="{{route('general-blog-single_article',$articles['row-3']['articles'][0]->id)}}">

                        <div class=" full-ad-box">
                            <img src="{{asset($articles['row-3']['articles'][0]->image)}}"
                                 alt="{{$articles['row-3']['articles'][0]->title}}">
                            <p>{{$articles['row-3']['articles'][0]->title}}</p>
                        </div>
                    </a>

                </div>
            </section>
        @endif

        <section class="news">
            <div class="container-wide">
                <div class="container-wrapper">
                    <div class="side-wrapper">
                        <div class="stickey-side">
                            <div class="mainside">
                                @if(count($articles['row-4-1-1']['articles'])>0)
                                    <div class="mainside--popular-news">
                                        <h3 class="main_title"><a
                                            ><span class="main_title_span">  {{$articles['row-4-1-1']['position']->title}}   </span></a>
                                        </h3>
                                        <div class="mainside--popular-news__content">
                                            @foreach($articles['row-4-1-1']['articles'] as $article)
                                                <div class="mainside--popular-news__content--box texthov">
                                                    <a href="{{route('general-blog-single_article',$article->id)}}"><img
                                                            src="{{asset($article->image)}}"
                                                            alt="{{$article->title}}"></a>
                                                    <a href="{{route('general-blog-single_article',$article->id)}}">
                                                        <h2 class="stnews">{{$article->title}}</h2>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if(count($articles['row-4-1-2']['articles'])>0)


                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="main_title">
                                            <a><span
                                                    class="main_title_span">{{$articles['row-4-1-2']['position']->title}}</span></a>
                                        </h3>
                                        <div class="mainside--review">
                                            <div class="mainside--review__box">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="{{route('general-blog-single_article',$articles['row-4-1-2']['articles'][0]->id)}}">
                                                            <div class="mainside--review__big shadow-gradient"
                                                                 style="background-image: url('{{asset($articles['row-4-1-2']['articles'][0]->image)}}');">
                                                                <div class="mainside--review__big--content">
                                                                    <h4>
                                                                        {{$articles['row-4-1-2']['articles'][0]->title}}
                                                                    </h4>
                                                                    <div class="post-meta post-meta-dark">

                                                                    <span class="post-author custom_author">
                                            {{$articles['row-4-1-2']['articles'][0]->user->firstName}} {{$articles['row-4-1-2']['articles'][0]->user->lastName}}
																		</span>
                                                                        <time class=" custom-post-published updated"
                                                                              datetime="2017-06-04T12:56:00+00:00">
                                                                            {{verta($articles['row-4-1-2']['articles'][0]->created_at)->format('%d %B  %Y ')}}

                                                                        </time>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mainside--review__medium">
                                                            @foreach($articles['row-4-1-2']['articles']->skip(1) as $article)
                                                                <div class="mainside--review__medium-box texthov">
                                                                    <a href="{{route('general-blog-single_article',$article->id)}}"><img
                                                                            src="{{asset($article->image)}}"
                                                                            alt="{{$article->title}}"></a>
                                                                    <div class="mainside--review__medium-box--content">
                                                                        <a href="#">
                                                                            <p>{{$article->title}}</p>
                                                                        </a>
                                                                        <div class="post-meta">
                                                                            <span>   {{verta($article->created_at)->format('%d %B  %Y ')}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>

                    </div>
                    @if(count($articles['row-4-2-1']['articles'])>0)
                        <div class="main-wrapper">

                            <h3 class="main_title"><a><span
                                        class="main_title_span">{{$articles['row-4-2-1']['position']->title}}</span></a>
                            </h3>
                            <div class="news-main">
                                @foreach($articles['row-4-2-1']['articles'] as $article)
                                    <article class="news-main__item texthov">
                                        <div class="news-main__item--image img-category-bottom">
                                            <a href="{{route('general-blog-single_article',$article->id)}}"
                                               class="{{!is_null($article->video)?"news-video":""}}"><img
                                                    src="{{asset($article->image)}}"
                                                    alt="{{$article->title}}"></a>
                                            <a class="img-category-bottom__link"
                                               href="{{route('general-blog-single_article',$article->id)}}"><span>{{$article->group->title}}</span></a>
                                        </div>
                                        <div class="news-main__item--content">
                                            <h2 class=" mnewsf main_title_span">
                                                <a href="{{route('general-blog-single_article',$article->id)}}"
                                                   class="main_title_span">
                                                    {{$article->title}}
                                                </a>
                                            </h2>
                                            <div class="post-meta">
											<span class="post-author custom_author">
 {{$article->user->firstName}} {{$article->user->lastName}}
											</span>
                                                <time class=" custom-post-published updated"
                                                      datetime="2017-06-04T12:56:00+00:00">
                                                    {{verta($article->created_at)->format('%d %B  %Y ')}}

                                                </time>
                                                <span class="post-meta-comments">{{\Modules\Comment\Entities\Comment::where('commentable_id', $article->id)->where('commentable_type', 'Modules\Article\Entities\Article')->get()->count()}}<i
                                                        class="fa fa-comments "></i></span>
                                            </div>
                                            <p>{{$article->shortDescription}}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        @if(count($articles['row-5']['articles'])>0)

            <section class="videos four-item">
                <div class="container-wide">
                    <h3 class="main_title main_title_dark text-white"><a><span class="text-white"
                                                                               class="main_title_span">{{$articles['row-5']['position']->title}}</span></a>
                    </h3>
                    <div class="four-item__boxes">
                        @foreach($articles['row-5']['articles'] as $article)
                            <div class="four-item__boxes--item">
                                <a class="four-item__boxes--item__link weblog"
                                   href="{{route('general-blog-single_article',$article->id)}}">
                                    <div
                                        class="four-item__boxes--item__header {{!is_null($article->video)?"news-video":""}}">
                                        <img src="{{asset($article->image)}}"
                                             alt="{{$article->title}}">
                                    </div>
                                    <div class="four-item__boxes--item__title">
                                        <P>{{$article->title}}</P>
                                        <div class="post-meta post-meta-dark">

										<span class="post-author custom_author">
                                           {{$article->user->firstName}} {{$article->user->lastName}}
										</span>
                                            <time class=" custom-post-published updated"
                                                  datetime="2017-06-04T12:56:00+00:00">
                                                {{verta($article->created_at)->format('%d %B  %Y ')}}
                                            </time>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <section class="categories">
            <div class="container-wide">
                <div class="container-wrapper">
                    <div class="side-wrapper">
                        @if(count($articles['row-6-1']['articles'])>0)

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="main_title"><a class="weblog"><span
                                                class="main_title_span">{{$articles['row-6-1']['position']->title}}</span></a>
                                    </h3>
                                    <div class="categories-side_second">
                                        @foreach($articles['row-6-1']['articles'] as $article)
                                            <div class="categories-side_second--item texthov">
                                                <a class="weblog"
                                                   href="{{route('general-blog-single_article',$article->id)}}"
                                                   title=""><img
                                                        src="{{asset($article->image)}}"
                                                        alt="{{$article->title}}"></a>
                                                <a class="weblog"
                                                   href="{{route('general-blog-single_article',$article->id)}}"
                                                   title="">
                                                    <p>{{$article->title}}</p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="main-wrapper">
                        @if(count($articles['row-6-2-1']['articles'])>0)

                            <div class="row">
                                <h3 class="main_title"><a class="weblog"><span
                                            class="main_title_span">{{$articles['row-6-2-1']['position']->title}}</span></a>
                                </h3>
                                <div class="col-md-6">
                                    <article class="categories-top-right texthov">

                                        <div class="img-category-bottom">
                                            <a class="weblog"
                                               href="{{route('general-blog-single_article',$articles['row-6-2-1']['articles'][0]->id)}}"
                                               title=""><img
                                                    src="{{asset($articles['row-6-2-1']['articles'][0]->image)}}"
                                                    alt="{{$articles['row-6-2-1']['articles'][0]->title}}"></a>
                                            <a title="" class="img-category-bottom__link weblog"
                                               href="{{route('general-blog-single_article',$articles['row-6-2-1']['articles'][0]->id)}}">
                                                <span>{{$articles['row-6-2-1']['articles'][0]->group->title}}</span>
                                            </a>
                                        </div>
                                        <h2 class="mnewsf main_title_span">
                                            <a href="{{route('general-blog-single_article',$articles['row-6-2-1']['articles'][0]->id)}}"
                                               class=" main_title_span weblog">
                                                {{$articles['row-6-2-1']['articles'][0]->title}}
                                            </a>
                                        </h2>
                                        <div class="post-meta">
												<span class="post-author custom_author">
                                           {{$articles['row-6-2-1']['articles'][0]->user->firstName}} {{$articles['row-6-2-1']['articles'][0]->user->lastName}}
													</span>
                                            <time class=" custom-post-published updated"
                                                  datetime="2017-06-04T12:56:00+00:00">
                                                {{verta($articles['row-6-2-1']['articles'][0]->created_at)->format('%d %B  %Y ')}}

                                            </time>
                                        </div>
                                        <p>{{$articles['row-6-2-1']['articles'][0]->shortDescription}}</p>
                                    </article>
                                </div>
                                <div class="col-md-6">
                                    <div class="categories-top-left">
                                        @foreach($articles['row-6-2-1']['articles']->skip(1) as $article)
                                            <article class="categories-top-left__item texthov">
                                                <a class="categories-top-left__item--img"
                                                   href="{{route('general-blog-single_article',$article->id)}}">
                                                    <img src="{{asset($article->image)}}"
                                                         alt="{{$article->title}}"></a>
                                                <div class="categories-top-left__item--content">
                                                    <a href="{{route('general-blog-single_article',$article->id)}}">
                                                        <h5>{{$article->title}}</h5>
                                                    </a>
                                                    <div class="post-meta">
													<span class="post-author custom_author">
                                           {{$article->user->firstName}} {{$article->user->lastName}}
													</span>
                                                        <time class=" custom-post-published updated"
                                                              datetime="2017-06-04T12:56:00+00:00">
                                                            {{verta($article->created_at)->format('%d %B  %Y ')}}

                                                        </time>
                                                    </div>
                                                </div>
                                            </article>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            @if(count($articles['row-6-2-2']['articles'])>0)

                                <div class="categories-half col-md-6">
                                    <h3 class="main_title"><a><span
                                                class="main_title_span">{{$articles['row-6-2-2']['position']->title}}</span></a>
                                    </h3>
                                    <article class="categories-half__first-item texthov">
                                        <a class="categories-half__first-item--img"
                                           href="{{route('general-blog-single_article',$articles['row-6-2-2']['articles'][0]->id)}}"><img
                                                src="{{asset($articles['row-6-2-2']['articles'][0]->image)}}"
                                                alt="{{$articles['row-6-2-2']['articles'][0]->title}}"></a>
                                        <div class="categories-half__first-item--content">
                                            <a href="{{route('general-blog-single_article',$articles['row-6-2-2']['articles'][0]->id)}}">
                                                <h3 class="h4title">{{$articles['row-6-2-2']['articles'][0]->title}}</h3>
                                            </a>
                                            <div class="post-meta">
												<span class="post-author custom_author">
                                           {{$articles['row-6-2-2']['articles'][0]->user->firstName}} {{$articles['row-6-2-2']['articles'][0]->user->lastName}}
												</span>
                                                <time class=" custom-post-published updated"
                                                      datetime="2017-06-04T12:56:00+00:00">
                                                    {{verta($articles['row-6-2-2']['articles'][0]->created_at)->format('%d %B  %Y ')}}

                                                </time>
                                            </div>
                                        </div>
                                    </article>
                                    @foreach($articles['row-6-2-2']['articles']->skip(1) as $article)

                                        <article class="categories-half__items texthov">
                                            <a class="categories-half__items--img"
                                               href="{{route('general-blog-single_article',$article->id)}}"><img
                                                    src="{{asset($article->image)}}" alt=""></a>
                                            <div class="categories-half__items--content">
                                                <a href="{{route('general-blog-single_article',$article->id)}}">
                                                    <h3 class="h4title">{{$article->title}}</h3>
                                                </a>
                                                <div class="post-meta">
                                                    <time class=" custom-post-published updated"
                                                          datetime="2017-06-04T12:56:00+00:00">
                                                        {{verta($article->created_at)->format('%d %B  %Y ')}}

                                                    </time>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                            @if(count($articles['row-6-2-3']['articles'])>0)

                                <div class="categories-half col-md-6">
                                    <h3 class="main_title"><a><span
                                                class="main_title_span">{{$articles['row-6-2-3']['position']->title}}</span></a>
                                    </h3>
                                    <article class="categories-half__first-item texthov">
                                        <a class="categories-half__first-item--img"
                                           href="{{route('general-blog-single_article',$articles['row-6-2-3']['articles'][0]->id)}}"><img
                                                src="{{asset($articles['row-6-2-3']['articles'][0]->image)}}"
                                                alt="{{$articles['row-6-2-3']['articles'][0]->title}}"></a>
                                        <div class="categories-half__first-item--content">
                                            <a href="{{route('general-blog-single_article',$articles['row-6-2-3']['articles'][0]->id)}}">
                                                <h3 class="h4title">{{$articles['row-6-2-3']['articles'][0]->title}}</h3>
                                            </a>
                                            <div class="post-meta">
												<span class="post-author custom_author">
                                           {{$articles['row-6-2-3']['articles'][0]->user->firstName}} {{$articles['row-6-2-3']['articles'][0]->user->lastName}}
												</span>
                                                <time class=" custom-post-published updated"
                                                      datetime="2017-06-04T12:56:00+00:00">
                                                    {{verta($articles['row-6-2-3']['articles'][0]->created_at)->format('%d %B  %Y ')}}

                                                </time>
                                            </div>
                                        </div>
                                    </article>
                                    @foreach($articles['row-6-2-3']['articles']->skip(1) as $article)

                                        <article class="categories-half__items texthov">
                                            <a class="categories-half__items--img"
                                               href="{{route('general-blog-single_article',$article->id)}}"><img
                                                    src="{{asset($article->image)}}" alt=""></a>
                                            <div class="categories-half__items--content">
                                                <a href="{{route('general-blog-single_article',$article->id)}}">
                                                    <h3 class="h4title">{{$article->title}}</h3>
                                                </a>
                                                <div class="post-meta">
                                                    <time class=" custom-post-published updated"
                                                          datetime="2017-06-04T12:56:00+00:00">
                                                        {{verta($article->created_at)->format('%d %B  %Y ')}}

                                                    </time>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(count($articles['row-7']['articles'])>0)

            <section class="last four-item">
                <div class="container-wide">
                    <h3 class="main_title"><a><span
                                class="main_title_span">{{$articles['row-7']['position']->title}}</span></a></h3>
                    <div class="four-item__boxes">
                        @foreach($articles['row-7']['articles'] as $article)
                            <div class="four-item__boxes--item">
                                <a class="four-item__boxes--item__link"
                                   href="{{route('general-blog-single_article',$article->id)}}">
                                    <div
                                        class="four-item__boxes--item__header {{!is_null($article->video)?"news-video":""}}">
                                        <img src="{{asset($article->image)}}"
                                             alt="{{$article->title}}">
                                    </div>
                                    <div class="four-item__boxes--item__title">
                                        <P>{{$article->title}}</P>
                                        <div class="post-meta">

										<span class="post-author custom_author">
                                            {{$article->user->firstName}} {{$article->user->lastName}}

										</span>
                                            <time class=" custom-post-published updated"
                                                  datetime="2017-06-04T12:56:00+00:00">
                                                {{verta($article->created_at)->format('%d %B  %Y ')}}

                                            </time>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
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
@endsection

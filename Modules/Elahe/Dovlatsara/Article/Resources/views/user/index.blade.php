@extends('UserMasterNew::master')
@section('title_user')مقالات
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/articleShow.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/singleArticlepage.css')}}">
@endsection

@section('content_userMasterNew')
    <section class="articlesShowPage">
        <div class="bg-color">
            <div class="container">
                <div class="row ">
                    <div class="col-12 px-2 py-4">
                        <div class="show-article-header-filter">
                            <form
                                {{--                                action="{{route('articles.filter.user')}}"--}}
                                method="post" id="articleFilterForm">
                                @csrf
                                <div class="inputs">
                                    <div class="show-article-header-filter-item">
                                        <div class="d-flex align-items-end">
                                            <div>
                                                <label for="">جست وجو</label>
                                                <input type="text" name="search" class="text-input"
                                                       onkeypress="searchFunc(this.val)">
                                                {{--                                                <input class="text-input" type="text">--}}
                                            </div>


                                            <div class="search-icon"><a href="" class="search-icon">
                                                    <i class="fas fa-search-plus"></i></a></div>
                                        </div>


                                    </div>
                                    <div class="show-article-header-filter-item">
                                        <div class="select">
                                            <label for="">دسته بندی مقالات</label>
                                            <select name="group" class="group">
                                                <option value=""></option>
                                                @foreach($article_groups as $group)
                                                    <option value="{{$group->id}}" @if(($group2 && $group2==$group->id) || $g==$group->id) selected @endif>{{$group->title}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="show-article-header-filter-item-btn">
                                    <a href="{{route('articles.index.user')}}" class="clear-filters">پاک کردن
                                        فیلترها</a>
                                </div>
                            </form>

                        </div>
                        <div class="articleShowBox">
                            <div class="articleShowTitle">
                                <h3>مقالات</h3>
                            </div>
                            <div class="row mt-4" id="articleFilterPage">
                                @foreach($articles as $article)
                                    <div class="col-xl-3 col-lg-4 col-md-6 px-sm-3 mb-4">
                                        <div class="articleIntBox">
                                            <div class="imageBox">
                                                <img src="{{asset($article->image)}}" alt="">
                                            </div>
                                            <div class="articleInfo">
                                                <div class="articleTitle">
                                                    <h5>
                                                        {{$article->title}}
                                                    </h5>
                                                </div>
                                                <div class="articleText">
                                                    <p>{{$article->shortDescription}}</p>
                                                </div>
                                                <div class="readMore">
                                                    <a href="{{route('articles.show.user', $article->slug)}}">بیشتر
                                                        بخوانید</a>
                                                </div>
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
    </section>
@endsection
@section('js_user')
    <script>
        $(document).ready(function () {
            $('#articleFilterForm').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('articles.filter.user')}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#articleFilterPage').empty();
                        $('#articleFilterPage').append(data.content);
                    }
                })
            });
        });
    </script>
    <script>
        jQuery(document).ready(function () {
        })
        $('.group').change(function (e) {
            $("#articleFilterForm").submit();
        });

        function searchFunc(val) {
            $("#articleFilterForm").submit();
        }
    </script>

@endsection

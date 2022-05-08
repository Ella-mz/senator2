@extends('AdminMasterNew::master')
@section('urlHeader') افزودن مقاله به پوزیشن {{$position->name}}
@endsection
@section('header')
    {{--    {!! $map !!}--}}
    {{--    @foreach($categories as $category->iteme)--}}
    {{--    <li><a href="{{route('category.index.admin',0)}}" title="categories">Categories</a></li>--}}
    {{--    @endforeach--}}
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
{{--                <a href=""--}}
{{--                   class="btn btn-sm btn-primary" style="float: left"> افزودن مقاله به پوزیشن {{$position->name}}</a>--}}

                <h1 class="card-title" style="float: right"> افزودن مقاله به پوزیشن {{$position->name}}</h1>

            </div>
            <div class="card-body p-0">
                @if(session()->has('error_message'))
                    <div class="alert alert-danger " style="color:darkred">{{ session()->get('error_message') }}</div>
                @endif
                <form method="post" action="{{route('admin-attach-article-position',$position->id)}}">
                    @csrf
                    <table  class="table table-bordered table-sm   display responsive nowrap "
                            style="width: 100%">
                        <thead>
                        <tr>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>گروه</th>
                            <th>نویسنده</th>
                            <th>بازدید</th>
                            {{--                <th>خبر</th>--}}
                            <th><button class="btn btn-sm btn-success" type="submit">ثبت</button></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $articles as $key=>$article)
                            <tr>
                                <td>
                                    @if(!is_null($article->image_id))
                                        <img src="{{custom_asset($article->image->link )}}" height="40px" width="40px"
                                             class="img-circle">
                                    @endif
                                </td>
                                <td>{{$article->title}}</td>
                                <td>{{$article->group->title}}</td>
                                <td>{{$article->user->firstName}} {{$article->user->lastName}}</td>
                                <td>{{$article->view}} </td>
                                {{--                    <td>--}}
                                {{--                        @if($article->news)--}}
                                {{--                            <i class="fa fa-check-circle text-success"></i>--}}
                                {{--                    @endif--}}
                                {{--                    </td>--}}
                                <td>
                                    <input type="checkbox" class="form-control " name="articles[]" value="{{$article->id}}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </form>
                <div class="row my-4">
                    <div class="col-md-12 d-flex justify-content-center align-content-center">{{ $articles->links() }}</div>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
    <script>
        function position_image(image)
        {
            let url = `{{asset('')}}`

            $('#modal-image-box').empty();
            $('#modal-image-box').append(`<img src=`+url.concat(image)+` style="max-width: 700px;max-height: 400px;min-width: 300px">`);

        }
    </script>
@endsection

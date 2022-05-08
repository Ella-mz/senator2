    @extends('RealestateMaster::master')
@section('title_realestate')مقالات
@endsection
@section('card_title')مقالات
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('articles.create.panel')}}"
                   class="btn btn-sm"  style="background-color: #3c3cce;color: #fff;float: left">ایجاد مقاله جدید</a>

                <h1 class="card-title" style="float: right">مقالات</h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>عکس</th>
                        <th>بازدید</th>
                        <th>تایید/عدم تایید</th>
                        <th>
                            ویرایش/حذف
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $key=>$article)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$article->title}}</td>
                            @if(isset($article->image))
                                <td width="80" height="40">
                                    <img src="{{asset($article->image)}}" width="80" height="40">
                                </td>
                            @else
                                <td width="80" height="40">
{{--                                    <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                </td>
                            @endif
                            <td>
                                {{$article->view}}
                            </td>
                            <td>
                                @if($article->status=='active')
                                    <i class="fa fa-check" style="color: #00B74A"></i>
                                @else
                                    <i class="fa fa-close" style="color: #F93154"></i>

                                    @endif
                            </td>
                            <td class="project-actions text-right">
                                <form
                                    action="{{route('articles.destroy.panel', $article->id)}}"
                                    method="POST">
                                    @csrf
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('articles.edit.panel', $article->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف مقاله {{$article->title}} اطمینان دارید؟')">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js_realestate')
    @include('RealestateMaster::layouts.data_table')
@endsection

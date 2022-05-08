@extends('AdminMasterNew::master')
@section('urlHeader') مقالات
@endsection
@section('header')
    مقالات
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('articles.create.admin', $slug)}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد مقاله جدید</a>

                <h1 class="card-title" style="float: right"> مقالات <a href="{{route('article-groups.index.admin')}}">{{$articleGroup->title}}</a></h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>عکس</th>
                        <th>ثبت شده توسط</th>
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
{{--                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                </td>
                            @endif
                            <td>
                                @if(isset($article->agency_id))
                                    {{$article->agency->shop_title}}
                                @else

                                    {{$article->user->name}} {{$article->user->sirName}}
                                @endif
                            </td>
                            <td>
                                {{$article->view}}
                            </td>
                            <td>
                                <input class="activation1" type="checkbox"
                                       {{$article->status=='active'?"checked":""}}
                                       data-toggle="tooltip" title="تایید/عدم تایید مقاله"
                                       id="{{$article->id}}"
                                       name="activation">
                            </td>
                            <td class="project-actions text-right">
                                <form
                                    action="{{route('articles.destroy.admin', $article->id)}}"
                                    method="POST">
                                    @csrf
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('articles.edit.admin', $article->id)}}">
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
@section('js')
    @include('AdminMasterNew::layouts.data_table')
    <script>
        $('.activation1').change(function () {
            var id = $(this).attr('id')
            if ($(this).is(":checked")) {
                var active = 'active';
            } else {
                var active = 'deactivate';
            }
            $.ajax({
                url: "{{route('article.activation.admin')}}",
                data: {
                    'id': id,
                    'active': active,
                },
                method: "get",
                dataType: 'JSON',

                success: function (data) {
                    location.reload();
                }
            })
        });
    </script>
@endsection

@extends('AdminMasterNew::master')
@section('urlHeader')گروه مقالات
@endsection
@section('header')
    گروه مقالات
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('article-groups.create.admin')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد گروه مقاله جدید</a>

                <h1 class="card-title" style="float: right">گروه مقالات</h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>عکس</th>
                        <th>مقالات</th>
                        <th>
                            ویرایش/حذف
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($article_groups as $key=>$article_group)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$article_group->title}}</td>
                            @if(isset($article_group->image))
                                <td width="80" height="40">
                                    <img src="{{asset($article_group->image)}}" width="80" height="40">
                                </td>
                            @else
                                <td width="80" height="40">
{{--                                    <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                </td>
                            @endif
                            <td>
                                    <a href="{{route('articles.index.admin', $article_group->slug)}}"
                                       class="btn btn-sm btn-primary"><i class="fa fa-plus-circle nav-icon text-white"></i></a>
                            </td>

                            <td class="project-actions text-right">
                                <form
                                    action="{{route('article-groups.destroy.admin', $article_group->id)}}"
                                    method="POST">
                                    @csrf
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('article-groups.edit.admin', $article_group->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف گروه مقاله {{$article_group->title}} اطمینان دارید؟')">
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
@endsection

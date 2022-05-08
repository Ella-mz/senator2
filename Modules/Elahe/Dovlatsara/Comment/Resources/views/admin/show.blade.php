@extends('AdminMasterNew::master')
@section('urlHeader')نظرات
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
                                <a href="{{$comment->parent_id==0?route('admin-comments-index'):route('admin-comments-show',$comment->parent_id)}}"
                                   class="btn btn-sm btn-primary" style="float: left">نظرات</a>

                <h1 class="card-title" style="float: right"> @if($comment->commentable_type=='Modules\Article\Models\Article')
                        مقاله
                    @elseif($comment->commentable_type=='Modules\Skill\Models\Skill')
                        مهارت
                    @elseif($comment->commentable_type=='Modules\Course\Models\Course')
                        کلاس
                    @endif
                    - {{$comment->commentable->title}}</h1>

            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-info">  متن نظر : </h6>
                    </div>
                    <div class="col-md-2">
                        {{--                            وضعیت :--}}
                        {{--                            {{}}--}}
                    </div>
                    <div class="col-md-1 text-success text">
                        <i class="fa fa-thumbs-o-up "></i>{{$comment->like}}
                    </div>
                    <div class="col-md-1 text-danger">
                        <i class="fa fa-thumbs-o-down "></i>{{$comment->dislike}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{$comment->comment}}
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h5>پاسخ ها</h5><hr>
                        <table id="example1" class="table table-bordered table-sm   display responsive nowrap "
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>متن</th>
                                <th>like</th>
                                <th>dislike</th>
                                <th>زمان ثبت</th>
                                <th>وضعیت</th>
                                <th>تایید/عدم تایید</th>

                                <th>جزئیات</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comment->comments as $comment)
                                <tr>
                                    <td>{{$comment->user->firstName}} {{$comment->user->lastName}}</td>
                                    <td style="width: 100px;max-width: 320px;white-space: nowrap;text-overflow: ellipsis; overflow: hidden;">{{$comment->comment}}</td>
                                    <td>{{$comment->like}}</td>
                                    <td>{{$comment->dislike}}</td>
                                    <td>{{verta($comment->created_at)->format('%d %B  %Y , i: G')}}</td>

                                    <td>
                                        @if($comment->status=='active')
                                            <small class="text-success"> تایید شده</small>
                                        @elseif($comment->status=='deactivate')
                                            <small class="text-danger"> رد شده</small>
                                        @elseif($comment->status=='waiting')
                                            <small class="text-info"> بررسی نشده</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">

                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id, 'status'=>'active'])}}" class="btn btn-sm btn-success"><i
                                                    class="fa fa-check text-withe "></i></a>
                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id, 'status'=>'deactivate'])}}" class="btn btn-sm btn-danger"><i
                                                    class=" fa fa-close text-withe 2"></i></a>
                                        </div>

                                    </td>
                                    <td>
                                        <a href="{{route('admin-comments-show',$comment->id)}}"><i
                                                class="fa fa-list text-warning m-2"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
@endsection

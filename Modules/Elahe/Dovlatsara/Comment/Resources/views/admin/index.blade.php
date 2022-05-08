@extends('AdminMasterNew::master')
@section('urlHeader')نظرات
@endsection
@section('header')
    نظرات
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#all" data-toggle="tab">همه نظرات</a></li>
                    <li class="nav-item"><a class="nav-link" href="#waiting" data-toggle="tab">
                            @if($comments->where('status','waiting')->count()>0)
                                نظرات بررسی نشده
                                <span
                                    class="badge badge-info">{{$comments->where('status','waiting')->count()}}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#active" data-toggle="tab">نظرات تایید شده</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#deactivate" data-toggle="tab">نظرات رد شده</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="all">
                        <table id="example1" class="table table-bordered table-sm   display responsive nowrap "
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>نظر برای</th>
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
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->user->name}} {{$comment->user->sirName}}</td>
                                    <td>
                                        @if($comment->commentable_type=='Modules\Article\Models\Article')
                                            مقاله
                                        @elseif($comment->commentable_type=='Modules\Skill\Models\Skill')
                                            مهارت
                                        @elseif($comment->commentable_type=='Modules\Course\Models\Course')
                                            کلاس
                                        @endif
                                        -{{$comment->commentable->title}}
                                    </td>
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

                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id,'status'=>'active'])}}"
                                               class="btn btn-sm btn-success"><i
                                                    class="fa fa-check text-withe "></i></a>
                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id,'status'=>'deactivate'])}}"
                                               class="btn btn-sm btn-danger"><i
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
                    <div class="tab-pane " id="waiting">
                        <table id="example1" class="table table-bordered table-sm   display responsive nowrap "
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>نظر برای</th>
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
                            @foreach($comments->where('status','waiting') as $comment)
                                <tr>
                                    <td>{{$comment->user->firstName}} {{$comment->user->lastName}}</td>
                                    <td>
                                        @if($comment->commentable_type=='Modules\Article\Models\Article')
                                            مقاله
                                        @elseif($comment->commentable_type=='Modules\Skill\Models\Skill')
                                            مهارت
                                        @elseif($comment->commentable_type=='Modules\Course\Models\Course')
                                            کلاس
                                        @endif
                                        -{{$comment->commentable->title}}
                                    </td>
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
                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id,'status'=>'active'])}}"
                                               class="btn btn-sm btn-success"><i
                                                    class="fa fa-check text-withe "></i></a>
                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id,'status'=>'deactivate'])}}"
                                               class="btn btn-sm btn-danger"><i
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

                    <div class="tab-pane" id="active">
                        <table id="example1" class="table table-bordered table-sm   display responsive nowrap "
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>نظر برای</th>
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
                            @foreach($comments->where('status','active') as $comment)
                                <tr>
                                    <td>{{$comment->user->firstName}} {{$comment->user->lastName}}</td>
                                    <td>
                                        @if($comment->commentable_type=='Modules\Article\Models\Article')
                                            مقاله
                                        @elseif($comment->commentable_type=='Modules\Skill\Models\Skill')
                                            مهارت
                                        @elseif($comment->commentable_type=='Modules\Course\Models\Course')
                                            کلاس
                                        @endif
                                        -{{$comment->commentable->title}}
                                    </td>
                                    <td style="width: 100px;max-width: 320px;white-space: nowrap;text-overflow: ellipsis; overflow: hidden;">{{$comment->comment}}</td>
                                    <td>{{$comment->like}}</td>
                                    <td>{{$comment->dislike}}</td>
                                    <td>{{verta($comment->created_at)->format('%d %B  %Y , i: G')}}</td>

                                    <td>
                                        @if($comment->status=='active')
                                            <small class="text-success"> تایید شده</small>
                                        @elseif($comment->status=='deactivate')
                                            <small class="text-success"> رد شده</small>
                                        @elseif($comment->status=='waiting')
                                            <small class="text-info"> بررسی نشده</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">

                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id,'status'=>'active'])}}"
                                               class="btn btn-sm btn-success"><i
                                                    class="fa fa-check text-withe "></i></a>
                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id,'status'=>'deactivate'])}}"
                                               class="btn btn-sm btn-danger"><i
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
                    <div class="tab-pane" id="deactivate">
                        <table id="example1" class="table table-bordered table-sm   display responsive nowrap "
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>نظر برای</th>
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
                            @foreach($comments->where('status','deactivate') as $comment)
                                <tr>
                                    <td>{{$comment->user->firstName}} {{$comment->user->lastName}}</td>
                                    <td>
                                        @if($comment->commentable_type=='Modules\Article\Models\Article')
                                            مقاله
                                        @elseif($comment->commentable_type=='Modules\Skill\Models\Skill')
                                            مهارت
                                        @elseif($comment->commentable_type=='Modules\Course\Models\Course')
                                            کلاس
                                        @endif
                                        -{{$comment->commentable->title}}
                                    </td>
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

                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id,'status'=>'active'])}}"
                                               class="btn btn-sm btn-success"><i
                                                    class="fa fa-check text-withe "></i></a>
                                            <a href="{{route('admin-comment-change-status',['comment'=>$comment->id,'status'=>'deactivate'])}}"
                                               class="btn btn-sm btn-danger"><i
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

@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش پوزیشن {{$position->name}}
@endsection
@section('header')
{{--    {{$association->parent_id==0?'':$association->createStringAsParents2(\Modules\Association\Entities\Association::find($association->parent_id)->path)}}--}}
    {{--    <ol class="breadcrumb float-sm-right">--}}
    {{--        <li class="breadcrumb-item"><a href="{{ route('category.index.admin',$category->parent_id)}}">دسته بندی ها</a></li>--}}
    {{--        <li class="breadcrumb-item"><a href="{{ route('category.edit.admin',$category->id)}}">ویرایش</a></li>--}}
    {{--    </ol>--}}
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title">ویرایش پوزیشن {{$position->name}}</h1>
                    </div>
                    <form class="form-horizontal" action="{{ route('position.update.admin',$position->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label class="col-form-label"> عنوان *</label>
                                <div>
                                    <input class="form-control" type="text" value="{{$position->title}}"
                                           name="title">
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش پوزیشن</button>
                            <a href="{{ route('position.index.admin')}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection

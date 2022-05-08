@extends('AdminMasterNew::master')
@section('urlHeader')ویجت جدید
@endsection
@section('header')
    {{--    <a type="button" class="btn btn-info btn-sm" href="{{route('category.index.admin', $category->parent_id)}}" style="float: left">--}}
    {{--        <i class="fa fa-arrow-left text-white"></i></a>--}}
    {{--    <ol class="breadcrumb float-sm-right">--}}
    {{--        <li class="breadcrumb-item active"><a href="{{ route('category.index.admin',$parentId)}}">دسته بندی ها</a></li>--}}
    {{--        <li class="breadcrumb-item"><a href={{ route('cities.add',$state_id)}}>Create</a></li>--}}
    {{--    </ol>--}}
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1" ></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start" >
                        <h1 class="card-title">ایجاد ویجت جدید</h1>
                    </div>
                    <form action="{{ route('widget.store.admin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">


                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="link">لینک</label>
                                    <input type="text" name="link" class="form-control" value="{{old('link')}}"
                                           autofocus>
                                <small class="text-danger">{{ $errors->first('link') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="icon">آیکون</label>
                                <input class="form-control filestyle"
                                       name="icon" id="file"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('icon')}}">
                                <small class="text-danger">{{ $errors->first('icon') }}</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد</button>
                            <a href="{{route('widget.index.admin')}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

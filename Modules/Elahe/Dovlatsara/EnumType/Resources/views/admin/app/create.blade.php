@extends('AdminMasterNew::master')
@section('urlHeader')اپلیکیشن
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
                        <h1 class="card-title">اپلیکیشن</h1>
                    </div>
                    <form action="{{ route('app.store.admin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">


                            <div class="form-group">
                                <label for="description">توضیحات</label>

                                @if(isset($appOfWebsite->description))
                                    <input type="text" name="description" class="form-control" value="{{$appOfWebsite->description}}"
                                           autofocus placeholder="توضیحات خود را در این مکان وارد کنید.">
                                @else
                                    <input type="text" name="description" class="form-control" value="{{old('description')}}"
                                           autofocus placeholder="توضیحات خود را در این مکان وارد کنید.">
                                @endif
                                <small class="text-danger">{{ $errors->first('description') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="file">فایل اپ</label>
                                <input class="form-control filestyle"
                                       name="file" id="file"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('file')}}">
                                <small class="text-danger">{{ $errors->first('file') }}</small>
                            </div>
                            @if(isset($appOfWebsite->link))
                                <a href="{{route('app.download.admin', $appOfWebsite->id)}}" download
                                   aria-hidden="true"><img src="{{$appOfWebsite->link}}" alt="" width="60px">
                                    <i class="fa fa-download"></i><span class="mr-3 text-bold">{{$appOfWebsite->title}}</span></a>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد</button>
{{--                            <a href="{{route('cities.index')}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد سوال جدید
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
                        <h1 class="card-title">سوال جدید</h1>
                    </div>
                    <form action="{{ route('commonQuestions.store.admin') }}" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">عنوان سوال</label>

                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="description">توضیحات (پاسخ)</label>

                                <textarea name="description" class="form-control" rows="8">{{old('description')}}</textarea>
{{--                                <input type="text" name="longitude" class="form-control" value="{{old('longitude')}}"--}}
{{--                                       autofocus>--}}
                                <small class="text-danger">{{ $errors->first('description') }}</small>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد سوال</button>
                            <a href="{{route('commonQuestions.index.admin')}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

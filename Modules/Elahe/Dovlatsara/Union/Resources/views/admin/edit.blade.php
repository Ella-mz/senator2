@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش صنف
@endsection
@section('header')
    <ol class="breadcrumb float-sm-right">
{{--        <li class="breadcrumb-item"><a href="{{ route('category.index.admin',$category->parent_id)}}">دسته بندی ها</a></li>--}}
{{--        <li class="breadcrumb-item"><a href="{{ route('category.edit.admin',$category->id)}}">ویرایش</a></li>--}}
    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title">ویرایش صنف</h1>
                    </div>
                    <form action="{{ route('unions.update', $union->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">عنوان صنف</label>

                                <input type="text" name="title" class="form-control" value="{{$union->title}}"
                                       autofocus required>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش صنف</button>
                            <a href="{{ route('unions.index')}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

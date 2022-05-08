@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش نقش
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
                        <h1 class="card-title">ویرایش نقش</h1>
                    </div>
                    <form action="{{ route('role.update', $role->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">عنوان نقش</label>

                                <input type="text" name="name" class="form-control" value="{{$role->name}}"
                                       autofocus required>
                                <small class="text-danger">{{ $errors->first('name') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="enName">عنوان انگلیسی نقش</label>

                                <input type="text" name="enName" class="form-control" value="{{$role->enName}}"
                                       autofocus required>
                                <small class="text-danger">{{ $errors->first('enName') }}</small>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش نقش</button>
                            <a href="{{ route('role.index')}}"
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


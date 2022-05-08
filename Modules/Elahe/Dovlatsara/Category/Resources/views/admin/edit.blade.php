@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش دسته بندی
@endsection
@section('header')
    {{$category->parent_id==0?'':$category->createStringAsParents2(\Modules\Category\Entities\Category::find($category->parent_id)->path)}}
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
                        <h1 class="card-title">ویرایش دسته بندی</h1>
                    </div>
                    <form action="{{ route('category.update.admin', $category->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
{{--                        @method('patch')--}}
                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputName">عنوان دسته بندی</label>
                                <input type="text" name="title" class="form-control" value="{{ $category->title }}">
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            @if($category->parent_id == 0)

                            <div class="form-group">
                                <label for="image">عکس</label>
                                <input class="form-control filestyle"
                                       name="image" id="flag"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('image')}}">
                                <small class="text-danger">{{ $errors->first('image') }}</small>

                                {{--                                <input type="file" name="image" class="btn btn-primary float-right" style="margin-right: 5px;">--}}
                                <div id="delete" style="margin-top: 2%">
                                    @if(isset($category->image))
                                        <img src="{{asset($category->image)}}" width="80">
                                        <i class="fa fa-trash" onclick="deleteFile({{$category->id}})"></i>
                                    @endif
                                </div>
                            </div>
                                @endif
{{--                            <div class="form-group px-4">--}}
{{--                                <label class="col-form-label" for="selected">در صفحه اصلی نمایش داده شود؟ </label>--}}
{{--                                <input class="icheckbox_minimal" type="checkbox" name="selected" id="selected"--}}
{{--                                       @if($category->selected==1) checked @endif>--}}
{{--                            </div>--}}
{{--                            <small class="text text-danger">اگر تعداد دسته بندی های انتخاب شده کمتر از 7 عدد باشد امکان انتخاب این دسته بندی برای نمایش در صفحه اصلی وجود دارد</small>--}}

                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش دسته بندی</button>
                            <a href="{{ route('category.index.admin', $category->parent_id)}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.delete_file')
@endsection

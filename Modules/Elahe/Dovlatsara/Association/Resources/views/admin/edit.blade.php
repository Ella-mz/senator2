@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش صنف
@endsection
@section('header')
    {{$association->parent_id==0?'':$association->createStringAsParents2(\Modules\Association\Entities\Association::find($association->parent_id)->path)}}
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
                        <h1 class="card-title">ویرایش صنف</h1>
                    </div>
                    <form action="{{ route('associations.update.admin', $association->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
{{--                        @method('patch')--}}
                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputName">عنوان صنف</label>
                                <input type="text" name="title" class="form-control" value="{{ $association->title }}">
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
{{--                            @if($category->parent_id == 0)--}}

                            <div class="form-group">
                                <label for="inputName">عکس</label>
                                <input class="form-control filestyle"
                                       name="image" id="flag"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('image')}}">
                                <small class="text-danger">{{ $errors->first('image') }}</small>

                                {{--                                <input type="file" name="image" class="btn btn-primary float-right" style="margin-right: 5px;">--}}
                                <div id="delete" style="margin-top: 2%">
                                    @if(isset($association->image))
                                        <img src="{{asset($association->image)}}" width="80">
                                        <i class="fa fa-trash" onclick="deleteFile({{$association->id}})" style="cursor: pointer"></i>
                                    @endif
                                </div>
                            </div>
{{--                                @endif--}}
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش صنف</button>
                            <a href="{{ route('associations.index.admin', $association->parent_id)}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript">
        function deleteFile(id) {
            jQuery(document).ready(function () {
                if (id) {
                    jQuery.ajax({
                        url: "{{route('associations.deleteFile')}}",
                        data: {
                            'id': id,
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            window.location.reload();

                            // $('#delete').html('');
                        }
                    });
                }
            });
        }
    </script>
@endsection

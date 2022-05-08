@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد صنف جدید
@endsection
@section('header')
    {{$parentId==0?'':$association->createStringAsParents2(\Modules\Association\Entities\Association::find($parentId)->path)}}

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

                        <h1 class="card-title">صنف جدید</h1>
                    </div>
                    <form action="{{ route('associations.store.admin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input  name="parentId2" type="hidden" value="{{$parentId}}">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputName">عنوان صنف</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>

{{--                            @if($parentId == 0)--}}

                            <div class="form-group">
                                <label for="inputName">عکس</label>

                                <input class="form-control filestyle"
                                       name="image" id="flag"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('image')}}">
                                <small class="text-danger">{{ $errors->first('image') }}</small>

                                {{--                                <input type="file" name="image" class="btn btn-primary float-right" >--}}
                            </div>
{{--                                @endif--}}

                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد صنف</button>
                            <a href="{{route('associations.index.admin', $parentId)}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

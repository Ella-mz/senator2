@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد
@endsection
@section('header')
    {{--    <a type="button" class="btn btn-info btn-sm" href="{{route('category.index.admin', $category->parent_id)}}" style="float: left">--}}
    {{--        <i class="fa fa-arrow-left text-white"></i></a>--}}
    {{--    <ol class="breadcrumb float-sm-right">--}}
    {{--        <li class="breadcrumb-item active"><a href="{{ route('category.index.admin',$parentId)}}">دسته بندی ها</a></li>--}}
    {{--        <li class="breadcrumb-item"><a href={{ route('cities.add',$state_id)}}>Create</a></li>--}}
    {{--    </ol>--}}

@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/adminMaster/plugins/colorpicker/bootstrap-colorpicker.min.css')}}">

@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title">{{$setting->fa_tittle}}</h1>
                    </div>
                    <form action="{{ route('setting.store.admin', $setting->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @if($setting->type=='text')
                                <div class="form-group">
                                    <label for="title"> {{$setting->fa_title}}</label>

                                    <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                    >
                                    <small class="text-danger">{{ $errors->first('title') }}</small>

                                </div>
                            @elseif($setting->type=='number')
                                <div class="form-group">
                                    <label for="title"> {{$setting->fa_title}}</label>

                                    <input type="number" name="title" class="form-control" value="{{old('title')}}"
                                    >
                                    <small class="text-danger">{{ $errors->first('title') }}</small>

                                </div>
                            @elseif($setting->type=='file')
                                <div class="form-group">
                                    <label> {{$setting->fa_title}}</label>

                                    <input class="form-control filestyle"
                                           name="title" id="flag"
                                           type="file" data-classbutton="btn btn-secondary"
                                           data-classinput="form-control inline"
                                           data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                           value="{{old('title')}}">
                                    <small class="text-danger">{{ $errors->first('title') }}</small>

                                    {{--                                <in  put type="file" name="image" class="btn btn-primary float-right" >--}}
                                </div>
                            @elseif($setting->type=='longtext')
                                <div class="form-group">
                                    <label for="title"> {{$setting->fa_title}}</label>
                                    <textarea name="title" id="description12" rows="5" class="form-control">
                                        {{old('title')}}
                                    </textarea>
                                    {{--                                    <input type="text" name="title" class="form-control" value="{{old('title')}}"--}}
                                    {{--                                    >--}}
                                    <small class="text-danger">{{ $errors->first('title') }}</small>

                                </div>
                            @elseif($setting->type=='color')
                                <div class="form-group">

                                    <label for="title"> {{$setting->fa_title}}</label>
                                    <input type="text" name="title" value="{{old('title')}}"
                                           class="form-control my-colorpicker1">
                                </div>
                            @elseif($setting->type=='fileAndLink')
                                <div class="form-group">
                                    <label for="link">  {{$setting->fa_title}}</label>

                                    <input type="text" name="link" class="form-control" value="{{old('link')}}"
                                    >
                                    <small class="text-danger">{{ $errors->first('link') }}</small>

                                </div>
                                <div class="form-group">
                                    <label> </label>

                                    <input class="form-control filestyle"
                                           name="title" id="flag"
                                           type="file" data-classbutton="btn btn-secondary"
                                           data-classinput="form-control inline"
                                           data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                           value="{{old('title')}}">
                                    <small class="text-danger">{{ $errors->first('title') }}</small>

                                    {{--                                <in  put type="file" name="image" class="btn btn-primary float-right" >--}}
                                </div>

                            @endif
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد</button>
                            <a href="{{route('setting.index.admin')}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{asset('files/adminMaster/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script>
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
    </script>
@endsection

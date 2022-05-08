@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد هولوگرام جدید
@endsection
@section('header')
{{--    گروه مشخصه دسته بندی {{$category->createStringAsParents2(\Modules\Category\Entities\Category::find($category->parent_id)->path)}}--}}
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
                        <h1 class="card-title">هولوگرام جدید</h1>
                    </div>
                    <form action="{{ route('holograms.store.admin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">عنوان هولوگرام</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="price">هزینه هولوگرام</label><br>
                                <small class="text-secondary">هزینه به ریال وارد شود</small>
                                <input type="number" name="price" class="form-control" value="{{old('price')}}"
{{--                                       autofocus onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out3').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('price') }}</small>

                            </div>
                            <small id="demo_out3"></small>

                            <div class="form-group">
                                <label for="hologram_type">نوع هولوگرام</label>

                                <select class="form-control select2" name="hologram_type" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">نوع هولوگرام</option>
                                    <option value="ad" @if('ad' == old('hologram_type'))
                                    selected @endif class="form-control">آگهی</option>
                                    <option value="user" @if('user' == old('hologram_type'))
                                    selected @endif class="form-control">کاربر</option>
                                </select>
                                <small class="text-danger">{{ $errors->first('hologram_type') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="description">توضیحات</label>
                                <textarea name="description" rows="5" class="form-control">{{old('description')}}</textarea>
                                <small class="text-danger">{{ $errors->first('description') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="logo">لوگو</label>

                                <input class="form-control filestyle"
                                       name="logo" id="flag"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('logo')}}">
                                <small class="text-danger">{{ $errors->first('logo') }}</small>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد هولوگرام</button>
                            <a href="{{route('holograms.index.admin')}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{asset('files/adminMaster/dist/js/numtostr.js')}}"></script>

@endsection

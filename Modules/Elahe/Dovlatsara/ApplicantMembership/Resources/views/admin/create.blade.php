@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد حق اشتراک جدید
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
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start">
                        <h1 class="card-title">حق اشتراک جدید</h1>
                    </div>
                    <form action="{{ route('applicant-memberships.store') }}" method="post">
                        @csrf
                        <div class="card-body">
{{--                            <div class="form-group">--}}
{{--                                <label for="category">دسته بندی</label>--}}
{{--                                <select class="form-control select2" name="category"--}}
{{--                                        style="width: 100%;">--}}
{{--                                    <option value="" disabled >دسته بندی</option>--}}
{{--                                    @foreach($categories as $category)--}}
{{--                                        <option value="{{$category->id}}" @if($category->id == old('category'))--}}
{{--                                        selected @endif class="form-control">{{$category->title}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <small class="text-danger">{{ $errors->first('category') }}</small>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="title">عنوان حق اشتراک</label>

                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus >
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="role_type[]">نقش</label>
                                <select class="form-control select2" name="role_type[]"
                                        style="width: 100%;text-align: right"
                                        multiple="multiple">
                                    {{--                                @foreach($roles as $role)--}}
                                    {{--                                    <option value="{{$role->id}}" @if($role->id == old('package_type'))--}}
                                    {{--                                    selected @endif class="form-control">{{$role->title}}</option>--}}
                                    {{--                                    @endforeach--}}
                                    @foreach($role_array as $role)
                                        <option value="{{$role->slug}}" @if($role->slug == old('role_type'))
                                        selected @endif class="form-control">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('role_type') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="duration">مدت زمان اعتبار</label><br>
                                <small class="text-secondary">واحد مدت زمان اعتبار روز باشد.</small>

                                <input type="text" name="duration" class="form-control" value="{{old('duration')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('duration') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="number_of_applications">تعداد درخواست قابل مشاهده</label><br>

                                <input type="text" name="number_of_applications" class="form-control" value="{{old('number_of_applications')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('number_of_applications') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="price">هزینه حق اشتراک</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="price" class="form-control" value="{{old('price')}}"
{{--                                       autofocus onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('price') }}</small>

                            </div>
                            <small id="demo_out"></small>

                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد حق اشتراک</button>
                            <a href="{{route('applicant-memberships.index')}}" class="btn btn-secondary"
                               style="margin-left:1%">لغو</a>
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

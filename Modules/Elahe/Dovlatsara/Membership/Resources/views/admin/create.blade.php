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
                    <form action="{{ route('memberships.store') }}" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">عنوان حق اشتراک</label>

                                <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="package_type[]">نوع بسته</label>--}}
{{--                                <select class="form-control select2" name="package_type[]"--}}
{{--                                        style="width: 100%;text-align: right"--}}
{{--                                        multiple="multiple" data-placeholder="">--}}
{{--                                    --}}{{--                                <option value="" disabled selected class="form-control">نوع بسته</option>--}}

{{--                                    <option value="general" @if('general' == old('package_type'))--}}
{{--                                    selected @endif>عادی--}}
{{--                                    </option>--}}
{{--                                    @if($hasScalar)--}}
{{--                                        <option value="scalar" @if('scalar' == old('package_type'))--}}
{{--                                        selected @endif>نردبانی--}}
{{--                                        </option>--}}
{{--                                    @endif--}}
{{--                                    @if($hasSpecial)--}}

{{--                                        <option value="special" @if('special' == old('package_type'))--}}
{{--                                        selected @endif>ویژه--}}
{{--                                        </option>--}}
{{--                                    @endif--}}
{{--                                    @if($hasEmergency)--}}

{{--                                        <option value="emergency" @if('emergency' == old('package_type'))--}}
{{--                                        selected @endif >فوری--}}
{{--                                        </option>--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                                <small class="text-danger">{{ $errors->first('package_type') }}</small>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="role_type[]">نقش</label>--}}
{{--                                <select class="form-control select2" name="role_type[]"--}}
{{--                                        style="width: 100%;text-align: right"--}}
{{--                                        multiple="multiple">--}}
{{--                                    @foreach($role_array as $role)--}}
{{--                                        <option value="{{$role->slug}}" @if($role->slug == old('role_type'))--}}
{{--                                        selected @endif class="form-control">{{$role->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <small class="text-danger">{{ $errors->first('role_type') }}</small>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="score">امتیاز حق اشتراک</label>
                                <input type="text" name="score" class="form-control"
                                       value="{{old('score')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('score') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="duration">مدت زمان اعتبار</label><br>
                                <small class="text-secondary">واحد مدت زمان اعتبار روز باشد.</small>

                                <input type="text" name="duration" class="form-control" value="{{old('duration')}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('duration') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="price">هزینه حق اشتراک</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="price" class="form-control" value="{{old('price')}}"
{{--                                       autofocus onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out3').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('price') }}</small>

                            </div>
                            <small id="demo_out3"></small>

                            <div class="form-group">
                                <label for="description">توضیحات</label><br>
                                <textarea name="description" class="form-control" rows="5">{{old('description')}}</textarea>
                                <small class="text-danger">{{ $errors->first('description') }}</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد حق اشتراک</button>
                            <a href="{{route('memberships.index')}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
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

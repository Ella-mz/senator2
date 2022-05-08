@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش حق اشتراک
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
                        <h1 class="card-title">ویرایش حق اشتراک</h1>
                    </div>
                    <form action="{{ route('memberships.update', $membership->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">عنوان حق اشتراک</label>

                                <input type="text" name="title" class="form-control" value="{{$membership->title}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="package_type">نوع بسته</label>--}}
{{--                                <select class="form-control select2" name="package_type" style="width: 100%;">--}}
{{--                                    <option value="" disabled selected class="form-control">نوع بسته</option>--}}
{{--                                    <option value="general" @if('general' == $membership->package_type)--}}
{{--                                    selected @endif class="form-control">عادی--}}
{{--                                    </option>--}}
{{--                                    @if($hasScalar)--}}

{{--                                        <option value="scalar" @if('scalar' == $membership->package_type)--}}
{{--                                        selected @endif class="form-control">نردبانی--}}
{{--                                        </option>--}}
{{--                                    @endif--}}
{{--                                    @if($hasSpecial)--}}

{{--                                        <option value="special" @if('special' == $membership->package_type)--}}
{{--                                        selected @endif class="form-control">ویژه--}}
{{--                                        </option>--}}
{{--                                    @endif--}}
{{--                                    @if($hasEmergency)--}}

{{--                                        <option value="emergency" @if('emergency' == $membership->package_type)--}}
{{--                                        selected @endif class="form-control">فوری--}}
{{--                                        </option>--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                                <small class="text-danger">{{ $errors->first('package_type') }}</small>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="role_type">نقش</label>--}}
{{--                                <select class="form-control select2" name="role_type" style="width: 100%;">--}}
{{--                                    <option value="" disabled selected>نوع نقش</option>--}}
{{--                                    @foreach($role_array as $role)--}}
{{--                                        <option value="{{$role->slug}}" @if($role->slug == $membership->role_type)--}}
{{--                                        selected @endif class="form-control">{{$role->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <small class="text-danger">{{ $errors->first('role_type') }}</small>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="score">امتیاز حق اشتراک</label>
                                <input type="text" name="score" class="form-control"
                                       value="{{$membership->score}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('score') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="duration">مدت زمان اعتبار</label><br>
                                <small class="text-secondary">واحد مدت زمان اعتبار روز باشد.</small>

                                <input type="text" name="duration" class="form-control"
                                       value="{{$membership->duration}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('duration') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="price">هزینه حق اشتراک</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="price" class="form-control" value="{{$membership->price}}"
{{--                                       autofocus required onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out3').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('price') }}</small>

                            </div>
                            <small id="demo_out3"></small>

                            <div class="form-group">
                                <label for="description">توضیحات</label><br>
                                <textarea name="description" class="form-control" rows="5">{{$membership->description??old('description')}}</textarea>
                                <small class="text-danger">{{ $errors->first('description') }}</small>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش حق اشتراک</button>
                            <a href="{{ route('memberships.index')}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
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

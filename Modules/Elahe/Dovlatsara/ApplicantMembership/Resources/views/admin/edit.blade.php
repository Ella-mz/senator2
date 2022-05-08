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
                    <form action="{{ route('applicant-memberships.update', $membership->id) }}"
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
                            <div class="form-group">
                                <label for="role_type">نقش</label>
                                <select class="form-control select2" name="role_type" style="width: 100%;">
                                    <option value="" disabled selected>نوع نقش</option>
                                    @foreach($role_array as $role)
                                        <option value="{{$role->slug}}" @if($role->slug == $membership->role_type)
                                        selected @endif class="form-control">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('role_type') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="duration">مدت زمان اعتبار</label><br>
                                <small class="text-secondary">واحد مدت زمان اعتبار روز باشد.</small>

                                <input type="text" name="duration" class="form-control" value="{{$membership->duration}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('duration') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="number_of_applications">تعداد درخواست قابل مشاهده</label><br>
                                <input type="text" name="number_of_applications" class="form-control" value="{{$membership->number_of_applications}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('number_of_applications') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="price">هزینه حق اشتراک</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="price" class="form-control" value="{{$membership->price}}"
{{--                                       autofocus onkeyup="separateNum(this.value,this);"--}}
                                       onkeyup="document.getElementById('demo_out').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('price') }}</small>

                            </div>
                            <small id="demo_out"></small>

                        </div>
                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش حق اشتراک</button>
                            <a href="{{ route('applicant-memberships.index')}}"
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

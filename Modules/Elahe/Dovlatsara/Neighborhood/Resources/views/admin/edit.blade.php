@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش محله
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
                        <h1 class="card-title">ویرایش محله</h1>
                    </div>
                    <form action="{{ route('neighborhoods.update', $neighborhood->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">عنوان محله</label>

                                <input type="text" name="title" class="form-control" value="{{$neighborhood->title}}"
                                       autofocus required>
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="longitude">طول جغرافیایی</label>

                                <input type="text" name="longitude" class="form-control" value="{{$neighborhood->longitude}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('longitude') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="latitude">عرض جغرافیایی</label>

                                <input type="text" name="latitude" class="form-control" value="{{$neighborhood->latitude}}"
                                       autofocus>
                                <small class="text-danger">{{ $errors->first('latitude') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="geographicalDirection">جهت جغرافیایی</label>
                                <select class="form-control select2" name="geographicalDirection" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">جهت جغرافیایی</option>
                                    <option value="North" @if('North' == $neighborhood->geographicalDirection)
                                    selected @endif class="form-control">شمال</option>
                                    <option value="South" @if('South' == $neighborhood->geographicalDirection)
                                    selected @endif class="form-control">جنوب</option>
                                    <option value="East" @if('East' == $neighborhood->geographicalDirection)
                                    selected @endif class="form-control">شرق</option>
                                    <option value="West" @if('West' == $neighborhood->geographicalDirection)
                                    selected @endif class="form-control">غرب</option>
                                    <option value="Center" @if('Center' == $neighborhood->geographicalDirection)
                                    selected @endif class="form-control">مرکز</option>
                                </select>
                                <small class="text-danger">{{ $errors->first('geographicalDirection') }}</small>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش محله</button>
                            <a href="{{ route('neighborhoods.index.admin', $neighborhood->city_id)}}"
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


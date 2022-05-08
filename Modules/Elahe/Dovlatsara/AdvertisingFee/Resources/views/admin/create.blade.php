@extends('AdminMasterNew::master')
@section('urlHeader')ایجاد هزینه جدید
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
            <div class="col-md-1" ></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header d-flex align-content-start justify-content-start" >
                        <h1 class="card-title">هزینه جدید</h1>
                    </div>
                    <form action="{{ route('advertising-fees.store') }}" method="post">
                        @csrf
                        <input  name="category" type="hidden" value="{{$category->id}}">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">مدت زمان انقضای آگهی ها</label><br>
                                <small class="text-secondary">تعداد روز وارد شود.</small>

                                <input type="text" name="expireTimeOfAds" class="form-control" value="{{old('expireTimeOfAds')}}"
                                       autofocus required>
                                <small class="text-danger">{{ $errors->first('expireTimeOfAds') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="title">هزینه به ازای هر آگهی عادی</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="generalAdFee" class="form-control" value="{{old('generalAdFee')}}"
                                       autofocus required onkeyup="separateNum(this.value,this);">
                                <small class="text-danger">{{ $errors->first('generalAdFee') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="title">هزینه به ازای هر آگهی نردبانی</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="scalarAdFee" class="form-control" value="{{old('scalarAdFee')}}"
                                       autofocus required onkeyup="separateNum(this.value,this);">
                                <small class="text-danger">{{ $errors->first('scalarAdFee') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="title">هزینه به ازای هر آگهی ویژه</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="specialAdFee" class="form-control" value="{{old('specialAdFee')}}"
                                       autofocus required onkeyup="separateNum(this.value,this);">
                                <small class="text-danger">{{ $errors->first('specialAdFee') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="title">هزینه به ازای هر آگهی فوری</label><br>
                                <small class="text-secondary">مبلغ به ریال وارد شود.</small>

                                <input type="text" name="emergencyAdFee" class="form-control" value="{{old('emergencyAdFee')}}"
                                       autofocus required onkeyup="separateNum(this.value,this);">
                                <small class="text-danger">{{ $errors->first('emergencyAdFee') }}</small>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد هزینه</button>
                            <a href="{{route('advertisingFee.index.admin', $category->id)}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

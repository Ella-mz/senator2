@extends('AdminMasterNew::master')
@section('urlHeader')درباره ما
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
                        <h1 class="card-title">درباره ما</h1>
                    </div>
                    <form action="{{ route('aboutUs.store.admin') }}" method="post">
                        @csrf
                        <div class="card-body">


                            <div class="form-group">
                                <label for="description">توضیحات</label>

                                @if(isset($aboutUs->description))
                                    <textarea class="form-control" rows="5" type="text"
                                              name="description"
                                              placeholder="توضیحات خود را در این مکان وارد کنید.">{{$aboutUs->description}}</textarea>
                                @else
                                    <textarea class="form-control" rows="5" type="text"
                                              name="description"
                                              placeholder="توضیحات خود را در این مکان وارد کنید.">{{old('description')}}</textarea>
                                @endif
                                <small class="text-danger">{{ $errors->first('description') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="mobile">موبایل</label>

                                @if(isset($aboutUs->mobile))
                                    <input type="text" name="mobile" class="form-control" value="{{$aboutUs->mobile}}"
                                           autofocus>
                                @else
                                <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}"
                                       autofocus>
                                @endif
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="email">ایمیل</label>

                                @if(isset($aboutUs->email))
                                    <input type="text" name="email" class="form-control" value="{{$aboutUs->email}}"
                                    autofocus>
                                @else
                                    <input type="text" name="email" class="form-control" value="{{old('email')}}"
                                           autofocus>
                                @endif
                                <small class="text-danger">{{ $errors->first('email') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="phone">تلفن ثابت</label>

                                @if(isset($aboutUs->phone))
                                    <input type="text" name="phone" class="form-control" value="{{$aboutUs->phone}}"
                                    autofocus>
                                @else
                                    <input type="text" name="phone" class="form-control" value="{{old('phone')}}"
                                           autofocus>
                                @endif
                                <small class="text-danger">{{ $errors->first('phone') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="link">لینک</label>

                                @if(isset($aboutUs->link))
                                    <input type="text" name="link" class="form-control" value="{{$aboutUs->link}}"
                                    autofocus>
                                @else
                                    <input type="text" name="link" class="form-control" value="{{old('link')}}"
                                           autofocus>
                                @endif
                                <small class="text-danger">{{ $errors->first('link') }}</small>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ایجاد</button>
{{--                            <a href="{{route('cities.index')}}" class="btn btn-secondary" style="margin-left:1%">لغو</a>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('RealestateMaster::master')
@section('title_realestate')ایجاد پروژه
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">ایجاد پروژه</h3>


                    </div>

                    <!-- /.card-header -->
                    <form action="{{route('contractorProject.store.realestate')}}" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">عنوان پروژه</label>

                                        <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                               autofocus>
                                        <small class="text-danger">{{ $errors->first('title') }}</small>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo">تصویر</label>

                                        <input class="form-control filestyle"
                                               name="images[]" multiple
                                               type="file" data-classbutton="btn btn-secondary"
                                               data-classinput="form-control inline"
                                               data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                               value="{{old('images')}}">
                                        <small class="text-danger">{{ $errors->first('images') }}</small>
{{--                                        <div id="userImage" style="margin-top: 2%">--}}
{{--                                            @if(isset($user->shop_logo))--}}
{{--                                                <img src2="{{asset($user->shop_logo)}}" width="80">--}}
{{--                                                <i class="fa fa-trash" onclick="deleteFiles('{{$user->id}}', 'logo')"></i>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>توضیحات</label>
                                        <textarea name="description" type="text" class="form-control" rows="5"
                                                  placeholder="توضیحات مربوط به پروژه خود را وارد کنید.">{{old('description')}}</textarea>
                                        <small class="text-danger">{{ $errors->first('description') }}</small>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn float-right" style="background-color: #3c3cce;color: #fff">ایجاد پروژه</button>
                            <a href="{{route('contractorProject.index.realestate')}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>


                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js_realestate')
@endsection

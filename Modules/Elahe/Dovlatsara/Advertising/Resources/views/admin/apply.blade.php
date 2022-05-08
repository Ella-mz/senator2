@extends('AdminMasterNew::master')
@section('urlHeader'){{$advertising->title}}
@endsection
@section('header')
@endsection
@section('content')
    <section class="content">
        {{--        <div class="container-fluid">--}}
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-bold">درخواست تبلیغ</h3>

                        <div class="card-tools">

                            {{--                        <div class="input-group input-group-sm" style="width: 150px;">--}}
                            {{--                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">--}}

                            <div class="input-group-append">
                                {{--                                    <a href="{{route('hologram.index.user.realestate')}}"--}}
                                {{--                                       class="btn btn-info btn-sm"><i class="fa fa-arrow-left text-white"></i></a>--}}
                            </div>
                            {{--                        </div>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    {{--                        <div class="card-body table-responsive p-0">--}}
                    {{--                            <table class="table table-hover">--}}
                    {{--                                <tr>--}}
                    {{--                                    <th>عنوان</th>--}}
                    {{--                                    <td>{{$hologram->title}}</td>--}}
                    {{--                                </tr>--}}

                    {{--                                <tr>--}}

                    {{--                                    <th>قیمت</th>--}}
                    {{--                                    <td>{{$hologram->price}}</td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <th>لوگو</th>--}}
                    {{--                                    <td>--}}
                    {{--                                        @if(isset($hologram->logo))--}}
                    {{--                                            <img src="{{asset($hologram->logo)}}" width="80"--}}
                    {{--                                                 height="40">--}}
                    {{--                                        @endif--}}

                    {{--                                    </td>--}}
                    {{--                                </tr>--}}
                    {{--                            </table>--}}
                    {{--                        </div>--}}
                    {{--                        <hr>--}}
                    <div class="card-body">
                        <div class="callout callout-info">
                            <h5>توضیحات</h5>
                            <p>{{$advertising->description}} </p>
                        </div>
                        <form method="post" action="{{route('advertisings.apply.submit.admin')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <input name="cat" value="{{$advertising->advertisingOrder->page->hasCategory}}" hidden>

                            <input hidden name="advertising_id" value="{{$advertising->id}}">
                            {{--                                <input hidden name="type_id" value="{{$id}}">--}}

                            <div class="row">

                                @if($advertising->advertisingOrder->page->hasCategory)
                                    <div class="col-md-12 mt-5">
                                        <label class="control-label mb-3">دسته بندی ها</label><br>
                                        <select name="category" class="form-control">
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                        @if($category->id==old('category')) selected @endif>{{$category->createStringAsParents()}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('category') }}</small>

                                    </div>

                                @endif
                                    @if($advertising->advertisingOrder->page->hasUser)
                                        <div class="col-md-12 mt-5">
                                            <label class="control-label mb-3">کسب و کار ها</label><br>
                                            <select name="user" class="form-control">
                                                <option value=""></option>
                                                @foreach($agencies as $user)
                                                    <option value="{{$user->id}}"
                                                            @if($user->id==old('user')) selected @endif>{{$user->shop_title}} - {{$user->slug}}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('user') }}</small>

                                        </div>

                                    @endif
                                <label class="control-label mb-3 mt-5">تاریخ</label>

                                <div class="col-md-12" id="listOfMonth">
                                    {!! $content !!}
                                </div>
                                <small class="text-danger">{{ $errors->first('date') }}</small>

                                <div class="col-md-12 mt-5">
                                    <label class="control-label mb-3">لینک به</label><br>
                                    <input name="link" class="form-control" value="{{old('link')}}">
                                </div>
                                <div class="col-md-6 mt-5">
                                    <label class="control-label" for="image">تصویر تبلیغ شما</label>
                                    <div class="custom-file ">
                                        <input class="form-control filestyle"
                                               name="image" id="image"
                                               type="file" data-classbutton="btn btn-secondary"
                                               data-classinput="form-control inline"
                                               data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;">
                                        <small class="text-danger">{{ $errors->first('image') }}</small>
                                    </div>
                                </div>
                                    <div class="col-md-6 mt-5">
                                        <label class="control-label" for="responsiveImage">تصویر ریسپانسیو تبلیغ شما</label>
                                        <div class="custom-file ">
                                            <input class="form-control filestyle"
                                                   name="responsiveImage" id="responsiveImage"
                                                   type="file" data-classbutton="btn btn-secondary"
                                                   data-classinput="form-control inline"
                                                   data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;">
                                            <small class="text-danger">{{ $errors->first('responsiveImage') }}</small>
                                        </div>
                                    </div>
                            </div>
                            <div class="d-flex justify-content-center align-content-center mt-3"
                                 style=" margin-bottom: 2%">
                                <button type="submit" class="btn btn-info float-right">ارسال درخواست</button>
                                <a href="{{route('advertisings.index.admin')}}"
                                   class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                            </div>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        {{--        </div><!-- /.container-fluid -->--}}
    </section>

@endsection
@section('js')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="category"]').on('change', function () {
                var categoryId = jQuery(this).val();
                if (categoryId) {
                    // console.log(cityId)
                    jQuery.ajax({
                        url: "{{route('getDates.index.admin')}}",
                        data: {
                            'categoryId': categoryId,
                            'advertisingId': '{{$advertising->id}}'
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            // console.log(data);
                            $('#listOfMonth').empty();
                            $('#listOfMonth').append(data.content);
                        }
                    });
                } else {
                    $('#listOfMonth').empty();
                }
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="user"]').on('change', function () {
                var userId = jQuery(this).val();
                if (userId) {
                    // console.log(cityId)
                    jQuery.ajax({
                        url: "{{route('getDates.user.index.admin')}}",
                        data: {
                            'userId': userId,
                            'advertisingId': '{{$advertising->id}}'
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#listOfMonth').empty();
                            $('#listOfMonth').append(data.content);
                        }
                    });
                } else {
                    $('#listOfMonth').empty();
                }
            });
        });
    </script>

@endsection

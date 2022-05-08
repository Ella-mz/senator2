@extends('RealestateMaster::master')
@section('title_realestate') {{$hologram->title}}
@endsection
@section('card_title') {{$hologram->title}}
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">
                </div>
                <!-- /.col -->
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">درخواست هولوگرام</h3>

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

                            <div class="callout callout-costumBlue">
                                <h5>توضیحات</h5>
                                <p>{{$hologram->description}} </p>
                            </div>
                            <form method="post" action="{{route('hologram.apply.realestate')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <input hidden name="hologram_id" value="{{$hologram->id}}">
                                <input hidden name="type_id" value="{{$id}}">

                                <div class="row">
                                    <div class="col-md-12 mt-5">
                                        <label class="control-label mb-3">توضیحات درخواست</label><br>
                                        <textarea name="description" rows="5"
                                                  class="form-control">{{old('description')}}</textarea>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <label class="control-label mb-3">جهت افزودن هر فایل کلیک کنید</label><br>
                                        <button class="btn btn-sm" type="button" id="add_holo_file_create"
                                                style="background-color: #3c3cce;color: #fff">افزودن فایل جدید
                                        </button>

                                    </div>
                                </div>
                                <div id="holo_file_create"></div>
                                <div class="d-flex justify-content-center align-content-center mt-3"
                                     style=" margin-bottom: 2%">
                                    <button type="submit" class="btn btn-info float-right">ارسال درخواست</button>
                                    <a href="{{route('hologram.index.realestate', ['type'=>$hologram->type, 'id'=>$id])}}"
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
        </div><!-- /.container-fluid -->
    </section>

@endsection
@section('js_realestate')
    <script>
        $('#add_holo_file_create').click(function () {
            let ad_images = $('#holo_file_create');
            let id = ad_images.children().length;
            ad_images.append(
                createNewHoloFile({
                    id
                })
            )
        })
        // let counter = 0;
        let str = '';
        let createNewHoloFile = ({id}) => {
            // counter = counter+1;
            str = `
            <div class="row" id="holoFile-${id}">
                                <div class="col-md-3 mt-5"></div>
                    <div class="col-md-5 mt-5">
             <label class="control-label" for="holoFile[${id}]">فایل پیوست</label>
            <div class="custom-file ">
                            <input class="form-control filestyle"
                                   name="holoFile[${id}]" id="holoFile[${id}]"
                                   type="file" data-classbutton="btn btn-secondary"
                                   data-classinput="form-control inline"
                                   data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;">
                            <small class="text-danger">{{ $errors->first('holoFile') }}</small>
                            <small class="text-danger">{{ $errors->first('holoFile.*') }}</small>

                        </div>
                        </div>
                        <div class="col-md-1" style="margin-top:60px">
                        <button class="btn btn-primary mt-4" onclick="document.getElementById('holoFile-${id}').remove()">حذف</button>
                        </div>
                        </div>

                        `;

            return str;
        };
    </script>

@endsection

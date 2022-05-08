@extends('AdminMasterNew::master')
@section('urlHeader')ویرایش هولوگرام
@endsection
@section('header')
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="margin-left: 7%; margin-bottom: 1%">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">ویرایش هولوگرام</h1>
                    </div>
                    <form action="{{ route('holograms.update.admin', $hologram->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        <input hidden name="hologram_id" value="{{$hologram->id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">عنوان هولوگرام</label>
                                <input type="text" name="title" class="form-control" value="{{ $hologram->title }}">
                                <small class="text-danger">{{ $errors->first('title') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="price">هزینه هولوگرام</label><br>
                                <small class="text-secondary">هزینه به ریال وارد شود</small>
                                <input type="number" name="price" class="form-control" value="{{ $hologram->price }}"
                                       onkeyup="document.getElementById('demo_out3').innerHTML = Num2persian(this.value)">
                                <small class="text-danger">{{ $errors->first('price') }}</small>

                            </div>
                            <small id="demo_out3"></small>

                            <div class="form-group">
                                <label for="hologram_type">نوع هولوگرام</label>

                                <select class="form-control select2" name="hologram_type" style="width: 100%;">
                                    <option value="" disabled selected class="form-control">نوع هولوگرام</option>
                                    <option value="ad" @if('ad' == $hologram->type)
                                    selected @endif class="form-control">آگهی</option>
                                    <option value="user" @if('user' == $hologram->type)
                                    selected @endif class="form-control">کاربر</option>
                                </select>
                                <small class="text-danger">{{ $errors->first('hologram_type') }}</small>

                            </div>
                            <div class="form-group">
                                <label for="description">توضیحات</label>
                                <textarea name="description" rows="5" class="form-control">{{$hologram->description??old('description')}}</textarea>
                                <small class="text-danger">{{ $errors->first('description') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="logo">لوگو</label>
                                <input class="form-control filestyle"
                                       name="logo" id="flag"
                                       type="file" data-classbutton="btn btn-secondary"
                                       data-classinput="form-control inline"
                                       data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;"
                                       value="{{old('logo')}}">
                                <small class="text-danger">{{ $errors->first('logo') }}</small>

                                <div id="delete" style="margin-top: 2%">
                                    @if(isset($hologram->logo))
                                        <img src="{{asset($hologram->logo)}}" width="80">
                                        <i class="fa fa-trash" onclick="deleteFile({{$hologram->id}})" style="cursor: pointer"></i>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn btn-success float-right">ویرایش هولوگرام</button>
                            <a href="{{ route('holograms.index.admin')}}"
                               class="btn btn-secondary" style="margin-left: 1%">لغو</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript">
        function deleteFile(id) {
            jQuery(document).ready(function () {
                if (id) {
                    jQuery.ajax({
                        url: "{{route('holograms.deleteFile')}}",
                        data: {
                            'id': id,
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#delete').html('');
                        }
                    });
                }
            });
        }
    </script>
    <script src="{{asset('files/adminMaster/dist/js/numtostr.js')}}"></script>

@endsection


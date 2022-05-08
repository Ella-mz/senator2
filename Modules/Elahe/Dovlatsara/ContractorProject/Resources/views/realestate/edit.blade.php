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
                    <form action="{{route('contractorProject.update.realestate', $contractorProject->id)}}" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">عنوان پروژه</label>

                                        <input type="text" name="title" class="form-control" value="{{$contractorProject->title}}"
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
                                        <div style="margin-top: 2%">
                                            @if(($contractorProject->contractorProjectImages()->count()>0))
                                                @foreach($contractorProject->contractorProjectImages as $image)
                                                <img src="{{asset($image->image)}}" width="80" class="rounded">
                                                <i class="fa fa-trash" onclick="deleteimages('{{$image->id}}', 'image')" style="cursor: pointer"></i>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>توضیحات</label>
                                        <textarea name="description" type="text" class="form-control" rows="5"
                                                  placeholder="توضیحات مربوط به پروژه خود را وارد کنید.">{{$contractorProject->description}}</textarea>
                                        <small class="text-danger">{{ $errors->first('description') }}</small>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-content-end" style=" margin-bottom: 2%">
                            <button type="submit" class="btn float-right" style="background-color: #3c3cce;color: #fff">ویرایش پروژه</button>
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

    <script type="text/javascript">
        @if($contractorProject->contractorProjectImages)
        function deleteimages(id) {
            jQuery(document).ready(function () {
                if (id) {
                    jQuery.ajax({
                        url: '{{route('deleteContractorProjectImage.realestate')}}',
                        data: {
                            'id': id,
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            // console.log(data == true)
                            if (data.success == true) {
                                // $('#oldImage').html('');
                                window.location.reload();

                            }
                        }
                    });
                }
            });
        }
        @endisset
    </script>
@endsection

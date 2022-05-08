@extends('RealestateMaster::master')
@section('title_realestate')هولوگرام
@endsection
@section('card_title') {{$hologramInterface->hologram->title}}
@endsection
@section('content_realestateMaster')
    <div class="modal fade" id="approveHologram" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="approveHologramForm" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">تایید درخواست</h5>
                    </div>
                    <div class="modal-body">
                        <div id="success2" class="w-100"></div>
                        <div id="error2"></div>
                        <input class="form-control" name="hologram_interface_id" hidden>
                        <input class="form-control" name="expert" hidden>
                        <div class="row">
                            <div class="col-md-1 mb-3"></div>
                            <div class="col-md-10 mb-3">
                                <label class="col-form-label"> توضیحات خود را برای درخواست کننده بنویسید </label><br>
                                <small class="text-danger">بعد از تایید درخواست امکان تغییر آن وجود ندارد</small>

                                <div>
                                    <textarea name="expert_description" rows="5" class="form-control">{{old('expert_description')}}</textarea>

                                    {{--                                    <input class="form-control" name="itemtitle" type="text">--}}
                                    <small class="text-danger">{{ $errors->first('expert_description') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-white btn-sm" data-dismiss="modal">انصراف
                            </button>
                            <button type="submit" class="btn btn-success btn-sm " id="approveHologramButton">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notApproveHologram" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="notApproveHologramForm" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">رد درخواست</h5>
                    </div>
                    <div class="modal-body">
                        <div id="success1" class="w-100"></div>
                        <div id="error1"></div>
                        <input class="form-control" name="hologram_interface_id" hidden>
                        <input class="form-control" name="expert" hidden>
                        <div class="row">
                            <div class="col-md-1 mb-3"></div>
                            <div class="col-md-10 mb-3">
                                <label class="col-form-label"> توضیحات خود را برای درخواست کننده بنویسید </label><br>
                                <small class="text-danger">بعد از رد درخواست امکان تغییر آن وجود ندارد</small>
                                <div>
                                    <textarea name="expert_description" rows="5" class="form-control">{{old('expert_description')}}</textarea>
                                    {{--                                    <input class="form-control" name="itemtitle" type="text">--}}
                                    <small class="text-danger">{{ $errors->first('expert_description') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-white btn-sm" data-dismiss="modal">انصراف
                            </button>
                            <button type="submit" class="btn btn-success btn-sm " id="notApproveHologramButton">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 text-right">
{{--                                @if($hologramInterface->status=='pending')--}}

                                    <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveHologram"
                                       data-attribute="{{$hologramInterface->status }}" data-id="{{$hologramInterface->id }}"
                                       data-expert="{{$hologramInterface->expert_id }}">تایید</a>
                                    <a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#notApproveHologram"
                                       data-attribute="{{$hologramInterface->status }}" data-id="{{$hologramInterface->id }}"
                                       data-expert="{{$hologramInterface->expert_id }}">عدم تایید</a>
{{--                                @endif--}}

                            </div>                            <div class="col-md-6 text-left">
                                @if($hologramInterface->status=='pending')
                                    <a type="button" class="btn btn-info btn-sm"
                                       href="{{route('hologramInterface.index.realestate', 'pending')}}"><i
                                            class="fa fa-arrow-left text-white"></i></a>
                                @else
                                    <a type="button" class="btn btn-info btn-sm"
                                       href="{{route('hologramInterface.index.realestate', 'checked')}}"><i
                                            class="fa fa-arrow-left text-white"></i></a>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 py-5">
                            <div class="card">
                                <div class="card-title mr-2 mt-2 text-bold">اطلاعات درخواست</div>
                                <div class="card-body table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            @if($hologramInterface->type=='ad')
                                                <th>عنوان آگهی</th>
                                                <td>{{$hologramInterface->ad->title}}</td>
                                            @elseif($hologramInterface->type == 'user')
                                                @if(\Modules\User\Entities\User::find($hologramInterface->type_id)->hasRole('real-state-administrator'))
                                                    <th>عنوان کسب و کاری</th>
                                                    <td>{{$hologramInterface->user->shop_title}}</td>
                                                @else
                                                    <th>نام و نام خانوادگی</th>
                                                    <td>{{$hologramInterface->user->name}} {{$hologramInterface->user->sirName}}</td>
                                                @endif

                                            @endif

                                        </tr>
                                        <tr>

                                            <th>هولوگرام</th>
                                            @if(isset($hologramInterface->hologram->logo))
                                                <td width="80" height="40">
                                                    <img
                                                        src="{{asset($hologramInterface->hologram->logo)}}"
                                                        width="80" height="40">
                                                </td>
                                            @else
                                                <td width="80" height="40">
                                                </td>
                                            @endif
                                        </tr>

                                        <tr>

                                            <th>تاریخ درخواست</th>
                                            <td>{{verta($hologramInterface->created_at)->formatJalaliDatetime()}}</td>
                                        </tr>
                                        <tr>

                                            <th>مبلغ پرداختی</th>
                                            <td>{{number_format($hologramInterface->hologram_price)}}</td>
                                        </tr>
                                        <tr>

                                            <th>وضعیت</th>
                                            <td>
                                                @if($hologramInterface->status=='pending')
                                                    در انتظار بررسی
                                                @elseif($hologramInterface->status == 'approved')
                                                    تایید شده
                                                @elseif($hologramInterface->status == 'notApproved')
                                                    تایید نشده
                                                @endif
                                            </td>

                                        </tr>
                                        {{--                        <tr>--}}

                                        {{--                            <th>فعال/غیرفعال</th>--}}
                                        {{--                            <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</td>--}}

                                        {{--                        </tr>--}}
                                    </table>
                                    @if(isset($hologramInterface->description))
                                        <div class="row p-4">
                                            <div class="callout callout-costumBlue" style="width: 100%">
                                                <h5>توضیحات درخواست دهنده </h5>

                                                <p class="mt-4">{{$hologramInterface->description}} </p><br>
                                                <p>زمان
                                                    درخواست: {{verta($hologramInterface->created_at)->formatJalaliDatetime()}}</p>
                                            </div>

                                        </div>
                                    @endif
                                    @if(isset($hologramInterface->expert_description) && $hologramInterface->status != 'pending')
                                        <div class="row p-4">
                                            <div class="callout callout-costumBlue" style="width: 100%">
                                                <h5>توضیحات کارشناس </h5>

                                                <p class="mt-4">{{$hologramInterface->expert_description}} </p><br>
                                                <p>زمان
                                                    پاسخگویی: {{verta($hologramInterface->expert_answer_time)->formatJalaliDatetime()}}</p>
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-1"></div>

                        <div class="col-md-1"></div>
                        @if($hologramInterface->hologramInterfaceFiles->count()>0)
                            <div class="col-md-10 py-5">
                                <div class="card">
                                    <div class="card-title mr-2 mt-2 text-bold"> فایل های آپلود شده</div>

                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            @foreach($hologramInterface->hologramInterfaceFiles as $key=>$file)
                                                <tr>
                                                    <th>فایل شماره {{$key+1}}</th>
                                                    <td>
                                                        <a href="{{route('hologramInterface.download.realestate', $file->id)}}" download
                                                           aria-hidden="true">{{$file->file_name}}</a>
                                                        {{--                                                        <i class="fa fa-trash nav-icon" onclick="deletefile({{$key}},{{$message->id}})"--}}
                                                        {{--                                                           id="filedelete"></i>--}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js_realestate')
    <script>
        $('#notApproveHologram').on('show.bs.modal', function (e) {
            var opener = e.relatedTarget;
            var id = $(opener).attr('data-id');
            var expert = $(opener).attr('data-expert');

            $('#notApproveHologramForm').find('[name="hologram_interface_id"]').val(id);
            $('#notApproveHologramForm').find('[name="expert"]').val(expert);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#notApproveHologramForm').on('submit', function (event) {
                event.preventDefault();
                var formData = {
                    'hologram_interface_id': $('input[name=hologram_interface_id]').val(),
                    'expert': $('input[name=expert]').val(),
                };
                var hologram_interface_id = formData["hologram_interface_id"];
                var expert = formData["expert"]
                $.ajax({
                    url: "{{route('hologramInterface.notApproved.realestate')}}",
                    method: "POST",
                    data: new FormData(this),
                    //data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.errorValidation) {
                            $('#error1').empty();
                            $('#error1').append('<small class="text-danger">' + data.errorValidation + '</small>');
                        }
                        if (data.success) {
                            $('#success1').empty();
                            $('#success1').append(data.success);
                            window.setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                    }
                })
            });
        });
    </script>

    <script>
        $('#approveHologram').on('show.bs.modal', function (e) {
            var opener = e.relatedTarget;
            var id = $(opener).attr('data-id');
            var expert = $(opener).attr('data-expert');

            $('#approveHologramForm').find('[name="hologram_interface_id"]').val(id);
            $('#approveHologramForm').find('[name="expert"]').val(expert);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#approveHologramForm').on('submit', function (event) {
                event.preventDefault();
                var formData = {
                    'hologram_interface_id': $('input[name=hologram_interface_id]').val(),
                    'expert': $('input[name=expert]').val(),
                };
                var hologram_interface_id = formData["hologram_interface_id"];
                var expert = formData["expert"]
                $.ajax({
                    url: "{{route('hologramInterface.approved.realestate')}}",
                    method: "POST",
                    data: new FormData(this),
                    //data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.errorValidation) {
                            $('#error2').empty();
                            $('#error2').append('<small class="text-danger">' + data.errorValidation + '</small>');
                        }
                        if (data.success) {
                            $('#success2').empty();
                            $('#success2').append(data.success);
                            window.setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                    }
                })
            });
        });
    </script>
@endsection

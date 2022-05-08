@extends('AdminMasterNew::master')
@section('urlHeader')درخواست تبلیغ
@endsection
@section('header')
@endsection
@section('content')

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <h6 class="card-title"></h6>--}}
                    {{--                    </div>--}}
                    <div class="col-md-6 text-right">
                        {{--                        @if($hologramInterface->status=='pending')--}}

                        {{--                        <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveHologram"--}}
                        {{--                           data-attribute="{{$hologramInterface->status }}" data-id="{{$hologramInterface->id }}"--}}
                        {{--                           data-expert="{{$hologramInterface->expert_id }}">تایید</a>--}}
                        {{--                        <a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#notApproveHologram"--}}
                        {{--                           data-attribute="{{$hologramInterface->status }}" data-id="{{$hologramInterface->id }}"--}}
                        {{--                           data-expert="{{$hologramInterface->expert_id }}">عدم تایید</a>--}}
                        {{--                        @endif--}}

                    </div>

                    <div class="col-md-6 text-left">
                        <a type="button" class="btn btn-info btn-sm"
                           href="{{route('advertisingApplicants.index.admin')}}"><i
                                class="fa fa-arrow-left text-white"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($applicant->image))
                    <div class="col-md-6 py-5">
                        <img style="width: 600px; height: 400px"
                             src="{{asset($applicant->image)}}">
                    </div>
                @endif
                @if(isset($applicant->responsive_image))
                    <div class="col-md-6 py-5">
                        <img style="width: 600px; height: 400px"
                             src="{{asset($applicant->responsive_image)}}">
                    </div>
                @endif

            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 py-5">
                    <div class="card">
                        <div class="card-title mr-2 mt-2 text-bold">اطلاعات درخواست</div>

                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>نام و نام خانوادگی درخواست کننده</th>
                                    <td>{{$applicant->userInfo->name}} {{$applicant->userInfo->sirName}}</td>

                                </tr>
                                <tr>

                                    <th>بسته تبلیغ</th>
                                    <td>{{$applicant->advertising->title}}</td>
                                    {{--                                    @if(isset($hologramInterface->hologram->logo))--}}
                                    {{--                                        <td width="80" height="40">--}}
                                    {{--                                            <img--}}
                                    {{--                                                src2="{{asset($hologramInterface->hologram->logo)}}"--}}
                                    {{--                                                width="80" height="40">--}}
                                    {{--                                        </td>--}}
                                    {{--                                    @else--}}
                                    {{--                                        <td width="80" height="40">--}}
                                    {{--                                        </td>--}}
                                    {{--                                    @endif--}}
                                </tr>
                                @if(isset($applicant->category))
                                    <tr>
                                        <th>دسته بندی انتخاب شده برای نمایش</th>
                                        <td>{{\Modules\Category\Entities\Category::find($applicant->category)->createStringAsParents()}} </td>

                                    </tr>
                                @endif
                                <tr>
                                    <th>لینک به</th>
                                    <td><a href="{{url($applicant->link)}}" target="_blank">{{$applicant->link}}</a>
                                    </td>

                                </tr>
                                <tr>

                                    <th>تاریخ شروع نمایش تبلیغ</th>
                                    <td>{{($applicant->startDate)}}</td>
                                </tr>
                                <tr>

                                    <th>تاریخ پایان نمایش تبلیغ</th>
                                    <td>{{($applicant->endDate)}}</td>
                                </tr>
                                <tr>

                                    <th>مبلغ پرداختی</th>
                                    <td>{{number_format($applicant->advertising->price)}}</td>
                                </tr>
                                <tr>

                                    <th>وضعیت پرداخت</th>
                                    <td>
                                        @if($applicant->isPaid==1)
                                            <span class="badge badge-success">موفق</span>
                                        @else
                                            <span class="badge badge-danger">ناموفق</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>

                                    <th>تعداد بازدید از لینک</th>
                                    <td>
                                        {{$applicant->clickCount}}
                                    </td>

                                </tr>
                                {{--                                @if(isset($applicant->image))--}}
                                <tr>

                                    <th>فایل عکس تبلیغ</th>
                                    <td><a href="{{route('advertisingApplicants.download.admin', ['applicant'=>$applicant->id,'type'=>'image'])}}"
                                           download
                                           aria-hidden="true">{{$applicant->image_title}}</a>
                                    </td>

                                </tr>
                                <tr>

                                    <th>فایل عکس ریسپانسیو تبلیغ</th>
                                    <td><a href="{{route('advertisingApplicants.download.admin', ['applicant'=>$applicant->id,'type'=>'responsive_image'])}}"
                                           download
                                           aria-hidden="true">{{$applicant->responsive_image_title}}</a>
                                    </td>

                                </tr>
                                {{--                                    @endif--}}
                            </table>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js')
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
                    url: "{{route('hologramInterface.notApproved.admin')}}",
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
                    url: "{{route('hologramInterface.approved.admin')}}",
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

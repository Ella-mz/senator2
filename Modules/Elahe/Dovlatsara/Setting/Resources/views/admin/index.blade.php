@extends('AdminMasterNew::master')
@section('urlHeader')تنظیمات
@endsection
@section('header')
    تنظیمات
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                {{--                <a href="{{route('setting.create.admin')}}"--}}
                {{--                   class="btn btn-sm btn-primary" style="float: left">جدید</a>--}}
                <h1 class="card-title" style="float: right">تنظیمات</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap"
                       style="width: 100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>مقدار</th>
                        {{--                        <th>لینک</th>--}}
                        <th>ایجاد/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $key=>$setting)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td style="white-space: normal;">{{$setting->fa_title}}</td>
                            <td style="white-space: normal;">
                                @if($setting->type=='file')
                                    @if(isset($setting->str_value))
                                        <img src="{{asset($setting->str_value)}}" style="width: 50px; height: 50px">
                                    @endif
                                @elseif($setting->type=='number')
                                    {{number_format($setting->str_value)}}

                                @elseif($setting->type=='fileAndLink')
                                    <img src="{{asset($setting->str_value)}}" style="width: 50px; height: 50px">
                                @elseif($setting->type=='longtext')
                                    <button type="button" data-bs-toggle="modal"
                                            value="{{$setting->id}}"
                                            data-target="#exampleModalChatPage"
                                            name="seeMoreModalButtonInSetting"
                                            data-adID="{{$setting->id}}"
                                            id="{{$setting->id}}"
                                            class="contact123 btn btn-info"
                                            onclick="showModalApplicant({{$setting->id}})">
                                        برای نمایش متن کلیلک کنید
                                    </button>
                                @else
                                    {{$setting->str_value}}

                                @endif
                            </td>
                            {{--                            <td style="white-space: normal;">{{$setting->link}}</td>--}}
                            <td>
                                <form action="{{route('setting.delete.admin', $setting->id)}}" method="POST">
                                    @csrf
                                    <a class="btn btn-success btn-sm"
                                       href="{{route('setting.create.admin', $setting->id)}}">
                                        <i class="fa fa-plus"></i>
                                    </a>

                                    {{--                                    <a class="btn btn-danger btn-sm"--}}
                                    {{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                        <i class="fa fa-trash"></i>--}}
                                    {{--                                    </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف این آیتم اطمینان دارید؟')">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
                <div class="modal fade" id="exampleModalDetailRequest1" tabindex="-1"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content applicantModalContent"
                             id="applicantModalContent">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
    <script type="text/javascript">
        function showModalApplicant(settingID) {
            $(function () {
                jQuery.ajax({
                    url: "{{route('get_setting_text.admin')}}",
                    data: {
                        'settingID': settingID,
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('.applicantModalContent').empty();
                        $('.applicantModalContent').append(data.content);
                    }
                });
                $('#exampleModalDetailRequest1').modal('show');

            });
        }

    </script>

@endsection

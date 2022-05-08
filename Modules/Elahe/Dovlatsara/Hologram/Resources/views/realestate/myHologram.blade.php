@extends('RealestateMaster::master')
@section('title_realestate')هولوگرام
@endsection
@section('card_title')هولوگرام {{$hologramInterface->hologram->title}}
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><h6 class="card-title"></h6></div>
                            <div class="col-md-6 text-left"><a type="button" class="btn btn-info btn-sm" href="{{route('hologram.index.realestate', ['type'=>$hologramInterface->type, 'id'=>$hologramInterface->type_id])}}"><i
                                        class="fa fa-arrow-left text-white"></i></a></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 py-5">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            @if($hologramInterface->type=='ad')
                                                <th>عنوان آگهی</th>
                                                <td>{{$hologramInterface->ad->title}}</td>
                                            @elseif($hologramInterface == 'user')
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
                                            <td>{{number_format(substr($hologramInterface->hologram_price, 0, -1))}} تومان</td>
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
                                    @if(isset($hologramInterface->expert_description))
                                        <div class="row p-4">
                                            <div class="callout callout-costumBlue" style="width: 100%">
                                                <h5>توضیحات کارشناس </h5>

                                                <p class="mt-4">{{$hologramInterface->expert_description}} </p><br>
                                                <p>زمان پاسخگویی: {{verta($hologramInterface->expert_answer_time)->formatJalaliDatetime()}}</p>
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
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            @foreach($hologramInterface->hologramInterfaceFiles as $key=>$file)
                                                <tr>
                                                    <th>فایل شماره {{$key+1}}</th>

                                                    <td>
                                                        <a href="{{route('hologram.download.realestate', $file->id)}}" download
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

@endsection
@section('js_realestate')
@endsection

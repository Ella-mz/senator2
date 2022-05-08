@extends('RealestateMaster::master')
@section('title_realestate') آگهی ها
@endsection
@section('card_title')لیست آگهی های ارسال شده به کسب و کار شما
@endsection
@section('css')
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title" style="float: right">لیست آگهی ها</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>کد آگهی</th>
                        <th>عنوان</th>
                        <th>شهر</th>
                        <th>نوع آگهی</th>
                        <th>ثبت شده توسط</th>
                        <th>هولوگرام</th>
{{--                        <th>تاییدیه کسب و کار</th>--}}
                        <th>مشاهده</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ads as $key=>$ad)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$ad->uniqueCodeOfAd}}</td>
                            <td>{{$ad->title}}</td>
                            <td>
                                {{$ad->city->title}}
                            </td>
                            <td>
                                @if($ad->type=='general')
                                    عادی
                                @elseif($ad->type=='scalar')
                                    نردبانی
                                @elseif($ad->type=='special')
                                    ویژه
                                @elseif($ad->type=='emergency')
                                    فوری
                                @endif
                            </td>
                            <td>
                                @if($ad->user->hasRole('real-state-administrator'))
                                    مدیر کسب و کار
                                @else
                                    {{$ad->user->name}} {{$ad->user->sirName}}
                                @endif
                            </td>
                            @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                                                              && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status=='approved')
                                <td width="80" height="40">
                                    <img src="{{asset(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $ad->id)
->where('type', 'ad')->first()->hologram->logo)}}" style="width: 100%; height: 50px">
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-secondary">هولوگرام ندارد</span>
                                </td>
                            @endif
{{--                            <td>--}}
{{--                                @if($ad->request_to_agency=='pending')--}}
{{--                                    در انتظار تایید--}}
{{--                                @elseif($ad->request_to_agency=='approved')--}}
{{--                                    تایید شده--}}
{{--                                @elseif($ad->request_to_agency=='disapproved')--}}
{{--                                    عدم تایید--}}
{{--                                @endif--}}
{{--                            </td>--}}
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm"
                                   href="{{route('ad.show.supplier.user', $ad->id)}}" target="_blank">
                                    <i class="fa fa-list"></i>
                                </a>
                            </td>
                            <td>

                                <a class="btn btn-success btn-sm"
                                   href="{{route('ad.chooseReceivedAd.panel', $ad->id)}}">
                                    انتخاب
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
@section('js_realestate')
    @include('RealestateMaster::layouts.data_table')
@endsection

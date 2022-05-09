@extends('RealestateMaster::master')
@section('title_realestate')بازدیدهای اخیر
@endsection
@section('card_title') بازدیدهای اخیر
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="card">
            <div class="card-header">
                {{--                <a href="{{route('ad.find.cats.realestate', 'supplier')}}"--}}
                {{--                   class="btn btn-sm" style="background-color: #3c3cce;color: #fff;float: left">ایجاد--}}
                {{--                    آگهی جدید</a>--}}
                <h1 class="card-title" style="float: right">لیست  بازدیدهای اخیر</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>کد آگهی</th>
                        <th>عنوان</th>
                        <th>شهر</th>
                        <th>نوع آگهی</th>
{{--                        <th>هولوگرام</th>--}}
                        <th>مشاهده</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recentseens as $key=>$bookmark)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$bookmark->ad->uniqueCodeOfAd}}</td>
                            <td>{{$bookmark->ad->title}}</td>
                            <td>
                                {{$bookmark->ad->city->title}}
                            </td>
                            <td>
                                @if($bookmark->ad->type=='general')
                                    عادی
                                @elseif($bookmark->ad->type=='scalar')
                                    نردبانی
                                @elseif($bookmark->ad->type=='special')
                                    ویژه
                                @elseif($bookmark->ad->type=='emergency')
                                    فوری
                                @endif
                            </td>
{{--                            @if(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $bookmark->ad->id)->where('type', 'ad')->first()--}}
{{--                                                              && \Modules\HologramInterface\Entities\HologramInterface::where('type_id', $bookmark->ad->id)->where('type', 'ad')->first()->status=='approved')--}}
{{--                                <td width="80" height="40">--}}
{{--                                    <img src="{{asset(\Modules\HologramInterface\Entities\HologramInterface::where('type_id', $bookmark->ad->id)--}}
{{--->where('type', 'ad')->first()->hologram->logo)}}" style="width: 100%; height: 50px">--}}
{{--                                </td>--}}
{{--                            @else--}}
{{--                                <td>--}}
{{--                                    <span class="badge badge-secondary">هولوگرام ندارد</span>--}}
{{--                                </td>--}}
{{--                            @endif--}}
                            <td class="project-actions text-right">

                                <a class="btn btn-primary btn-sm"
                                   href="{{route('ad.show.supplier.user', $bookmark->ad->id)}}" target="_blank">
                                    <i class="fa fa-list"></i>
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

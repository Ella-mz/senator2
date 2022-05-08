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
                        <th>پنل نمایش</th>
                        <th>هولوگرام</th>
                        <th>تاییدیه کسب و کار</th>
                        <th>تایید/عدم تایید</th>
                        <th>مشاهده</th>
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
                            {{--                            <td>--}}
                            {{--                                @if($ad->active=='inactive')--}}
                            {{--                                    غیرفعال--}}
                            {{--                                @elseif($ad->active=='active')--}}
                            {{--                                    فعال--}}
                            {{--                                @elseif($ad->active=='delete')--}}
                            {{--                                    حذف توسط کاربر--}}
                            {{--                                @endif--}}
                            {{--                            </td>--}}
                            <td>
                                @if(!(isset($ad->agency_id) && $ad->request_to_agency=='approved' && auth()->id()==$ad->user_id))

                                    <select class="form-control-sm form-control userStatusInRealestate123"
                                            style="width: 220px" id="{{$ad->id}}">
                                        <option value="'active" @if($ad->userStatus=='active') selected @endif>
                                            نمایش در تمامی صفحات
                                        </option>
                                        <option value="onlyEstatePanel"
                                                @if($ad->userStatus=='onlyEstatePanel') selected @endif>
                                            فقط نمایش در صفحه مشاور کسب و کار
                                        </option>
                                        <option value="inactive" @if($ad->userStatus=='inactive') selected @endif>
                                            غیرفعال
                                        </option>
                                    </select>
                                @endif
                                {{--                                <input type="number" class="form-control-sm form-control w-25 orderInput"--}}
                                {{--                                       id="{{$groupAttr->id}}"--}}
                                {{--                                       value="{{$groupAttr->order}}">--}}
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
                            <td>
                                @if($ad->request_to_agency=='pending')
                                    در انتظار تایید
                                @elseif($ad->request_to_agency=='approved')
                                    تایید شده
                                @elseif($ad->request_to_agency=='disapproved')
                                    عدم تایید
                                @endif
                            </td>
                            <td>

                                <a class="btn btn-success btn-sm"
                                   href="{{route('ad.designateOfRequestToAgencies.panel', ['adId'=>$ad->id, 'status'=>'approved'])}}">
                                    <i class="fa fa-check"></i>
                                </a>

                                <a class="btn btn-danger btn-sm"
                                   href="{{route('ad.designateOfRequestToAgencies.panel', ['adId'=>$ad->id, 'status'=>'disapproved'])}}">
                                    <i class="fa fa-close"></i>
                                </a>

                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm"
                                   href="{{route('ad.show.supplier.user', $ad->id)}}" target="_blank">
                                    <i class="fa fa-list"></i>
                                </a>
                                {{--                                    <a class="btn btn-primary btn-sm"--}}
                                {{--                                       href="{{route('ad.show.supplier.realestate', $ad->id)}}">--}}
                                {{--                                        <i class="fa fa-list"></i>--}}
                                {{--                                    </a>--}}

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

    <script>
        $('.userStatusInRealestate123').change(function () {
            var userStatus = $(this).val();
            var ad_id = $(this).attr('id');
            $.ajax({
                url: "{{route('changeAdUserStatus.realestate')}}",
                data: {
                    'userStatus': userStatus,
                    'ad_id': ad_id,
                },
                method: "GET",
                dataType: 'JSON',

                success: function (data) {
                    location.reload();
                }
            })
        });
    </script>

@endsection

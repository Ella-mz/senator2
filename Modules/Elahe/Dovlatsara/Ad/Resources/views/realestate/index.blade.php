@extends('RealestateMaster::master')
@section('title_realestate') آگهی ها
@endsection
@section('card_title') آگهی ها
@endsection
@section('css')

    {{--    <link rel="stylesheet" href="{{asset('files/realestateMaster/plugins/datatables/dataTables.bootstrap4.css')}}">--}}

    {{--    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet">--}}

    {{--    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">--}}


@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('categories.find.cats', ['type'=>'supplier', 'panel'=>'panel'])}}"
                   class="btn btn-sm" style="background-color: #3c3cce;color: #fff;float: left">ایجاد
                    آگهی جدید</a>
                <h1 class="card-title" style="float: right">لیست آگهی ها{{$content}}</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm   display responsive nowrap"
                       style="width: 1325px;">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>کد آگهی</th>
                        <th>عنوان</th>
                        <th>شهر</th>
                        <th>نوع آگهی</th>
                        {{--                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('real-state-administrator'))--}}
                        {{--                            <th>ثبت شده توسط</th>--}}
                        {{--                        @endif--}}
                        <th>وضعیت</th>
                        <th>پنل نمایش</th>
                        <th>هولوگرام</th>
                        <th style="white-space: normal;">وضعیت پرداخت</th>
                        @can('RequestToAgencyStatusInPanel')
                            <th style="white-space: normal;">
                                وضعیت درخواست به کسب و کار
                            </th>
                        @endcan

                        <th>انتقال به آژانس</th>
                        <th style="white-space: normal;">هولوگرام/مشاهده/ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ads as $key=>$ad)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$ad->uniqueCodeOfAd}}</td>
                            <td style="white-space: normal;">{{$ad->title}}</td>
                            <td style="white-space: normal;">
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
                            {{--                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('real-state-administrator'))--}}
                            {{--                                <td>--}}
                            {{--                                    @if($ad->user->hasRole('real-state-administrator'))--}}
                            {{--                                        مدیر کسب و کار--}}
                            {{--                                    @else--}}
                            {{--                                        {{$ad->user->name}} {{$ad->user->sirName}}--}}
                            {{--                                    @endif--}}
                            {{--                                </td>--}}
                            {{--                            @endif--}}
                            <td style="white-space: normal;">
                                @if($ad->active=='inactive')
                                    غیرفعال
                                @elseif($ad->active=='active')
                                    فعال
                                @elseif($ad->active=='delete')
                                    حذف توسط کاربر
                                @endif
                            </td>
                            <td>
                                @if(!(isset($ad->agency_id) && $ad->request_to_agency=='approved' && auth()->id()==$ad->user_id))

                                    <select class="form-control-sm form-control userStatusInRealestate123"
                                            style="width: 150px" id="{{$ad->id}}">
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
                            <td style="white-space: normal;">
                                @if($ad->isPaid=='paid')
                                    پرداخت شده
                                    @if($ad->paymentType=='membership')
                                        با حق عضویت
                                    @endif
                                @elseif($ad->isPaid=='unpaid')
                                    <a class="btn btn-sm" style="background-color: #3c3cce;color: #fff"
                                       href="{{route('adFeeList.realestate', $ad->id)}}">
                                        پرداخت
                                    </a>
                                    {{--                                    پرداخت نشده--}}
                                @endif

                            </td>
                            @can('RequestToAgencyStatusInPanel')
                                <td>
                                    @if($ad->request_to_agency=='noRequest')
                                        درخواستی نفرستاده اید
                                    @elseif($ad->request_to_agency=='pending')
                                        در انتظار تایید مدیر کسب و کار
                                    @elseif($ad->request_to_agency=='approved')
                                        تایید شده توسط کسب و کار
                                    @elseif($ad->request_to_agency=='disapproved')
                                        عدم تایید توسط کسب و کار
                                    @endif
                                </td>
                            @endcan
                            {{--                            @if($type!='my-ads')--}}
                            <td>
                                @if(isset($ad->agency_id) && auth()->user()->hasRole('real-state-administrator'))
                                    <a class="btn btn-sm" style="background-color: #3c3cce;color: #fff"
                                       href="{{route('ad.transfer.panel', ['adId'=>$ad->id, 'destination'=>'quitAgency'])}}">
                                        خروج از
                                        {{$user->hasRole('real-state-agent')?$user->agency->shop_title:$user->shop_title}}
                                    </a>
                                @elseif(($user->id == $ad->user_id)  && !isset($ad->agency_id) && !auth()->user()->hasRole('ordinary-user'))
                                    <a class="btn btn-sm" style="background-color: #3c3cce;color: #fff"
                                       href="{{route('ad.transfer.panel', ['adId'=>$ad->id, 'destination'=>'toAgency'])}}">
                                        انتقال
                                        به {{$user->hasRole('real-state-agent')?$user->agency->shop_title:$user->shop_title}}
                                    </a>
                                @elseif(($user->id == $ad->user_id)  && isset($ad->agency_id))
                                    انتقال یافته
                                    به{{$user->hasRole('real-state-agent')?$user->agency->shop_title:$user->shop_title}}
                                @else
                                    <span class="badge badge-info">غیر قابل انتقال</span>
                                @endif
                                {{--    <a class="btn btn-sm" style="background-color: #3c3cce;color: #fff"
                                       href="{{route('ad.transfer.panel', ['adId'=>$ad->id, 'destination'=>isset($ad->agency_id)?'quitAgency':'toAgency'])}}">
                                        @if(isset($ad->agency_id)) خروج از@else انتقال
                                        به @endif {{$user->hasRole('real-state-agent')?$user->agency->shop_title:$user->shop_title}}
                                    </a>--}}
                            </td>
                            {{--                            @endif--}}
                            <td class="project-actions text-right">
                                <form action="{{route('ad.destroy.supplier.realestate', $ad->id)}}" method="POST">
                                    @csrf
                                    <a class="btn btn-sm" style="background-color: #3c3cce;color: #fff"
                                       href="{{route('hologram.index.realestate', ['type'=>'ad', 'id'=>$ad->id])}}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a class="btn btn-primary btn-sm"
                                       href="{{route('ad.show.supplier.realestate', $ad->id)}}">
                                        <i class="fa fa-list"></i>
                                    </a>
                                    @if(\Carbon\Carbon::now()<= $ad->endDate || $ad->isPaid == 'unpaid')
                                        <a class="btn btn-info btn-sm"
                                           href="{{route('ad.edit.supplier.panel', $ad->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-info btn-sm" style="color: #fff">
                                            <i class="fa fa-ban"></i>
                                        </a>
                                        {{--                                        <span class="badge" style="color: #ffffff; background-color: #17a2b8;">منقضی</span>--}}
                                    @endif

                                    {{--                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                    <i class="fa fa-trash"></i>--}}
                                    {{--                                </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف آگهی اطمینان دارید؟')">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>

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
    {{--    <script>--}}
    {{--        $('#sidebarCollapseChange').addClass('sidebar-collapse');--}}
    {{--    </script>--}}
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

    {{--    <script src="{{asset('/files/AdminMaster/plugins/datatables/jquery.dataTables.js')}}"></script>--}}
    {{--    <script src="{{asset('/files/AdminMaster/plugins/datatables/dataTables.bootstrap4.js')}}"></script>--}}
    {{--    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>--}}
    {{--    <script src="{{asset('/files/AdminMaster/plugins/datatables/export2/buttons.flash.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/files/AdminMaster/plugins/datatables/export2/jszip.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/files/AdminMaster/plugins/datatables/export2/pdfmake.js')}}"></script>--}}
    {{--    <script src="{{asset('/files/AdminMaster/plugins/datatables/export2/vfs_fonts.js')}}"></script>--}}
    {{--    <script src="{{asset('/files/AdminMaster/plugins/datatables/export2/buttons.html5.min.js')}}"></script>--}}
    {{--    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>--}}


    {{--    <script>--}}

    {{--        $(document).ready(function() {--}}
    {{--            $("#datatable").DataTable({--}}

    {{--                dom: 'Bfrtip',--}}
    {{--                buttons: [--}}
    {{--                    {--}}
    {{--                        extend: 'copyHtml5',--}}
    {{--                        exportOptions: {--}}
    {{--                            columns: ':visible'--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                    {--}}
    {{--                        extend: 'excelHtml5',--}}
    {{--                        exportOptions: {--}}
    {{--                            columns: ':visible'--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                    {--}}
    {{--                        extend: 'pdfHtml5',--}}
    {{--                        exportOptions: {--}}
    {{--                            columns: ':visible'--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                    'colvis'--}}
    {{--                ],--}}
    {{--                "ordering": false,--}}
    {{--                "searching": false,--}}
    {{--                "bPaginate": false,--}}
    {{--                "language": {--}}
    {{--                    "sSearch": "جستجو : ",--}}
    {{--                    "paginate": {--}}
    {{--                        "next": "بعدی",--}}
    {{--                        "previous": "قبلی",--}}
    {{--                        "sEmptyTable": "موردی یافت نشد",--}}
    {{--                    }--}}
    {{--                },--}}
    {{--                "info": false,--}}
    {{--                responsive: {--}}
    {{--                    details: true--}}
    {{--                }--}}
    {{--            });--}}
    {{--            new $.fn.dataTable.Responsive(table, {--}}
    {{--                details: true--}}
    {{--            });--}}
    {{--        });--}}
    {{--        $(document).ready(function() {--}}
    {{--            $("#datatable-with_pagination").DataTable({--}}

    {{--                dom: 'Bfrtip',--}}
    {{--                buttons: [--}}
    {{--                    {--}}
    {{--                        extend: 'copyHtml5',--}}
    {{--                        exportOptions: {--}}
    {{--                            columns: ':visible'--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                    {--}}
    {{--                        extend: 'excelHtml5',--}}
    {{--                        exportOptions: {--}}
    {{--                            columns: ':visible'--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                    {--}}
    {{--                        extend: 'pdfHtml5',--}}
    {{--                        exportOptions: {--}}
    {{--                            columns: ':visible'--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                    'colvis'--}}
    {{--                ],--}}
    {{--                "ordering": false,--}}
    {{--                "language": {--}}
    {{--                    "sSearch": "جستجو : ",--}}
    {{--                    "paginate": {--}}
    {{--                        "next": "بعدی",--}}
    {{--                        "previous": "قبلی",--}}
    {{--                        "sEmptyTable": "موردی یافت نشد",--}}
    {{--                    }--}}
    {{--                },--}}
    {{--                "info": false,--}}
    {{--                responsive: {--}}
    {{--                    details: true--}}
    {{--                }--}}
    {{--            });--}}
    {{--            new $.fn.dataTable.Responsive(table, {--}}
    {{--                details: true--}}
    {{--            });--}}
    {{--        });--}}

    {{--    </script>--}}

@endsection

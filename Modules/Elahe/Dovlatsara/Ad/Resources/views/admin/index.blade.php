@extends('AdminMasterNew::master')
@section('urlHeader') آگهی ها
@endsection
@section('header')
    آگهی های @if($active == 'inactive') غیرفعال @elseif($active=='active') فعال @elseif($active=='delete') حذف شده@elseif($active=='expire') منقضی شده  @elseif($active=='disConfirm') تایید نشده  @endif
@endsection
@section('css')
  <style>
      .select2-selection.select2-selection--single {
          min-height: 38px;
          background-color: #e9ecef;
      }
  </style>
    @endsection
@section('content')
    <section class="content">
        <div class="card">
            <form action="{{route('ad.filter.supplier.admin', $active)}}" method="post">
                @csrf
                <input name="t" value="1" hidden/>
                <div class="p-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>دسته بندی:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fa fa-list"></i>
                                      </span>
                                    </div>
                                    <select class="form-control" name="category" readonly>
                                        <option value=""></option>
                                        @foreach($categories as $category2)
                                            <option value="{{$category2->id}}">
                                                {{$category2->createStringAsParents()}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>شهر:</label>

{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                      <span class="input-group-text">--}}
{{--                        <i class="fa fa-building"></i>--}}
{{--                      </span>--}}
{{--                                    </div>--}}
                                    <select class="form-control select2" name="city" dir="rtl">
                                        <option value=""></option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">
                                                {{$city->title}}
                                            </option>
                                        @endforeach

                                    </select>
{{--                                </div>--}}
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>محله:</label>

{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                      <span class="input-group-text">--}}
{{--                        <i class="fa fa-building"></i>--}}
{{--                      </span>--}}
{{--                                    </div>--}}
                                    <select class="form-control select2" name="neighborhood" id="neighborhood" dir="rtl">
                                    </select>
{{--                                </div>--}}
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>نوع آگهی:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-tag"></i>
                      </span>
                                    </div>
                                    <select class="form-control" name="type" id="type" readonly>
                                        <option value=""></option>
                                        <option value="general">عادی</option>
                                        <option value="scalar">نردبانی</option>
                                        <option value="emergency">
                                            فوری
                                        </option>
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>وضعیت پرداخت:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-tag"></i>
                      </span>
                                    </div>
                                    <select class="form-control" name="isPaid" readonly>
                                        <option value=""></option>
                                        <option value="paid">پرداخت شده</option>
                                        <option value="unpaid">پرداخت نشده</option>
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>جستجو:</label>

                                <div class="input-group">
                                    <input class="form-control" name="search" value="{{old('search')}}" placeholder="عنوان یا کد آگهی">

                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <div class="row">

                        <div class="col-md-12 text-left">

                            <button type="submit" class="btn btn-info btn-sm">فیلتر</button>
                            <a href="{{route('ad.index.supplier.admin', $active)}}" class="btn btn-secondary btn-sm">برگشت
                                به حالت
                                اولیه</a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-2  mt-2 ">
                    <p>فیلتر های اعمال شده :</p>
                </div>
                <div class="col-md-10  mt-2 ">

                    @foreach($tags as $key=>$tag)
                        <span class="badge badge-danger text-white mx-2"> {{$tag}}</span>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="card-header">
                <a href="{{route('categories.find.cats', ['type'=>'supplier', 'panel'=>'admin'])}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد آگهی جدید</a>
                <h1 class="card-title" style="float: right">آگهی ها</h1>
            </div>
            <div class="card-body p-0">
                <table id="exampleNew" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>کد آگهی</th>
                        <th>عنوان</th>
                        <th>شهر</th>
                        <th>نوع آگهی</th>
                        <th>ثبت شده توسط</th>
                        <th>وضعیت</th>
                        <th>وضعیت پرداخت</th>
                        <th>هولوگرام</th>
                        <th>مشاهده/ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ads as $key=>$ad)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$ad->uniqueCodeOfAd}}</td>
                            <td style="white-space: normal;">{{$ad->title}}</td>

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
                            <td style="white-space: normal;">
                                @if($ad->user->hasRole('real-state-administrator'))
                                    مدیر کسب و کار
                                @else
                                    {{--                                    @elseif($ad->user->hasRole('real-state-agent'))--}}
                                    {{$ad->user->name}} {{$ad->user->sirName}}
                                    {{--                                @elseif($ad->user->hasRole('independent-agent'))--}}
                                    {{--                                    {{$ad->user->name}} {{$ad->user->sirName}}--}}

                                    {{--                                @elseif($ad->user->hasRole('ordinary-user'))--}}
                                    {{--                                    {{$ad->user->name}} {{$ad->user->sirName}}--}}
                                @endif
                            </td>
                            <td>
                                @if($ad->active=='inactive')
                                    غیرفعال
                                @elseif($ad->active=='active')
                                    فعال
                                @elseif($ad->active=='disConfirm')
                                    عدم تایید
                                @elseif($ad->active=='delete')
                                    حذف توسط کاربر
                                @endif

                            </td>
                            <td>
                                @if($ad->isPaid=='paid')
                                    پرداخت شده
                                @elseif($ad->isPaid=='unpaid')
                                    <span class="badge badge-danger"> پرداخت نشده</span>
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
                                    <span class="badge badge-info">هولوگرام ندارد</span>
                                </td>
                            @endif
                            <td class="project-actions text-right">
                                <form action="{{route('ad.destroy.supplier.admin', $ad->id)}}" method="POST">
                                    @csrf
                                    <input name="active" value="{{$active}}" hidden>

                                    <a class="btn btn-primary btn-sm"
                                       href="{{route('ad.show.supplier.admin', $ad->id)}}">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm"
                                       href="{{route('ad.edit.supplier.admin', $ad->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

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
    <div class="d-flex justify-content-center">
            {!! $ads->links() !!}
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"]').on('change', function () {
                var cityId = jQuery(this).val();
                if (cityId) {
                    jQuery.ajax({
                        url: "{{route('gettingNeighborhood')}}",
                        data: {
                            'city': cityId
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="neighborhood"]').empty();
                            $('select[name="neighborhood"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhood"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="neighborhood"]').empty();
                }
            });
        });
    </script>
    <script>
        $(function () {
            $("#exampleNew").DataTable({
                "ordering": false,
                "lengthChange": false,
                "pageLength": {{$paginate}},
                "bPaginate":false,
                "language": {
                    "sSearch": "جستجو : ",
                    "paginate": {
                        "next": "بعدی",
                        "previous": "قبلی",
                        "sEmptyTable": "موردی یافت نشد",
                    }
                },
                "info": false,

                responsive: {
                    details: true
                },
            });
            new $.fn.dataTable.Responsive(table, {
                details: true
            });
        });
    </script>
@endsection

@extends('AdminMasterNew::master')
@section('urlHeader') آگهی ها
@endsection
@section('header')
    {{--    {!! $map !!}--}}
    {{--    @foreach($categories as $category->iteme)--}}
    {{--    <li><a href="{{route('category.index.admin',0)}}" title="categories">Categories</a></li>--}}
    {{--    @endforeach--}}
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('ad.find.cats.admin', 'supplier')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد آگهی جدید</a>
                <h1 class="card-title" style="float: right">آگهی ها</h1>
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
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
@endsection

@extends('AdminMasterNew::master')
@section('urlHeader')لیست تبلیغات
@endsection
@section('header')
    لیست تبلیغات
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('advertisings.create.admin')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد تبلیغ جدید</a>

                <h1 class="card-title" style="float: right">لیست تبلیغات
                </h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>هزینه</th>
                        <th>مکان تبلیغ</th>
                        <th>توضیحات</th>
                        <th>وضعیت</th>

                        <th>
                            رزرو/ویرایش/تغییر وضعیت
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($advertisings as $key=>$advertising)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>

                            <td>{{$advertising->title}}</td>
                            {{--                            @if($parentId == 0 )--}}
{{--                            @if(isset($skill->image))--}}
{{--                                <td width="80" height="40">--}}
{{--                                    <img src="{{asset($skill->image)}}" width="80" height="40">--}}
{{--                                </td>--}}
{{--                            @else--}}
{{--                                <td width="80" height="40">--}}
{{--                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
{{--                                </td>--}}
{{--                            @endif--}}
                            <td>
                                {{number_format($advertising->price)}}
                            </td>
                            <td>
                                {{$advertising->advertisingOrder->fa_title}}-{{$advertising->advertisingOrder->page->fa_title}}
                            </td>
                            <td>
                                {{$advertising->description}}
                            </td>
                            <td>
                                @if($advertising->active)
                                    <span class="badge badge-success">فعال</span>
                                @else
                                    <span class="badge badge-danger">غیرفعال</span>

                                @endif
                            </td>
                            <td class="project-actions text-right">
                                @if($advertising->active)
                                <form
                                    action="{{ route('advertisings.inactive.admin' ,$advertising->id) }}"
                                    method="POST">
                                    @csrf
                                    <a class="btn btn-primary btn-sm"
                                       href="{{route('advertisings.apply.admin', $advertising->id)}}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('advertisings.edit.admin', $advertising->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{--                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                    <i class="fa fa-trash"></i>--}}
                                    {{--                                </a>--}}
                                    <button type="submit" class="btn btn-secondary btn-sm"
                                            onclick="return confirm('آیا از غیرفعال کردن تبلیغ {{$advertising->title}} اطمینان دارید؟')">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </form>
                                @else
                                    <form
                                        action="{{ route('advertisings.active.admin' ,$advertising->id) }}"
                                        method="POST">
                                        @csrf
                                        <a class="btn btn-primary btn-sm"
                                           href="{{route('advertisings.apply.admin', $advertising->id)}}">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('advertisings.edit.admin', $advertising->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        {{--                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                        {{--                                    <i class="fa fa-trash"></i>--}}
                                        {{--                                </a>--}}
                                        <button type="submit" class="btn btn-success btn-sm"
                                                >
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </form>
                                @endif

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

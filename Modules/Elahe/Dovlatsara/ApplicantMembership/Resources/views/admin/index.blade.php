@extends('AdminMasterNew::master')
@section('urlHeader')حق اشتراک های درخواست
@endsection
@section('header')
    حق اشتراک های درخواست
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('applicant-memberships.create')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد حق اشتراک جدید</a>
                <h1 class="card-title" style="float: right">حق اشتراک های درخواست</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>نقش</th>
                        <th>مدت زمان اعتبار</th>
                        <th>تعداد درخواست قابل مشاهده</th>
                        <th>مبلغ</th>
                        <th>ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($memberships as $key=>$membership)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$membership->title}}</td>
                            <td>
                                @if(\Modules\RoleAndPermission\Entities\Role::where('slug', $membership->role_type)->first())
                                    {{\Modules\RoleAndPermission\Entities\Role::where('slug', $membership->role_type)->first()->name}}
                                @endif
                            </td>
                            <td>{{$membership->duration}} روز</td>
                            <td>{{$membership->number_of_applications}} عدد</td>
                            <td>{{number_format($membership->price)}} ریال</td>
                            <td>
                                <form action="{{ route('applicant-memberships.destroy' ,$membership->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('applicant-memberships.edit', $membership->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{--                                    <a class="btn btn-danger btn-sm"--}}
                                    {{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                        <i class="fa fa-trash"></i>--}}
                                    {{--                                    </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف حق اشتراک {{$membership->title}} اطمینان دارید؟')">
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

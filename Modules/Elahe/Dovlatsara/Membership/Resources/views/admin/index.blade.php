@extends('AdminMasterNew::master')
@section('urlHeader')حق اشتراک ها
@endsection
@section('header')
    حق اشتراک ها
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('memberships.create')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد حق اشتراک جدید</a>
                <h1 class="card-title" style="float: right">حق اشتراک ها</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
{{--                        <th>نوع بسته</th>--}}
{{--                        <th>نقش</th>--}}
                        <th>امتیاز</th>
                        <th>مدت زمان اعتبار</th>
                        <th>مبلغ</th>
                        <th>توضیحات</th>
                        <th>حذف/ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($memberships as $key=>$membership)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$membership->title}}</td>
{{--                            <td>--}}
{{--                                @if($membership->package_type=='general')--}}
{{--                                    عادی--}}
{{--                                @elseif($membership->package_type=='scalar')--}}
{{--                                    نردبانی--}}
{{--                                @elseif($membership->package_type=='special')--}}
{{--                                    ویژه--}}
{{--                                @elseif($membership->package_type=='emergency')--}}
{{--                                    فوری--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                @if(\Modules\RoleAndPermission\Entities\Role::where('slug', $membership->role_type)->first())--}}
{{--                                {{\Modules\RoleAndPermission\Entities\Role::where('slug', $membership->role_type)->first()->name}}--}}
{{--                                @endif--}}
{{--                            </td>--}}
                            <td>{{$membership->score}}</td>
                            <td>{{$membership->duration}} روز</td>
                            <td>{{number_format(substr($membership->price, 0, -1))}} تومان</td>
                            <td>
                               @if(isset($membership->description))
                                    <button type="button" data-bs-toggle="modal"
                                            value="{{$membership->id}}"
                                            data-target="#exampleModalChatPage"
                                            name="seeMoreModalButtonInSetting"
                                            data-adID="{{$membership->id}}"
                                            id="{{$membership->id}}"
                                            class="btn btn-info"
                                            onclick="showModalMembership({{$membership->id}})">
                                        برای نمایش متن کلیلک کنید
                                    </button>
                                   @else
                                <span class="badge badge-info">توضیحات ندارد</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('memberships.destroy' ,$membership->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('memberships.edit', $membership->id)}}">
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
                <div class="modal fade" id="exampleModalDetailRequest1" tabindex="-1"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content membershipModalContent"
                             id="membershipModalContent">
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
        function showModalMembership(membershipID) {
            $(function () {
                jQuery.ajax({
                    url: "{{route('getDescription.admin')}}",
                    data: {
                        'membershipID': membershipID,
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data)
                        $('.membershipModalContent').empty();
                        $('.membershipModalContent').append(data.content);
                    }
                });
                $('#exampleModalDetailRequest1').modal('show');

            });
        }

    </script>

@endsection

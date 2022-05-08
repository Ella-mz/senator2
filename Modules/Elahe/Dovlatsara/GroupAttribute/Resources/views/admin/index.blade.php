@extends('AdminMasterNew::master')
@section('urlHeader')گروه مشخصات
@endsection
@section('header')
    گروه مشخصات {{$category->title}}
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('groupAttrs.add.admin', $category->id)}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد گروه مشخصه جدید</a>

                <h1 class="card-title" style="float: right">
                    @if($category->parent_id==0)
                    گروه مشخصات <a
                        href="{{route('category.index.admin', 0)}}">{{$category->title}}</a>
                    @else
                        گروه مشخصات <a
                            href="{{route('category.index.admin', $category->category->id)}}">{{$category->title}}</a>

                    @endif
                </h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>تعداد ستون های نمایش</th>
                        <th>عرضه/درخواست</th>
                        <th>جایگاه نمایش</th>
                        <th>نمایش عنوان</th>
                        <th>ترتیب</th>
                        <th>مشخصات</th>
                        <th>ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groupAttrs as $key=>$groupAttr)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$groupAttr->title}}</td>
                            {{--                            @if(isset($category->image))--}}
                            {{--                                <td width="80" height="40">--}}
                            {{--                                    <img src2="{{asset($category->image)}}" width="80" height="40">--}}
                            {{--                                </td>--}}
                            {{--                            @else--}}
                            {{--                                <td width="80" height="40">--}}
                            {{--                                    <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                            {{--                                </td>--}}
                            {{--                            @endif--}}
                            <td>
                                @if($groupAttr->numberOfColumnsForDisplay==1)
                                    12
                                @elseif($groupAttr->numberOfColumnsForDisplay==2)
                                    6
                                @elseif($groupAttr->numberOfColumnsForDisplay==3)
                                    4
                                @elseif($groupAttr->numberOfColumnsForDisplay==4)
                                    3
                                @elseif($groupAttr->numberOfColumnsForDisplay==20)
                                    <span class="badge badge-info">ندارد</span>

                                @else
                                    2
                                @endif
                            </td>

                            <td> @if($groupAttr->advertiser=='supplier')
                                    <i class="fa fa-check" style="color: #00B74A"></i>
                                    <i class="fa fa-close" style="color: #F93154"></i>
                                @elseif($groupAttr->advertiser=='applicant')
                                    <i class="fa fa-close" style="color: #F93154"></i>
                                    <i class="fa fa-check" style="color: #00B74A"></i>
                                    {{--                                @else--}}
                                    {{--                                    <i class="fa fa-check" style="color: #00B74A"></i>--}}
                                    {{--                                    <i class="fa fa-check" style="color: #00B74A"></i>--}}
                                @endif

                            </td>
                            <td>
                                @if($groupAttr->type == 'estate-information')
                                    ردیف بالا
                                @elseif($groupAttr->type=='estate-features')
                                    ردیف بالا
                                @elseif($groupAttr->type=='financial-situation')
                                    ردیف پایین
                                @else
                                    <span class="badge badge-info">ندارد</span>
                                @endif
                            </td>
                            <td>
                                @if($groupAttr->hidden==0)
                                    <i class="fa fa-check" style="color: #00B74A"></i>
                                @else
                                    <i class="fa fa-close" style="color: #F93154"></i>

                                @endif
                            </td>
                            <td>
                                <input type="number" class="form-control-sm form-control w-25 orderInput"
                                       id="{{$groupAttr->id}}"
                                       value="{{$groupAttr->order}}">
                            </td>
                            <td><a href="{{route('attrs.index.admin', $groupAttr->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus-circle nav-icon text-white"></i></a></td>
                            <td>
                                <form action="{{ route('group-attrs.destroy' ,$groupAttr->id) }}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('group-attrs.edit', $groupAttr->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{--                                    <a class="btn btn-danger btn-sm"--}}
                                    {{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                        <i class="fa fa-trash"></i>--}}
                                    {{--                                    </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف گروه مشخصه {{$groupAttr->title}} اطمینان دارید؟ در صورت حذف تمام مشخصات زیر مجموعه این گروه نیز حذف می شوند.')">
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
    <script>
        $('.orderInput').change(function () {
            var order = $(this).val();
            var groupAttr_id = $(this).attr('id');
            $.ajax({
                url: "{{route('changeGroupAttrOrder')}}",
                data: {
                    'order': order,
                    'groupAttr_id': groupAttr_id,
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

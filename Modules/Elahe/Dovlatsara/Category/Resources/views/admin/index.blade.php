@extends('AdminMasterNew::master')
@section('urlHeader')دسته بندی ها
@endsection
@section('header')
    @if($category)
        دسته بندی های {{$category->title}}
    @else
        دسته بندی ها
    @endif

@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('category.add.admin', $parentId)}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد دسته بندی جدید</a>

                <h1 class="card-title" style="float: right">
                    @if($category)
                        <a href="{{route('category.index.admin', $category->parent_id)}}">برگشت
                            به {{$category->title}}</a>
                    @else
                        دسته بندی ها
                    @endif

                </h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        @if($parentId == 0 )
                            <th>عکس</th>
                        @endif
                        <th>گروه مشخصات</th>
                        {{--                        @if($category->node == 1 )--}}
{{--                        <th>هزینه</th>--}}
                        {{--                        @endif--}}
                        <th>ترتیب</th>
{{--                        <th>نمایش در صفحه اصلی</th>--}}
                        <th>فعال/غیرفعال</th>
                        <th>
                            @if($parentId == 0 ? true : \Modules\Category\Entities\Category::find($parentId)->depth<2)
                                مشاهده/
                            @endif
                            ویرایش/حذف
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $key=>$category)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$category->title}}</td>
                            @if($parentId == 0 )
                                @if(isset($category->image))
                                    <td width="80" height="40">
                                        <img src="{{asset($category->image)}}" width="80" height="40">
                                    </td>
                                @else
                                    <td width="80" height="40">
                                        <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">
                                    </td>
                                @endif
                            @endif
                            <td><a href="{{route('groupAttrs.index.admin', $category->id)}}"
                                   class="btn btn-sm btn-primary"><i class="fa fa-plus-circle nav-icon text-white"></i></a>
                            </td>
{{--                            @if($category->node == 1 )--}}

{{--                                <td>--}}
{{--                                    <a href="{{route('advertisingFee.index.admin', $category->id)}}"--}}
{{--                                       class="btn btn-sm btn-primary"><i class="fa fa-plus-circle nav-icon text-white">--}}
{{--                                        </i>--}}
{{--                                    </a>--}}

{{--                                </td>--}}
{{--                            @else--}}
{{--                                <td>--}}
{{--                                    <span class="badge badge-primary">برای زیردسته ها تعریف شود</span>--}}
{{--                                </td>--}}
{{--                            @endif--}}
                            <td>
                                <input type="number" class="form-control-sm form-control w-25 orderInput"
                                       id="{{$category->id}}"
                                       value="{{$category->order}}">
                            </td>
{{--                            <td>--}}
{{--                                @if($category->selected)--}}
{{--                                    <i class="fa fa-check" style="color: #00B74A"></i>--}}
{{--                                @else--}}
{{--                                    <i class="fa fa-close" style="color: #F93154"></i>--}}

{{--                                @endif--}}
{{--                            </td>--}}
                            <td>
                                <a class="btn btn-warning btn-sm"
                                   href="{{route('categories.changeActivation.admin',$category->id)}}">
                                    @if($category->active)
                                        غیرفعال کردن
                                    @else
                                        فعال کردن
                                    @endif
                                </a>
                            </td>
                            <td class="project-actions text-right">
                                <form action="{{ route('category.destroy.admin' ,$category->id) }}" method="POST">
                                    @csrf
                                    @if($parentId == 0 ? true : \Modules\Category\Entities\Category::find($parentId)->depth<2)

                                        <a class="btn btn-primary btn-sm"
                                           href="{{route('category.index.admin',$category->id)}}">
                                            <i class="fa fa-list"></i>
                                        </a>
                                    @endif
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('category.edit.admin', $category->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف دسته بندی {{$category->title}} اطمینان دارید؟')">
                                        @if ($category->ads()->count() <= 0 && $category->applications()->count() <= 0 && $category->node)
                                            <i class="fa fa-trash-o"></i>
                                        @else
                                            <i class="fa fa-ban"></i>
                                        @endif
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
            var cat_id = $(this).attr('id');
            $.ajax({
                url: "{{route('categories.changeOrder.admin')}}",
                data: {
                    'order': order,
                    'cat_id': cat_id,
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

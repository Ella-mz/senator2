@extends('AdminMasterNew::master')
@section('urlHeader') شهرها
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
                <a href="{{route('cities.create')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد شهر جدید</a>
                <h1 class="card-title" style="float: right">شهرها</h1>
            </div>
            <div class="card-body p-0">
                <table id="exampleNew" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>طول جغرافیایی</th>
                        <th>عرض جغرافیایی</th>
                        <th>محله ها</th>
                        <th>ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $key=>$city)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$city->title}}</td>
                            <td>
                                {{$city->longitude}}
                            </td>
                            <td>
                                {{$city->latitude}}

                            </td>
                            <td><a href="{{route('neighborhoods.index.admin', $city->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle nav-icon text-white"></i></a>
                            </td>
                            <td>
{{--                                <form action="{{ route('cities.destroy' ,$city->id) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @method('delete')--}}
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('cities.edit', $city->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

{{--                                    <a class="btn btn-danger btn-sm"--}}
{{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}
{{--                                    <button type="submit" class="btn btn-danger btn-sm"--}}
{{--                                            onclick="return confirm('آیا از حذف شهر {{$city->title}} اطمینان دارید؟')">--}}
{{--                                        <i class="fa fa-trash-o"></i>--}}
{{--                                    </button>--}}
{{--                                </form>--}}

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
            {!! $cities->links() !!}
    </div>
@endsection
@section('js')
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

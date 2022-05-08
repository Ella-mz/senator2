@extends('AdminMasterNew::master')
@section('urlHeader') محله های {{$city->title}}
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
                <a href="{{route('neighborhood.add.admin', $city->id)}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد محله جدید</a>
                <h1 class="card-title" style="float: right">محله های <a href="{{route('cities.index')}}">{{$city->title}}</a></h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>طول جغرافیایی</th>
                        <th>عرض جغرافیایی</th>
                        <th>جهت جغرافیایی</th>
                        <th>ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($neighborhoods as $key=>$neighborhood)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$neighborhood->title}}</td>
                            <td>
                                {{$neighborhood->longitude}}
                            </td>
                            <td>
                                {{$neighborhood->latitude}}

                            </td>
                            <td>
                                @if($neighborhood->geographicalDirection=='North')
                                    شمال
                                    @elseif($neighborhood->geographicalDirection=='South')
                                جنوب
                                @elseif($neighborhood->geographicalDirection=='West')
                                    غرب
                                @elseif($neighborhood->geographicalDirection=='East')
                                شرق
                                @elseif($neighborhood->geographicalDirection=='Center')
                                    مرکز
                                @endif
                            </td>
                            <td>
{{--                                <form action="{{ route('neighborhoods.destroy' ,$neighborhood->id) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @method('delete')--}}
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('neighborhoods.edit', $neighborhood->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{--                                    <a class="btn btn-danger btn-sm"--}}
                                    {{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                        <i class="fa fa-trash"></i>--}}
                                    {{--                                    </a>--}}
{{--                                    <button type="submit" class="btn btn-danger btn-sm"--}}
{{--                                            onclick="return confirm('آیا از حذف محله {{$neighborhood->title}} اطمینان دارید؟')">--}}
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
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
@endsection

@extends('AdminMasterNew::master')
@section('urlHeader')اصناف
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
                <a href="{{route('unions.create')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد صنف جدید</a>
                <h1 class="card-title" style="float: right">اصناف</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>حذف/ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($unions as $key=>$union)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$union->title}}</td>
                            <td>
                                <form action="{{ route('unions.destroy' ,$union->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('unions.edit', $union->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

{{--                                    <a class="btn btn-danger btn-sm"--}}
{{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف صنف {{$union->title}} اطمینان دارید؟')">
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

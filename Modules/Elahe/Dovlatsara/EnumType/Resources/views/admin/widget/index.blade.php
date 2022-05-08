@extends('AdminMasterNew::master')
@section('urlHeader')ویجت ها
@endsection
@section('header')
    ویجت ها
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('widget.create.admin')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد ویجت جدید</a>
                <h1 class="card-title" style="float: right">ویجت ها</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>آیکون </th>
                        <th>عنوان</th>
                        <th>لینک</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $widgets as $key=>$widget)
                        <tr>

                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            @if(isset($widget->image))
                                <td width="80" height="40">
                                    <img src="{{asset($widget->image)}}" width="80" height="40">
                                </td>
                            @else
                                <td width="80" height="40">
                                    {{--                                    <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                </td>
                            @endif
                            <td>
                                {{$widget->title}}
                            </td>
                            <td>
                                {{$widget->link}}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('widget.destroy.admin' ,$widget->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('آیا از حذف این آیتم اطمینان دارید؟ ')">
                                            <i class="fa fa-trash-o text-white "></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
@endsection

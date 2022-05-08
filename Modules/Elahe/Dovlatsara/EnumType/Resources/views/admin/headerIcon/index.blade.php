@extends('AdminMasterNew::master')
@section('urlHeader')آیکون ها
@endsection
@section('header')
    آیکون ها
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('header_icon.create.admin')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد آیکون جدید</a>
                <h1 class="card-title" style="float: right">آیکون ها</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>آیکون </th>
                        <th>لینک</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $header_icons as $key=>$header_icon)
                        <tr>

                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            @if(isset($header_icon->image))
                                <td width="80" height="40">
                                    <img src="{{asset($header_icon->image)}}" width="80" height="40">
                                </td>
                            @else
                                <td width="80" height="40">
                                    {{--                                    <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                </td>
                            @endif
                            <td>
                                {{$header_icon->link}}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('header_icon.destroy.admin' ,$header_icon->id) }}" method="POST">
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

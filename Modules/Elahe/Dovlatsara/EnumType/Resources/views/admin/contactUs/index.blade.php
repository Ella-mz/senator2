@extends('AdminMasterNew::master')
@section('urlHeader') لیست تماس یا ما
@endsection
@section('header')
    لیست تماس یا ما
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('contactUs.create.admin')}}"
                   class="btn btn-sm btn-primary" style="float: left">متن تماس با ما</a>
                <h1 class="card-title" style="float: right"> لیست تماس یا ما</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام و نام خانوادگی </th>
                        <th>ایمیل</th>
                        <th>موضوع</th>
                        <th>توضیحات</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $contactUs as $key=>$contact)
                        <tr>

                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>

                            <td>
                                {{$contact->name}}
                            </td>
                            <td>
                                {{$contact->email}}
                            </td>
                            <td>
                                {{$contact->subject}}
                            </td>
                            <td>
                                {{$contact->description}}
                            </td>
                            <td>
                                <div class="btn-group">
{{--                                    <form action="{{ route('contactUs.destroy' ,$contact->id) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="btn btn-sm btn-danger"--}}
{{--                                                onclick="return confirm('آیا از حذف این آیتم اطمینان دارید؟ ')">--}}
{{--                                            <i class="fa fa-trash-o text-white "></i>--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
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
        {{--    {!! $categories->links() !!}--}}
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
@endsection

@extends('AdminMasterNew::master')
@section('urlHeader')سوالات متداول
@endsection
@section('header')
    سوالات متداول
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('commonQuestions.create.admin')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد سوال جدید</a>
                <h1 class="card-title" style="float: right">سوالات</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>سوال</th>
                        <th>پاسخ</th>
                        <th>ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($commonQuestions as $key=>$question)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$question->title}}</td>
                            <td>
                                {{$question->description}}
                            </td>
                            <td>
                                <form action="{{ route('commonQuestions.destroy.admin' ,$question->id) }}" method="POST">
                                    @csrf
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('commonQuestions.edit.admin', $question->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

{{--                                    <a class="btn btn-danger btn-sm"--}}
{{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف این سوال اطمینان دارید؟')">
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

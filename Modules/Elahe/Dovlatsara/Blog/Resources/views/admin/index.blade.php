@extends('AdminMasterNew::master')
@section('urlHeader')  پوزیشن های وبلاگ
@endsection
@section('header')
    پوزیشن های وبلاگ
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
{{--                <a href="{{route('articles.create.admin', $slug)}}"--}}
{{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد مقاله جدید</a>--}}

                <h1 class="card-title" style="float: right">  پوزیشن های وبلاگ</h1>

            </div>
            <div class="card-body p-0">
                <table  class="table table-bordered table-sm   display responsive nowrap "
                        style="width: 100%">
                    <thead>
                    <tr>
                        <th>پوزیشن</th>
                        <th>عنوان</th>
                        <th>تعداد مقالات</th>
                        <th>لیست مقالات</th>
                        <th>تصویر پوزیشن </th>
                        <th> ویرایش </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $positions as $key=>$position)
                        <tr>

                            <td>{{$position->name}} </td>
                            <td>{{$position->title}}</td>
                            <td>{{$position->articles()->count()}}</td>

                            <td> <a href="{{route('admin-position-article',$position->id)}}"><i
                                        class="fa fa-list text-info m-2"></i></a>
                            </td>
                            <td> <a data-toggle="modal" data-target="#imageModal" onclick="position_image('{{$position->image}}')"><i
                                        class="fa fa-image text-secondary m-2" ></i></a>
                            </td>
                            <td> <a href="{{route('position.edit.admin',$position->id)}}"><i
                                        class="fa fa-edit text-info m-2"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered    modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"> تصویر جایگاه</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body d-flex justify-content-center align-content-center" id="modal-image-box">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            </div>
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
    <script>
        function position_image(image)
        {
            let url = `{{asset('')}}`

            $('#modal-image-box').empty();
            $('#modal-image-box').append(`<img src=`+url.concat(image)+` style="max-width: 700px;max-height: 400px;min-width: 300px">`);

        }
    </script>
@endsection

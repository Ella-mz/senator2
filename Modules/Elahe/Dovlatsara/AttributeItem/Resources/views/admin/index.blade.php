@extends('AdminMasterNew::master')
@section('urlHeader') مشخصات آیتم {{$attribute->title}}
@endsection
@section('header')
 مشخصات آیتم {{$attribute->title}}

@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
{{--                <a href="{{route('attrs.add.admin', $attribute->id)}}"--}}
{{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد مشخصه آیتم جدید</a>--}}

                <h1 class="card-title" style="float: right">مشخصات آیتم <a href="{{route('attrs.index.admin', $attribute->groupAttribute_id)}}">{{$attribute->title}}</a></h1>

            </div>
            <div class="card-body p-0">
                <div class="modal fade" id="editItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                     aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" id="editItemForm" method="post">
                                @csrf
                                @if(session()->has('message'))
                                    <div class="alert alert-danger " style="color:darkred">{{ session()->get('message') }}</div>
                                @endif
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">ویرایش آیتم</h5>
                                </div>
                                <div class="modal-body">
                                    <div id="success" class="w-100"></div>
                                    <div id="error"></div>
                                    <input class="form-control" name="itemid" hidden>
                                    <input class="form-control" name="itemattribute" hidden>
                                    <div class="row">
                                        <div class="col-md-1 mb-3"></div>
                                        <div class="col-md-10 mb-3">
                                            <label class="col-form-label"> عنوان آیتم <small class="text-danger"> *</small></label>
                                            <div>
                                                <input class="form-control" name="itemtitle" type="text">
                                                <small class="text-danger">{{ $errors->first('title') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger text-white btn-sm" data-dismiss="modal">انصراف
                                        </button>
                                        <button type="submit" class="btn btn-success btn-sm " id="edititem">ثبت</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal" action="{{route('store.items.admin')}}" method="post">
                    @if(session()->has('message'))
                        <div class="alert alert-danger " style="color:darkred">{{ session()->get('message') }}</div>
                    @endif
                    @csrf
                    <input class="form-control" hidden value="{{$attribute->id}}" name="attribute">
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-3 mb-3"></div>
                            <div class="col-md-6 mb-3">
                                <label class="col-form-label">عنوان آیتم <small class="text-danger"> * </small> </label>
                                    <input class="form-control" type="text" value="{{old('title')}}"
                                           name="title">
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-content-center">
                        <input class="btn btn-info" type="submit" value="ثبت">
                    </div><br>
                </form>
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان آیتم</th>
                        <th>حذف/ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$item->title}}</td>
                            <td>
                                <form action="{{ route('destroy.items.admin' ,$item->id) }}" method="POST">
                                    @csrf
{{--                                    @method('delete')--}}
                                    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editItem"
                                       data-attribute="{{$item->attribute_id }}" data-id="{{$item->id }}"
                                       data-title="{{$item->title }}"><i class="fa fa-edit text-white"></i> </a>
{{--                                    <a class="btn btn-info btn-sm"--}}
{{--                                       href="{{ route('attributes.edit', $attribute->id)}}">--}}
{{--                                        <i class="fa fa-edit"></i>--}}
{{--                                    </a>--}}

                                    {{--                                    <a class="btn btn-danger btn-sm"--}}
                                    {{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                        <i class="fa fa-trash"></i>--}}
                                    {{--                                    </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف مشخصه آیتم {{$item->title}} اطمینان دارید؟')">
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
        $('#editItem').on('show.bs.modal', function (e) {
            var opener = e.relatedTarget;
            var id = $(opener).attr('data-id');
            var title = $(opener).attr('data-title');
            var attribute = $(opener).attr('data-attribute');

            $('#editItemForm').find('[name="itemid"]').val(id);
            $('#editItemForm').find('[name="itemtitle"]').val(title);
            $('#editItemForm').find('[name="itemattribute"]').val(attribute);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#editItemForm').on('submit', function (event) {
                event.preventDefault();
                var formData = {
                    'itemid': $('input[name=itemid]').val(),
                    'itemtitle': $('input[name=itemtitle]').val(),
                    'itemattribute': $('input[name=itemattribute]').val(),
                };
                var id = formData["itemid"];
                var title = formData["itemtitle"]
                var attribute = formData["itemattribute"]
                // console.log(formData["itemtitle"])
                $.ajax({
                    url: "{{route('update.items.admin')}}",
                    method: "POST",
                    data: new FormData(this),
                    //data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.errorValidation) {
                            $('#error').empty();
                            $('#error').append('<small class="text-danger">' + data.errorValidation + '</small>');
                        }
                        if (data.success) {
                            $('#success').empty();
                            $('#success').append(data.success);
                            window.setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                    }
                })
            });
        });
    </script>
@endsection

@extends('AdminMasterNew::master')
@section('urlHeader')نقش ها و دسترسی ها
@endsection
@section('header')
@endsection
@section('content')
{{--    <section class="content">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <a href="{{route('roles.create')}}"--}}
{{--                   class="btn btn-sm btn-primary" style="float: left">ایجاد نقش جدید</a>--}}
{{--                <h1 class="card-title" style="float: right">نقش ها و دسترسی ها</h1>--}}
{{--            </div>--}}
{{--            <div class="card-body p-0">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-1"></div>--}}
{{--                    <div class="col-md-10 mt-3">--}}
{{--                        <select id="roles" class="form-control select2">--}}
{{--                            <option selected="true" disabled="disabled" value="">انتخاب کنید</option>--}}
{{--                            @foreach($roles as $role)--}}
{{--                                <option value="{{ $role->slug }}" data-dbid="{{ $role->id }}">{{ $role->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <div class="card mt-3">--}}
{{--                            <div class="card-body" id="role">--}}
{{--                                <h3 class="float-left" data-id=""></h3>--}}
{{--                                <div class="float-right">--}}
{{--                                    <a href=""--}}
{{--                                       id="editrole"--}}
{{--                                       class="btn btn-info" title="edited">--}}
{{--                                        <i class="fa fa-edit"></i>--}}
{{--                                    </a>--}}
{{--                                    <a href=""--}}
{{--                                       data-url=""--}}
{{--                                       id="deleterole"--}}
{{--                                       class="btn btn-danger" title="deleted">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="p-2 row row-cols-1 row-cols-sm-2 row-cols-md-4">--}}
{{--                    @foreach($permissions as $permission)--}}
{{--                        <div class="col-md-4">--}}
{{--                            <span>{{ $permission->name }}</span>--}}
{{--                            <input class="custom-checkbox-2" onclick="togglePermission(`{{ $permission->slug }}`)"--}}
{{--                                   type="checkbox" name="{{ $permission->slug }}" id="{{ $permission->slug }}">--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('roles.create')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد نقش جدید</a>
                <h1 class="card-title" style="float: right">نقش ها و دسترسی ها</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان نقش</th>
                        <th>ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $key=>$role)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                @if($role->active==1)
                                <form action="{{route('roles.destroy', $role->id)}}" method="POST">
                                    @csrf
                                    <a class="btn btn-info btn-sm"
                                       href="{{route('roles.edit', $role->id)}}">
                                        <i class="fa fa-edit text-white"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف نقش اطمینان دارید؟')">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                                    @endif
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
        $("#roles").change(function () {
            var str = ""; // value in option we selected
            var id = ""; // set id of this role
            $("#roles option:selected").each(function () {
                str += $(this).val();
                id += $(this).attr("data-dbid")

                $("#role h3").text(str);
                $("#role h3").attr('data-id', id);

                // Edit Btn
                let editUrl = "{{ route('roles.edit', ':id') }}";
                editUrl = editUrl.replace(':id', id);
                $("#editrole").attr('href', editUrl);
                $("#editrole").attr('data-id', id);

                // Delete Btn
                let deleteUrl = "{{ route('roles.destroy', ':id') }}";
                deleteUrl = deleteUrl.replace(':id', id);
                $("#deleterole").attr('data-url', deleteUrl);
                $("#deleterole").attr('data-id', id);

                // unCheck all checkbox
                $(".custom-checkbox-2").prop("checked", false);

                // fetch Permission for the role of we chose
                fetchPermission(str)
            });
        });

        function fetchPermission(str) {
            jQuery(document).ready(function () {
                if (str) {
                    jQuery.ajax({
                        url: "{{route('access.level.fetchpermission')}}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},

                        data: {
                            'role': str,
                        },
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            if (data.status) {
                                $.map(data.data, function (val, i) {
                                    $("#" + val.slug).prop("checked", true);
                                });
                            }
                        }
                    });
                }
            });
        }

        function togglePermission(slug) {
            let role = $("#roles option:selected").val();
            let checkinput = $("#" + slug).prop("checked") ? true : false;

            if (slug) {
                jQuery.ajax({
                    url: "{{route('access.level.assignpermission')}}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},

                    data: {
                        'role': role,
                        'permission': slug,
                        'checkinput': checkinput
                    },
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        if (data.status) {
                            $.toast({
                                heading: 'success',
                                text: data.message,
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                        }
                    }
                });
            }
        }

        $("#deleterole").on('click',function (e){
            let message = 'آیا از حذف نقش اطمینان دارید؟';
            let action = confirm(message) ? true : false;
            e.preventDefault();

            let choosenOption = $("#role h3").html();

            if ($.trim(choosenOption).length !== 0){

                let url = $("#deleterole").attr('data-url');
                let id = $("#deleterole").attr('data-id');
                if (action){
                    jQuery.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},

                        data: {
                            'id': id,
                        },
                        type: "DELETE",
                        dataType: "json",
                        success: function (data) {
                            if (data.status) {
                                $.toast({
                                    heading: 'success',
                                    text: data.message,
                                    showHideTransition: 'slide',
                                    icon: 'success'
                                });
                                setTimeout(location.reload.bind(location), 3000);
                            }
                        }
                    });
                }
            }else {
                console.log('no');
            }

        });
    </script>
@endsection

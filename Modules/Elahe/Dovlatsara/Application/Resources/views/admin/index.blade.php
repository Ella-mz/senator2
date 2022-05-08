@extends('AdminMasterNew::master')
@section('urlHeader') درخواست ها
@endsection
@section('header')
    درخواست ها
@endsection
@section('css')
    <style>
        .select2-selection.select2-selection--single {
            min-height: 38px;
            background-color: #e9ecef;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <form action="{{route('application.filer.admin')}}" method="post">
                @csrf
                <input name="t" value="1" hidden/>
                <div class="p-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>دسته بندی:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fa fa-list"></i>
                                      </span>
                                    </div>
                                    <select class="form-control" name="category" readonly>
                                        <option value=""></option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">
                                                {{$category->createStringAsParents()}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>شهر:</label>
                                    <select class="form-control select2" name="city" dir="rtl">
                                        <option value=""></option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">
                                                {{$city->title}}
                                            </option>
                                        @endforeach

                                    </select>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>محله:</label>

                                    <select class="form-control select2" name="neighborhood" id="neighborhood" dir="rtl">
                                    </select>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>وضعیت:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-tag"></i>
                      </span>
                                    </div>
                                    <select class="form-control" name="active" readonly>
                                        <option value=""></option>
                                        <option value="active">فعال</option>
                                        <option value="inactive">غیرفعال</option>
                                        <option value="disConfirm">تایید نشده</option>
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <div class="row">

                        <div class="col-md-12 text-left">

                            <button type="submit" class="btn btn-info btn-sm">فیلتر</button>
                            <a href="{{route('application.index.admin')}}" class="btn btn-secondary btn-sm">برگشت به حالت
                                اولیه</a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-2  mt-2 ">
                    <p>فیلتر های اعمال شده :</p>
                </div>
                <div class="col-md-10  mt-2 ">

                    @foreach($tags as $key=>$tag)
                        <span class="badge badge-danger text-white mx-2"> {{$tag}}</span>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="card-header">
                <a href="{{route('categories.find.cats', ['type'=>'applicant', 'panel'=>'admin'])}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد درخواست جدید</a>
                <h1 class="card-title" style="float: right">درخواست ها</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>شهر</th>
                        <th>ثبت شده توسط</th>
                        <th>شماره تماس</th>
                        <th>وضعیت</th>
                        {{--                        <th>فعال/غیرفعال</th>--}}
                        <th>مشاهده/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $key=>$application)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$application->title}}</td>

                            <td>
                                {{$application->city->title}}
                            </td>

                            <td>
                                {{$application->user->name}} {{$application->user->sirName}}
                            </td>
                            <td>
                                {{$application->phone}} @if(isset($application->mobile))- {{$application->mobile}}@endif
                            </td>
                            <td>
                                @if($application->active=='inactive')
                                    غیرفعال
                                @elseif($application->active=='active')
                                    فعال
                                @elseif($application->active=='disConfirm')
                                    عدم تایید
                                    {{--                                @elseif($application->active=='delete')--}}
                                    {{--                                    حذف توسط کاربر--}}
                                @endif

                            </td>
                            {{--                            <td>--}}
                            {{--                                <input class="activation1" type="checkbox"--}}
                            {{--                                       {{$application->active=='active'?"checked":""}}--}}
                            {{--                                       data-toggle="tooltip" title="فعال/غیرفعال کردن "--}}
                            {{--                                       id="{{$application->id}}"--}}
                            {{--                                       name="activation">--}}
                            {{--                            </td>--}}
                            <td class="project-actions text-right">
                                <form action="{{route('application.destroy.admin', $application->id)}}" method="POST">
                                    @csrf

                                    <a class="btn btn-primary btn-sm"
                                       href="{{route('application.show.admin', $application->id)}}">
                                        <i class="fa fa-list"></i>
                                    </a>
                                    {{--                                    <a class="btn btn-info btn-sm"--}}
                                    {{--                                       href="">--}}
                                    {{--                                        <i class="fa fa-edit"></i>--}}
                                    {{--                                    </a>--}}

                                    {{--                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                    <i class="fa fa-trash"></i>--}}
                                    {{--                                </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف درخواست اطمینان دارید؟')">
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
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('select[name="city"]').on('change', function () {
                var cityId = jQuery(this).val();
                if (cityId) {
                    jQuery.ajax({
                        url: "{{route('gettingNeighborhood')}}",
                        data: {
                            'city': cityId
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            jQuery('select[name="neighborhood"]').empty();
                            $('select[name="neighborhood"]').append('<option value=""></option>');
                            jQuery.each(data, function (key, value) {
                                $('select[name="neighborhood"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="neighborhood"]').empty();
                }
            });
        });
    </script>

    {{--    <script>--}}
    {{--        $('.activation1').change(function () {--}}
    {{--            var id = $(this).attr('id')--}}
    {{--            if ($(this).is(":checked")) {--}}
    {{--                var active = 'active';--}}
    {{--            } else {--}}
    {{--                var active = 'inactive';--}}
    {{--            }--}}
    {{--            $.ajax({--}}
    {{--                url: "{{route('applications.activation.admin')}}",--}}
    {{--                data: {--}}
    {{--                    'id': id,--}}
    {{--                    'active': active,--}}
    {{--                },--}}
    {{--                method: "get",--}}
    {{--                dataType: 'JSON',--}}

    {{--                success: function (data) {--}}

    {{--                    location.reload();--}}
    {{--                }--}}
    {{--            })--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection

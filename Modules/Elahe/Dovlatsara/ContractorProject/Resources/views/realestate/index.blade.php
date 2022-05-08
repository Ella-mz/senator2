@extends('RealestateMaster::master')
@section('title_realestate')پروژه های پیمانکاران
@endsection
@section('card_title')پروژه های پیمانکاران
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="card">
            <div class="card-header">
                                <a href="{{route('contractorProject.create.realestate')}}"
                                   class="btn" style="float: left;background-color: #3c3cce;color: #fff">ایجاد پروژه جدید</a>
                <h1 class="card-title" style="float: right">پروژه های پیمانکاران</h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>نام کاربر</th>
                        <th>توضیحات</th>
{{--                        <th>وضعیت</th>--}}
                        <th>ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($con_projects as $key=>$con_project)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$con_project->title}}</td>

                            <td>
                                {{$con_project->user->name}} {{$con_project->user->sirName}}
                            </td>
                            <td>{{$con_project->description}}</td>

{{--                            <td>--}}
{{--                                @if($con_project->active=='inactive')--}}
{{--                                    غیرفعال--}}
{{--                                @elseif($con_project->active=='active')--}}
{{--                                    فعال--}}
{{--                                @endif--}}

{{--                            </td>--}}
                            <td class="project-actions text-right">
                                <form action="{{route('contractorProject.destroy.realestate', $con_project->id)}}" method="POST">
                                    @csrf

{{--                                    <a class="btn btn-primary btn-sm"--}}
{{--                                         href="{{route('ad.show.supplier.realestate', $con_project->id)}}">--}}
{{--                                        <i class="fa fa-list"></i>--}}
{{--                                    </a>--}}
                                    <a class="btn btn-info btn-sm"
                                       href="{{route('contractorProject.edit.realestate', $con_project->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{--                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                    <i class="fa fa-trash"></i>--}}
                                    {{--                                </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف پروژه اطمینان دارید؟')">
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

@endsection
@section('js_realestate')
    @include('RealestateMaster::layouts.data_table')

@endsection

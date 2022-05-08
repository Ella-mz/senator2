@extends('AdminMasterNew::master')
@section('urlHeader')مهارت های اصناف
@endsection
@section('header')
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('associationSkills.create.admin', $association->id)}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد مهارت جدید</a>

                <h1 class="card-title" style="float: right">مهارت های صنف <a
                        href="{{route('associations.index.admin', $association->parent_id)}}">{{$association->title}}</a>
                </h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>عکس</th>
                        <th>
                            ویرایش/حذف
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($associationSkills as $key=>$skill)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>

                            <td>{{$skill->title}}</td>
                            {{--                            @if($parentId == 0 )--}}
                            @if(isset($skill->image))
                                <td width="80" height="40">
                                    <img src="{{asset($skill->image)}}" width="80" height="40">
                                </td>
                            @else
                                <td width="80" height="40">
                                    <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">
                                </td>
                            @endif
                            <td class="project-actions text-right">
                                <form
                                    action="{{ route('associationSkills.destroy.admin' ,$skill->id) }}"
                                    method="POST">
                                    @csrf
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('associationSkills.edit.admin', $skill->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{--                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                    <i class="fa fa-trash"></i>--}}
                                    {{--                                </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف مهارت {{$skill->title}} اطمینان دارید؟')">
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

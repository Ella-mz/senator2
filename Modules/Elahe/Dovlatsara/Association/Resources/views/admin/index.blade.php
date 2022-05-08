@extends('AdminMasterNew::master')
@section('urlHeader')اصناف
@endsection
@section('header')
    {!! $map !!}
    {{--    @foreach($categories as $category->iteme)--}}
    {{--    <li><a href="{{route('category.index.admin',0)}}" title="categories">Categories</a></li>--}}
    {{--    @endforeach--}}
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('associations.add.admin', $parentId)}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد صنف جدید</a>

                <h1 class="card-title" style="float: right">اصناف</h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
{{--                        @if($parentId == 0 )--}}
                            <th>عکس</th>
{{--                        @endif--}}
                        <th>مهارت ها</th>
{{--                        @if($parentId == 0 )--}}
{{--                            <th>هزینه</th>--}}
{{--                        @endif--}}
                        <th>
                            @if($parentId == 0 ? true : \Modules\Association\Entities\Association::find($parentId)->depth<1)
                                مشاهده/
                            @endif
                            ویرایش/حذف
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($associations as $key=>$association)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$association->title}}</td>
{{--                            @if($parentId == 0 )--}}
                                @if(isset($association->image))
                                    <td width="80" height="40">
                                        <img src="{{asset($association->image)}}" width="80" height="40">
                                    </td>
                                @else
                                    <td width="80" height="40">
                                        <img src="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">
                                    </td>
                                @endif
{{--                            @endif--}}
                            <td>
                                @if($association->depth==2)

                                <a href="{{route('associationSkills.index.admin', $association->id)}}"
                                   class="btn btn-sm btn-primary"><i class="fa fa-plus-circle nav-icon text-white"></i></a>
                                @else
                                    <span class="badge badge-info">مهارت برای زیر مجموعه اصناف تعریف می شود</span>
                                @endif
                            </td>

                            {{--                            @if($parentId == 0 )--}}

{{--                                <td>--}}
{{--                                    <a href="{{route('advertisingFee.index.admin', $category->id)}}"--}}
{{--                                       class="btn btn-sm btn-primary"><i class="fa fa-plus-circle nav-icon text-white">--}}
{{--                                        </i></a>--}}

{{--                                </td>--}}
{{--                            @endif--}}

                            <td class="project-actions text-right">
                                <form
                                    action="{{ route('associations.destroy.admin' ,$association->id) }}"
                                    method="POST">
                                    @csrf
                                    @if($parentId == 0 ? true : \Modules\Association\Entities\Association::find($parentId)->depth<1)

                                        <a class="btn btn-primary btn-sm"
                                           href="{{route('associations.index.admin',$association->id)}}">
                                            <i class="fa fa-list"></i>
                                        </a>
                                    @endif
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('associations.edit.admin', $association->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{--                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                    <i class="fa fa-trash"></i>--}}
                                    {{--                                </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف صنف {{$association->title}} اطمینان دارید؟')">
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

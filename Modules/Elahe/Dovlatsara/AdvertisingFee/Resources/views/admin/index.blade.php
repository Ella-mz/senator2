@extends('AdminMasterNew::master')
@section('urlHeader') هزینه های {{$category->title}}
@endsection
@section('header')
    {{--    {!! $map !!}--}}
    {{--    @foreach($categories as $category->iteme)--}}
    {{--    <li><a href="{{route('category.index.admin',0)}}" title="categories">Categories</a></li>--}}
    {{--    @endforeach--}}
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('advertisingFee.add.admin', $category->id)}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد هزینه جدید</a>
                <h1 class="card-title" style="float: right">هزینه های <a href="{{route('category.index.admin', $category->id)}}">{{$category->title}}</a></h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>مدت زمان</th>
                        <th>هزینه آگهی های عادی</th>
                        <th>هزینه آگهی های نردبانی</th>
                        <th>هزینه آگهی های ویژه</th>
                        <th>هزینه آگهی های فوری</th>
                        <th>حذف/ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($adFees as $key=>$adFee)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$adFee->expireTimeOfAds}}</td>
                            <td>
                                {{number_format($adFee->generalAdFee)}}
                            </td>
                            <td>
                                {{number_format($adFee->scalarAdFee)}}

                            </td>
                            <td>
                                {{number_format($adFee->specialAdFee)}}

                            </td>
                            <td>
                                {{number_format($adFee->emergencyAdFee)}}

                            </td>
                            <td>
                                <form action="{{ route('advertising-fees.destroy' ,$adFee->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('advertising-fees.edit', $adFee->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

{{--                                    <a class="btn btn-danger btn-sm"--}}
{{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف هزینه اطمینان دارید؟')">
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

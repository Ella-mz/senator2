@extends('AdminMasterNew::master')
@section('urlHeader')هولوگرام ها
@endsection
@section('header')
    هولوگرام ها
@endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{route('holograms.create.admin')}}"
                   class="btn btn-sm btn-primary" style="float: left">ایجاد هولوگرام جدید</a>

                <h1 class="card-title" style="float: right">هولوگرام ها</h1>

            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>لوگو</th>
                        <th>نوع</th>
                        <th>هزینه</th>
                        <th>توضیحات</th>
                        <th>ویرایش/حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($holograms as $key=>$hologram)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$hologram->title}}</td>
                            {{--                            @if(isset($category->image))--}}
                            {{--                                <td width="80" height="40">--}}
                            {{--                                    <img src2="{{asset($category->image)}}" width="80" height="40">--}}
                            {{--                                </td>--}}
                            {{--                            @else--}}
                            {{--                                <td width="80" height="40">--}}
                            {{--                                    <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                            {{--                                </td>--}}
                            {{--                            @endif--}}
                            @if(isset($hologram->logo))
                                <td width="80" height="40">
                                    <img src="{{asset($hologram->logo)}}" width="80" height="40">
                                </td>
                            @else
                                <td width="80" height="40">
{{--                                    <img src2="{{asset('panel/dist/img/AdminLTELogo.png')}}" width="80" height="40">--}}
                                </td>
                            @endif
                            <td>
                                @if($hologram->type=='ad')
                                    آگهی
                                @elseif($hologram->type=='user')
                                    کاربر
                                @endif
                            </td>
                            <td>
                                {{number_format($hologram->price)}} ریال

                            </td>
                            <td>
                               {{$hologram->description}}

                            </td>
                            <td>
                                <form action="{{ route('holograms.destroy.admin' ,$hologram->id) }}" method="POST">
                                    @csrf
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('holograms.edit.admin', $hologram->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{--                                    <a class="btn btn-danger btn-sm"--}}
                                    {{--                                       href="{{ route('category.destroy.admin', $category->id)}}">--}}
                                    {{--                                        <i class="fa fa-trash"></i>--}}
                                    {{--                                    </a>--}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا از حذف هولوگرام {{$hologram->title}} اطمینان دارید؟ درصورت حذف هولوگرام، هولوگرام کاربران یا آگهی های مربوطه نیز حذف خواهد شد.')">
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

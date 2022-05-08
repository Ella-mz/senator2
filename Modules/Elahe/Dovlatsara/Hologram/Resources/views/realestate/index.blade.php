@extends('RealestateMaster::master')
@section('title_realestate')هولوگرام های @if($type=='user') کاربری @elseif($type=='ad') آگهی @endif
@endsection
@section('card_title')هولوگرام های @if($type=='user') کاربری @elseif($type=='ad') آگهی @endif
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="card">
            <div class="card-header">
{{--                <a href="{{route('contractorProject.create.realestate')}}"--}}
{{--                   class="btn" style="float: left;background-color: #3c3cce;color: #fff">ایجاد پروژه جدید</a>--}}
                <h1 class="card-title" style="float: right">هولوگرام های @if($type=='user') کاربری @elseif($type=='ad') آگهی @endif </h1>
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
                        <th>درخواست</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($holograms as $key=>$hologram)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$hologram->title}}</td>
                            @if(isset($hologram->logo))
                                <td width="80" height="40">
                                    <img src="{{asset($hologram->logo)}}" width="80" height="40">
                                </td>
                            @else
                                <td width="80" height="40">
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
                                {{number_format(substr($hologram->price, 0, -1))}} تومان

                            </td>
                            <td>
                                {{$hologram->description}}
                            </td>
                            <td>
                                <a href="{{route('hologram.choose.realestate', ['hologram'=>$hologram->id, 'id'=>$id])}}" class="btn btn-sm"
                                style="background-color: #3c3cce;color: #fff"><i class="fa fa-plus"></i></a>

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

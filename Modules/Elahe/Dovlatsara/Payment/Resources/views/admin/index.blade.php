@extends('AdminMasterNew::master')
@section('urlHeader')لیست پرداخت های @if($type=='ad')آگهی
@elseif($type=='advertisement')
    تبلیغات

@elseif($type=='membership')
    حق اشتراک ها

@elseif($type=='applicantMembership')
    حق اشتراک های درخواست

@endif
@endsection
@section('header')
لیست پرداخت های @if($type=='ad')آگهی
@elseif($type=='advertisement')
    تبلیغات

@elseif($type=='membership')
    حق اشتراک ها

@elseif($type=='applicantMembership')
    حق اشتراک های درخواست
@endif

@endsection
@section('content')
    <section class="content">

        <div class="card">
            <form action="{{route('payments.filter.admin', $type)}}" method="post">
                @csrf
                <input name="t" value="1" hidden/>
                <div class="p-2">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>موبایل کاربر:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fa fa-mobile"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control"><br>
                                    <div>
                                        <small class="text-danger">{{ $errors->first('mobile') }}</small></div>

                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>کد رهگیری:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fa fa-code"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="resNum" value="{{old('resNum')}}" class="form-control">
                                    <small class="text-danger">{{ $errors->first('resNum') }}</small>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        {{--                <div class="col-md-3">--}}
                        {{--                    <div class="form-group">--}}
                        {{--                        <label>نوع آگهی:</label>--}}

                        {{--                        <div class="input-group">--}}
                        {{--                            <div class="input-group-prepend">--}}
                        {{--                      <span class="input-group-text">--}}
                        {{--                        <i class="fa fa-link"></i>--}}
                        {{--                      </span>--}}
                        {{--                            </div>--}}
                        {{--                            <select class="form-control" name="type" readonly>--}}
                        {{--                                <option value=""></option>--}}
                        {{--                                <option value="1">عرضه کننده</option>--}}
                        {{--                                <option value="2">درخواست کننده</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                        {{--                        <!-- /.input group -->--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--                <div class="col-md-3">--}}
                        {{--                    <div class="form-group">--}}
                        {{--                        <label>وضعیت پرداخت:</label>--}}

                        {{--                        <div class="input-group">--}}
                        {{--                            <div class="input-group-prepend">--}}
                        {{--                      <span class="input-group-text">--}}
                        {{--                        <i class="fa fa-link"></i>--}}
                        {{--                      </span>--}}
                        {{--                            </div>--}}
                        {{--                            <select class="form-control" name="status" readonly>--}}
                        {{--                                <option value=""></option>--}}
                        {{--                                <option value="paid">موفق</option>--}}
                        {{--                                <option value="unpaid">ناموفق</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                        {{--                        <!-- /.input group -->--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--                    <div class="col-md-3">--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <label>شهر:</label>--}}

                        {{--                            <div class="input-group">--}}
                        {{--                                <div class="input-group-prepend">--}}
                        {{--                      <span class="input-group-text">--}}
                        {{--                        <i class="fa fa-building"></i>--}}
                        {{--                      </span>--}}
                        {{--                                </div>--}}
                        {{--                                <select class="form-control" name="city" readonly>--}}
                        {{--                                    <option value=""></option>--}}
                        {{--                                    @foreach($cities as $city)--}}
                        {{--                                        <option value="{{$city->id}}">--}}
                        {{--                                            {{$city->title}}--}}
                        {{--                                        </option>--}}
                        {{--                                    @endforeach--}}

                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /.input group -->--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                    <div class="col-md-3">--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <label>محله:</label>--}}

                        {{--                            <div class="input-group">--}}
                        {{--                                <div class="input-group-prepend">--}}
                        {{--                      <span class="input-group-text">--}}
                        {{--                        <i class="fa fa-building"></i>--}}
                        {{--                      </span>--}}
                        {{--                                </div>--}}
                        {{--                                <select class="form-control" name="neighborhood" readonly>--}}
                        {{--                                    --}}{{--                                <option value=""></option>--}}
                        {{--                                    --}}{{--                                @foreach($neighborhoods as $neighborhood)--}}
                        {{--                                    --}}{{--                                    <option value="{{$neighborhood->id}}">--}}
                        {{--                                    --}}{{--                                        {{$neighborhood->title}}--}}
                        {{--                                    --}}{{--                                    </option>--}}
                        {{--                                    --}}{{--                                @endforeach--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /.input group -->--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                <div class="col-md-3">--}}
                        {{--                    <div class="form-group">--}}
                        {{--                        <label>از تاریخ:</label>--}}

                        {{--                        <div class="input-group">--}}
                        {{--                            <div class="input-group-prepend">--}}
                        {{--                      <span class="input-group-text">--}}
                        {{--                        <i class="fa fa-calendar"></i>--}}
                        {{--                      </span>--}}
                        {{--                            </div>--}}
                        {{--                            <input class="datePicker form-control" name="startDate" readonly/>--}}
                        {{--                        </div>--}}
                        {{--                        <!-- /.input group -->--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}

                        {{--                <div class="col-md-3">--}}
                        {{--                    <div class="form-group">--}}
                        {{--                        <label>تا تاریخ:</label>--}}

                        {{--                        <div class="input-group">--}}
                        {{--                            <div class="input-group-prepend">--}}
                        {{--                      <span class="input-group-text">--}}
                        {{--                        <i class="fa fa-calendar"></i>--}}
                        {{--                      </span>--}}
                        {{--                            </div>--}}
                        {{--                            <input class="datePicker form-control" name="endDate" readonly/>--}}
                        {{--                        </div>--}}
                        {{--                        <!-- /.input group -->--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}


                    </div>
                </div>
                <div class="p-2">
                    <div class="row">
                        <div class="col-md-12 text-left">

                            <button type="submit" class="btn btn-info btn-sm">فیلتر</button>
                            <a href="{{route('payments.filter.admin', $type)}}" class="btn btn-secondary btn-sm">برگشت به حالت
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
            </div> <div class="card-header">
                <h1 class="card-title" style="float: right">لیست پرداخت های @if($type=='ad')آگهی
                    @elseif($type=='advertisement')
                        تبلیغات

                    @elseif($type=='membership')
                        حق اشتراک ها

                    @elseif($type=='applicantMembership')
                        حق اشتراک های درخواست

                    @endif
                </h1>
            </div>
            <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-hover table-sm display responsive nowrap">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>موبایل کاربر</th>
                        <th>هزینه</th>
                        <th>کد رهگیری</th>
                        <th>تاریخ</th>
                        <th>وضعیت پرداخت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $key=>$payment)
                        <tr>
                            <td>{{strlen($key+1)==1?'0'.($key+1):$key+1}}</td>
                            <td>{{$payment->order->user->mobile}}</td>

                            <td>{{number_format($payment->price)}} ریال</td>
                            <td>{{$payment->resNum}}</td>
                            <td>{{isset($payment->date)?verta($payment->date)->formatJalaliDate():''}}</td>

                            <td>
                                @if($payment->status=='paid')
                                    موفق
                                @else
                                    ناموفق
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
    </div>
@endsection
@section('js')
    @include('AdminMasterNew::layouts.data_table')
@endsection

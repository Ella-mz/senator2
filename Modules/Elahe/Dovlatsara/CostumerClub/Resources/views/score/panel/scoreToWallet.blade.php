@extends('RealestateMaster::master')
@section('title_realestate') تبدیل امتیاز به کیف پول
@endsection
@section('card_title')  تبدیل امتیاز به پول
@endsection
@section('content_realestateMaster')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">
                </div>
                <!-- /.col -->
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold"></h3>

                            <div class="card-tools">

                                {{--                        <div class="input-group input-group-sm" style="width: 150px;">--}}
                                {{--                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">--}}

                                <div class="input-group-append">
                                    {{--                                    <a href="{{route('hologram.index.user.realestate')}}"--}}
                                    {{--                                       class="btn btn-info btn-sm"><i class="fa fa-arrow-left text-white"></i></a>--}}
                                </div>
                                {{--                        </div>--}}
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="callout callout-costumBlue">
                                <h5>توضیحات</h5>
                                <table class="table table-hover">

                                    <tr>
                                        <th>موجودی کیف پول فعلی شما:</th>
                                        <td>{{number_format($current_balance)}} ریال</td>
                                    </tr>
                                    <tr>

                                        <th>امتیاز شما:</th>
                                        <td>{{$current_bonus_scores}} امتیاز</td>
                                    </tr>
                                    <tr>
                                        <th>مبلغ حاصل از تبدیل امتیازات شما:</th>
                                        <td>{{number_format($score_exchange)}} ریال</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row justify-content-center align-items-center">
                                <a href="{{route('scores.conversion-score-to-wallet.panel')}}" class="btn" style="background-color: #3c3cce;color: #fff; @if($current_bonus_scores<=0) cursor: not-allowed @endif"> تبدیل امتیاز به کیف پول</a>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
@section('js_realestate')

@endsection

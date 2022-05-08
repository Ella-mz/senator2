@extends('UserMasterNew::master')
@section('title_user')پرداخت هزینه
@endsection
@section('css_user')
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/invoice.css')}}">
    <style>
        .input-style {
            box-shadow: inset 0 0 6px #35353567;
            border: none;
            height: 40px;
            width: 280px;
            border-radius: 5px;
            margin-left: 10px;
        }

        .button-style {
            margin: 0 8px;
            padding: 6px 18px;
            border: 1px solid #23376c;
            border-radius: 6px;
            font-size: 15px;
            background-color: #23376c;
            color: #fff;
        }
    </style>

@endsection
@section('content_userMasterNew')
    <main class="invoice-main-page">
        <section class="invoice-page">
            <form method="post" action="{{route('adFee.pay.realestate')}}">
                @csrf
                <input hidden name="id" value="{{$ad->id}}">
                <input hidden name="adFeeId" value="{{$advertisingFee->id}}">
                <div id="isWallet">
                </div>
                <div class="container">
                    <div class="show-invoice">
                        <div class="invoice-title">
                            <h3><strong>پرداخت هزینه آگهی
                                </strong></h3>
                        </div>
                        <div class="invoice-image">
                            <img src="{{asset('files/userMaster/assets/img/Icon awesome-credit-card.png')}}" alt="">
                        </div>
                        <div class="invoice-info-box">
                            <ul>
                                <li>
                                    <p class="title">آگهی:</p>
                                    <span>{{$ad->title}}</span>
                                </li>
                                <li>
                                    <p class="title">نوع آگهی:</p>
                                    @if($ad->type=='general')
                                        <span>عادی</span>
                                    @elseif($ad->type=='scalar')
                                        <span>نردبانی</span>
                                    @elseif($ad->type=='special')
                                        <span>ویژه</span>
                                    @else
                                        <span>فوری</span>
                                    @endif
                                </li>
                                <li>
                                    <p class="title">هزینه آگهی:</p>
                                    @if($ad->type=='general')
                                        <span>{{number_format(substr($advertisingFee->generalAdFee, 0, -1))}} تومان</span>
                                    @elseif($ad->type=='scalar')
                                        <span>{{number_format(substr($advertisingFee->scalarAdFee, 0, -1))}} تومان</span>

                                    @elseif($ad->type=='special')
                                        <span>{{number_format(substr($advertisingFee->specialAdFee, 0, -1))}} تومان</span>

                                    @else
                                        <span>{{number_format(substr($advertisingFee->emergencyAdFee, 0, -1))}} تومان</span>

                                    @endif
                                </li>
                                <li>
                                    <p class="title">برداشت از کیف پول:</p>
                                    <span id="wallet_withdrawal">{{number_format(0) }} تومان</span>
                                </li>
                                <li id="total_payment">

                                </li>
                            </ul>
                        </div>
                        آگهی شما از تاریخ {{verta(\Carbon\Carbon::now())->formatJalaliDate()}} تا
                        تاریخ {{verta(\Carbon\Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'))->formatJalaliDate()}}
                        معتبر خواهد بود
                    </div>
                    <div class="show-invoice">
                        <div class="invoice-info-box">

                            <input name="wallet_value" id="wallet_value" class="input-style"
                                   value="{{old('wallet_value')}}"
                                   placeholder="مبلغ برداشتی از کیف پول(تومان) را وارد نمایید"
                                   onkeyup="separateNum(this.value,this);">
                            <button type="button" class="button-style" style="cursor: pointer"
                                    onclick="walletComputation($('#wallet_value').val())">اعمال
                                کیف پول
                            </button>
                            <span
                                style="color: #21cc8d; margin-left: 215px" id="walletBalance">موجودی کیف پول شما: {{number_format($current_balance>0?substr($current_balance, 0, -1):0)}} تومان</span><br>
                            <small class="text text-danger" id="walletValueError"></small><br>
                            @error('wallet_value')
                            <small class="text text-danger">{{ $message }}</small><br>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="sub-invoice-btns">
                    <button class="sub-invoice-button"
                            {{--                       href="{{route('payAdFee.realestate', ['ad'=>$ad->id,'adFee'=>$advertisingFee->id])}}"--}}
                            style="cursor: pointer">پرداخت</button>
                    <a href="{{route('ad.myPosts.supplier.user')}}"
                       class="sub-invoice-button cancel">انصراف</a>
                </div>
            </form>
        </section>
    </main>
@endsection
@section('js_user')
    <script>
        function walletComputation(val) {
            if ('{{$ad->type=='general'}}') {
                var price = '{{$advertisingFee->generalAdFee}}';
            }
            else if('{{$ad->type=='scalar'}}') {
                var price = '{{$advertisingFee->scalarAdFee}}';
            }else if('{{$ad->type=='special'}}') {
                var price = '{{$advertisingFee->specialAdFee}}';
            }else{
                var price = '{{$advertisingFee->emergencyAdFee}}';
            }

            if (val) {
                $('#walletValueError').empty();
                jQuery.ajax({
                    url: "{{route('wallet.computation')}}",
                    data: {
                        'walletValue': val,
                        'price': price,
                    },
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 403) {
                            $('#walletValueError').empty();
                            $('#walletValueError').append(data.errors);
                            $('#isWallet').empty();
                        } else {
                            $('#walletValueError').empty();
                            $('#walletValueError').append(data.errors);
                            $('#total_payment').empty();
                            $('#wallet_withdrawal').empty();
                            $('#total_payment').append(data.totalPayment);
                            $('#wallet_withdrawal').append(data.walletWithdrawal);
                            $('#walletBalance').empty();
                            $('#walletBalance').append(data.walletBalance);
                            $('#isWallet').empty();
                            str = `<input hidden name="isWallet" value="1">`;
                            $('#isWallet').append(str);

                        }
                    }
                });
            } else {
                $('#isWallet').empty();
                $('#walletValueError').empty();
                $('#walletValueError').append('لطفا مبلغ را وارد نمایید');
            }
        }
    </script>

@endsection

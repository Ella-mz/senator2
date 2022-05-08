@extends('RealestateMaster::master')
@section('title_realestate')فاکتور
@endsection
@section('css')
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
@section('content_realestateMaster')
    <main class="invoice-main-page">
        <section class="invoice-page">
            <form method="post" action="{{route('advertisement.pay.realestate')}}" id="factorForm">
                @csrf
                <input hidden name="id" value="{{$advertisingApplication->id}}">
                <div id="isWallet">
                </div>
                <div class="container">
                    <div class="show-invoice">
                        <div class="invoice-title">
                            <h3><strong>پرداخت هزینه تبلیغ
                                </strong></h3>
                        </div>
                        <div class="invoice-image">
                            <img src="{{asset('files/userMaster/assets/img/Icon awesome-credit-card.png')}}" alt="">
                        </div>
                        <div class="invoice-info-box">
                            <ul>
                                <li>
                                    <p class="title">تبلیغ:</p>
                                    <span>{{$advertising->title}}</span>
                                </li>
                                <li>
                                    <p class="title">تبلیغ لینک به:</p>
                                    <span>{{$advertisingApplication->link}}</span>
                                </li>
                                @if($advertisingApplication->category)
                                    <li>
                                        <p class="title">دسته بندی: </p>
                                        <span>{{\Modules\Category\Entities\Category::find($advertisingApplication->category)->createStringAsParents3()}}</span>
                                    </li>
                                @endif
                                <li>
                                    <p class="title">مبلغ:</p>
                                    <span>{{number_format(substr($advertising->price, 0, -1)) }} تومان</span>
                                </li>
                                <li>
                                    <p class="title">برداشت از کیف پول:</p>
                                    <span id="wallet_withdrawal">{{number_format(0) }} تومان</span>
                                </li>
                                <li id="total_payment">

                                </li>
                            </ul>

                        </div>
                        تبلیغ شما از تاریخ {{verta($advertisingApplication->startDate)->formatJalaliDate()}} تا
                        تاریخ {{verta($advertisingApplication->endDate)->formatJalaliDate()}} معتبر خواهد بود
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
                    <button class="sub-invoice-button" style="cursor: pointer">پرداخت</button>
                    <a href="{{url($callbackUrlForFactor)}}" class="sub-invoice-button cancel">انصراف</a>
                </div>
            </form>
        </section>
    </main>
@endsection
@section('js_realestate')
    <script>
        function walletComputation(val) {
            if (val) {
                $('#walletValueError').empty();
                jQuery.ajax({
                    url: "{{route('wallet.computation')}}",
                    data: {
                        'walletValue': val,
                        'price': {{$advertising->price}},
                        // ''
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

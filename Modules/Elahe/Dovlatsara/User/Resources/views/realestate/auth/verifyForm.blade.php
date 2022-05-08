
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('files/userMaster/assets/css/verification.css')}}">
    <link rel="shortcut icon" type="image/jpg" href="{{asset(\Modules\Setting\Entities\Setting::where('title', 'favicon_file')->first()->str_value)}}">
    <title>کد تایید</title>
</head>

<body>
<header></header>
<main>
    <section class="verification">

        <div class="finger-bg">
            <div class="fraworkBg">
                <div class="container">
                    <div class="show-verification">
                        <div class="verification-box">
                            <div class="verification-box-white-bg">
                                <div class="verification-box-show-prev-btn">
                                </div>

                                <div class="verification-box-show-logo">
                                    <img src="{{asset('fiels/userMaster/assets/img/logoDolatsara.svg')}}" alt="">
                                </div>
                                <div class="verification-box-show-p-text">
                                    <p>لطفا کد ارسال شده به {{$user->mobile}} را وارد نمایید</p>
                                </div>
                                <form action="{{route('user.verify.panel', $user->id)}}" method="post">
                                    @csrf
                                    <input hidden name="mobile" value="{{$user->mobile}}">
                                <div class="verification-box-show-input">
                                    <input type="text" name="verification_code">
                                    <br>
                                    @error('verification_code')
                                    <small class="text-danger mb-4">{{ $message }}</small><br>
                                    @enderror
                                    @if(session()->has('message'))
                                        <small class="text-danger mb-4">{{ session()->get('message') }}</small>

                                    @endif
                                </div>
                                <div class="verification-box-show-send-btn">
                                    <button type="submit">
                                        ارسال
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
<footer style="all: unset"></footer>
</body>

</html>

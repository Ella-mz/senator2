<footer>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-12 ">
                <div class="show-footer">
                    <div class="footer-menu">
                        <div class="right">
                            <div class="logo">
{{--                                @if(isset(\Modules\Setting\Entities\Setting::--}}
{{--where('title', 'logo_of_site')->first()->str_value))--}}
{{--                                    <img src="{{asset(\Modules\Setting\Entities\Setting::--}}
{{--where('title', 'logo_of_site')->first()->str_value)}}" alt="logo">--}}
{{--                                @endif--}}
                            </div>

                            <div class="" id="footer-nav">
                                <ul class="footer-nav-ul">

                                    <li class="footer-nav-item">
                                        <a class="nav-link cool-move purple" href="{{route('aboutUs.index.user')}}">درباره ما</a>
                                    </li>
                                    <li class="footer-nav-item">
                                        <a class="nav-link cool-move purple" href="{{route('rulesAndTerms.index.user')}}">قوانین و مقررات </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-xl-6 col-lg-12 ">
                <div class="show-footer">
                    <div class="footer-left">
                        <!-- <div class="col-lg-6 col-md-12"> -->
                        <div class="footer-social-copy">
                            <div class="socials">
                                <a href=""> <img src="{{asset('files/userMaster/assets/img/facebook.svg')}}" alt=""></a>
                                <a href=""> <img src="{{asset('files/userMaster/assets/img/twitter.svg')}}" alt=""></a>
                                <a href=""> <img src="{{asset('files/userMaster/assets/img/youtube.svg')}}" alt=""></a>
                                <a href=""> <img src="{{asset('files/userMaster/assets/img/instagram.svg')}}" alt=""></a>
                            </div>

                        </div>
                        <div class="footer-left-img">

                            <img src="{{asset('files/userMaster/assets/img/logo.png')}}" alt=""><img src="{{asset('files/userMaster/assets/img/logo (1).png')}}" alt="">
                        </div>
                    </div>
                    <!-- <div class="col-lg-6 col-md-12"> -->

                </div>

            </div>

        </div>
    </div>
    {{--    <div class="copy-text">--}}
    {{--        <p>Copyright 2020 Dolatsara Allrights Reserved</p>--}}
    {{--    </div>--}}
</footer>

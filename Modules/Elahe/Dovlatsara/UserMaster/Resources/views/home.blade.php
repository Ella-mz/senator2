@extends('UserMaster::master')
@section('title_user')  خانه
@endsection
@section('content_userMaster')
    <div class="homePage-header">
        <div class="mainTop ">
            <div class="container header">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="heading">
                            <div class="title">
                                <h2>دولت سرا، جامع ترین سیستم خدمات ملک در ایران</h2>
                            </div>
                            <div class="input-box">
                                <form action="">
                                    <select name="titles" id="titles">
                                        <option value="volvo">دنبال چی میگردی؟</option>
                                        <option value="saab">اجاره خانه</option>
                                        <option value="opel">خرید خانه</option>
                                        <option value="audi">درخواست خانه</option>
                                    </select>
                                    <input type="input" class="header-input large" placeholder="آدرس، منطقه، محله">
                                    <button class="RecBtn red">جستجو</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-circle">
            <div class="circle">
                <div class="second-circle">
                    <img src="{{asset('files/userMaster/assets/img/maps-and-flags.png')}}" alt="">
                </div>

            </div>
        </div>
    </div>
    <main>

        <!-- show city -->
        <div class="city-tehran">
            <div class="container">
                <h1>محله های پر معامله تهران</h1>
                <div class="">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 px-3 my-4">
                            <div class="show-city">
                                <div class="city-logo">
                                    <img src="assets/img/maps-and-flags.png" alt="">
                                </div>
                                <div class="city-name">
                                    <h2>شمال تهران</h2>
                                </div>
                                <div class="city-desc">
                                    <p>
                                        مناطق 1 و 2 و 3 و 4 و 5
                                    </p>
                                </div>
                                <div class="city-icon-down">
                                    <a href=""> <img src="assets/img/Group 19.svg" alt=""></a>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-2 col-md-3 px-3 my-4">
                            <div class="show-city">
                                <div class="city-logo">
                                    <img src="assets/img/maps-and-flags.png" alt="">
                                </div>
                                <div class="city-name">
                                    <h2>شمال تهران</h2>
                                </div>
                                <div class="city-desc">
                                    <p>
                                        مناطق 1 و 2 و 3 و 4 و 5
                                    </p>
                                </div>
                                <div class="city-icon-down">
                                    <a href=""> <img src="assets/img/Group 19.svg" alt=""></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-1 px-3"></div>
                        <div class="col-lg-2 col-md-3 px-3 my-4">
                            <div class="show-city">
                                <div class="city-logo">
                                    <img src="assets/img/maps-and-flags.png" alt="">
                                </div>
                                <div class="city-name">
                                    <h2>شمال تهران</h2>
                                </div>
                                <div class="city-desc">
                                    <p>
                                        مناطق 1 و 2 و 3 و 4 و 5
                                    </p>
                                </div>
                                <div class="city-icon-down">
                                    <a href=""> <img src="assets/img/Group 19.svg" alt=""></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-1 px-3"></div>
                        <div class="col-lg-2 col-md-3 px-3 my-4">
                            <div class="show-city">
                                <div class="city-logo">
                                    <img src="assets/img/maps-and-flags.png" alt="">
                                </div>
                                <div class="city-name">
                                    <h2>شمال تهران</h2>
                                </div>
                                <div class="city-desc">
                                    <p>
                                        مناطق 1 و 2 و 3 و 4 و 5
                                    </p>

                                </div>
                                <div class="city-icon-down">
                                    <a href=""> <img src="assets/img/Group 19.svg" alt=""></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-2 col-md-3 px-3 my-4">
                            <div class="show-city">
                                <div class="city-logo">
                                    <img src="assets/img/maps-and-flags.png" alt="">
                                </div>
                                <div class="city-name">
                                    <h2>شمال تهران</h2>
                                </div>
                                <div class="city-desc">
                                    <p>
                                        مناطق 1 و 2 و 3 و 4 و 5
                                    </p>

                                </div>
                                <div class="city-icon-down">
                                    <a href=""> <img src="assets/img/Group 19.svg" alt=""></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end of show city -->


        <!-- resent product -->
        <div class="resent-product">
            <div class="container">
                <div class="resent-product-title">

                    <h1>آخرین ملک ها</h1>
                    <h6>جدید ترین ملک های ثبت شده</h6>
                </div>

                <div class="row">

                    <div class="col-lg-3 col-md-4 col-sm-6  mb-5">
                        <div class="show-product">
                            <div class="pro-img">
                                <img src="assets/img/download (3).jpg" alt="">
                            </div>
                            <div class="pro-option">
                                <ul>
                                    <li>
                                        <img src="assets/img/Group 20.png" alt="">
                                    </li>
                                    <li>
                                        <img src="assets/img/Group 21.png" alt="" class="option-img">
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-code">
                                <p> <span>کد ملک</span> <span> 4686012 </span></p>
                            </div>

                            <div class="pro-name">
                                <h2>فروش اپارتمان 200 متری</h2>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="pro-desc">
                                <ul>
                                    <li>
                                        <div class="pro-desc-item">

                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="pro-desc-item">

                                            <img src="assets/img/home.png" alt="">
                                            <span class="pro-desc-item-num">4</span>
                                            <span> خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-price-btn">
                                <div class="price">
                                    <h3>قیمت</h3>
                                    <p>25/200/000/000</p>
                                </div>
                                <a href="">
                                    <div class="pro-btn">

                                        <img src="assets/img/Group 19.svg" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="product-more">
                    <a href="">
                        <span>موارد بیشتر</span>
                        <img src="assets/img/Group 18.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
        <!-- end of resent product -->


        <!-- product baner -->
        <div class="product-baner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 my-3">
                        <div class="banner">
                            <div class="baner-content">
                                <div class="baner-content-desc">
                                    <h2>ملک های اجاره ای</h2>
                                    <P>
                                        تجربه رویایی یافتن و اجاره ملک خود با جستجوی پیشرفته
                                    </P>
                                </div>
                                <!-- <div class="baner-content-img">
                                    <img src="assets/img/images (5).jpg" alt="">
                                </div> -->

                            </div>

                            <div class="baner-link">
                                <a href="">
                                    مشاهده
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 my-3">
                        <div class="banner">
                            <div class="baner-content">
                                <div class="baner-content-desc">
                                    <h2> ملک های فروشی</h2>
                                    <P>
                                        مشاهئه انبوهی از جدیدترین اگهی های فروش ملک
                                    </P>

                                </div>
                                <!-- <div class="baner-content-img">
                                    <img src="assets/img/images (6).jpg" alt="">
                                </div> -->
                            </div>
                            <div class="baner-link">
                                <a href="">
                                    مشاهده
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of product baner -->

        <!-- enter product -->
        <div class="enter-product">
            <div class="container">
                <div class="enter-product-desc">
                    <h2>افزودن ملک</h2>
                    <p>قصد دارید ملک خود را بفروشید یا اجاره دهید؟</p>
                </div>
                <div class="enter-product-link">
                    <a href="">افزودن</a>
                </div>
            </div>

        </div>
        <!-- end of enter product -->




        <!-- quick sale -->
        <div class="quick-sale">
            <div class="quick-sale-tile container">
                <h2>
                    فروش فوری
                </h2>
                <p>
                    ملک های ثبت شده برای فروش و اجاره
                </p>
            </div>


            <div class="quick-sale-product container owl-carousel d-flex ">

                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="item col-lg-3 col-md-6 ">
                    <div class="item-show">
                        <div class="quick-sale-img">
                            <img src="assets/img/images.jpg" alt="">
                        </div>
                        <div class="quick-sale-desc">
                            <div class="quick-sale-desc-name">
                                <h3>
                                    فروش اپارتمان 130 متری
                                </h3>
                                <p>کسب و کار یاس</p>
                            </div>
                            <div class="quick-sale-desc-option">
                                <ul>
                                    <li>
                                        <div>
                                            <img src="assets/img/placeholder.png" alt="">
                                            <span>نیاوران</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="assets/img/home.png" alt="">
                                            <span>2</span>
                                            <span>خوابه</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="quick-sale-desc-price">
                                <p>5/800/000/000</p>
                            </div>

                        </div>
                    </div>

                </div>





            </div>
        </div>


        <!-- end of quick sale -->

        <!-- buy a product  steps -->
        <div class="product-step">
            <div class="step-title">
                <h3>
                    مراحل خرید ملک
                </h3>
                <p>
                    قدم به قدم با شماییم از ثبت ملک تا فروش ان
                </p>

            </div>
            <div class="step-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6  px-4 ">
                            <div class="show-step">
                                <div class="step-img">
                                    <img src="assets/img/Group 24.svg" alt="">
                                </div>
                                <div class="step-desc">
                                    <div class="step-desc-name">
                                        <p>1</p>
                                        <h4>
                                            ثبت نام در دولت سرا
                                        </h4>
                                    </div>
                                    <div class="step-desc-intro">
                                        <p>
                                            اولین مرحله خرید ساخت اکانت کاربری در سایت میباشد.شما به راحتی میتوانید با
                                            شماره موبایل خود در سی ثانیه اکانت خورد را سازید.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 my-3 px-4 step-special">
                            <div class="show-step">
                                <div class="step-img">
                                    <img src="assets/img/Group 24.svg" alt="">
                                </div>
                                <div class="step-desc">
                                    <div class="step-desc-name">
                                        <p>2</p>
                                        <h4>
                                            جستجوی ملک
                                        </h4>
                                    </div>
                                    <div class="step-desc-intro">
                                        <p>
                                            از طریق جستجو در سایت با برسی ارشیو کسب و کار.میتوانید ملک مورد نظر خود را
                                            انتخاب و برای خرید یا اجاره آن اقدام کنید
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6  px-4">
                            <div class="show-step">
                                <div class="step-img">
                                    <img src="assets/img/Group 24.svg" alt="">
                                </div>
                                <div class="step-desc">
                                    <div class="step-desc-name">
                                        <p>3</p>
                                        <h4>
                                            ارتباط با مشاوران
                                        </h4>
                                    </div>
                                    <div class="step-desc-intro">
                                        <p>
                                            از طریق جستجو در سایت با برسی ارشیو کسب و کار.میتوانید ملک مورد نظر خود را
                                            انتخاب و برای خرید یا اجاره آن اقدام کنید
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 my-3 px-4 step-special">
                            <div class="show-step">
                                <div class="step-img">
                                    <img src="assets/img/Group 24.svg" alt="">
                                </div>
                                <div class="step-desc">
                                    <div class="step-desc-name">
                                        <p>4</p>
                                        <h4>
                                            ثبت قرار داد
                                        </h4>
                                    </div>
                                    <div class="step-desc-intro">
                                        <p>
                                            از طریق جستجو در سایت با برسی ارشیو کسب و کار.میتوانید ملک مورد نظر خود را
                                            انتخاب و برای خرید یا اجاره آن اقدام کنید
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end of buy a product  steps -->


        <!-- join contractor -->

        <div class="join-contractor">
            <div class="container">
                <div class="join-contractor-title">
                    <h2>پیوستن به پیمانکاران</h2>
                    <p>قصد دارید حرفه خود را معرفی کنید؟</p>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 my-5 px-5">
                        <div class="show-contractor">
                            <div class="show-contractor-content">
                                <div class="show-contractor-content-desc">
                                    <div class="contractor-img">
                                        <img src="assets/img/Rectangle 40.png" alt="">
                                    </div>
                                    <div class="contractor-intro">
                                        <div class="contractor-name">
                                            <h3>
                                                محسن محمدی
                                            </h3>
                                            <p>
                                                مهندس ناظر
                                            </p>
                                        </div>
                                        <div class="contractore-job">
                                            <span>
                                                انبوه سازان
                                            </span>
                                        </div>
                                    </div>
                                    <div class="contractor-profile">
                                        <a href="">
                                            نمایش پروفایل
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 my-5 px-5">
                        <div class="show-contractor">
                            <div class="show-contractor-content">
                                <div class="show-contractor-content-desc">
                                    <div class="contractor-img">
                                        <img src="assets/img/Rectangle 40.png" alt="">
                                    </div>
                                    <div class="contractor-intro">
                                        <div class="contractor-name">
                                            <h3>
                                                محسن محمدی
                                            </h3>
                                            <p>
                                                مهندس ناظر
                                            </p>
                                        </div>
                                        <div class="contractore-job">
                                            <span>
                                                انبوه سازان
                                            </span>
                                        </div>
                                    </div>
                                    <div class="contractor-profile">
                                        <a href="">
                                            نمایش پروفایل
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 my-5 px-5">
                        <div class="show-contractor">
                            <div class="show-contractor-content">
                                <div class="show-contractor-content-desc">
                                    <div class="contractor-img">
                                        <img src="assets/img/Rectangle 40.png" alt="">
                                    </div>
                                    <div class="contractor-intro">
                                        <div class="contractor-name">
                                            <h3>
                                                محسن محمدی
                                            </h3>
                                            <p>
                                                مهندس ناظر
                                            </p>
                                        </div>
                                        <div class="contractore-job">
                                            <span>
                                                انبوه سازان
                                            </span>
                                        </div>
                                    </div>
                                    <div class="contractor-profile">
                                        <a href="">
                                            نمایش پروفایل
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 my-5 px-5">
                        <div class="show-contractor">
                            <div class="show-contractor-content">
                                <div class="show-contractor-content-desc">
                                    <div class="contractor-img">
                                        <img src="assets/img/Rectangle 40.png" alt="">
                                    </div>
                                    <div class="contractor-intro">
                                        <div class="contractor-name">
                                            <h3>
                                                محسن محمدی
                                            </h3>
                                            <p>
                                                مهندس ناظر
                                            </p>
                                        </div>
                                        <div class="contractore-job">
                                            <span>
                                                انبوه سازان
                                            </span>
                                        </div>
                                    </div>
                                    <div class="contractor-profile">
                                        <a href="">
                                            نمایش پروفایل
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end of join contractor -->

        <!-- enter contractore -->
        <div class="enter-product">
            <div class="container">
                <div class="enter-product-desc">
                    <h2> پیوستن به پیمانکاران</h2>
                    <p>قصد دارید دارید حرفه خود راه معرفی کنید؟</p>
                </div>
                <div class="enter-product-link">
                    <a href="">افزودن</a>
                </div>
            </div>

        </div>
        <!-- end of enter contractore -->

        <!-- best store -->
        <div class="best-store">
            <div class="container">
                <div class="best-store-title">
                    <h2>
                        برترین مشاوران کسب و کار
                    </h2>
                    <p>
                        برترین مشاوران کسب و کار بر اساس معاملات موفق ثبتی
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 px-3">
                        <div class="show-store">
                            <div class="show-store-bg">
                                <img src="assets/img/images (10).jpg" alt="">
                                <div class="show-store-content-bg">
                                    <div class="show-store-content">
                                        <div class="store-img">
                                            <img src="assets/img/Group 24.svg" alt="">
                                        </div>
                                        <div class="store-intro">
                                            <h3>
                                                مشاورین کسب و کار کیان
                                            </h3>
                                            <p>
                                                با ده سال سابقه در خرید و فروش
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-3">
                        <div class="show-store">
                            <div class="show-store-bg">
                                <img src="assets/img/images (12).jpg" alt="">
                                <div class="show-store-content-bg">
                                    <div class="show-store-content">
                                        <div class="store-img">
                                            <img src="assets/img/Group 24.svg" alt="">
                                        </div>
                                        <div class="store-intro">
                                            <h3>
                                                مشاورین کسب و کار کیان
                                            </h3>
                                            <p>
                                                با ده سال سابقه در خرید و فروش
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-3">
                        <div class="show-store">
                            <div class="show-store-bg">
                                <img src="assets/img/images (10).jpg" alt="">
                                <div class="show-store-content-bg">
                                    <div class="show-store-content">
                                        <div class="store-img">
                                            <img src="assets/img/Group 24.svg" alt="">
                                        </div>
                                        <div class="store-intro">
                                            <h3>
                                                مشاورین کسب و کار کیان
                                            </h3>
                                            <p>
                                                با ده سال سابقه در خرید و فروش
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-3">
                        <div class="show-store">
                            <div class="show-store-bg">
                                <img src="assets/img/images (12).jpg" alt="">
                                <div class="show-store-content-bg">
                                    <div class="show-store-content">
                                        <div class="store-img">
                                            <img src="assets/img/Group 24.svg" alt="">
                                        </div>
                                        <div class="store-intro">
                                            <h3>
                                                مشاورین کسب و کار کیان
                                            </h3>
                                            <p>
                                                با ده سال سابقه در خرید و فروش
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-3">
                        <div class="show-store">
                            <div class="show-store-bg">
                                <img src="assets/img/images (10).jpg" alt="">
                                <div class="show-store-content-bg">
                                    <div class="show-store-content">
                                        <div class="store-img">
                                            <img src="assets/img/Group 24.svg" alt="">
                                        </div>
                                        <div class="store-intro">
                                            <h3>
                                                مشاورین کسب و کار کیان
                                            </h3>
                                            <p>
                                                با ده سال سابقه در خرید و فروش
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-3">
                        <div class="show-store">
                            <div class="show-store-bg">
                                <img src="assets/img/images (12).jpg" alt="">
                                <div class="show-store-content-bg">
                                    <div class="show-store-content">
                                        <div class="store-img">
                                            <img src="assets/img/Group 24.svg" alt="">
                                        </div>
                                        <div class="store-intro">
                                            <h3>
                                                مشاورین کسب و کار کیان
                                            </h3>
                                            <p>
                                                با ده سال سابقه در خرید و فروش
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of best store -->

        <!-- enter  store -->
        <div class="enter-product">
            <div class="container">
                <div class="enter-product-desc">
                    <h2> ثبت بنگاه کسب و کاری</h2>
                    <p>ثبت بنگاه معاملاتی در دولت سرا</p>
                </div>
                <div class="enter-product-link yellow-bg">
                    <a href="">افزودن</a>
                </div>
            </div>

        </div>


        <!-- news -->
        <div class="news">
            <div class="news-title">
                <h3>
                    اخرین اخبار دولت سرا
                </h3>
                <p>
                    از اخرین خبر ها در حوزه ملک با خبر شوید
                </p>

            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 px-2">
                        <div class="show-news">
                            <div class="main-news">
                                <div class="main-news-img">
                                    <img src="assets/img/images (13).jpg" alt="" style="width: 100%">
                                </div>
                                <div class="main-news-desc">
                                    <div class="main-news-info">
                                        <ul>
                                            <li class="main-news-info-yellow">اخبار</li>
                                            <li>1400/4/8</li>
                                        </ul>
                                    </div>
                                    <div class="main-news-intro">
                                        <h4>
                                            اتش سوزی در واحد های مجتمع سپهر
                                        </h4>
                                        <p>
                                            اولین مرحله خرید ساخت اکانت کاربری در سایت میباشد.شما به راحتی میتوانید با
                                            شماره موبایل خود در سی ثانیه اکانت خورد را سازید.
                                        </p>
                                    </div>
                                    <div class="main-news-link">
                                        <a href="">
                                            ادامه مطلب
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 my-3 px-2">
                        <div class="row">
                            <div class="col-6">
                                <div class="show-news">
                                    <div class="sub-news">
                                        <div class="sub-news-img">
                                            <img src="assets/img/download (3).jpg" alt="">
                                        </div>
                                        <div class="sub-news-desc">
                                            <h4>
                                                فروش واحد های مجتمع سپهر
                                            </h4>
                                            <p>

                                                اولین مرحله خرید ساخت اکانت کاربری در سایت میباشد.شما به راحتی میتوانید
                                                با شماره موبایل خود در سی ثانیه اکانت خورد را سازید.

                                            </p>
                                        </div>
                                        <div class="sub-news-link">
                                            <a href="">
                                                ادامه مطلب
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="show-news">
                                    <div class="sub-news">
                                        <div class="sub-news-img">
                                            <img src="assets/img/download (3).jpg" alt="">
                                        </div>
                                        <div class="sub-news-desc">
                                            <h4>
                                                فروش واحد های مجتمع سپهر
                                            </h4>
                                            <p>

                                                اولین مرحله خرید ساخت اکانت کاربری در سایت میباشد.شما به راحتی میتوانید
                                                با شماره موبایل خود در سی ثانیه اکانت خورد را سازید.

                                            </p>
                                        </div>
                                        <div class="sub-news-link">
                                            <a href="">
                                                ادامه مطلب
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="product-more">
                    <a href="">
                        <span>موارد بیشتر</span>
                        <img src="assets/img/Group 18.svg" alt="">
                    </a>
                </div>
            </div>
        </div>

        <!-- end of news -->
    </main>
@endsection

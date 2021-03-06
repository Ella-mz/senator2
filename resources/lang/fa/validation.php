<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => ":attribute باید پذیرفته شده باشد.",
    "active_url" => "آدرس :attribute معتبر نیست",
    "after" => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha" => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash" => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num" => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array" => ":attribute باید شامل آرایه باشد.",
    "before" => ":attribute باید تاریخی قبل از :date باشد.",
    "between" => array(
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file" => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string" => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array" => ":attribute باید بین :min و :max آیتم باشد.",
    ),
    "boolean" => "The :attribute field must be true or false",
    "confirmed" => ":attribute با تاییدیه مطابقت ندارد.",
    "date" => ":attribute یک تاریخ معتبر نیست.",
    "date_format" => ":attribute با الگوی :format مطاقبت ندارد.",
    "different" => ":attribute و :other باید متفاوت باشند.",
    "digits" => ":attribute باید :digits رقم باشد.",
    "digits_between" => ":attribute باید بین :min و :max رقم باشد.",
    "email" => "فرمت :attribute معتبر نیست.",
    "exists" => ":attribute انتخاب شده، معتبر نیست.",
    "image" => ":attribute باید تصویر باشد.",
    "in" => ":attribute انتخاب شده، معتبر نیست.",
    "integer" => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip" => ":attribute باید IP آدرس معتبر باشد.",
    "max" => array(
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file" => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string" => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array" => ":attribute نباید بیشتر از :max آیتم باشد.",
    ),
    "mimes" => ":attribute باید یکی از فرمت های :values باشد.",
    "min" => array(
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file" => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string" => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array" => ":attribute نباید کمتر از :min آیتم باشد.",
    ),
    "not_in" => ":attribute انتخاب شده، معتبر نیست.",
    "numeric" => ":attribute باید شامل عدد باشد.",
    "regex" => ":attribute یک فرمت معتبر نیست",
    "required" => "فیلد :attribute الزامی است",
    "required_if" => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same" => ":attribute و :other باید مانند هم باشند.",
    "size" => array(
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file" => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string" => ":attribute باید برابر با :size کاراکتر باشد.",
        "array" => ":attribute باسد شامل :size آیتم باشد.",
    ),
    "timezone" => "The :attribute must be a valid zone.",
    "unique" => ":attribute قبلا انتخاب شده است.",
    "url" => "فرمت آدرس :attribute اشتباه است.",
    "exists_code" => "کد ارسالی در سیستم وجود ندارد",
    "expire_code" => "اعتبار کد ارسالی به پایان رسیده است",
    "used" => "این کد قبلا مورد استفاده قرار گرفته است",
    "exists_phone" => "چنین شماره ای در سیستم ثبت نشده است",
    "captcha" => "The :attribute field entered is wrong",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => array(
        "name" => "نام",
        "username" => "نام کاربری",
        "email" => "پست الکترونیکی",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "password" => "رمز عبور",
        "password_confirmation" => "تاییدیه ی رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "تلفن",
        "mobile" => "تلفن همراه",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "description" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "body" => "متن",
        "imageUrl" => "تصویر",
        "videoUrl" => "آدرس ویدیو",
        "slug" => "نامک",
        "tags" => "تگ ها",
        "category" => "دسته بندی",
        "story" => "داستان",
        'number' => 'شماره قسمت',
        'price' => 'هزینه',
        'course_id' => 'دوره مورد نظر',
        'fileUrl' => 'آدرس فایل',
        'enSlug' => 'نامک انگلیسی',
        'percent' => 'درصد',
        'images' => 'تصویر',
        'surname' => 'نام‌خانوادگی',
        'subject' => 'موضوع',
        'message' => 'پیام',
        'category_id' => 'دسته بندی',
        'image' => 'تصویر',
        'city_id' => 'شهر',
        'flag' => 'پرچم',
        'reduction' => 'اختصار',
        'adminCurrency' => 'واحد پول مدیر',
        'adminCurrencySign' => 'علامت',
        'clientCurrency' => 'واحد پول مشتری',
        'clientCurrencySign' => 'علامت',
        'rtl' => 'راست چین',
        'convertRate' => 'نرخ تبدیل مدیر به مشتری',
        'taskPercent' => 'درصد مالیاتی',
        'language_id' => 'زبان ',
        'seller_id' => 'فروشنده',
        'lastname' => 'نام خانوادگی',
        'firstname' => 'نام ',
        'count' => 'تعداد',
        'priceProduct' => 'قیمت کالا',
        'language' => ' زبان',
        'question' => 'سوال',
        'province' => 'استان',
        'storeName' => 'نام فروشگاه',
        'phoneNumber' => 'تلفن ثابت',
        'lastName' => 'نام‌خانوادگی',
        'type' => 'آیتم',
        'renewal_fee' => 'هزینه تمدید',
        'add_fee' => 'هزینه آگهی',
        'advertiser' => 'نوع آگهی',
        'number_of_free_adds' => 'تعداد آگهی رایگان',
        'number_of_allowed_adds' => 'تعداد آگهی مجاز',
        'nationalCode' => 'کد ملی',
        'nationalCardImage' => 'تصویر کارت ملی',
        'nationalCardImageWithOwner' => 'تصویر کارت ملی همراه با صاحب کارت',
        'itemtitle' => 'عنوان آیتم',
        'code' => 'کد تایید',
        'neighborhood' => 'محله',
        'adImages' => 'عکس',
        'attribute.*' => 'مشخصه',
        'adImages.*' => 'عکس',
        'Authorization' => 'احراز هویت',
        'authorization' => 'احراز هویت',
        'latt' => 'عرض جغرافیایی',
        'longg' => 'طول جغرافیایی',
        'generalPaymentFee' => 'هزینه',
        'union' => 'صنف',
        'generalAdFee' => 'هزینه آگهی عادی',
        'scalarAdFee' => 'هزینه آگهی نردبانی',
        'specialAdFee' => 'هزینه آگهی ویژه',
        'expireDateOfAds' => 'مدت زمان انقضای آگهی',
        'description2' => 'توضیحات',
        'title2' => 'عنوان',
        'description3' => 'توضیحات',
        'title3' => 'عنوان',
        'description4' => 'توضیحات',
        'title4' => 'عنوان',
        'duration' => 'مدت زمان',
        'prePhoneNumber' => 'پیش شماره',
        'numberOfGeneralAds' => 'تعداد آگهی های عادی',
        'numberOfScalarAds' => 'تعداد آگهی های نردبانی',
        'numberOfSpecialAds' => 'تعداد آگهی های ویژه',
        'nameOfUser' => 'نام و نام خانوادگی',
        'justApplicant' => 'نوع آگهی',
        'justApplicantEdit' => 'نوع آگهی',
        'adPaymentFee' => 'هزینه آگهی',
        'adType' => 'نوع آگهی',
        'verification_code' => 'کد',
        'sirName' => 'نام خانوادگی',
        'confirm_password' => 'تکرار رمز عبور',
        'register_mobile' => 'تلفن همراه',
        'shop_title' => 'عنوان کسب و کاری',
        'prev_password' => 'رمز عبور فعلی',
        'new_password' => 'رمز عبور جدید',
        'geographicalDirection' => 'جهت جغرافیایی',
        'number_of_allowed_ads' => 'تعداد آگهی مجاز',
        'package_type' => 'بسته',
        'role_type' => 'نوع نقش',
        'email_phone' => 'تلفن همراه یا ایمیل',
        'admin_name' => 'نام',
        'admin_sirName' => 'نام خانوادگی',
        'admin_email' => 'ایمیل',
        'admin_password' => 'رمز عبور',
        'admin_confirm_password' => 'تکرار رمز عبور',
        'admin_slug' => 'نامک',
        'admin_mobile' => 'تلفن همراه',
        'admin_verifyCode' => 'کد تایید',
        'agent_name' => 'نام',
        'agent_sirName' => 'نام خانوادگی',
        'agent_email' => 'ایمیل',
        'agent_password' => 'رمز عبور',
        'agent_confirm_password' => 'تکرار رمز عبور',
        'agent_slug' => 'نامک',
        'agent_mobile' => 'تلفن همراه',
        'agent_verifyCode' => 'کد تایید',
        'contractor_name' => 'نام',
        'contractor_sirName' => 'نام خانوادگی',
        'contractor_email' => 'ایمیل',
        'contractor_password' => 'رمز عبور',
        'contractor_confirm_password' => 'تکرار رمز عبور',
        'contractor_slug' => 'نامک',
        'contractor_mobile' => 'تلفن همراه',
        'contractor_verifyCode' => 'کد تایید',
        'admin_shop_city' => 'شهر',
        'admin_shop_website' => 'وبسایت',
        'admin_userImage' => 'عکس پروفایل',
        'admin_national_card_image' => 'عکس کارت ملی',
        'admin_mobasher_card_image' => 'عکس کارت مباشر',
        'admin_business_license_card_image' => 'عکس پروانه کسب',
        'agent_userImage' => 'عکس پروفایل',
        'agent_national_card_image' => 'عکس کارت ملی',
        'contractor_userImage' => 'عکس پروفایل',
        'contractor_national_card_image' => 'عکس کارت ملی',
        'admin_logo' => 'لوگو',
        'admin_shop_title' => 'عنوان کسب و کاری',
        'adImage' => 'عکس آگهی',
        'skill' => 'مهارت',
        'shop_city' => 'شهر',
        'businessLicenseImage' => 'عکس پروانه کسب',
        'mobasherCardImage' => 'عکس کارت مباشر',
        'real_estate' => 'کسب و کاری',
        'association' => 'صنف',
        'logo' => 'لوگو',
        'hologram_type' => 'نوع هولوگرام',
        'attribute_type' => 'نوع مشخصه',
        'emergencyAdFee' => 'هزینه آگهی فوری',
        'expireTimeOfAds' => 'مدت زمان انقضای آگهی',
        'admin_userName' => 'نام کاربری',
        'agent_userName' => 'نام کاربری',
        'contractor_userName' => 'نام کاربری',
        'userName' => 'نام کاربری',
        'orderPage' => 'مکان تبلیغ',
        'number_of_applications' => 'تعداد درخواست',
        'en_title' => 'عنوان انگلیسی',
        'resNum' => 'کد رهگیری',
        'article_group_id' => 'دسته بندی مقاله',
        'walletValue' => 'مبلغ',
        'file' => 'فایل',
        'subCategory' => 'حوزه های فعالیت',
        'responsiveImage' => 'تصویر ریسپانسیو',
        'score' => 'امتیاز',
        'OTP_mobile' => 'تلفن همراه',
        'mobile_login' => 'تلفن همراه',
        'password_login' => 'رمز عبور',
//        'OTP_mobile' => 'تلفن همراه',
    ),
);

<?php

namespace Modules\Setting\Console;

use Illuminate\Console\Command;
use Modules\Setting\Repository\SettingRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SettingRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:setting-record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    private $repo;

    /**
     * Create a new command instance.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        parent::__construct();
        $this->repo = $settingRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->repo->delete();
        $this->repo->create([
            ['title'=>'title_of_site', 'fa_title'=>'عنوان سایت', 'type'=>'text'],
            ['title'=>'bright_logo_of_site', 'fa_title'=>'عکس روشن  لوگوی سایت', 'type'=>'file'],
            ['title'=>'logo_of_site', 'fa_title'=>'عکس تیره لوگوی سایت', 'type'=>'file'],
            ['title'=>'header_title_first_page', 'fa_title'=>'عنوان هدر صفحه اصلی', 'str_value'=>'دولت سرا، جامع ترین سیستم زمین و ویلا در ایران', 'type'=>'text'],
            ['title'=>'header_image', 'fa_title'=>'عکس هدر صفحه اصلی', 'type'=>'file'],
            ['title'=>'header_image_responsive', 'fa_title'=>'عکس هدر صفحه اصلی در حالت ریسپانسیو', 'type'=>'file'],
            ['title'=>'emergency_label', 'fa_title'=>'عکس برچسب فوری', 'type'=>'file'],
            ['title'=>'ad_default_photo', 'fa_title'=>'عکس پیش فرض آگهی', 'type'=>'file'],
            ['title'=>'shop_default_photo', 'fa_title'=>'عکس پیش فرض کسب و کاری', 'type'=>'file'],
            ['title'=>'shop_default_logo', 'fa_title'=>'عکس لوگوی پیش فرض کسب و کاری', 'type'=>'file'],
            ['title'=>'duration_of_ads', 'fa_title'=>'مدت اعتبار آگهی(روز)', 'str_value'=>'14','type'=>'text'],
            ['title'=>'duration_of_applications', 'fa_title'=>'مدت اعتبار درخواست(روز)', 'str_value'=>'14','type'=>'text'],
            ['title'=>'phone_number_of_header', 'fa_title'=>'شماره تماس منو', 'type'=>'text'],
            ['title'=>'user_default_photo', 'fa_title'=>'عکس پیش فرض پروفایل', 'type'=>'file'],
            ['title'=>'contractor_men_default_photo', 'fa_title'=>'عکس پروفایل پیش فرض پیمانکاران مرد', 'type'=>'file'],
            ['title'=>'contractor_women_default_photo', 'fa_title'=>'عکس پروفایل پیش فرض پیمانکاران زن', 'type'=>'file'],
            ['title'=>'Enamad', 'fa_title'=>'عکس اینماد سایت', 'type'=>'file'],
            ['title'=>'shop_default_photo_in_app', 'fa_title'=>'عکس پس زمینه کارت کسب و کاری در اپ', 'type'=>'file'],
            ['title'=>'contractors_default_photo_in_app', 'fa_title'=>'عکس پس زمینه کارت پیمانکاران در اپ', 'type'=>'file'],
            ['title'=>'number_of_months', 'fa_title'=>'تعداد ماه جهت نمایش تاریخ برای ثبت درخواست تبلیغ', 'type'=>'text'],

            ['title'=>'duration_of_applications', 'fa_title'=>'مدت اعتبار درخواست(روز)', 'type'=>'text'],
            ['title'=>'watermark_for_ads', 'fa_title'=>'عکس واترمارک ', 'type'=>'file'],
            ['title'=>'favicon_file', 'fa_title'=>'فایل favicon', 'type'=>'file'],
            ['title'=>'application_text_in_application_form', 'fa_title'=>'متن بالای فرم ثبت درخواست', 'type'=>'longtext'],
            ['title'=>'video_image_for_display_in_upload', 'fa_title'=>'فایل عکس برای نمایش آپلود ویدیو', 'type'=>'file'],
            ['title'=>'coefficient_bonus_score', 'fa_title'=>'ارزش هر امتیاز به ریال', 'type'=>'number'],
            ['title'=>'address_of_system', 'fa_title'=>'آدرس برای نمایش در فوتر', 'type'=>'text'],
            ['title'=>'phone_number_of_footer1', 'fa_title'=>'شماره تماس فوتر1', 'type'=>'text'],
            ['title'=>'phone_number_of_footer2', 'fa_title'=>'شماره تماس فوتر2', 'type'=>'text'],
            ['title'=>'email_for_system', 'fa_title'=>'ایمیل برای نمایش در فوتر', 'type'=>'text'],
            ['title'=>'aparat-link', 'fa_title'=>'لینک آپارات', 'type'=>'text'],
            ['title'=>'telegram-link', 'fa_title'=>'لینک تلگرام', 'type'=>'text'],
            ['title'=>'youtube-link', 'fa_title'=>'لینک یوتوب', 'type'=>'text'],
            ['title'=>'instagram-link', 'fa_title'=>'لینک اینستاگرام', 'type'=>'text'],
            ['title'=>'header_title_color', 'fa_title'=>'کد رنگ عنوان صفحه اصلی', 'type'=>'color'],
            ['title'=>'logo_of_first_page', 'fa_title'=>'لوگوی صفحه ی اصلی(70*210)', 'type'=>'file'],
            ['title'=>'Neshan_API_Key', 'fa_title'=>'کلید دسترسی سرویس ها', 'type'=>'text'],
            ['title'=>'Neshan_SDK_Key', 'fa_title'=>'کلید دسترسی نقشه وب', 'type'=>'text'],
            ['title'=>'latitude', 'fa_title'=>'عرض جغرافیایی', 'type'=>'text'],
            ['title'=>'longitude', 'fa_title'=>'طول جغرافیایی', 'type'=>'text'],
            ['title'=>'levelupToAdminOfAgency', 'fa_title'=>'عکس و لینک ارتقا حساب کاربری به مدیر کسب و کار', 'type'=>'file'],
            ['title'=>'message_of_business_manager_register', 'fa_title'=>'متن ثبت نام مدیر کسب و کار', 'type'=>'longtext'],
            ['title'=>'submit_general_ad_score', 'fa_title'=>'امتیاز ثبت آگهی عادی', 'type'=>'number'],
            ['title'=>'submit_scalar_ad_score', 'fa_title'=>'امتیاز ثبت آگهی نردبانی', 'type'=>'number'],
            ['title'=>'submit_emergency_ad_score', 'fa_title'=>'امتیاز ثبت آگهی فوری', 'type'=>'number'],
            ['title'=>'see_application_score', 'fa_title'=>'امتیاز مشاهده درخواست', 'type'=>'number'],
        ]);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
//        return [
//            ['example', InputArgument::REQUIRED, 'An example argument.'],
//        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}

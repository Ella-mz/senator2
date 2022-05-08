<?php

namespace Modules\CostumerClub\Console;

use Illuminate\Console\Command;
use Modules\CostumerClub\Repositories\ScoreRepository;
use Symfony\Component\Console\Input\InputOption;

class ScoreRecords extends Command
{
    private $scoreRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:score-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @param ScoreRepository $scoreRepository
     */
    public function __construct(ScoreRepository $scoreRepository)
    {
        parent::__construct();
        $this->scoreRepository = $scoreRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->scoreRepository->create([
            ['title' => 'خرید بسته های واحدی(امتیاز به ازای هر 1 واحد)', 'slug' => 'buy_bux', 'bonus' => 0,'grant'=>0,'type'=>'increase','description'=>' به ازای خرید بسته های واحدی به ازای هر واحد امتیاز کسب کنید'],
//            ['title' => 'خرید از فروشگاه به ازای هر 100,000 تومان', 'slug' => 'shop', 'bonus' => 0,'grant'=>0,'type'=>'increase','description'=>'با خرید از فروشگاه امتیاز کسب کنید'],
            ['title' => 'کد معرف-امتیاز معرف', 'slug' => 'invite-caller-user', 'bonus' => 0,'grant'=>0,'type'=>'increase','description'=>'با معرفی دوستان امتیاز دریافت کردید'],
            ['title' => 'کد معرف-امتیاز معرفی شده', 'slug' => 'invite-new-user', 'bonus' => 0,'grant'=>0,'type'=>'increase','description'=>'با ورود کد معرف امتیاز دریافت کردید'],
//            ['title' => 'کد معرف-امتیاز خرید معرف', 'slug' => 'invite-buy-caller-user', 'bonus' => 0,'grant'=>0,'type'=>'increase','description'=>'با معرفی دوستان به ازای خرید ان ها امتیاز دریافت کردید'],
//            ['title' => 'کد معرف-امتیاز خرید معرفی شده', 'slug' => 'invite-buy-new-user', 'bonus' => 0,'grant'=>0,'type'=>'increase','description'=>'به دلیل ورود کد معرف با هر خرید امتیاز کسب می کنید'],
            ['title' => 'ثبت مقاله با تایید ادمین', 'slug' => 'create-article', 'bonus' => 0,'grant'=>0,'type'=>'increase','description'=>'با ثبت مقاله امتیاز کسب خواهید کرد'],
            ['title' => 'ثبت نظر در صورت تایید مدیریت', 'slug' => 'create-comment', 'bonus' => 0,'grant'=>0,'type'=>'increase','description'=>'با ثبت دیدگاه امتیاز کسب خواهید کرد'],
            ['title' => 'درخواست هولوگرام تایید ادمین', 'slug' => 'apply-hologram', 'bonus' => 10,'grant'=>10,'type'=>'increase','description'=>'با درخواست هولوگرام امتیاز کسب خواهید کرد'],
            ['title' => 'ثبت تبلیغ با تایید ادمین', 'slug' => 'apply-advertisement', 'bonus' => 10,'grant'=>10,'type'=>'increase','description'=>'با ثبت تبلیغ امتیاز کسب خواهید کرد'],

        ]);

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
//            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
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

<?php

namespace Modules\Setting\Console;

use Illuminate\Console\Command;
use Modules\Setting\Repository\AdminSettingRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminSettingRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:adminsetting-record';

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
     * @return void
     */
    public function __construct(AdminSettingRepository $adminSettingRepository)
    {
        parent::__construct();
        $this->repo = $adminSettingRepository;
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
            ['title'=>'hologram_publish', 'fa_title'=>'نوع پخش هولوگرام برای کارشناسان', 'value'=>'auto'],//auto OR manual
            ['title'=>'hasSpecial', 'fa_title'=>'کانسپت ویژه در پروژه', 'value'=>0],
            ['title'=>'hasScalar', 'fa_title'=>'کانسپت نردبانی در پروژه', 'value'=>1],
            ['title'=>'hasEmergency', 'fa_title'=>'کانسپت فوری در پروژه', 'value'=>1],
            ['title'=>'depthOfCategoryForAdvertising', 'fa_title'=>'تعیین سطح دسته بندی برا نمایش تبلیغات', 'value'=>1],
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

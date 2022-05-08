<?php

namespace Modules\Blog\Console;

use Illuminate\Console\Command;
use Modules\Blog\Repositories\PositionRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreatePosition extends Command
{
    private $positionRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:weblog-positions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @param PositionRepository $positionRepository
     */
    public function __construct(PositionRepository $positionRepository)
    {
        parent::__construct();
        $this->positionRepository = $positionRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->positionRepository->delete_all();
        $this->positionRepository->create([
            ['title' => '', 'name' => 'سطر اول', 'slug' => 'row-1','image'=>'upload/positions/row-1.PNG'],
            ['title' => '', 'name' => 'سطر دوم', 'slug' => 'row-2','image'=>'upload/positions/row-2.PNG'],
            ['title' => '', 'name' => 'سطر سوم', 'slug' => 'row-3','image'=>'upload/positions/row-3.PNG'],
            ['title' => '', 'name' => 'سطر چهارم-راست-بالا', 'slug' => 'row-4-1-1','image'=>'upload/positions/row-4-1-1.PNG'],
            ['title' => '', 'name' => 'سطر چهارم-راست-پایین', 'slug' => 'row-4-1-2','image'=>'upload/positions/row-4-1-2.PNG'],
            ['title' => '', 'name' => 'سطر چهارم-چپ', 'slug' => 'row-4-2-1','image'=>'upload/positions/row-4-1-2.PNG'],
            ['title' => '', 'name' => 'سطر پنجم', 'slug' => 'row-5','image'=>'upload/positions/row-5.PNG'],
            ['title' => '', 'name' => 'سطر ششم-راست', 'slug' => 'row-6-1','image'=>'upload/positions/row-6-1.PNG'],
            ['title' => '', 'name' => 'سطر ششم-چپ-بالا', 'slug' => 'row-6-2-1','image'=>'upload/positions/row-6-2-1.PNG'],
            ['title' => '', 'name' => 'سطر ششم-چپ-پایین-راست', 'slug' => 'row-6-2-2','image'=>'upload/positions/row-6-2-2.PNG'],
            ['title' => '', 'name' => 'سطر ششم-چپ-پایین-چپ', 'slug' => 'row-6-2-3','image'=>'upload/positions/row-6-2-3.PNG'],
            ['title' => '', 'name' => 'سطر هفتم', 'slug' => 'row-7','image'=>'upload/positions/row-7.PNG'],

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

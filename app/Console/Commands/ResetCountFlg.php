<?php

namespace App\Console\Commands;

use App\Models\GoalInformation;
use Illuminate\Console\Command;

class ResetCountFlg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resetcountflg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset count_flg';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        GoalInformation::update_count_flg();
        // \Log::info('ログ出力テスト - command');
        return 0;
    }
}

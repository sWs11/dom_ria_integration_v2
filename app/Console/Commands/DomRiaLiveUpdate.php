<?php

namespace App\Console\Commands;

use App\Classes\Cron;
use App\Classes\Integrations\TelegramBot;
use Illuminate\Console\Command;

class DomRiaLiveUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dom_ria:live_update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $cron = new Cron();

        while (true) {
            $cron->getOrdersFromDomRia();
            sleep(60);
        }
    }
}

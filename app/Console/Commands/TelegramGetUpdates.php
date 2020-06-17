<?php

namespace App\Console\Commands;

use App\Classes\Integrations\TelegramBot;
use App\Models\User;
use Illuminate\Console\Command;

class TelegramGetUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:get_updates';

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
     * @return void
     */
    public function handle()
    {
        /*
        $this->info('--------------------------');
        $this->info('Display this on the screen');
        $this->info('--------------------------');
        $this->error('Something went wrong!');
        $this->info('--------------------------');
        $this->line('Display this on the screen');

        $headers = array_keys(User::first()->toArray());
        $users = User::all();

        $bar = $this->output->createProgressBar(count($users));

        $bar->start();

        foreach ($users as $user) {
            sleep(2);

            $bar->advance();
        }

        $bar->finish();

        $this->table($headers, $users);
        */

        // chat_id = 422621375
        $bot = new TelegramBot();
        $response = $bot->getUpdates();

        $response_arr = json_decode($response, true);

        dd($response_arr);

        $this->table(array_keys($response_arr), $response_arr);

        $new_subscribes = [];

        foreach ($response_arr['result'] as $item) {
            if(strpos($item['message']['text'], '/start') === false)
                continue;

            $telegram_subscribe_key = trim(substr($item['message']['text'], 6));

            if(empty($telegram_subscribe_key))
                continue;

            $new_subscribes[$telegram_subscribe_key] = $item['message'];
        }

//        dd($new_subscribes);

        if(!empty($new_subscribes)) {
            $users = User::whereIn('telegram_subscribe_key', array_keys($new_subscribes))->get();

            $users = $users->keyBy('telegram_subscribe_key');

            foreach ($users as $subscribe_key => $user) {
                $user->telegram_user_id = $new_subscribes[$subscribe_key]['from']['id'];
                $user->telegram_chat_id = $new_subscribes[$subscribe_key]['chat']['id'];
                $user->telegram_subscribe_key = null;

                $user->save();
            }
        }

        $this->info('--------------------------');
        $this->info('Count new subscriber: ' . count($new_subscribes));
        $this->info('--------------------------');

    }
}

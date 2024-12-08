<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdataPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:updata-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        updateEnv([
            '_94LIST_RANDOM_PASSWORD' =>  random_int(1000, 9999),
        ]);

        $this->info(env('_94LIST_RANDOM_PASSWORD'));
    }
}

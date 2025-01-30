<?php

namespace Modules\DeliveryRoute\Console\Commands;

use Illuminate\Console\Command;

class DeliveryRouteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DeliveryRouteCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DeliveryRoute Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}

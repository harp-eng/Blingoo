<?php

namespace Modules\SubscriptionPlan\Console\Commands;

use Illuminate\Console\Command;

class SubscriptionPlanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SubscriptionPlanCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SubscriptionPlan Command description';

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

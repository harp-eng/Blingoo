<?php

namespace Modules\DeliveryTimeSlot\Console\Commands;

use Illuminate\Console\Command;

class DeliveryTimeSlotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DeliveryTimeSlotCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DeliveryTimeSlot Command description';

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

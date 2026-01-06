<?php

namespace Modules\Invoice\Console\Commands;

use Illuminate\Console\Command;

class InvoiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:InvoiceCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invoice Command description';

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

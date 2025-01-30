<?php

namespace Modules\Unit\Console\Commands;

use Illuminate\Console\Command;

class UnitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:UnitCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unit Command description';

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

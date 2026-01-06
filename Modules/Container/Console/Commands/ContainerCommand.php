<?php

namespace Modules\Container\Console\Commands;

use Illuminate\Console\Command;

class ContainerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ContainerCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Container Command description';

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

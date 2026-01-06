<?php

namespace Modules\Banner\Console\Commands;

use Illuminate\Console\Command;

class BannerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:BannerCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Banner Command description';

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

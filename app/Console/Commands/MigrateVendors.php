<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\VendorDB;  // Assuming you have a Vendor model

class MigrateVendors extends Command
{
    protected $signature = 'vendors:migrate';
    protected $description = 'Run migrations for all vendor databases';

    public function handle()
    {
        // Fetch all vendors (you can replace this with your actual vendor model or table)
        $vendors = VendorDB::all();

        foreach ($vendors as $vendor) {
            $this->info("Running migrations for vendor: " . $vendor->domain);

            // Dynamically set the database connection for each vendor
            Config::set('database.connections.vendor', [
                'driver'    => 'mysql',
                'host'      => env('DB_HOST', '127.0.0.1'),
                'port'      => env('DB_PORT', '3306'),
                'database'  => $vendor->database,  // assuming vendor has a database column
                'username'  => env('DB_USERNAME', 'root'),
                'password'  => env('DB_PASSWORD', ''),
                'charset'   => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix'    => '',
                'strict'    => true,
                'engine'    => null,
            ]);

            DB::purge('vendor');  // Clear previous connection
            DB::setDefaultConnection('vendor');  // Set to vendor DB connection

            // Run migrations for the vendor's database
            Artisan::call('migrate', ['--database' => 'vendor', '--force' => true]);

            $this->info("Migrations completed for vendor: " . $vendor->domain);
        }

        $this->info('All vendor migrations completed.');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use App\Models\VendorDB;
use Illuminate\Support\Facades\DB;

class DomainDatabaseSwitcher
{
    public function handle($request, Closure $next)
    {
        $host = request()->getHost();

        // Cache all vendor DB records once
        $vendors = Cache::rememberForever("all_vendors", function () {
            return VendorDB::all();
        });

        // Find the vendor record by domain from cached data
        $vendor = $vendors->firstWhere('domain', $host);

        if ($vendor) {
            // Set the database connection dynamically
            config()->set('database.connections.vendor', [
                'driver' => 'mysql',
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => $vendor->database,
                'username' => env('DB_USERNAME', 'root'),
                'password' => env('DB_PASSWORD', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ]);

            // Purge and set the connection
            DB::purge('vendor');
            DB::setDefaultConnection('vendor');
        }

        return $next($request);
    }
}

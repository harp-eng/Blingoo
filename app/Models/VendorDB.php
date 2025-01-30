<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class VendorDB extends Model
{
    use HasFactory;

    // Table associated with the model (optional, since Laravel infers it)
    protected $table = 'vendor_dbs';

    // The attributes that are mass assignable
    protected $fillable = ['domain', 'database'];

    // Timestamps (optional)
    public $timestamps = true;

    // Boot method to run actions on certain model events
    protected static function boot()
    {
        parent::boot();

        static::created(function ($vendor) {
            // Run migrations for the new vendor
            Config::set('database.connections.vendor.database', $vendor->database);
            DB::purge('vendor');
            DB::setDefaultConnection('vendor');
            Artisan::call('migrate', ['--database' => 'vendor', '--force' => true]);
        });

        static::saved(function ($tenant) {
            Cache::forget("all_vendors");
        });

        static::deleted(function ($tenant) {
            Cache::forget("all_vendors");
        });
    }
}

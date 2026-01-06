<?php

namespace Modules\Banner\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Banner\Models\Banner;

class BannerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Banners Seed
         * ------------------
         */

        // DB::table('banners')->truncate();
        // echo "Truncate: banners \n";

        Banner::factory()->count(20)->create();
        $rows = Banner::all();
        echo " Insert: banners \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

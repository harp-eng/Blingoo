<?php

namespace Modules\Promotion\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Promotion\Models\Promotion;

class PromotionDatabaseSeeder extends Seeder
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
         * Promotions Seed
         * ------------------
         */

        // DB::table('promotions')->truncate();
        // echo "Truncate: promotions \n";

        Promotion::factory()->count(20)->create();
        $rows = Promotion::all();
        echo " Insert: promotions \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

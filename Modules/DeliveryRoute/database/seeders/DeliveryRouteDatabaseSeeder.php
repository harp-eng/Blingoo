<?php

namespace Modules\DeliveryRoute\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\DeliveryRoute\Models\DeliveryRoute;

class DeliveryRouteDatabaseSeeder extends Seeder
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
         * DeliveryRoutes Seed
         * ------------------
         */

        // DB::table('deliveryroutes')->truncate();
        // echo "Truncate: deliveryroutes \n";

        DeliveryRoute::factory()->count(20)->create();
        $rows = DeliveryRoute::all();
        echo " Insert: deliveryroutes \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

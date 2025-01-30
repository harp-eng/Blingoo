<?php

namespace Modules\DeliveryTimeSlot\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\DeliveryTimeSlot\Models\DeliveryTimeSlot;

class DeliveryTimeSlotDatabaseSeeder extends Seeder
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
         * DeliveryTimeSlots Seed
         * ------------------
         */

        // DB::table('deliverytimeslots')->truncate();
        // echo "Truncate: deliverytimeslots \n";

        DeliveryTimeSlot::factory()->count(20)->create();
        $rows = DeliveryTimeSlot::all();
        echo " Insert: deliverytimeslots \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

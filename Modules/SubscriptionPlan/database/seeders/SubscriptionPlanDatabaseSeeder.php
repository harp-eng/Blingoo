<?php

namespace Modules\SubscriptionPlan\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\SubscriptionPlan\Models\SubscriptionPlan;

class SubscriptionPlanDatabaseSeeder extends Seeder
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
         * SubscriptionPlans Seed
         * ------------------
         */

        // DB::table('subscriptionplans')->truncate();
        // echo "Truncate: subscriptionplans \n";

        SubscriptionPlan::factory()->count(20)->create();
        $rows = SubscriptionPlan::all();
        echo " Insert: subscriptionplans \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

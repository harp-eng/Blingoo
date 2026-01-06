<?php

namespace Modules\Invoice\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Invoice\Models\Invoice;

class InvoiceDatabaseSeeder extends Seeder
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
         * Invoices Seed
         * ------------------
         */

        // DB::table('invoices')->truncate();
        // echo "Truncate: invoices \n";

        Invoice::factory()->count(20)->create();
        $rows = Invoice::all();
        echo " Insert: invoices \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

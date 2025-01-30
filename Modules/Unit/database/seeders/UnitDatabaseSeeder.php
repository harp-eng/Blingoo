<?php

namespace Modules\Unit\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Unit\Models\Unit;

class UnitDatabaseSeeder extends Seeder
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
         * Units Seed
         * ------------------
         */

        // DB::table('units')->truncate();
        // echo "Truncate: units \n";

        Unit::factory()->count(20)->create();
        $rows = Unit::all();
        echo " Insert: units \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

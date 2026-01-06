<?php

namespace Modules\Container\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Container\Models\Container;

class ContainerDatabaseSeeder extends Seeder
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
         * Containers Seed
         * ------------------
         */

        // DB::table('containers')->truncate();
        // echo "Truncate: containers \n";

        Container::factory()->count(20)->create();
        $rows = Container::all();
        echo " Insert: containers \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

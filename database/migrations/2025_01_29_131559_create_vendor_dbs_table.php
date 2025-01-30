<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vendor_dbs', function (Blueprint $table) {
            $table->id();
            $table->string('domain')->unique();
            $table->string('database');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendor_dbs');
    }
};

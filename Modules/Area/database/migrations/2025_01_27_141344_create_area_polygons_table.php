<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('area_polygons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id');
            $table->text('coordinates');
            $table->unsignedInteger('sequence')->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('area_polygons');
    }
};

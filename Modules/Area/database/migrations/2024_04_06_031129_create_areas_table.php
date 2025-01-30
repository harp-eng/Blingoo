<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Area\Enums\AreaStatus;

return new class extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125);
            $table->text('description')->nullable();
            $table->enum('area_type', ['polygon', 'postcode']);
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('status')->default(AreaStatus::Active->name);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('areas');
    }
};

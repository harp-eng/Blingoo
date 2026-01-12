<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable()->comment('User who receives the notification');
            $table->text('message')->nullable()->comment('Notification message content');
            $table->unsignedBigInteger('admin_id')->nullable()->comment('Associated vendor ID');
            $table->enum('type', ['push', 'sms', 'email'])->default('push')->comment('Notification type');
            $table->tinyInteger('status')->default(0)->comment('0 = Not Read, 1 = Read');

            $table->json('json')->nullable()->comment('Extra JSON data for notification');

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 50);
            $table->longText('body', 900);
            $table->boolean('read')->default(false);
            $table->boolean('notified')->default(false);
            $table->unsignedBigInteger('recipient');
            $table->unsignedBigInteger('writer');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('recipient')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('writer')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}

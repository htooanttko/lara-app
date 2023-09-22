<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_chats', function (Blueprint $table) {
            $table->id();
            $table->integer('gp_id');
            $table->integer('user_id');
            $table->integer('fir_user_id');
            $table->string('fir_status')->default('sent');
            $table->integer('sec_user_id')->nullable();
            $table->string('sec_status')->default('sent');
            $table->integer('a_user_id')->nullable();
            $table->string('a_status')->default('sent');
            $table->integer('b_user_id')->nullable();
            $table->string('b_status')->default('sent');
            $table->integer('c_user_id')->nullable();
            $table->string('c_status')->default('sent');
            $table->integer('d_user_id')->nullable();
            $table->string('d_status')->default('sent');
            $table->integer('e_user_id')->nullable();
            $table->string('e_status')->default('sent');
            $table->integer('f_user_id')->nullable();
            $table->string('f_status')->default('sent');
            $table->integer('g_user_id')->nullable();
            $table->string('g_status')->default('sent');
            $table->integer('h_user_id')->nullable();
            $table->string('h_status')->default('sent');
            $table->integer('chat_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_chats');
    }
};

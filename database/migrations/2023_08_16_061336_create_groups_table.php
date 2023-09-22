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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('group_name');
            $table->string('group_image')->nullable();
            $table->integer('fir_user_id');
            $table->integer('sec_user_id')->nullable();
            $table->integer('a_user_id')->nullable();
            $table->integer('b_user_id')->nullable();
            $table->integer('c_user_id')->nullable();
            $table->integer('d_user_id')->nullable();
            $table->integer('e_user_id')->nullable();
            $table->integer('f_user_id')->nullable();
            $table->integer('g_user_id')->nullable();
            $table->integer('h_user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};

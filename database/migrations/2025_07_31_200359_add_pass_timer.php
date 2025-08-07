<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPassTimer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('password_expires_in_days')->nullable();
            $table->integer('password_history_limit')->default(5);
            $table->integer('password_min_length')->default(12);
            $table->boolean('password_require_lowercase')->default(true);
            $table->boolean('password_require_uppercase')->default(true);
            $table->boolean('password_require_digit')->default(true);
            $table->boolean('password_require_special')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

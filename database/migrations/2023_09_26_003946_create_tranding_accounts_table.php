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
        Schema::create('tranding_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');
            $table->string('trading_acount_password');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->comment('ID del usuario');
            $table->double('balance')->nullable();
            $table->string('broker_id');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tranding_accounts');
    }
};

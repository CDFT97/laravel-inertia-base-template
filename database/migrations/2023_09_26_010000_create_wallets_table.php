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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->comment('ID del usuario');
            $table->foreignId('order_id')->nullable()->references('id')->on('orders')->comment('ID del usuario');
            $table->string('description',100);
            $table->double('amount')->nullable()->comment('amount for display');
            $table->double('amount_retired')->nullable()->comment('amount retired for calculations');
            $table->double('amount_available')->nullable()->comment('amount for calculations');
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 - Available, 2 - Paid, 3 - Voided');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};

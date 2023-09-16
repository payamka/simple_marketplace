<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('shopping_carts', function (Blueprint $table) {
            $table->after('user_id', function ($table) {
                $table->unsignedBigInteger('order_id')->nullable();
            });

            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shopping_carts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('order_id');
        });
    }
};

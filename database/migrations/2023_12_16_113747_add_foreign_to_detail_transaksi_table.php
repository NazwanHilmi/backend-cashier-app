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
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table
                ->foreign('menu_id')
                ->references('id')
                ->on('menu')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('transaksi_id')
                ->references('id')
                ->on('transaksi')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // $table
            //     ->foreign('product_id')
            //         ->references('id')
            //         ->on('product')
            //         ->onUpdate('CASCADE')
            //         ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropForeign(['transaction_id']);
        });
    }
};

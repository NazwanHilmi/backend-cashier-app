<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('type', function (Blueprint $table) {
            $table
                ->foreign('kategori_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::table('type', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
        });
    }
};

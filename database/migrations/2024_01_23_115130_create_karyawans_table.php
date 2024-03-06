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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip', 12);
            $table->string('nik', 12);
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('telepon', 100);
            $table->string('agama', 15);
            $table->enum('status_nikah', ['belum nikah', 'nikah']);
            $table->text('alamat');
            $table->unsignedBigInteger('golongan_id');
            $table->string('foto', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};

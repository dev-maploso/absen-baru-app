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
        Schema::create('mahasantris', function (Blueprint $table) {
            $table->id();

            // ID dari sistem master (Laravel A)
            $table->unsignedBigInteger('master_id')->unique();

            $table->string('nim')->unique();
            $table->string('name');

            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('kode_kelas')->nullable();
            $table->string('nama_kelas')->nullable();

            $table->unsignedBigInteger('kamar_id')->nullable();
            $table->string('kode_kamar')->nullable();
            $table->string('nama_kamar')->nullable();

            $table->timestamps();

            $table->index('nim');
            $table->index('kode_kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasantris');
    }
};

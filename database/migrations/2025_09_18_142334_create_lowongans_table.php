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
    Schema::create('lowongans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_perusahaan')->constrained('perusahaans')->cascadeOnDelete();
        $table->string('judul_lowongan', 200);
        $table->text('deskripsi')->nullable();
        $table->string('gambar')->nullable(); // Banner atau logo lowongan
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};

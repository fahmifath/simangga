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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sasaran_kegiatan_id')->constrained('sasaran_kegiatan');
            $table->foreignId('iku_id')->constrained('iku');
            $table->foreignId('ro_id')->constrained('ro');
            $table->foreignId('komponen_id')->constrained('komponen');
            $table->foreignId('sub_komponen_id')->constrained('sub_komponen');
            $table->foreignId('detil_id')->constrained('detil');
            $table->foreignId('sub_detil_id')->constrained('sub_detil');
            $table->string('pengaju');
            $table->integer('qty');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};

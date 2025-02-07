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
        Schema::create('r_k_a_k_l_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('komponen_id')->constrained('komponens')->cascadeOnDelete();
            $table->foreignId('sub_komponen_id')->constrained('sub_komponens')->cascadeOnDelete();
            $table->foreignId('detil_id')->constrained('detils')->cascadeOnDelete();
            $table->foreignId('sub_detil_id')->constrained('sub_detils')->cascadeOnDelete();
            // $table->string('volume_output');
            $table->string('quantity');
            $table->string('satuan');
            $table->string('harga_satuan');
            $table->string('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_k_a_k_l_s');
    }
};

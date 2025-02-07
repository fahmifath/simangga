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
        Schema::create('detils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_komponen_id')->constrained('sub_komponens')->cascadeOnDelete();
            $table->string('detil');
            $table->string('kode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detils');
    }
};

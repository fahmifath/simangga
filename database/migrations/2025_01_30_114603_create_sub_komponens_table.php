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
        Schema::create('sub_komponens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('komponen_id')->constrained('komponens')->cascadeOnDelete();
            $table->string('sub_komponen');
            $table->string('kode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_komponens');
    }
};

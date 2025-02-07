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
        Schema::table('r_k_a_k_l_s', function (Blueprint $table) {
            $table->string('kode')->after('id');
            $table->string('name')->after('sub_detil_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rkak', function (Blueprint $table) {
            //
        });
    }
};

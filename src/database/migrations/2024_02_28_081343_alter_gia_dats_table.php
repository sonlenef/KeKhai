<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gia_dats', function (Blueprint $table) {
            $table->foreignId('doan_id')->constrained('doans');
            $table->foreignId('duong_id')->constrained('duong_phos');
            $table->foreignId('vi_tri_id')->constrained('vi_tris');
            $table->foreignId('giai_doan_id')->constrained('giai_doans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gia_dats', function (Blueprint $table) {
            $table->dropForeign(['doan_id']);
            $table->dropForeign(['duong_id']);
            $table->dropForeign(['vi_tri_id']);
            $table->dropForeign(['giai_doan_id']);
        });
    }
};
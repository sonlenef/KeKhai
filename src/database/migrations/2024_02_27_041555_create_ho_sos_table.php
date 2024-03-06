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
        Schema::create('ho_sos', function (Blueprint $table) {
            $table->id();
            $table->string('mst');
            $table->string('ten');
            $table->string('to');
            $table->string('so_gcn');
            $table->String('ngay_cap');
            $table->string('tds');
            $table->string('tbd');
            $table->string('dt');
            $table->string('duong_pho');
            $table->string('doan_duong');
            $table->string('dia_chi');
            $table->string('han_muc');
            $table->string('vi_tri');
            $table->string('he_so');
            $table->string('tu_ky');
            $table->string('den_ky');
            $table->string('gia_22');
            $table->string('gia_17');
            $table->string('gia_12');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ho_sos');
    }
};
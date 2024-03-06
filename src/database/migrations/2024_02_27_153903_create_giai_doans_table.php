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
        Schema::create('giai_doans', function (Blueprint $table) {
            $table->id();
            $table->string("giai_doan");
            $table->timestamps();
        });

        // Insert default data
        DB::table('giai_doans')->insert([
            ['giai_doan' => '2012-2016'],
            ['giai_doan' => '2017-2021'],
            ['giai_doan' => '2022-2026'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giai_doans');
    }
};
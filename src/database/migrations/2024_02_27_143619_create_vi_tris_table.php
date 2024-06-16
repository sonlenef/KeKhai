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
        Schema::create('vi_tris', function (Blueprint $table) {
            $table->id();
            $table->string('vi_tri');
            $table->timestamps();
        });

        // Insert default data
        DB::table('vi_tris')->insert([
            ['vi_tri' => '1'],
            ['vi_tri' => '2'],
            ['vi_tri' => '3'],
            ['vi_tri' => '4'],
            ['vi_tri' => '5']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vi_tris');
    }
};
<?php

namespace Database\Factories;

use App\Models\Doan;
use App\Models\DuongPho;
use App\Models\ViTri;
use App\Models\GiaiDoan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GiaDat>
 */
class GiaDatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'doan_id' => Doan::factory(),
            'duong_id' => DuongPho::factory(),
            'vi_tri_id' => ViTri::factory(),
            'giai_doan_id' => GiaiDoan::factory(),
            'gia_dat' => $this->faker->gia_dat,
        ];
    }
}
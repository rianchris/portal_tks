<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peserta>
 */
class PesertaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'batch_id' => fake()->numberBetween(10, 12),
            'no_sertifikat' => 'TKS-' . fake()->numberBetween(12345, 54321),
            'nik' => fake()->numberBetween(1, 2171071312999003),
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telepon' => fake()->phoneNumber(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'foto' => fake()->imageUrl(640, 480, 'people', true),
        ];
    }
}

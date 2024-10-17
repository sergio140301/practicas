<?php

namespace Database\Seeders;

use App\Models\Depto;
use App\Models\Alumno;
use App\Models\Carrera;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea un departamento con 3 carreras, cada una con 4 alumnos
        Depto::factory()
        ->count(1)
        ->has(
            Carrera::factory()
                ->count(3)
                ->has(Alumno::factory()->count(4))
        )
        ->create();
    }
}

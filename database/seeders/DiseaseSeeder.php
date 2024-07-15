<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Disease;
use Illuminate\Support\Facades\DB;

class DiseaseSeeder extends Seeder
{
    public function run(): void {
        $diseases = array([
            'd' => ['name' => '{"es": "Rabia", "en": "Rage"}'],
            's' => [1,2]
        ], [
            'd' => ['name' => '{"es": "Leucemia felina", "en": "Leucemia felina"}'],
            's' => [1]
        ]);

        foreach($diseases as $disease) {
            $this->createDisease($disease['d'],$disease['s']);
        }
    }

    private function createDisease($diseases,$species) {
        $disease = Disease::create($diseases);
        foreach($species as $specie) {
            $this->infection($disease->id,$specie);
        }
    }

    private function infection($disease,$specie) {
        DB::table('species_diseases')->insert([
            'disease_id' => $disease,
            'specie_id' => $specie
        ]);
    }
}
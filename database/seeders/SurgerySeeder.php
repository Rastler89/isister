<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SurgeryType;
use Illuminate\Support\Facades\DB;

class SurgerySeeder extends Seeder
{
    public function run(): void {
        $surg = SurgeryType::create([
            'name' => '{"es": "Esterilización/Castración", "en": "Esterilización/Castración"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Cirugía Dental", "en": "Dental Surgery"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Cirurgía Ortopédica", "en": "Ortopedic Surgery"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Cirurgía de tejidos blandos", "en": "Surgery"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Cirurgía de emergencia", "en": "Emergency Surgery"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Cirurgía Oftalmológica", "en": "Optical Surgery"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Cirurgía Respiratoria", "en": "Surgery"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Cirurgía Cardíaca", "en": "Surgery"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Cirurgía Aparato Reproductor", "en": "Surgery"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Cirurgía Sistema Nervioso", "en": "Surgery"}'
        ]);

        $surg = SurgeryType::create([
            'name' => '{"es": "Procedimientos Diagnósticos Invasivos", "en": "Surgery"}'
        ]);
        
    }
}
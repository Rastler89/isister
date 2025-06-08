<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DummyVaccineController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName); // Standardized path
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    public function getVaccinesPet(Request $request, $petId) {
        $allVaccines = $this->loadData('vaccines.json');
        $allDiseases = $this->loadData('diseases.json'); // Load diseases for embedding

        $petVaccines = array_filter($allVaccines, function ($vaccine) use ($petId) {
            return isset($vaccine['pet_id']) && $vaccine['pet_id'] == $petId;
        });

        $result = array_map(function ($vaccine) use ($allDiseases) {
            $diseaseDetails = [];
            if (isset($vaccine['disease_ids']) && is_array($vaccine['disease_ids'])) {
                foreach ($vaccine['disease_ids'] as $diseaseId) {
                    foreach ($allDiseases as $disease) {
                        if (isset($disease['id']) && $disease['id'] == $diseaseId) {
                            // Storing name object directly, original might pick based on locale
                            $diseaseDetails[] = ['id' => $disease['id'], 'name' => $disease['name']];
                            break;
                        }
                    }
                }
            }
            $vaccine['diseases'] = $diseaseDetails; // Embed disease info
            return $vaccine;
        }, array_values($petVaccines));

        return response()->json($result);
    }

    public function add(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'disease_ids' => 'sometimes|array',
            'disease_ids.*' => 'integer', // Validate each item in array if present
            'lot' => 'nullable|string|max:255',
            'application_date' => 'required|date',
            'next_date' => 'nullable|date|after_or_equal:application_date',
            'vcode' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $vaccineData = $request->all();
        $vaccineData['id'] = rand(100, 999); // Dummy ID
        $vaccineData['pet_id'] = (int)$petId;
        // Ensure disease_ids are integers if provided
        if (isset($vaccineData['disease_ids'])) {
            $vaccineData['disease_ids'] = array_map('intval', $vaccineData['disease_ids']);
        }


        return response()->json(['message' => 'Vaccine added successfully (dummy)', 'vaccine' => $vaccineData], 201);
    }
}

<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DummyAllergyController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName); // Standardized path
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    public function getAllergiesPet(Request $request, $petId) {
        $allAllergies = $this->loadData('allergies.json');
        $petAllergies = array_filter($allAllergies, function ($allergy) use ($petId) {
            return isset($allergy['pet_id']) && $allergy['pet_id'] == $petId;
        });
        return response()->json(array_values($petAllergies));
    }

    public function add(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'severity' => 'required|string|max:100', // Assuming severity is a string like Low, Medium, High
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $allergyData = $request->all();
        $allergyData['id'] = rand(100, 999); // Dummy ID
        $allergyData['pet_id'] = (int)$petId;

        return response()->json(['message' => 'Allergy added successfully (dummy)', 'allergy' => $allergyData], 201);
    }

    public function edit(Request $request, $petId, $allergyId) {
        // In a real dummy, you might first check if an allergy with $allergyId and $petId exists in the JSON.
        // For simplicity, we'll just validate and return the "updated" data.
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'severity' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $allergyData = $request->all();
        $allergyData['id'] = (int)$allergyId;
        $allergyData['pet_id'] = (int)$petId;

        return response()->json(['message' => 'Allergy updated successfully (dummy)', 'allergy' => $allergyData]);
    }
}

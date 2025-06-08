<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DummyTreatmentController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName); // Standardized path
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    public function getTreatment(Request $request, $petId) {
        $allTreatments = $this->loadData('treatments.json');
        $petTreatments = array_filter($allTreatments, function ($treatment) use ($petId) {
            return isset($treatment['pet_id']) && $treatment['pet_id'] == $petId;
        });
        return response()->json(array_values($petTreatments));
    }

    public function addTreatment(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'repetition' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $treatmentData = $request->all();
        $treatmentData['id'] = rand(100, 999); // Dummy ID
        $treatmentData['pet_id'] = (int)$petId;

        return response()->json(['message' => 'Treatment added successfully (dummy)', 'treatment' => $treatmentData], 201);
    }
}

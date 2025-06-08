<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DummyVisitController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName); // Standardized path
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    public function getVisit(Request $request, $petId) {
        $allVisits = $this->loadData('vet_visits.json');
        $petVisits = array_filter($allVisits, function ($visit) use ($petId) {
            return isset($visit['pet_id']) && $visit['pet_id'] == $petId;
        });
        return response()->json(array_values($petVisits));
    }

    public function addVisit(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $visitData = $request->all();
        $visitData['id'] = rand(100, 999); // Dummy ID
        $visitData['pet_id'] = (int)$petId;

        return response()->json(['message' => 'Vet visit added successfully (dummy)', 'visit' => $visitData], 201);
    }
}

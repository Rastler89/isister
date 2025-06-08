<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DummyMedicalController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName); // Standardized path
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    public function getTypes() {
        $types = $this->loadData('medical_types.json');
        return response()->json($types);
    }

    public function getMedical(Request $request, $petId) {
        $allMedicalTests = $this->loadData('medical_tests.json');
        $allTypes = $this->loadData('medical_types.json');

        $petMedicalTests = array_filter($allMedicalTests, function ($test) use ($petId) {
            return isset($test['pet_id']) && $test['pet_id'] == $petId;
        });

        $result = array_map(function ($test) use ($allTypes) {
            $typeName = null;
            if (isset($test['type_id'])) {
                foreach ($allTypes as $type) {
                    if (isset($type['id']) && $type['id'] == $test['type_id']) {
                        $typeName = $type['name']; // Storing name object
                        break;
                    }
                }
            }
            $test['type_name'] = $typeName; // Embed type name
            return $test;
        }, array_values($petMedicalTests));

        return response()->json($result);
    }

    public function addMedical(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|integer',
            'date' => 'required|date',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $medicalTestData = $request->all();
        $medicalTestData['id'] = rand(100, 999); // Dummy ID
        $medicalTestData['pet_id'] = (int)$petId;

        $allTypes = $this->loadData('medical_types.json');
        $typeName = null;
        foreach ($allTypes as $type) {
            if (isset($type['id']) && $type['id'] == $medicalTestData['type_id']) {
                $typeName = $type['name'];
                break;
            }
        }
        $medicalTestData['type_name'] = $typeName;

        return response()->json(['message' => 'Medical test added successfully (dummy)', 'medical_test' => $medicalTestData], 201);
    }
}

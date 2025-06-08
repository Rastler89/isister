<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DummySurgeryController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName); // Standardized path
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    public function getTypes() {
        $types = $this->loadData('surgery_types.json');
        return response()->json($types);
    }

    public function getSurgery(Request $request, $petId) {
        $allSurgeries = $this->loadData('surgeries.json');
        $allTypes = $this->loadData('surgery_types.json');

        $petSurgeries = array_filter($allSurgeries, function ($surgery) use ($petId) {
            return isset($surgery['pet_id']) && $surgery['pet_id'] == $petId;
        });

        $result = array_map(function ($surgery) use ($allTypes) {
            $typeName = null;
            if (isset($surgery['type_id'])) {
                foreach ($allTypes as $type) {
                    if (isset($type['id']) && $type['id'] == $surgery['type_id']) {
                        // Storing name object directly, original might pick based on locale
                        $typeName = $type['name'];
                        break;
                    }
                }
            }
            $surgery['type_name'] = $typeName; // Embed type name
            // The original controller also had a 'type' field with the full type object.
            // For simplicity here, just adding 'type_name'. Could be enhanced.
            return $surgery;
        }, array_values($petSurgeries));

        return response()->json($result);
    }

    public function addSurgery(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|integer', // In a real app, check if type_id exists
            'date' => 'required|date',
            'preop' => 'nullable|string',
            'description' => 'required|string',
            'result' => 'nullable|string',
            'complications' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $surgeryData = $request->all();
        $surgeryData['id'] = rand(100, 999); // Dummy ID
        $surgeryData['pet_id'] = (int)$petId;

        // Optionally, fetch and embed type_name if desired for the response
        $allTypes = $this->loadData('surgery_types.json');
        $typeName = null;
        foreach ($allTypes as $type) {
            if (isset($type['id']) && $type['id'] == $surgeryData['type_id']) {
                $typeName = $type['name'];
                break;
            }
        }
        $surgeryData['type_name'] = $typeName;


        return response()->json(['message' => 'Surgery added successfully (dummy)', 'surgery' => $surgeryData], 201);
    }
}

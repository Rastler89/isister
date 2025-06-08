<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // For created_at timestamp

class DummyConstantController extends Controller
{
    // Note: The original ConstantController doesn't have methods to get all constants for a pet.
    // It only has addSize and addWeight. So, no loadData or get methods here.

    public function addSize(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'value' => 'required|string|max:100', // Or numeric depending on how it's stored/used
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $constantData = [
            'id' => rand(100, 999), // Dummy ID
            'pet_id' => (int)$petId,
            'type' => 1, // 1 for Size
            'value' => $request->value,
            'created_at' => Carbon::now()->toIso8601String(),
        ];

        return response()->json(['message' => 'Size added successfully (dummy)', 'constant' => $constantData], 201);
    }

    public function addWeight(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'value' => 'required|string|max:100', // Or numeric
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $constantData = [
            'id' => rand(100, 999), // Dummy ID
            'pet_id' => (int)$petId,
            'type' => 2, // 2 for Weight
            'value' => $request->value,
            'created_at' => Carbon::now()->toIso8601String(),
        ];

        return response()->json(['message' => 'Weight added successfully (dummy)', 'constant' => $constantData], 201);
    }
}

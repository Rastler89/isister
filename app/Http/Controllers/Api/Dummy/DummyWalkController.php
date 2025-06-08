<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DummyWalkController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName); // Standardized path
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    // Similar to DummyDietController, getWalksPet will return a raw list.
    // The original WalkController has getSchedule($petId).
    public function getWalksPet(Request $request, $petId) {
        $allWalks = $this->loadData('walk_routines.json');
        $petWalks = array_filter($allWalks, function ($walk) use ($petId) {
            return isset($walk['pet_id']) && $walk['pet_id'] == $petId;
        });
        return response()->json(array_values($petWalks));
    }

    public function add(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'DayOfWeek' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday,Everyday',
            'time' => 'required|date_format:H:i:s', // Original uses H:i
            'description' => 'required|string|max:255',
            'duration' => 'nullable|string|max:100',
            'intensity' => 'nullable|string|max:100',
            'route' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $walkData = $request->all();
        $walkData['id'] = rand(100, 999); // Dummy ID
        $walkData['pet_id'] = (int)$petId;
        // $walkData['time'] = \Carbon\Carbon::parse($request->time)->format('H:i');

        return response()->json(['message' => 'Walk routine added successfully (dummy)', 'walk' => $walkData], 201);
    }

    public function delete(Request $request, $petId, $day, $hour) {
        // Dummy delete, similar to DummyDietController.
        return response()->json(['message' => "Walk routine for pet {$petId} on {$day} at {$hour} processed for deletion (dummy)."]);
    }
}

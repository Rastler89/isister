<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DummyDietController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName); // Standardized path
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    // In the original, there's getSchedule($petId) which groups by DayOfWeek.
    // For this dummy, getDietsPet will return the raw list for simplicity first.
    // Replicating the exact schedule structure can be a future enhancement if needed.
    public function getDietsPet(Request $request, $petId) {
        $allDiets = $this->loadData('diets.json');
        $petDiets = array_filter($allDiets, function ($diet) use ($petId) {
            return isset($diet['pet_id']) && $diet['pet_id'] == $petId;
        });
        return response()->json(array_values($petDiets));
    }

    public function add(Request $request, $petId) {
        $validator = Validator::make($request->all(), [
            'DayOfWeek' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday,Everyday',
            'time' => 'required|date_format:H:i:s', // Original uses H:i
            'description' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'amount' => 'nullable|string|max:100',
            'type' => 'nullable|string|max:100',
            'information' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $dietData = $request->all();
        $dietData['id'] = rand(100, 999); // Dummy ID
        $dietData['pet_id'] = (int)$petId;
        // Ensure time is formatted correctly if needed, though validator handles format.
        // $dietData['time'] = \Carbon\Carbon::parse($request->time)->format('H:i');

        return response()->json(['message' => 'Diet item added successfully (dummy)', 'diet' => $dietData], 201);
    }

    public function delete(Request $request, $petId, $day, $hour) {
        // Dummy delete doesn't modify JSON. Just acknowledges.
        // In a real dummy, you might check if such an item exists.
        // The original controller uses $day as integer 0-6 and $hour as H:i.
        // Here, we receive $day as string name and $hour as H:i:s (from route definition, assumed).
        // For simplicity, we won't try to find and "delete" from the mock file.

        // $dayOfWeekMap = ['Sunday' => 0, 'Monday' => 1, ...];
        // $dayInt = $dayOfWeekMap[$day] ?? -1;

        return response()->json(['message' => "Diet item for pet {$petId} on {$day} at {$hour} processed for deletion (dummy)."]);
    }
}

<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // For reading JSON file

class DummyPetController extends Controller
{
    private function loadPetsData() {
        $path = base_path('mock_data/pets.json');
        if (!File::exists($path)) {
            return [];
        }
        $json = File::get($path);
        return json_decode($json, true);
    }

    public function pets(Request $request) {
        $allPets = $this->loadPetsData();
        // Simulate filtering by user_id. For dummy, let's assume user_id 1
        // In a real dummy, you might get user_id from a dummy token or ignore auth
        $userId = 1; // Hardcoded for simplicity
        $userPets = array_filter($allPets, function ($pet) use ($userId) {
            return isset($pet['user_id']) && $pet['user_id'] == $userId;
        });

        $response['data'] = array_values($userPets); // Re-index array
        $response['count'] = count($userPets);

        return response()->json($response);
    }

    public function get(Request $request, $id) {
        $allPets = $this->loadPetsData();
        $pet = null;
        foreach ($allPets as $p) {
            if (isset($p['id']) && $p['id'] == $id) {
                // For now, just return the basic pet data.
                // Mimicking profilePet would require loading mock breed/specie data here too.
                $pet = $p;
                break;
            }
        }

        if (!$pet) {
            return response()->json(['message' => 'Pet not found.'], 404);
        }
        return response()->json($pet);
    }

    public function add(Request $request) {
        // Simulate adding a pet. Does not modify pets.json.
        // Generate a dummy ID (e.g., max_id + 1 or random)
        $allPets = $this->loadPetsData();
        $newId = count($allPets) > 0 ? max(array_column($allPets, 'id')) + 1 : 1;

        // Create a dummy pet record from request data
        $newPetData = $request->all();
        $newPetData['id'] = $newId;
        // Add other potential default fields if necessary for consistency
        $newPetData['user_id'] = $request->input('user_id', 1); // Default to user 1 if not provided
        $newPetData['created_at'] = now()->toIso8601String();
        $newPetData['updated_at'] = now()->toIso8601String();

        return response()->json($newPetData, 201);
    }

    public function addImage(Request $request, $id) {
        // Simulate adding an image. Does not save any file.
        $allPets = $this->loadPetsData();
        $petExists = false;
        foreach ($allPets as $p) {
            if (isset($p['id']) && $p['id'] == $id) {
                $petExists = true;
                break;
            }
        }

        if (!$petExists) {
            return response()->json(['message' => 'Pet not found.'], 404);
        }

        // Mock image data might be in $request->input('image') or $request->file('image')
        // For dummy, we just acknowledge.
        return response()->json(['message' => 'Dummy image uploaded successfully for pet ' . $id], 200);
    }

    public function update(Request $request, $id) {
        // Simulate updating a pet. Does not modify pets.json.
        $allPets = $this->loadPetsData();
        $petData = null;
        $petKey = null;

        foreach ($allPets as $key => $p) {
            if (isset($p['id']) && $p['id'] == $id) {
                $petData = $p;
                $petKey = $key;
                break;
            }
        }

        if (!$petData) {
            return response()->json(['message' => 'Pet not found.'], 404);
        }

        // Merge existing data with request data
        $updatedPetData = array_merge($petData, $request->all());
        $updatedPetData['updated_at'] = now()->toIso8601String();

        return response()->json($updatedPetData, 200);
    }

    public function changeStatus(Request $request, $id) {
        // Simulate changing pet status. Does not modify pets.json.
        $allPets = $this->loadPetsData();
        $petExists = false;
        foreach ($allPets as $p) {
            if (isset($p['id']) && $p['id'] == $id) {
                $petExists = true;
                break;
            }
        }

        if (!$petExists) {
            return response()->json(['message' => 'Pet not found.'], 404);
        }

        $newStatus = $request->input('status', null); // Assuming status is passed in request body
        if ($newStatus === null) {
             return response()->json(['message' => 'Status value not provided.'], 400);
        }

        return response()->json(['message' => 'Dummy status updated for pet ' . $id . ' to ' . $newStatus], 200);
    }

    private function loadMockData($filename) {
        $path = base_path('mock_data/' . $filename);
        if (!File::exists($path)) {
            return [];
        }
        $json = File::get($path);
        return json_decode($json, true);
    }

    public function publicGet(Request $request, $hash) {
        $allPets = $this->loadPetsData();
        $pet = null;
        foreach ($allPets as $p) {
            if (isset($p['hash']) && $p['hash'] == $hash) {
                $pet = $p;
                break;
            }
        }

        if (!$pet) {
            return response()->json(['message' => 'Pet not found by hash.'], 404);
        }

        // Mimic profilePet structure
        $breeds = $this->loadMockData('breeds.json');
        $species = $this->loadMockData('species.json');

        $breedInfo = null;
        foreach ($breeds as $b) {
            if ($b['id'] == $pet['breed_id']) {
                $breedInfo = $b;
                break;
            }
        }

        $specieInfo = null;
        if ($breedInfo && isset($breedInfo['specie_id'])) {
            foreach ($species as $s) {
                if ($s['id'] == $breedInfo['specie_id']) {
                    $specieInfo = $s;
                    break;
                }
            }
        }

        // Fallback for names if not present directly in pet data (as per old pets.json structure)
        // The new pets.json already has these, but good for robustness if structure varies.
        $pet['breed_en'] = $pet['breed_en'] ?? ($breedInfo['name']['en'] ?? 'Unknown Breed');
        $pet['breed_es'] = $pet['breed_es'] ?? ($breedInfo['name']['es'] ?? 'Raza Desconocida');
        $pet['specie_en'] = $pet['specie_en'] ?? ($specieInfo['name']['en'] ?? 'Unknown Specie');
        $pet['specie_es'] = $pet['specie_es'] ?? ($specieInfo['name']['es'] ?? 'Especie Desconocida');

        // Add other fields from profilePet as needed, e.g. vaccines, allergies (empty for now)
        $pet['vaccines'] = $pet['vaccines'] ?? [];
        $pet['allergies'] = $pet['allergies'] ?? [];
        $pet['walkroutines'] = $pet['walkroutines'] ?? [];
        $pet['diets'] = $pet['diets'] ?? [];
        $pet['vetvisits'] = $pet['vetvisits'] ?? [];
        $pet['treatments'] = $pet['treatments'] ?? [];
        $pet['surgeries'] = $pet['surgeries'] ?? [];
        $pet['medicaltests'] = $pet['medicaltests'] ?? [];
        $pet['constants'] = $pet['constants'] ?? [];
        // Ensure all expected fields from the initial pets.json are present, even if empty
        $pet['image'] = $pet['image'] ?? null;
        $pet['character'] = $pet['character'] ?? null;
        $pet['description'] = $pet['description'] ?? null;


        return response()->json($pet);
    }
}

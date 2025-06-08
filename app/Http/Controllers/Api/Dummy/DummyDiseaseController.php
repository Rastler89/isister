<?php
namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DummyDiseaseController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName);
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    public function get() { // Corresponds to original get()
        $diseases = $this->loadData('diseases.json');
        // Optional: If you need to embed species details, load species.json
        // and map them here. For now, returning diseases with species_ids.
        return response()->json($diseases);
    }

    public function getBy($id) { // Corresponds to original getBy(specie_id)
        $allDiseases = $this->loadData('diseases.json');
        $specieDiseases = array_filter($allDiseases, function ($disease) use ($id) {
            return isset($disease['species_ids']) && in_array($id, $disease['species_ids']);
        });
        return response()->json(array_values($specieDiseases));
    }
}

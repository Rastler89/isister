<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Though not used in all methods, good for consistency
use Illuminate\Support\Facades\File;

class DummyCountryController extends Controller
{
    private function loadData($fileName) {
        $path = base_path('mock_data/' . $fileName); // Standardized path
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    public function getCountries() {
        $countries = $this->loadData('countries.json');
        return response()->json($countries);
    }

    public function getStates($countryId) {
        $allStates = $this->loadData('states.json');
        $countryStates = array_filter($allStates, function ($state) use ($countryId) {
            return isset($state['country_id']) && $state['country_id'] == $countryId;
        });
        return response()->json(array_values($countryStates));
    }

    public function getTownsByState($stateId) {
        $allTowns = $this->loadData('towns.json');
        $stateTowns = array_filter($allTowns, function ($town) use ($stateId) {
            return isset($town['state_id']) && $town['state_id'] == $stateId;
        });
        return response()->json(array_values($stateTowns));
    }

    public function fullVersion() {
        $countries = $this->loadData('countries.json');
        $allStates = $this->loadData('states.json');
        $allTowns = $this->loadData('towns.json');

        $result = array_map(function ($country) use ($allStates, $allTowns) {
            $countryStates = [];
            foreach ($allStates as $state) {
                if (isset($state['country_id']) && $state['country_id'] == $country['id']) {
                    $stateTowns = [];
                    foreach ($allTowns as $town) {
                        if (isset($town['state_id']) && $town['state_id'] == $state['id']) {
                            $stateTowns[] = $town;
                        }
                    }
                    $state['towns'] = $stateTowns;
                    $countryStates[] = $state;
                }
            }
            $country['states'] = $countryStates;
            return $country;
        }, $countries);

        return response()->json($result);
    }
}

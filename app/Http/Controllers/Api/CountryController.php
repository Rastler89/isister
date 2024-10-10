<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\Town;

class CountryController extends Controller
{
    public function getCountries() {
        return response()->json(Country::all());
    }

    public function getStates($id) {
        return response()->json(State::where('country_id','=',$id)->get());
    }

    public function getTownsByState($id) {
        return response()->json(Town::where('state_id','=',$id)->get());
    }

    public function fullVersion() {

        $countries = Country::all();

        foreach($countries as $country) {
            $states = State::where('country_id','=',$country->id)->get();

            foreach($states as $state) {
                $state->towns = Town::where('state_id','=',$state->id)->get();
            }

            $country->states = $states;
        }

        return response()->json($countries);
    }


}

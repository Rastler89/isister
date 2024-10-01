<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\State;
use App\Models\Town;

class Countries extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = Storage::disk('public')->get('countries.json');

        $countries = json_decode($contents);

        foreach($countries as $country) {
            $ctry = new Country();

            $ctry['name'] = '{"es":"","en":"'.$country->country_name.'"}';
            $ctry['phone'] = $country->country_phone_code;
            $ctry['iso'] = $country->country_short_name;

            $ctry->save();

            if(!is_null($country->states)) {
                foreach($country->states as $state) {
                    $stt = new State();
    
                    $stt['name'] = '{"es":"","en":"'.$state->state_name.'"}';
                    $stt['country_id'] = $ctry['id'];
    
                    $stt->save();
    
                    if(!is_null($state->cities)) {
                        foreach($state->cities as $city) {
                            $twn = new Town();
        
                            $twn['name'] = '{"es":"","en":"'.$city->city_name.'"}';
                            $twn['country_id'] = $ctry['id'];
                            $twn['state_id'] = $stt['id'];
        
                            $twn->save();
                        }
                    }
                }
            }
        }
    }
}

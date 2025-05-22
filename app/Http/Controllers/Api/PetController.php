<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Moved to the top
use App\Models\Pet;
use App\Models\Breed;
use App\Models\Specie;
use App\Models\Vaccine;
use App\Models\Disease;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
// Removed duplicate Validator use statement that was here


class PetController extends Controller
{

    //Torna totes les mascotes
    public function pets(Request $request) {
        $data = Pet::where('user_id','=',$request->user()->id)->get();
        $count = Pet::where('user_id','=',$request->user()->id)->count();

        $response['data'] = $data;
        $response['count'] = $count;

        return response()->json($response);
    }

    //Afegeix una mascota
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:1', // e.g., M, F
            'birth' => 'required|date',
            'breed_id' => 'required|integer|exists:breeds,id',
            'code' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $pet = new Pet();

        $hash = base64_encode(hash('sha256', Str::random(40), true));
        $hash = strtr($hash, '+/', '-_'); // Sustituye + y / por caracteres seguros
        $hash = rtrim($hash, '='); // Elimina el '=' final

        $pet->user_id = $request->user()->id;
        $pet->name = $request->input('name');
        $pet->gender = $request->input('gender');
        $pet->birth = $request->input('birth');
        $pet->breed_id = $request->input('breed_id'); // Corrected from 'breed' to 'breed_id'
        $pet->code = $request->input('code');
        $pet->hash = $hash;
        $pet->status = 1;
        // Optional fields from request if they exist and are fillable
        if ($request->has('character')) {
            $pet->character = $request->input('character');
        }
        if ($request->has('description')) {
            $pet->description = $request->input('description');
        }


        $pet->save();

        return response()->json($pet->id);

    }

    //Afegeix la imatge
    public function addImage(Request $request, $id) {
        $request->validate([
            'image' => 'required|string',
        ]);

        $image = $request->image;  // your base64 encoded

        $imageData = base64_decode(substr($image,strpos($image,',')+1));

        $filename = uniqid().'.jpg';

        Storage::disk('public')->put($filename,$imageData);

        // Update pet record with the image filename
        $pet = Pet::find($id);
        $pet->image = $filename;
        $pet->save();

        return response()->json(['message' => 'Upload']);
    }

    //Cerca la mascota
    public function get(Request $request, $id) {
        $pet = Pet::where('id','=',$id)
                    ->where('user_id','=',$request->user()->id)
                    ->with('vaccines')
                    ->with('allergies')
                    ->with(['walkroutines' => function ($query) {
                        $query->orderBy('DayOfWeek','asc')->orderBy('time','asc');
                    }])
                    ->with(['diets' => function ($query) {
                        $query->orderBy('DayOfWeek','asc')->orderBy('time','asc');
                    }])
                    ->with('vetvisits')
                    ->with('treatments')
                    ->with('surgeries')
                    ->with('medicaltests')
                    ->with(['constants' => function ($query) {
                        $query->orderBy('type','asc')->orderBy('created_at','desc');
                    }])
                    ->first();

        if (!$pet) {
            return response()->json(['message' => 'Pet not found.'], 404);
        }

        $pet = $this->profilePet($pet);

        return response()->json($pet);
    }

    //Modifica
    public function update(Request $request, $id) {
        $pet = Pet::find($id);

        if($request->has('name') && $request->get('name') != '' && $request->get('name') != $pet->name) {
            $pet->name = $request->get('name');
        }

        if($request->has('gender') && $request->get('gender') != '' && $request->get('gender') != $pet->gender) {
            $pet->gender = $request->get('gender');
        }

        if($request->has('birth') && $request->get('birth') != '' && $request->get('birth') != $pet->birth) {
            $pet->birth = $request->get('birth');
        }

        if($request->has('description') && $request->get('description') != '' && $request->get('description') != $pet->description) {
            $pet->description = $request->get('description');
        }

        if($request->has('character') && $request->get('character') != '' && $request->get('character') != $pet->character) {
            $pet->character = $request->get('character');
        }

        if($request->has('code') && $request->get('code') != '' && $request->get('code') != $pet->code) {
            $pet->code = $request->get('code');
        }

        $pet->save();

        return response()->json($pet);
    }

    public function changeStatus(Request $request, $id) {
        $pet = Pet::find($id);

        if($request->get('value')==1) {
            $count = Pet::where('status','=',1)->where('user_id','=',$request->user()->id)->count();
            if($count>0) {
                return response()->json(['error' => 'se ha sobrepasado'],422);
            }
        }
        $pet->status = $request->get('value');

        $pet->save();

        return response()->json($pet);
    }

    //Publico
    public function public(Request $request, $hash) {
        $pet = Pet::where('hash','=',$hash)
                    ->with('vaccines')
                    ->with('allergies')
                    ->with(['walkroutines' => function ($query) {
                        $query->orderBy('DayOfWeek','asc')->orderBy('time','asc');
                    }])
                    ->with(['diets' => function ($query) {
                        $query->orderBy('DayOfWeek','asc')->orderBy('time','asc');
                    }])
                    ->with('vetvisits')
                    ->with('treatments')
                    ->with('surgeries')
                    ->with('medicaltests')
                    ->with('constants')
                    ->first();

        $pet = $this->profilePet($pet);

        return response()->json($pet);
    }

    private function profilePet($pet) {
        if (!$pet) {
            return null; // Or handle as an error response appropriately
        }

        $breed = Breed::find($pet->breed_id);
        if ($breed && $breed->name) { // Rely on Eloquent cast to array for $breed->name
            $pet->breed_en = $breed->name['en'] ?? 'EN NAME MISSING';
            $pet->breed_es = $breed->name['es'] ?? 'ES NAME MISSING';
        } else {
            $pet->breed_en = 'BREED DATA MISSING';
            $pet->breed_es = 'BREED DATA MISSING';
        }

        $specie = $breed ? Specie::find($breed->specie_id) : null;
        if ($specie && $specie->name) { // Rely on Eloquent cast to array for $specie->name
            $pet->specie_id = $breed->specie_id; // specie_id is already on breed
            $pet->specie_en = $specie->name['en'] ?? 'EN NAME MISSING';
            $pet->specie_es = $specie->name['es'] ?? 'ES NAME MISSING';
        } else {
            $pet->specie_id = $breed ? $breed->specie_id : null;
            $pet->specie_en = 'SPECIE DATA MISSING';
            $pet->specie_es = 'SPECIE DATA MISSING';
        }

        if ($pet->vaccines) { // Check if relation is loaded and not null
            foreach($pet->vaccines as $vaccine) {
                $diseasesData = json_decode($vaccine->disease, true);
                $processedDiseases = [];
                if ($diseasesData) { // json_decode with true returns array or null
                    foreach($diseasesData as $diseaseId) {
                        $diseaseModel = Disease::find($diseaseId);
                        if ($diseaseModel && $diseaseModel->name) { // Rely on Eloquent cast for $diseaseModel->name
                            // Create a new object or array to avoid modifying the model directly if not intended
                            $diseaseInfo = new \stdClass();
                            $diseaseInfo->id = $diseaseModel->id; // Or whatever properties are needed
                            $diseaseInfo->name_en = $diseaseModel->name['en'] ?? 'EN NAME MISSING';
                            $diseaseInfo->name_es = $diseaseModel->name['es'] ?? 'ES NAME MISSING';
                            $processedDiseases[] = $diseaseInfo;
                        }
                    }
                }
                $vaccine->disease = $processedDiseases; // Assign processed data
            }
        }

        // Ensure relations are loaded before trying to use getSchedule or access $specie->diseases
        if ($pet->relationLoaded('walkroutines') && $pet->walkroutines) {
            $pet->scheduleWalks = getSchedule($pet->walkroutines,'walk');
        } else {
            $pet->scheduleWalks = []; // Default empty schedule
        }
        
        if ($pet->relationLoaded('diets') && $pet->diets) {
            $pet->scheduleDiets = getSchedule($pet->diets,'diet');
        } else {
            $pet->scheduleDiets = []; // Default empty schedule
        }

        if ($specie && $specie->relationLoaded('diseases') && $specie->diseases) {
            $pet->diseases = $specie->diseases;
        } elseif($specie) { // If specie exists but diseases not loaded or null
             $pet->diseases = $specie->diseases()->get(); // Attempt to load if not loaded
        } else {
            $pet->diseases = []; // Default empty array
        }
        
        return $pet;
    }
}

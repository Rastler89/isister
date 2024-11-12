<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Breed;
use App\Models\Specie;
use App\Models\Vaccine;
use App\Models\Disease;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


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
        $pet = new Pet();

        $pet->user_id = $request->user()->id;
        $pet->name = $request->get('name');
        $pet->gender = $request->get('gender');
        $pet->birth = $request->get('birth');
        $pet->breed_id = $request->get('breed');
        $pet->code = $request->get('code');
        $pet->hash = Hash::make(Str::random(40));
        $pet->status = 1;

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
        $user = User::find($request->user()->id);

        $pet->adoptive = ($user->type == 'society');

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

        $user = User::find($request->user()->id);

        if($request->get('value')==1) {
            $count = Pet::where('status','=',1)->where('user_id','=',$request->user()->id)->count();
            if($count>0 && $user->type == 'user') { //TODO: crear para suscripción (CheckSubscription)
                return response()->json(['error' => 'se ha sobrepasado'],422);
            }
        }
        $pet->status = $request->get('value');

        $pet->save();

        return response()->json($pet);
    }

    public function changeAdopt(Request $request, $id) {
        $pet = Pet::find($id);

        $pet->is_in_adoption = $request->get('value');

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
        $breed = Breed::find($pet->breed_id);
        $names = $breed->name;

        $pet->breed_en = $names['en'];
        $pet->breed_es = $names['es'];

        $specie = Specie::find($breed->specie_id);
        $names = $specie->name;

        $pet->specie_id = $breed->specie_id;
        $pet->specie_en = $names['en'];
        $pet->specie_es = $names['es'];

        foreach($pet->vaccines as $vaccine) {
            $diseases = json_decode($vaccine->disease, true);

            foreach($diseases as &$disease) {
                $dname = Disease::find($disease);
                $names = $dname->name;

                $dname->name_en = $names['en'];
                $dname->name_es = $names['es'];

                $disease = $dname;
            }

            $vaccine->disease = $diseases;
        }

        $pet->scheduleWalks = getSchedule($pet->walkroutines);
        $pet->scheduleDiets = getSchedule($pet->diets);

        return $pet;
    }
}

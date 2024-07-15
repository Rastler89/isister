<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Breed;
use App\Models\Specie;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.'png';
        \File::put(storage_path(). '/app/public/' . $imageName, base64_decode($image));


        // Update pet record with the image filename
        $pet = Pet::find($id);
        $pet->image = $imageName;
        $pet->save();

        return response()->json(['message' => 'Upload']);
    }

    //Cerca la mascota
    public function get($id) {
        $pet = Pet::find($id);

        $breed = Breed::find($pet->breed_id);
        $names = json_decode($breed->name,true);

        $pet->breed_en = $names['en'];
        $pet->breed_es = $names['es'];

        $specie = Specie::find($breed->specie_id);
        $names = json_decode($specie->name,true);

        $pet->specie_id = $breed->specie_id;
        $pet->specie_en = $names['en'];
        $pet->specie_es = $names['es'];

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
}

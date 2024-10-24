<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Constant;

class ConstantController extends Controller
{
    private array $type = [
        'size' => 1,
        'weight' => 2,
    ];


    public function addSize(Request $request, $id) {
        return response()->json($this->addConstant($this->type['size'],$request,$id));
    }

    public function addWeight(Request $request, $id) {
        return response()->json($this->addConstant($this->type['weight'],$request,$id));
    }

    private function addConstant($type,$request,$id) {
        $constant = new Constant();

        $constant->pet_id = $id;
        $constant->type = $type;
        $constant->value = $request->get('value');

        $constant->save();

        return $constant;
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {

    public function profile(Request $request) {
        $user = User::find($request->user()->id);

        return response()->json($user);
    }

    public function payments_method(Request $request) {
        $user = User::find($request->user()->id);

        return response()->json($user->paymentMethods());
    }
}
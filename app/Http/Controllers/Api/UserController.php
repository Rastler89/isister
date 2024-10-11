<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class UserController extends Controller {

    public function profile(Request $request) {
        $user = User::find($request->user()->id);

        return response()->json($user);
    }

    public function payments_method(Request $request) {
        $user = User::find($request->user()->id);

        return response()->json($user->paymentMethods());
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return response()->json(['message' => 'User created successfully'], 201);
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required|string|min:8',
            'newPassword' => 'required|string|min:8',
            'rePassword' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::find($request->user()->id);
        $user->password = Hash::make($request->newPassword);

        $user->save();

        return response()->json(['message' => 'Password updated!'],201);
    }

    public function getProfile(Request $request) {
        return response()->json(User::find($request->user()->id));
    }

    public function changeProfile(Request $request) {
        $user = User::find($request->user()->id);

        $user->name = $request->get('name');
        $user->surname = $request->get('username');
        $user->phone = $request->get('phone');
        $user->country = $request->get('country');
        $user->state = $request->get('state');
        $user->town = $request->get('town');
        $user->adress = $request->get('adress');
        $user->cp = $request->get('cp');

        $user->save();

        return response()->json($user);
    }
}
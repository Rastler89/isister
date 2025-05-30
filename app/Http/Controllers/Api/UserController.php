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
            'password' => 'required|string|min:8|confirmed', // Added 'confirmed'
        ]);

        if ($validator->fails()) {
            // Return standard validation error structure
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
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
            'new_password_confirmation' => 'required|string|min:8|same:newPassword', // Using 'same' rule
        ]);

        if ($validator->fails()) {
            // Return standard validation error structure
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 400);
        }

        $user = $request->user(); // Use $request->user() to get authenticated user

        // Check if oldPassword matches current password
        if (!Hash::check($request->oldPassword, $user->password)) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => ['oldPassword' => ['Incorrect old password.']]], 400);
        }

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
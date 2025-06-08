<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator; // Add this
use Illuminate\Support\Facades\Hash; // Add this

class DummyUserController extends Controller
{
    private function loadUsersData() {
        $path = base_path('mock_data/users.json'); // Corrected path
        if (!File::exists($path)) {
            return [];
        }
        $json = File::get($path);
        return json_decode($json, true);
    }

    public function getProfile(Request $request) {
        $users = $this->loadUsersData();
        if (empty($users)) {
            return response()->json(['message' => 'No users found in mock data.'], 404);
        }
        // Return the first user as a generic profile for the dummy
        return response()->json($users[0]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255', // In a real dummy, you might not check for uniqueness against the JSON
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        // Simulate user creation without saving to JSON
        $userData = [
            'id' => rand(100, 999), // Dummy ID
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password), // Don't include hashed password in response generally
            'email_verified_at' => now()->toIso8601String(),
            'created_at' => now()->toIso8601String(),
            'updated_at' => now()->toIso8601String(),
            'profile' => [] // Empty profile for simplicity in dummy registration
        ];

        return response()->json(['message' => 'User created successfully (dummy)', 'user' => $userData], 201);
    }

    // Add other methods like changePassword, changeProfile as needed.
    // These would typically just return success messages without modifying the JSON file.

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        // Simulate password change
        return response()->json(['message' => 'Password changed successfully (dummy)']);
    }

    public function changeProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            // Add other profile fields as needed for validation
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }
        // Simulate profile update
        $profileData = $request->only(['name', 'surname', 'phone', 'country', 'state', 'town', 'adress', 'cp']);
        return response()->json(['message' => 'Profile updated successfully (dummy)', 'profile' => $profileData]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    // Registration tests
    /** @test */
    public function test_user_can_register_successfully()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123', // Changed from rePassword
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'User created successfully']); // Adjust message as per your controller

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /** @test */
    public function test_user_registration_fails_with_missing_fields()
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'password']); // password_confirmation not required if password missing
    }

    /** @test */
    public function test_user_registration_fails_with_invalid_email()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123', // Changed from rePassword
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function test_user_registration_fails_with_short_password()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'short', // Password shorter than 8 characters
            'password_confirmation' => 'short', // Changed from rePassword
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function test_user_registration_fails_with_duplicate_email()
    {
        User::factory()->create(['email' => 'test@example.com']);

        $userData = [
            'name' => 'Another User',
            'email' => 'test@example.com', // Duplicate email
            'password' => 'password123',
            'password_confirmation' => 'password123', // Changed from rePassword
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function test_user_registration_fails_with_password_confirmation()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password456', // Different password, changed from rePassword
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['password']); // Error is on 'password' field for 'confirmed' rule
    }

    // Get Profile tests
    /** @test */
    public function test_authenticated_user_can_get_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->getJson('/api/profile');

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $user->id,
                     'name' => $user->name,
                     'email' => $user->email,
                 ]);
    }

    /** @test */
    public function test_unauthenticated_user_cannot_get_profile()
    {
        $response = $this->getJson('/api/profile');

        $response->assertStatus(401);
    }

    // Change Password tests
    /** @test */
    public function test_authenticated_user_can_change_password()
    {
        $user = User::factory()->create(['password' => Hash::make('oldpassword')]);

        $response = $this->actingAs($user, 'api')->postJson('/api/changePassword', [
            'oldPassword' => 'oldpassword',
            'newPassword' => 'newpassword123',
            'new_password_confirmation' => 'newpassword123', // Changed from rePassword
        ]);

        $response->assertStatus(201) // As per instructions
                 ->assertJson(['message' => 'Password updated!']); // Adjusted message

        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    /** @test */
    public function test_change_password_fails_with_validation_errors()
    {
        $user = User::factory()->create();

        // Scenario 1: Missing oldPassword
        $response1 = $this->actingAs($user, 'api')->postJson('/api/changePassword', [
            'newPassword' => 'newpassword123',
            'new_password_confirmation' => 'newpassword123',
        ]);
        $response1->assertStatus(400) // As per instructions
                  ->assertJsonValidationErrors(['oldPassword']);

        // Scenario 2: Missing newPassword
        $response2 = $this->actingAs($user, 'api')->postJson('/api/changePassword', [
            'oldPassword' => 'oldpassword',
            'new_password_confirmation' => 'newpassword123',
        ]);
        $response2->assertStatus(400)
                  ->assertJsonValidationErrors(['newPassword']);

        // Scenario 3: Missing new_password_confirmation
        $response3 = $this->actingAs($user, 'api')->postJson('/api/changePassword', [
            'oldPassword' => 'oldpassword',
            'newPassword' => 'newpassword123',
        ]);
        $response3->assertStatus(400)
                  ->assertJsonValidationErrors(['new_password_confirmation']); // Error is on new_password_confirmation now

        // Scenario 4: newPassword and new_password_confirmation do not match
        $response4 = $this->actingAs($user, 'api')->postJson('/api/changePassword', [
            'oldPassword' => 'oldpassword',
            'newPassword' => 'newpassword123',
            'new_password_confirmation' => 'anotherpassword',
        ]);
        $response4->assertStatus(400)
                  ->assertJsonValidationErrors(['new_password_confirmation']); // Error is on new_password_confirmation now

        // Scenario 5: newPassword is too short (assuming min 8 characters)
        $response5 = $this->actingAs($user, 'api')->postJson('/api/changePassword', [
            'oldPassword' => 'oldpassword',
            'newPassword' => 'short',
            'new_password_confirmation' => 'short',
        ]);
        $response5->assertStatus(400)
                  ->assertJsonValidationErrors(['newPassword']);
    }

    /** @test */
    public function test_unauthenticated_user_cannot_change_password()
    {
        $response = $this->postJson('/api/changePassword', [
            'oldPassword' => 'oldpassword',
            'newPassword' => 'newpassword123',
            'new_password_confirmation' => 'newpassword123', // Changed from rePassword
        ]);

        $response->assertStatus(401);
    }
}

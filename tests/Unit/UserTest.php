<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_can_create_user()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('test@example.com', $user->email);
    }

    /** @test */
    public function test_password_is_hashed()
    {
        $user = User::factory()->create(['password' => 'password123']);

        $this->assertNotEquals('password123', $user->password);
        $this->assertTrue(Hash::check('password123', $user->password));
    }

use App\Models\Specie;
use App\Models\Breed;

    /** @test */
    public function test_user_can_have_pets()
    {
        $user = User::factory()->create();

        // Ensure a Specie and Breed exist for the PetFactory to use
        $specie = Specie::factory()->create(['name' => 'Dog']); // Assuming Specie model and factory exist
        Breed::factory()->create(['id' => 1, 'name' => 'Labrador', 'specie_id' => $specie->id]); // Assuming Breed model and factory exist

        Pet::factory()->create(['user_id' => $user->id, 'breed_id' => 1]);
        Pet::factory()->create(['user_id' => $user->id, 'breed_id' => 1]);

        $this->assertInstanceOf(Collection::class, $user->pets);
        $this->assertCount(2, $user->pets);
        $this->assertInstanceOf(Pet::class, $user->pets->first());
    }

    /** @test */
    public function test_user_can_be_soft_deleted()
    {
        $user = User::factory()->create();

        $user->delete();

        $this->assertTrue($user->trashed());
        $this->assertModelMissing($user); // Alternative assertion
        $this->assertInstanceOf(User::class, User::withTrashed()->find($user->id));
    }
}

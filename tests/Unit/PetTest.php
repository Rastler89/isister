<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pet;
use App\Models\User;
use App\Models\Breed;
use App\Models\Specie;
use App\Models\VetVisit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;

class PetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_can_create_pet()
    {
        $user = User::factory()->create();
        $specie = Specie::factory()->create();
        $breed = Breed::factory()->create(['specie_id' => $specie->id]);

        $pet = Pet::factory()->create([
            'user_id' => $user->id,
            'breed_id' => $breed->id,
            // PetFactory should handle other required fields like gender, birth, code, hash
        ]);

        $this->assertInstanceOf(Pet::class, $pet);
        $this->assertEquals($user->id, $pet->user_id);
        $this->assertEquals($breed->id, $pet->breed_id);
        // Add more assertions if specific values from PetFactory are known/testable
        $this->assertNotNull($pet->name);
        $this->assertNotNull($pet->gender);
        $this->assertNotNull($pet->birth);
        $this->assertNotNull($pet->code);
        $this->assertNotNull($pet->hash);
    }

    /** @test */
    public function test_pet_belongs_to_owner()
    {
        $user = User::factory()->create();
        $specie = Specie::factory()->create(); // Needed for Breed factory
        $breed = Breed::factory()->create(['specie_id' => $specie->id]); // Needed for Pet factory

        $pet = Pet::factory()->create([
            'user_id' => $user->id,
            'breed_id' => $breed->id,
        ]);

        $this->assertEquals($user->id, $pet->user_id); // Check if user_id is set on the model
        $this->assertInstanceOf(User::class, $pet->owner);
        $this->assertEquals($user->id, $pet->owner->id);
    }

    /** @test */
    public function test_pet_belongs_to_breed()
    {
        $specie = Specie::factory()->create();
        $breed = Breed::factory()->create(['specie_id' => $specie->id]);
        // User is also needed because PetFactory associates a user_id by default
        $user = User::factory()->create();


        $pet = Pet::factory()->create([
            'breed_id' => $breed->id,
            'user_id' => $user->id, // Ensure user_id is provided
        ]);

        $this->assertInstanceOf(BelongsTo::class, $pet->breed());
        $this->assertInstanceOf(Breed::class, $pet->breed);
        $this->assertEquals($breed->id, $pet->breed->id);
    }

    /** @test */
    public function test_pet_can_be_soft_deleted()
    {
        $user = User::factory()->create(); // Needed for Pet factory
        $specie = Specie::factory()->create(); // Needed for Breed factory
        $breed = Breed::factory()->create(['specie_id' => $specie->id]); // Needed for Pet factory

        $pet = Pet::factory()->create([
            'user_id' => $user->id,
            'breed_id' => $breed->id,
        ]);

        $pet->delete();

        $this->assertTrue($pet->trashed());
        $this->assertNull(Pet::find($pet->id));
        $this->assertInstanceOf(Pet::class, Pet::withTrashed()->find($pet->id));
    }

    /** @test */
    public function test_pet_can_have_vet_visits()
    {
        $user = User::factory()->create(); // Needed for Pet factory
        $specie = Specie::factory()->create(); // Needed for Breed factory
        $breed = Breed::factory()->create(['specie_id' => $specie->id]); // Needed for Pet factory

        $pet = Pet::factory()->create([
            'user_id' => $user->id,
            'breed_id' => $breed->id,
        ]);

        VetVisit::factory()->create(['pet_id' => $pet->id]);

        $this->assertInstanceOf(Collection::class, $pet->vetvisits);
        $this->assertCount(1, $pet->vetvisits);
        $this->assertInstanceOf(VetVisit::class, $pet->vetvisits->first());
    }
}

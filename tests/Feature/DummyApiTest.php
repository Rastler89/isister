<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\File; // To read mock data files

class DummyApiTest extends TestCase
{
    private function loadMockData($filename)
    {
        $path = base_path('mock_data/' . $filename);
        if (!File::exists($path)) {
            return null; // Or throw exception, depending on test needs
        }
        return json_decode(File::get($path), true);
    }

    /** @test */
    public function it_can_get_all_dummy_pets()
    {
        // Expected data based on DummyPetController logic (filters by user_id = 1)
        $allPets = $this->loadMockData('pets.json');
        $expectedPets = [];
        if ($allPets) {
            foreach ($allPets as $pet) {
                if (isset($pet['user_id']) && $pet['user_id'] == 1) {
                    $expectedPets[] = $pet;
                }
            }
        }

        $response = $this->getJson('/api/dummy/pets');

        $response->assertStatus(200)
                 ->assertJsonCount(count($expectedPets), 'data')
                 ->assertJsonPath('count', count($expectedPets));

        // Optionally, assert the structure of one of the pets if $expectedPets is not empty
        if (!empty($expectedPets)) {
            $response->assertJsonPath('data.0.id', $expectedPets[0]['id']);
        }
    }

    /** @test */
    public function it_can_get_a_single_dummy_pet_by_id()
    {
        $allPets = $this->loadMockData('pets.json');
        $targetPet = null;
        if ($allPets) {
            foreach ($allPets as $pet) {
                if (isset($pet['id']) && $pet['id'] == 1) { // Assuming pet with ID 1 exists
                    $targetPet = $pet;
                    break;
                }
            }
        }

        if (!$targetPet) {
            $this->markTestSkipped('Pet with ID 1 not found in mock_data/pets.json.');
            return;
        }

        $response = $this->getJson('/api/dummy/pets/1');

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $targetPet['id'],
                     'name' => $targetPet['name'],
                     // Add more fields from $targetPet as needed for a thorough check
                 ]);
    }

    /** @test */
    public function it_can_get_a_public_dummy_pet_by_hash()
    {
        $allPets = $this->loadMockData('pets.json');
        $targetPet = null;
        $targetPetHash = null;

        if ($allPets) {
            foreach ($allPets as $pet) {
                // Find the first pet that has a 'hash' and 'breed_id'
                if (!empty($pet['hash']) && isset($pet['breed_id'])) {
                    $targetPet = $pet;
                    $targetPetHash = $pet['hash'];
                    break;
                }
            }
        }

        if (!$targetPet || !$targetPetHash) {
            $this->markTestSkipped('No suitable pet with hash and breed_id found in mock_data/pets.json for publicGet test.');
            return;
        }

        // Load breed and specie data for assertion
        $breedData = null;
        if (isset($targetPet['breed_id'])) {
            $allBreeds = $this->loadMockData('breeds.json');
            if ($allBreeds) {
                foreach ($allBreeds as $breed) {
                    if ($breed['id'] == $targetPet['breed_id']) {
                        $breedData = $breed;
                        break;
                    }
                }
            }
        }

        $specieData = null;
        if ($breedData && isset($breedData['specie_id'])) {
            $allSpecies = $this->loadMockData('species.json');
            if ($allSpecies) {
                foreach ($allSpecies as $specie) {
                    if ($specie['id'] == $breedData['specie_id']) {
                        $specieData = $specie;
                        break;
                    }
                }
            }
        }

        $response = $this->getJson("/api/dummy/public/pet/" . $targetPetHash);

        $response->assertStatus(200)
                 ->assertJsonPath('id', $targetPet['id'])
                 ->assertJsonPath('name', $targetPet['name'])
                 ->assertJsonPath('hash', $targetPetHash);

        if ($breedData && isset($breedData['name']['en']) && isset($breedData['name']['es'])) {
            $response->assertJsonPath('breed_en', $breedData['name']['en']);
            $response->assertJsonPath('breed_es', $breedData['name']['es']);
        }
        if ($specieData && isset($specieData['name']['en']) && isset($specieData['name']['es'])) {
            $response->assertJsonPath('specie_en', $specieData['name']['en']);
            $response->assertJsonPath('specie_es', $specieData['name']['es']);
        }
    }

    /** @test */
    public function it_can_simulate_creating_a_dummy_pet()
    {
        $petData = [
            'name' => 'TestDummyPet',
            'gender' => 'M',
            'birth' => '2023-05-01',
            'breed_id' => 1, // Assuming a breed with ID 1 exists in mock_data/breeds.json
            'code' => 'TD001',
        ];

        $response = $this->postJson('/api/dummy/pets', $petData);

        $response->assertStatus(201) // DummyPetController returns 201 for add
                 ->assertJsonFragment(['name' => 'TestDummyPet'])
                 ->assertJsonStructure(['id', 'name', 'gender', 'birth', 'breed_id', 'code', 'user_id', 'created_at', 'updated_at']); // Structure from DummyPetController@add
    }
}

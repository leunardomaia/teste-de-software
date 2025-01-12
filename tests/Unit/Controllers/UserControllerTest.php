<?php

namespace Tests\Unit\Controllers;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
   
    public function testIndex(): void
    {

        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->getJson('/api/users');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);
    }

    public function testStore(): void
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Leo',
            'email' => 'leo@email.com',
            'password' => 'senha'
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                    'id',
                    'nome',
                    'email',
            ]);
        
    }

    public function testShow(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/$user->id");

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);
    }

    
}

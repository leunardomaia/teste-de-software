<?php

namespace Tests\Unit\Controllers;

use App\Models\User;
use Database\Seeders\TestTableSeeder;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
 
    public function testLoginFail(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'errado@gmail',
            'password' => 'senha'
        ]);

        $response
            ->assertStatus(401)
            ->assertJsonStructure([
                'mensagem'
            ]);
    }

    public function testLoginSuccess(): void
    {

        $this->seed(TestTableSeeder::class);
        $response = $this->postJson('/api/login', [
            'email' => 'usuario@email.com',
            'password' => 'senha'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'mensagem',
                'token',
            ]);
    }

    public function testLogout(): void
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/logout');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'mensagem'
            ])
            ->assertJson([
                'mensagem' => 'Token removido.'
            ]);
    }    

}

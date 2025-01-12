<?php

namespace Tests\Unit\Controllers;

use Database\Seeders\TarefasTableSeeder;
use Database\Seeders\TestTableSeeder;
use Tests\TestCase;

class TarefaControllerTest extends TestCase
{

    public function testIndex(): void
    {
        $response = $this->getJson('/api/tarefas');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);
    }

    public function testStore(): void
    {

        $this->seed(TestTableSeeder::class);

        $response = $this->postJson('/api/tarefas', [
            'user_id' => 1,
            'titulo' => 'Primeira tarefa criada pela API.',
            'descricao' => 'Essa é a descrição da Primeira tarefa criada pela API.',
            'data_limite' => '2024/06/29',
            'concluida' => 0
        ]);

        $response
        ->assertStatus(201)
        ->assertJsonStructure([
            'id',
            'usuario' => [
                'id',
                'nome',
                'email',
            ],
            'titulo',
            'descricao',
            'data_limite',
            'status',
        ]);
    }

    public function testStoreBadRequest(): void
    {
        $response = $this->postJson('/api/tarefas', [
            'user_id' => 1,
            'titulo' => 'Primeira tarefa criada pela API.',
            'descricao' => 'Essa é a descrição da Primeira tarefa criada pela API.',
            'data_limite' => '2024/06/29',
            'concluida' => 2 // Valor inválido
        ]);

        $response
            ->assertStatus(400)
            ->assertJsonFragment([
                'concluida' => [
                    'The concluida field must be between 0 and 1.'
                ]
            ]);
    }

    public function testShow(): void
    {
        $this->seed(TestTableSeeder::class);

        $response = $this->getJson('/api/tarefas/1');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'usuario' => [
                        'id',
                        'nome',
                        'email',
                    ],
                    'titulo',
                    'descricao',
                    'data_limite',
                    'status',
                ]
            ]);
    }

    public function testUpdate(): void
    {
        $this->seed(TestTableSeeder::class);

        $response = $this->putJson('/api/tarefas/1', [
            'user_id' => 1,
            'titulo' => 'Primeira tarefa criada pela API.',
            'descricao' => 'Essa é a descrição da Primeira tarefa atualizada pela API.',
            'data_limite' => '2024/06/29',
            'concluida' => 1
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'usuario' => [
                        'id',
                        'nome',
                        'email',
                    ],
                    'titulo',
                    'descricao',
                    'data_limite',
                    'status',
                ]
            ])
            ->assertJsonFragment([
                'descricao' => 'Essa é a descrição da Primeira tarefa atualizada pela API.',
                'status' => 'Concluída'
            ]);
    }

    public function testUpdateBadRequest(): void
    {
        $response = $this->putJson('/api/tarefas/1', [
            'user_id' => 1,
            'titulo' => 'Primeira tarefa criada pela API.',
            'data_limite' => '2024/06/29',
            'concluida' => 1
        ]);

        $response
            ->assertStatus(400)
            ->assertJsonFragment([
                'descricao' => [
                    'The descricao field is required.'
                ]
            ]);
    }

    public function testDestroy(): void
    {
        $this->seed(TestTableSeeder::class);

        $response = $this->deleteJson('/api/tarefas/1');

        $response
            ->assertStatus(200);
    }

    public function testDestroyNotFound(): void
    {
        $response = $this->deleteJson('/api/tarefas/1');

        $response
            ->assertStatus(404)
            ->assertJsonFragment([
                'mensagem' => 'Tarefa não encontrada.'
            ]);
    }
}

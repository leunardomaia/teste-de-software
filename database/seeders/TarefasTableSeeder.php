<?php

namespace Database\Seeders;

use App\Models\Tarefa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarefasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tarefa::truncate();

        Tarefa::create([
            'id' => 1,
            'usuario' => [
                'id' => 1,
                'nome' => 'Usuário Teste',
                'email' => 'usuario@email.com',
            ],
            'titulo' => 'Tarefa 1',
            'descricao' => 'Descrição da tarefa 1',
            'data_limite' => '2021/12/31',
            'status' => 'Pendente',
        ]);
    }
}

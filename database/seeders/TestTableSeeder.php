<?php

namespace Database\Seeders;

use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::truncate();

        User::create([
            'id' => 1,
            'name' => 'Usuário Teste',
            'email' => 'usuario@email.com',
            'password' => bcrypt('senha'),
            ]);

        Tarefa::truncate();

        Tarefa::create([
            'id' => 1,
            'user_id' => 1,
            'titulo' => 'Tarefa 1',
            'descricao' => 'Descrição da tarefa 1',
            'data_limite' => '2021/12/31',
            'concluida' => 'Pendente',
        ]);
    }
}

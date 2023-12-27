<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activities')->insert([
            'user_id' => 1,
            'name' => 'Construtora',
        ]);
        DB::table('activities')->insert([
            'user_id' => 1,
            'name' => 'Revenda de Carros',
        ]);
        DB::table('activities')->insert([
            'user_id' => 1,
            'name' => 'Supermercado',
            'description' => 'teste...',
        ]);
        DB::table('activities')->insert([
            'user_id' => 1,
            'name' => 'Material de construção',
        ]);
        DB::table('activities')->insert([
            'user_id' => 1,
            'name' => 'Material elétrico',
        ]);

        // Adicionando mais linhas na tabela,
        //  relacionadas ao usuário ID=3
        DB::table('activities')->insert([
            'user_id' => 3,
            'name' => 'Construtora 3',
        ]);
        DB::table('activities')->insert([
            'user_id' => 3,
            'name' => 'Revenda de Carros 3',
        ]);
        DB::table('activities')->insert([
            'user_id' => 3,
            'name' => 'Supermercado 3',
            'description' => 'teste...',
        ]);
        DB::table('activities')->insert([
            'user_id' => 3,
            'name' => 'Material de construção 3',
        ]);
        DB::table('activities')->insert([
            'user_id' => 3,
            'name' => 'Material elétricozzzz',
        ]);
        DB::table('activities')->insert([
            'user_id' => 3,
            'name' => 'Material xxxxx',
        ]);
        DB::table('activities')->insert([
            'user_id' => 3,
            'name' => 'Material wwwww',
        ]);
    }
}

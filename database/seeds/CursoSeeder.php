<?php

use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert([
            'nome' => 'Sistemas de Informação',
            'carga_horaria_obrigatoria'=> 3240,
            'carga_horaria_optativa' => 160,
            'carga_horaria_complementar' => 100,
            'nivel_curso_id' => 1,
        ]);

        DB::table('cursos')->insert([
            'nome' => 'Ciência da Computação',
            'carga_horaria_obrigatoria'=> 3400,
            'carga_horaria_optativa' => 80,
            'carga_horaria_complementar' => 200,
            'nivel_curso_id' => 1,
        ]);

        DB::table('cursos')->insert([
            'nome' => 'Design Gráfico',
            'carga_horaria_obrigatoria'=> 2420,
            'carga_horaria_optativa' => 80,
            'carga_horaria_complementar' => 216,
            'nivel_curso_id' => 1,
        ]);
    }
}

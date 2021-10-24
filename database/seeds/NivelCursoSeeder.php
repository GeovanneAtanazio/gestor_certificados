<?php

use Illuminate\Database\Seeder;

class NivelCursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $niveis_cursos = array(
            'Graduação',
            'Pós-Graduação',
        );

        foreach($niveis_cursos as $nivel_curso){
            DB::table('niveis_cursos')->insert([
                'nome' => $nivel_curso,
            ]);
        }
    }
}

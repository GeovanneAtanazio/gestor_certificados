<?php

use Illuminate\Database\Seeder;

class TipoCertificadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos_certificados = array(
            'Proficiência',
            'Curso Online',
            'Curso Presencial',
            'Estudos Temáticos',
            'Pesquisa',
            'Extensão',
            'Participação em Projeto de Ensino',
            'Participação em Empresa Júnior',
            'Participação em Eventos e Palestras',
            'Organização de Eventos',
            'Ministrante de Curso, Treinamento ou Palestra',
        );

        foreach($tipos_certificados as $tipo_certificado){
            DB::table('tipos_certificados')->insert([
                'nome' => $tipo_certificado,
            ]);
        }
    }
}

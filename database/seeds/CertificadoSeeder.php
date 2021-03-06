<?php

use Illuminate\Database\Seeder;

class CertificadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certificados')->insert([
            'titulo' => 'Certificado A',
            'arquivo' => 'teste',
            'carga_horaria' => '4',
            'user_id' => '3',
            'status_certificado_id' => '1',
            'tipo_certificado_id' => '2',
            'arquivo' => 'certificado.png',
        ]);

        DB::table('certificados')->insert([
            'titulo' => 'Certificado B',
            'arquivo' => 'teste',
            'carga_horaria' => '6',
            'user_id' => '4',
            'status_certificado_id' => '2',
            'tipo_certificado_id' => '3',
            'arquivo' => 'certificado.png',
        ]);

        DB::table('certificados')->insert([
            'titulo' => 'Certificado C',
            'arquivo' => 'teste',
            'carga_horaria' => '8',
            'user_id' => '5',
            'status_certificado_id' => '3',
            'tipo_certificado_id' => '4',
            'arquivo' => 'certificado.png',
        ]);
    }
}

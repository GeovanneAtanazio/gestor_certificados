<?php

use Illuminate\Database\Seeder;

class StatusCertificadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_certificados = array(
            'Em Análise',
            'Homologado ',
            'Não-Homologado',
        );

        foreach($status_certificados as $status_certificado){
            DB::table('status_certificados')->insert([
                'nome' => $status_certificado,
            ]);
        }
    }
}

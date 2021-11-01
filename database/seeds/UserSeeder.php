<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jorge Jesus',
            'email'=> 'jj@unit.br',
            'password'  =>  bcrypt('123456789'),
        ]);

        DB::table('users')->insert([
            'name' => 'João de Deus',
            'email'=> 'jd@unit.br',
            'password'  =>  bcrypt('123456789'),
        ]);

        DB::table('users')->insert([
            'name' => 'Gabriel Barbosa',
            'email'=> 'gabigol@unit.br',
            'password'  =>  bcrypt('123456789'),
            'carga_horaria_obrigatoria' => '30',
            'carga_horaria_optativa' => '4',
            'carga_horaria_complementar' => '0',
            'curso_id' => '1'
        ]);

        DB::table('users')->insert([
            'name' => 'Giorgian De Arrascaeta',
            'email'=> 'de_arrascaeta@unit.br',
            'password'  =>  bcrypt('123456789'),
            'carga_horaria_obrigatoria' => '30',
            'carga_horaria_optativa' => '50',
            'carga_horaria_complementar' => '6',
            'curso_id' => '3',
        ]);

        DB::table('users')->insert([
            'name' => 'Bruno Henrique',
            'email'=> 'oto_pata_mar@unit.br',
            'password'  =>  bcrypt('123456789'),
            'carga_horaria_obrigatoria' => '30',
            'carga_horaria_optativa' => '50',
            'carga_horaria_complementar' => '0',
            'curso_id' => '2',
        ]);

        DB::table('users')->insert([
            'name' => 'Gerson Coringa',
            'email'=> 'vapo_vapo@unit.br',
            'password'  =>  bcrypt('123456789'),
            'carga_horaria_obrigatoria' => '30',
            'carga_horaria_optativa' => '50',
            'carga_horaria_complementar' => '0',
            'curso_id' => '1',
        ]);

    }
}

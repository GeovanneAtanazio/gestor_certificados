<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            'Gestor',
            'Aluno',
        );

        foreach($roles as $role){
            DB::table('roles')->insert([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }
    }
}

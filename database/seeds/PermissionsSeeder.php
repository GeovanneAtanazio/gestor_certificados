<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            'certificado.index',
            'certificado.create',
            'certificado.store',
            'certificado.show',
            'certificado.update',
            'certificado.destroy',
            'aluno.index',
            'aluno.show',
        );

        foreach($permissions as $permission)
        {
            DB::table('permissions')->insert([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}

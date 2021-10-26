<?php

use Illuminate\Database\Seeder;

class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Permission:certificado.index
         * Role: Gestor
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 1,
            'role_id' => 1,
        ]);

        /**
         * Permission:certificado.create
         * Role: Gestor
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 2,
            'role_id' => 1,
        ]);

        /**
         * Permission:certificado.store
         * Role: Gestor
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 3,
            'role_id' => 1,
        ]);

        /**
         * Permission:certificado.show
         * Role: Gestor
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 4,
            'role_id' => 1,
        ]);

        /**
         * Permission:certificado.update
         * Role: Gestor
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 5,
            'role_id' => 1,
        ]);

        /**
         * Permission:certificado.destroy
         * Role: Gestor
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 6,
            'role_id' => 1,
        ]);

        /**
         * Permission:aluno.index
         * Role: Gestor
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 7,
            'role_id' => 1,
        ]);

         /**
         * Permission:aluno.show
         * Role: Gestor
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 8,
            'role_id' => 1,
        ]);

        /**
         * Permission:certificado.index
         * Role: Aluno
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 1,
            'role_id' => 2,
        ]);

        /**
         * Permission:certificado.create
         * Role: Aluno
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 2,
            'role_id' => 2,
        ]);

        /**
         * Permission:certificado.store
         * Role: Aluno
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 3,
            'role_id' => 2,
        ]);

        /**
         * Permission:certificado.show
         * Role: Aluno
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 4,
            'role_id' => 2,
        ]);

        /**
         * Permission:certificado.update
         * Role: Aluno
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 5,
            'role_id' => 2,
        ]);

        /**
         * Permission:certificado.destroy
         * Role: Aluno
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 6,
            'role_id' => 2,
        ]);

         /**
         * Permission:aluno.show
         * Role: Aluno
         */
        DB::table('role_has_permissions')->insert([
            'permission_id' => 8,
            'role_id' => 2,
        ]);
    }
}

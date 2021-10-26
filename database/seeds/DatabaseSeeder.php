<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(array(
            RoleSeeder::class,
            PermissionsSeeder::class,
            RoleHasPermissionsSeeder::class,
            NivelCursoSeeder::class,
            CursoSeeder::class,
            UserSeeder::class,
            ModelHasRoleSeeder::class,
            TipoCertificadoSeeder::class,
            StatusCertificadoSeeder::class,
            CertificadoSeeder::class,
        ));
    }
}

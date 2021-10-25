<?php

use Illuminate\Database\Seeder;

class ModelHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->insert([
            'role_id' => '1',
            'model_type'  => 'App\Models\Entities\User',
            'model_id'=> '1',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => '1',
            'model_type'  => 'App\Models\Entities\User',
            'model_id'=> '2',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => '2',
            'model_type'  => 'App\Models\Entities\User',
            'model_id'=> '3',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => '2',
            'model_type'  => 'App\Models\Entities\User',
            'model_id'=> '4',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => '2',
            'model_type'  => 'App\Models\Entities\User',
            'model_id'=> '5',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => '2',
            'model_type'  => 'App\Models\Entities\User',
            'model_id'=> '6',
        ]);
    }
}

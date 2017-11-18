<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 21,
                'user_name' => 'tiny',
                'nick_name' => 'tiny',
                'email' => 'taoyu@qq.com',
                'password' => bcrypt('tiny123'),
                'locked_at' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
        /*$tableNames = config('permission.table_names');

        DB::table($tableNames['model_has_roles'])->insert([
            [
                'role_id' => 1,
                'model_id' => 1,
                'model_type' => \App\Models\User::class
            ], [
                'role_id' => 2,
                'model_id' => 2,
                'model_type' => \App\Models\User::class
            ]
        ]);*/
    }
}

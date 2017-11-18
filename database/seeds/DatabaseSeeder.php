<?php

use Illuminate\Database\Seeder;
use App\Models\PostContent;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* factory(\App\Models\Category::class, 5)->create()->each(function ($category) {
            factory(\App\Models\Category::class, random_int(0, 3))->create(['parent_id' => $category->id]);
        });

        factory(App\Models\User::class, 10)->create()->each(function ($user) {
            factory(App\Models\Post::class, random_int(0, 10))->create(['user_id' => $user->id])->each(function ($post) {
                $post->postContent()->save(factory(PostContent::class)->make());
            });
        });

        DB::table('users')->where('id', 1)->update(['user_name' => 'tiny', 'email' => 'tiny@test.com', 'locked_at' => null]);

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TypesTableSeeder::class);*/
        $this->call(UsersTableSeeder::class);
    }
}

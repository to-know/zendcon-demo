<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $users = factory(User::class)->times(10)->create();

        $users->each(function ($user) {
            foreach (factory(Post::class)->times(3)->make() as $post) {
                $user->posts()->save($post);
            }
        });

        Model::reguard();
    }
}

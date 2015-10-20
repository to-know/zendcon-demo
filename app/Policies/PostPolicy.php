<?php

namespace App\Policies;

use App\User;
use App\Post;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can view the given post.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return bool
     */
    public function view(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * View a given post for the user.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return Response
     */
    public function show(User $user, Post $post)
    {
        if ($user->cant('view', $post)) {
            abort(403);
        }

        return $post->title;
    }
}

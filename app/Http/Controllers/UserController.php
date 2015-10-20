<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
	protected $users;

	/**
	 * Create a new controller instance.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(UserRepository $users)
	{
		$this->users = $users;
	}

	/**
	 * Get all of the users.
	 *
	 * @return Response
	 */
    public function all()
    {
    	return $this->users->all();
    }

    /**
     * Get a specific user of the application.
     *
     * @return Response
     */
    public function show(User $user)
    {
    	return $user;
    }
}

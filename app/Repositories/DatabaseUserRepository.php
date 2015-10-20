<?php

namespace App\Repositories;

use App\User;

class DatabaseUserRepository implements UserRepository
{
	/**
	 * Get all of the users of the application.
	 */
	public function all()
	{
		return User::all();
	}
}

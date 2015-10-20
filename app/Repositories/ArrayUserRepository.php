<?php

namespace App\Repositories;

class ArrayUserRepository implements UserRepository
{
	/**
	 * Get all of the users of the application.
	 */
	public function all()
	{
		return [1, 2, 3];
	}
}

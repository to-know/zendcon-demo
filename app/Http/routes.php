<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/hello/{name}', function ($name) {
    return 'Hello, '.ucfirst($name);
});


Route::get('/hello/{name}/request', function (Request $request, $name) {
    dd($request);

    return 'Hello, '.ucfirst($name);
});

/**
 * Enough Fluff... Time For Real Programming™
 *
 * Automatic Dependency Injection... Even In Routes!
 */

use App\User;
use App\Repositories\UserRepository;

Route::get('/users', function (UserRepository $users) {
    return $users->all();
});

/**
 * Automatic Model Resolution...
 */

Route::get('/users/{user}', function (User $user) {
    return $user;
});

/**
 * Can Even Be Combined With Other Dependencies!
 */

Route::get('/users/{user}/inject', function (UserRepository $users, User $user) {
	dd($users);

	return $user;
});

/**
 * Controllers...
 */

Route::get('/controller/users', 'UserController@all');
Route::get('/controller/users/{user}', 'UserController@show');

/**
 * Middleware! It's the new Hottness™
 */

Route::get('/vegas', ['middleware' => 'gamble', function () {
    return 'You lost your life savings!';
}]);

/**
 * A Real™ Example: Authentication
 */

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('/home', ['middleware' => 'auth', function () {
    return 'I am logged in!';
}]);

/**
 * Authorization!
 */

Route::get('/users/{user}/posts/{post}', 'PostController@show');

/**
 * Sessions
 */

Route::get('/session/put', function (Request $request) {
    $request->session()->put('name', 'Taylor');

    // session(['name' => 'Taylor']);

    return 'Value Set!';
});


Route::get('/session/get', function (Request $request) {
    return $request->session()->get('name');

    // return session('name');
});

/**
 * Doing Something Useful With Session... Also Validation... Also Blade...
 */

Route::get('/form', 'ValidationController@showForm');
// Route::post('/form', 'ValidationController@processFormAnotherWay');
// Route::post('/form', 'ValidationController@processFormWithFormRequest');

/**
 * Speaking Of Blade... Layouts™!
 */

Route::get('/blade', function () {
    return view('blade.child');
});

/**
 * Cache All The Things!
 */

Route::get('/cache/put', function () {
    Cache::put('users', User::all(), 1);

    return 'Value Stored!';
});

/**
 * Injecting Cache For Maximum Enterprise™ and Testability™?
 *
 * List Of Laravel Contracts: http://laravel.com/docs/5.1/contracts
 */

use Illuminate\Contracts\Cache\Repository;

Route::get('/cache/inject', function (Repository $cache) {
    $cache->put('users', User::all(), 1);

    return 'Value Stored!';
});


Route::get('/cache/get', function () {
    $users = Cache::get('users', function () {
        dump('Cache Not Found - Hitting Database');

        return User::all();
    });

    foreach ($users as $user) {
        dump($user->name);
    }

    return 'All Done!';
});


Route::get('/cache/remember', function () {
    $users = Cache::remember('users', 1, function () {
        dump('Cache Not Found - Hitting Database');

        return User::all();
    });

    foreach ($users as $user) {
        dump($user->name);
    }

    return 'All Done!';
});

/**
 * Database Stuff!
 */

// Migrations...

/**
 * Raw SQL!
 */

Route::get('/sql', function () {
    return DB::select('select * from users where id > ?', [5]);
});


/**
 * Query Builder!
 */
Route::get('/query', function () {
    return DB::table('users')->where('id', '>', 5)->get();
});


/**
 * Eloquent ORM...
 */

Route::get('/eloquent/get', function () {
    // Eloquent Collections / Models Rendered As JSON™ Automatically!

    return User::where('id', '>', 5)->get();
});


Route::get('/eloquent/first', function () {
    return User::where('id', '>', 5)->first();
});


Route::get('/eloquent/fail/{id}', function ($id) {
    return User::where('id', $id)->firstOrFail();
});


Route::get('/eloquent/create', function () {
    $user = new User;

    $user->name = 'Taylor Otwell';
    $user->email = 'taylor@laravel.com';
    $user->password = bcrypt('secret');

    $user->save();

    return $user;
});


Route::get('/eloquent/mass', function () {
    return User::create([
        'name' => 'Taylor Otwell',
        'email' => 'taylor@laravel.com',
        'password' => bcrypt('secret'),
    ]);
});


Route::get('/eloquent/update/{user}', function (User $user) {
    $user->name = 'Abigail Otwell';

    $user->save();

    return $user;
});


Route::get('/eloquent/relations', function () {
    // Show Relationship Definition...

    // DB::listen(function ($sql) {
    // 	dump($sql);
    // });

    $users = User::get();

    foreach ($users as $user) {
        foreach ($user->posts as $post) {
            dump($post->title);
        }
    }
});


Route::get('/eloquent/relations/eager', function () {
    DB::listen(function ($sql) {
        dump($sql);
    });

    $users = User::with('posts')->get();

    foreach ($users as $user) {
        foreach ($user->posts as $post) {
            // dump($post->title);
        }
    }
});

/**
 * Collections Are Pretty Neat
  *
  * Methods: http://laravel.com/docs/5.1/collections
 */

Route::get('/eloquent/relations/collections', function () {
    return User::with('posts')->get()
                ->filter(function ($user) {
                    return $user->id > 5;
                })
                ->reject(function ($user) {
                    return $user->name === 'Taylor Otwell';
                })
                ->sortBy(function ($user) {
                    return $user->name;
                })->values();
});


Route::get('/eloquent/delete/{user}', function (User $user) {
    $user->delete();

    return 'Deleted!';
});

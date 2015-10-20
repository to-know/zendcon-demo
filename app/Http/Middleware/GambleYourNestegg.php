<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\TopicalAnimatedGifRetriever;

class GambleYourNestegg
{
    /**
     * Create a new middleware.
     *
     * @param  TopicalAnimatedGifRetriever  $gifs
     * @return void
     */
    public function __construct(TopicalAnimatedGifRetriever $gifs)
    {
        // Full dependency injection™ here too!

        $this->gifs = $gifs;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Laravel Elephant™ if you know what "mt" stands for...

        if (mt_rand(1, 5) === 3) {
            return $this->gifs->imageTagFor('rich');
        } else {
            return $next($request);
        }
    }
}

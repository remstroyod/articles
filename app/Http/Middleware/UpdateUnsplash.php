<?php

namespace App\Http\Middleware;

use App\Traits\UnsplashTrait;
use Closure;
use Illuminate\Http\Request;

class UpdateUnsplash
{

    use UnsplashTrait;

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if( $request->has('refresh') && $request->get('refresh') === 'image' )
        {

            $image = $this->getUnsplashImage();

            $request->merge(['unsplashImage' => $image]);

        }

        return $next($request);
    }
}

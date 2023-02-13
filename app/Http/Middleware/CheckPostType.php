<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckPostType
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $config = config('posttypes');
        $name = $request->route()->parameter('name');
        $postType = collect($config)->firstWhere('path', $name);
        if (!$postType)
            abort(Response::HTTP_NOT_FOUND);
        $request->merge(['postType' => $postType]);


        return $next($request);
    }
}

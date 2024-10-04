<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $slug=$request->route('vendor_slug');
        if (!Auth::guard('customer')->check()) {
            Session::put('url.intended', $request->url());
            return redirect()->route('customer.login' ,$slug )
            ->with(['info'=> 'Please log in to complete your order.' ]);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$allowedStatus): Response
    {
        $status = session()->get('status');
        if (in_array($status, $allowedStatus)) {
            return $next($request);
        }
        
    
        abort(403, 'Unauthorized action.');
    }
}

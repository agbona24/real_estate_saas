<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Ensures that users can only access data belonging to their tenant (agency).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Super admin has access to all tenants
        if ($user->role === 'super_admin') {
            return $next($request);
        }

        // Ensure user has a tenant_id
        if (!$user->tenant_id) {
            abort(403, 'No agency associated with this account.');
        }

        // Store tenant_id in session for global access
        session(['tenant_id' => $user->tenant_id]);

        return $next($request);
    }
}

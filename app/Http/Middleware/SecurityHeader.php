<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeader
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Anti Clickjacking (legacy support)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Anti MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Legacy XSS protection (older browsers)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Prevent Adobe cross-domain policies
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        // Disable dangerous browser features
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=()'
        );

        $response->headers->set('Content-Security-Policy',"default-src 'self';script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdn.tailwindcss.com https://cdn.tiny.cloud;style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://cdn.tiny.cloud;img-src 'self' data: https:;font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com data:;media-src 'self';frame-src https://www.youtube.com https://www.youtube-nocookie.com;connect-src 'self' https://cdn.jsdelivr.net https://cdn.tiny.cloud;object-src 'none';frame-ancestors 'self';base-uri 'self';");


        return $response;
    }
}

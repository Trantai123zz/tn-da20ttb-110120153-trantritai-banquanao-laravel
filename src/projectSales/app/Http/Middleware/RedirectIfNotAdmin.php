<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu người dùng không đăng nhập hoặc không phải là admin
        if (!Auth::guard('admin')->check()) {
            // Redirect về trang đăng nhập admin
            return redirect()->route('admin.login');
        }

        // Cho phép request tiếp tục nếu là admin
        return $next($request);
    }
}

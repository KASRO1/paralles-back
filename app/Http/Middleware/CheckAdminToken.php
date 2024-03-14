<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminToken
{
    public function handle(Request $request, Closure $next)
    {
        // Замените 'your_admin_token_here' на реальный токен
        $adminToken = 'your_admin_token_here';

        // Проверка наличия токена в параметре запроса 'token'
        if ($request->query('token') !== $adminToken) {
            // Если токен неверный, вы можете перенаправить пользователя на другую страницу
            // или возвращать ошибку 403 Forbidden
            return abort(403, 'Access denied');
        }

        return $next($request);
    }
}

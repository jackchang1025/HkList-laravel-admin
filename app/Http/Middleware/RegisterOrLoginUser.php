<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterOrLoginUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $username = $request->input('user');

        if (!$username) {
            return $next($request);
        }

        // 查找用户
        $user = User::where('username', $username)->first();

        if (!$user) {
            // 如果用户不存在，注册新用户
            $user = User::create([
                'username' => $username,
                'password' => bcrypt($username), // 默认密码与用户名一致
                'role' => 'user', // 默认角色
                'inv_code_id' => config('94list.default_inv_code',1),
            ]);
        }

        // 登录用户
        Auth::guard('api')->setUser($user);
        return $next($request);
    }
}
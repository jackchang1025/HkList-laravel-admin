<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Token;
use App\Models\Record;
use App\Models\FileList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLimit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 确保响应是 JsonResponse 类型
        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $data = $response->getData(true);

            // 检查是否使用token
            if (config('94list.token_mode') && !empty($request->input('token'))) {
                $token = Token::query()->firstWhere('name', $request->input('token'));
                if ($token) {
                    
                    $quotaInfo = $token->getQuotaInfo();

                    $quotaMessage = sprintf(
                        "剩余次数: %d 剩余空间: %s </br> 已用次数: %d 已用空间: %s </br> 过期时间: %s",
                        $quotaInfo['remaining_count'],
                        $quotaInfo['remaining_size'],
                        $quotaInfo['used_count'],
                        $quotaInfo['used_size'],
                        $quotaInfo['expired_at']
                    );
    
                    // 将配额信息和消息添加到响应中
                    $data['quota_info'] = $quotaInfo;
                    $data['quota_message'] = $quotaMessage;
                    $response->setData($data);
    
                    return $response;
                }

            }

            /**
             * @var \App\Models\User $user
             */
            $user = Auth::guard('api')->user();
            if ($user) {
                $quotaInfo = $user->getQuotaInfo();
            } else {
                $quotaInfo = User::getDefaultQuotaInfo();
            }

            $quotaMessage = sprintf(
                "剩余次数: %d 剩余空间: %s </br> 已用次数: %d 已用空间: %s",
                $quotaInfo['remaining_count'],
                $quotaInfo['remaining_size'],
                $quotaInfo['used_count'],
                $quotaInfo['used_size']
            );

            // 将配额信息和消息添加到响应中
            $data['quota_info'] = $quotaInfo;
            $data['quota_message'] = $quotaMessage;
            $response->setData($data);
            return $response;
        }

        return $response;
    }

 
}

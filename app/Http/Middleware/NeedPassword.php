<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ResponseController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Token;
use App\Http\Controllers\UtilsController;

class NeedPassword
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 如果token验证已通过，直接放行
        if (!empty($request->input('token')) && config('94list.token_mode')) {


             // 验证token是否有效
            $token = Token::query()->firstWhere('name', $request->input('token'));
            if ($token) {
                // 验证IP限制
                if ($token['ip'] !== null && $token['ip'] !== UtilsController::getIp()) {
                    return ResponseController::error(
                        code: 403,
                        title: 'IP限制',
                        message: '该卡密已绑定其他ip，请更换卡密' .
                        '<br><span style="color:red;font-weight: 700;">温馨提示:</span>' .
                        '<span>由于烧号快仅提供测试' .
                        '<span style="color:FF436A;font-weight: 700;position: relative;top: -2px;">【2次】</span>' .
                        '<br><span>如需真正下载还多多支持合租</span></span>' .
                        '<br><a href="https://ass.coxpan.com" target="_blank" style="font-weight: 900;">' .
                        '作者推荐:超低价百度网盘svip出租，稳定好用！</a>' .
                        '<br><a href="https://t.me/+B1PiSmBGPIw0MTYx" target="_blank" style="font-weight: 900;">' .
                        '点击加入防失联交流群组</a></span>'
                    );
                }

                // 验证过期时间
                if ($token['expired_at'] !== null && $token['expired_at'] < now()) {

                    return ResponseController::error(
                        code: 403,
                        title: '卡密已过期',
                        message: '卡密已过期，请更换卡密' .
                        '<br><span style="color:red;font-weight: 700;">温馨提示:</span>' .
                        '<span>由于烧号快仅提供测试' .
                        '<span style="color:FF436A;font-weight: 700;position: relative;top: -2px;">【2次】</span>' .
                        '<br><span>如需真正下载还多多支持合租</span></span>' .
                        '<br><a href="https://ass.coxpan.com" target="_blank" style="font-weight: 900;">' .
                        '作者推荐:超低价百度网盘svip出租，稳定好用！</a>' .
                        '<br><a href="https://t.me/+B1PiSmBGPIw0MTYx" target="_blank" style="font-weight: 900;">' .
                        '点击加入防失联交流群组</a></span>'
                    );
                    
                }

                $quotaInfo = $token->getQuotaInfo();
                //判断配额是否已用完
                if ($quotaInfo['remaining_count'] <= 0 || $quotaInfo['remaining_size'] <= 0) {

                    return ResponseController::error(
                        code: 403,  
                        title: '卡密配额已用完',
                        message: '卡密配额已用完，请更换卡密' .
                        '<br><span style="color:red;font-weight: 700;">温馨提示:</span>' .
                        '<span>由于烧号快仅提供测试' .
                        '<span style="color:FF436A;font-weight: 700;position: relative;top: -2px;">【2次】</span>' .
                        '<br><span>如需真正下载还多多支持合租</span></span>' .
                        '<br><a href="https://ass.coxpan.com" target="_blank" style="font-weight: 900;">' .
                        '作者推荐:超低价百度网盘svip出租，稳定好用！</a>' .
                        '<br><a href="https://t.me/+B1PiSmBGPIw0MTYx" target="_blank" style="font-weight: 900;">' .
                        '点击加入防失联交流群组</a></span>'
                    );
                }

                // token验证通过，直接放行
                return $next($request);
            }

            
        }

        //设置 Request token 为 空
        $request->merge(['token' => '']);
        // 验证密码
        $passwordConfig = config('94list.password');
        $randPassword = env('_94LIST_RANDOM_PASSWORD');
        $password = $request->input('password');

        // 两个密码都为空时直接通过
        if (empty($passwordConfig) && empty($randPassword)) {
            return $next($request);
        }

        // 密码为空时拒绝
        if (empty($password)) {
            return $this->passwordErrorResponse();
        }

        // 任一密码匹配即通过
        if ($password === $passwordConfig || $password === $randPassword) {
            return $next($request);
        }

        // 其他情况都视为��码错误
        return $this->passwordErrorResponse();
    }

    /**
     * 返回密码错误响应
     *
     * @return Response
     */
    private function passwordErrorResponse(): Response
    {
        return ResponseController::error(
            code: 403,   
            title: '解析密码错误',
            message: '暗号错误(或已更新)，请重新获取 ' .
            '<br><span style="color:red;font-weight: 700;">温馨提示:</span>' .
            '<span>由于烧号快仅提供测试' .
            '<span style="color:FF436A;font-weight: 700;position: relative;top: -2px;">【2次】</span>' .
            '<br><span>如需真正下载还多多支持合租</span></span>' .
            '<br><a href="https://ass.coxpan.com" target="_blank" style="font-weight: 900;">' .
            '作者推荐:超低价百度网盘svip出租，稳定好用！</a>' .
            '<br><a href="https://t.me/+B1PiSmBGPIw0MTYx" target="_blank" style="font-weight: 900;">' .
            '点击加入防失联交流群组</a></span>'
        );
    }
}
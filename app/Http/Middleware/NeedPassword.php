<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ResponseController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Token;
use App\Http\Controllers\UtilsController;
use App\Services\QuotaService;
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

                $quotaService = QuotaService::make($token);

                // 验证IP限制
                if (!$quotaService->checkIp(UtilsController::getIp())) {

                    return ResponseController::error(
                        code: 403,
                        title: 'IP限制',
                        message: '<span style="color:red;font-weight: 900;">该卡密已绑定其他ip，请更换卡密</span>' .
                        '<br><a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">' .
                        '如需不限次数or流量解析在下方链接前往下单</a>' .
                        '<br><a href="https://ass.coxpan.com" target="_blank" style="font-weight: 900;">' .
                        '作者推荐:超低价百度网盘共享svip出租，稳定好用！</a>' .
                        '<br><a href="https://q3q454wst2.feishu.cn/docx/E4qCdOhnpo68pdxqxx5cjGwLnub?from=from_copylink" target="_blank" style="font-weight: 900;">' .
                        '点击加入防失联交流群组</a></span>'
                    );

                }

                // 验证过期时间
                if ($quotaService->isExpired()) {

                    return ResponseController::error(
                        code: 403,
                        title: '卡密已过期',
                        message: '<span style="color:red;font-weight: 900;">你的卡密已过期，请更换卡密</span>' .
                        '<br><a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">' .
                        '如需不限次数or流量解析在下方链接前往下单</a>' .
                        '<br><a href="https://ass.coxpan.com" target="_blank" style="font-weight: 900;">' .
                        '作者推荐:超低价百度网盘共享svip出租，稳定好用！</a>' .
                        '<br><a href="https://q3q454wst2.feishu.cn/docx/E4qCdOhnpo68pdxqxx5cjGwLnub?from=from_copylink" target="_blank" style="font-weight: 900;">' .
                        '点击加入防失联交流群组</a></span>'
                    );
                    
                }

                
                //判断配额是否已用完
                if ($quotaService->isUsedUp() || $quotaService->isFileSizeUsedUp()) {

                    return ResponseController::error(
                        code: 403,
                        title: '卡密配额已用完',
                        message: '<span style="color:red;font-weight: 900;">卡密次数/文件配额已用完，请更换卡密</span>' .
                        '<br><a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">' .
                        '如需不限次数or流量解析在下方链接前往下单</a>' .
                        '<br><a href="https://ass.coxpan.com" target="_blank" style="font-weight: 900;">' .
                        '作者推荐:超低价百度网盘共享svip出租，稳定好用！</a>' .
                        '<br><a href="https://q3q454wst2.feishu.cn/docx/E4qCdOhnpo68pdxqxx5cjGwLnub?from=from_copylink" target="_blank" style="font-weight: 900;">' .
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
            message: '<a href="/" target="_blank" style="font-weight: 900;font-size: 29px;">卡密/暗号错误(或已更新)，请重新获取</a>' .
            '<br><span style="color:red;font-weight: 700;">温馨提示:</span>' .
            '<a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">' .
            '如需不限次数or流量解析在下方链接前往下单</a>' .
            '<br><a href="https://ass.coxpan.com" target="_blank" style="font-weight: 900;">' .
            '作者推荐:超低价百度网盘svip出租，稳定好用！</a>' .
            '<br><a href="http://qm.qq.com/cgi-bin/qm/qr?_wv=1027&k=B-K3Z-CreEtxD4PW3gn2cPa-XuU1iSPg&authKey=i%2Fq7Bamff%2BaV1PaCowD3RvZOhQELQCnd4URySWWZuO0c4Z1rN%2Ba3uHReFih3uTgT&noverify=0&group_code=63120253" target="_blank" style="font-weight: 900;">' .
            '点击加入防失联交流群组</a></span>'
        );
    }
}
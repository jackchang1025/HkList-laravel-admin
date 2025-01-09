<?php

namespace App\Http\Controllers;

class ResponseController extends Controller
{
    public static function response($code, $statusCode, $message, $data = null, $headers = [])
    {
        return response()->json(
            [
                "code"    => $code,
                "message" => $message,
                "data"    => $data
            ],
            $statusCode,
            $headers,
            JSON_UNESCAPED_UNICODE
        );
    }

    public static function success($data = null)
    {
        return self::response(200, 200, "请求成功", $data);
    }

    public static function error(int $code = 400,?string $title = null,?string $message = null,int $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                "code"    => $code,
                "message" => $message,
                "title"    => $title
            ],
            $statusCode
        );
    }

    public static function dbFileExists()
    {
        return self::response(10001, 500, "94list-laravel已安装!");
    }

    public static function paramsError()
    {
        return self::response(10002, 400, "非法参数");
    }

    public static function userExists()
    {
        return self::response(10003, 409, "用户名称已存在");
    }

    public static function userNotExists()
    {
        return self::response(10004, 400, "用户不存在");
    }

    public static function userPasswordError()
    {
        return self::response(10005, 401, "用户名或密码错误");
    }

    public static function userNotLogin()
    {
        return self::response(10006, 401, "用户未登陆");
    }

    public static function permissionsDenied()
    {
        return self::response(10007, 403, "用户权限不足");
    }

    public static function groupNotExists()
    {
        return self::response(10008, 400, "用户组不存在");
    }

    public static function groupExists()
    {
        return self::response(10009, 409, "用户组名称已存在");
    }

    public static function recordNotExists()
    {
        return self::response(10010, 400, "记录不存在");
    }

    public static function accountNotExists()
    {
        return self::response(10011, 400, "账户不存在");
    }

    public static function networkError($query)
    {
        return self::response(10013, 500, "在进行{$query}时出现网络错误,检查服务器网络状态");
    }

    public static function getAccountInfoFailed()
    {
        return self::response(10015, 500, "获取账户信息失败");
    }

    public static function getSvipEndTimeFailed()
    {
        return self::response(10015, 500, "获取SVIP到期时间失败");
    }

    public static function sendMailFailed($reason)
    {
        return self::response(10016, 500, "发送邮件失败" . ($reason ? ",原因:" . $reason : ""));
    }

    public static function parsePasswordError()
    {
        return self::response(10017, 403, "解析密码错误");
    }

    public static function fileNotExists()
    {
        return self::response(10018, 400, "百度服务器返回: 文件不存在");
    }

    public static function pwdWrong()
    {
        return self::response(10019, 403, "百度服务器返回: 提取码错误");
    }

    public static function pathNotExists()
    {
        return self::response(10020, 400, "百度服务器返回: 不存在此目录");
    }

    public static function linkWrongOrPathNotExists()
    {
        return self::response(10021, 400, "百度服务器返回: 不存在此分享链接或提取码错误");
    }

    public static function linkNotValid()
    {
        return self::response(10022, 403, "百度服务器返回: 此链接分享内容可能因为涉及侵权、色情、反动、低俗等信息，无法访问！");
    }

    public static function linkIsOutDate()
    {
        return self::response(10023, 410, "百度服务器返回: 啊哦，来晚了，该分享文件已过期");
    }

    public static function cookieError($errno)
    {
        return self::response(10024, 500, "fakeCookie失效,code:$errno");
    }

    public static function getFileListError($errno)
    {
        return self::response(10025, 500, "获取文件列表遇到未知错误,code:$errno");
    }

    public static function getSignError($errno, $message)
    {
        return self::response(10026, 500, "获取文件签名遇到未知错误,code:$errno,提示信息:$message");
    }

    public static function linksOverloaded()
    {
        return self::response(10027, 403, "超出单次解析最大数量");
    }

    public static function normalAccountIsNotEnough()
    {
        return self::response(10028, 403, "普通用户账户不足");
    }

    public static function svipAccountIsNotEnough($bool = false, $name = ["超级会员"])
    {
        if ($bool) return self::response(10029, 403, "[" . join(",", $name) . "]账户不足");
        return "超级会员账户不足";
    }

    public static function accountHasBeenLimitOfTheSpeedOrCookieExpired($bool = false)
    {
        if ($bool) return self::response(10030, 403, "账户被限速或cookie已过期,请重新解析尝试!");
        return "账户被限速或cookie已过期,请重新解析尝试!";
    }

    public static function getDlinkError($code)
    {
        return self::response(10031, 500, "在获取dlink时请求失败,code:$code");
    }

    public static function getRealLinkError($extend)
    {
        // 10032
        return "在获取reallink时请求失败!$extend";
    }

    public static function hitCaptcha($data = [])
    {
        return self::response(10033, 500, "百度服务器返回: 触发验证码,请重试!", $data);
    }

    public static function downloadError()
    {
        return self::response(10034, 500, "百度服务器返回: 下载失败");
    }

    public static function ipHasBeenBaned()
    {
        return self::response(10035, 500, "百度服务器返回: 服务器ip被拉黑");
    }

    public static function signIsOutDate()
    {
        return self::response(10036, 500, "百度服务器返回: 签名过期");
    }

    public static function processFilesTooMuch()
    {
        return self::response(10037, 500, "百度服务器返回: 操作的文件过多");
    }

    public static function invCodeNotExists()
    {
        return self::response(10038, 400, "邀请码不存在");
    }

    public static function invCodeExists()
    {
        return self::response(10039, 409, "邀请码名称已存在");
    }

    public static function notInWhiteList()
    {
        return self::response(10040, 403, "您不在白名单中!");
    }

    public static function inBlackList()
    {
        return self::response(10041, 403, "您在黑名单中!");
    }

    public static function IpNotExists()
    {
        return self::response(10042, 400, "ip不存在");
    }

    public static function IpExists()
    {
        return self::response(10043, 409, "ip名称已存在");
    }

    public static function groupQuotaHasBeenUsedUp()
    {
        return self::response(10044, 403, '<a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">你当前可用次数或下载文件大小已用完<br>如需不限量下载请前往https://hezu.gongxianghao.vip</a>');
    }
    

    public static function accountExpired($isDlink = false)
    {
        return self::response(10045, 403, ($isDlink ? "获取dlink时,遇到" : "") . "账户cookie已失效");
    }

    public static function groupCanNotBeRemoved($reason)
    {
        return self::response(10046, 403, "用户组不能被删除,原因:$reason");
    }

    public static function groupQuotaCountIsNotEnough()
    {
        return self::response(10047, 403, '<a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">你当前可用次数已不足<br>如需不限量下载请前往https://hezu.gongxianghao.vip</a>');
    }

    public static function groupQuotaSizeIsNotEnough()
    {
        return self::response(10047, 403, '<a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">你当前可用下载文件大小已不足<br>如需不限量下载请前往https://hezu.gongxianghao.vip</a>');
    }

    public static function paramsErrorFromRequest($code)
    {
        return self::response(10048, 403, "百度服务器返回: 参数错误,code:$code");
    }

    public static function unknownFsId()
    {
        return self::response(10049, 400, "未记录的fs_id");
    }

    public static function errorFromMainServer($reason)
    {
        return self::response(10050, 500, "解析服务器提示: $reason");
    }

    public static function getVcodeError()
    {
        return self::response(10051, 500, "获取验证码失败");
    }

    public static function unknownParseMode()
    {
        return self::response(10052, 500, "未知解析模式");
    }

    public static function nullFile()
    {
        return self::response(10053, 400, "请求的文件数量为空");
    }

    public static function TokenNotExists()
    {
        return self::response(10054, 400, "卡密不存在");
    }

    public static function TokenExists()
    {
        return self::response(10055, 400, "卡密已存在");
    }

    public static function TokenExpired()
    {
        return self::response(10056, 400, '<a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">你当前的卡密已过期<br>如需不限量下载请前往https://hezu.gongxianghao.vip</a>');
    }

    public static function TokenQuotaHasBeenUsedUp()
    {
        return self::response(10057, 400, '<a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">你的卡密可用次数或下载文件大小已用完<br>如需不限量下载请前往https://hezu.gongxianghao.vip</a>');
    }

    public static function unsupportNotCNCountry()
    {
        return self::response(10058, 400, "不支持非中国用户使用");
    }

    public static function dbConnectFailed($message)
    {
        return self::response(10059, 400, "数据库配置错误:$message");
    }

    public static function invCodeCanNotBeRemoved($reason)
    {
        return self::response(10060, 403, "邀请码不能被删除,原因:$reason");
    }

    public static function invCodeQuotaHasBeenUsedUp()
    {
        return self::response(10061, 403, "邀请码配额已用完");
    }

    public static function userCanNotBeRemoved($reason)
    {
        return self::response(10060, 403, "用户不能被删除,原因:$reason");
    }

    public static function userCanNotBeUpdated($reason)
    {
        return self::response(10060, 403, "用户不能被更新,原因:$reason");
    }

    public static function isProcessing()
    {
        return self::response(10061, 403, "正在解析中，請勿重複請求，如果多次提示請嘗試登陸或使用卡密");
    }

    public static function unknownError($message)
    {
        return self::response(10062, 500, "未知错误,错误信息:$message");
    }

    public static function onlyOneFile()
    {
        return self::response(10063, 500, "测试账号请只解析一个文件");
    }

    public static function TokenIpIsNotMatch()
    {
        return self::response(10064, 500, "该卡密已绑定其他ip");
    }

    public static function getAccessTokenFailed($reason = null)
    {
        return self::response(10065, 500, "换取AccessToken失败" . ($reason ? ",原因:{$reason}" : ''));
    }

    public static function accountTypeWrong($id)
    {
        return self::response(10066, 500, "账号ID:{$id}的类型错误");
    }

    public static function accountCanNotBeDeleted()
    {
        return self::response(10067, 500, "自带账户禁止删除");
    }

    public static function accountIsNotEnterprise()
    {
        return self::response(10068, 500, "获取账户信息失败或账户非企业用户");
    }
}

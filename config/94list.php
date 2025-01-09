<?php

return [
    "fake_user_agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36",
    "fake_wx_user_agent" => "Mozilla/5.0 (Linux; Android 7.1.1; MI 6 Build/NMF26X; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/6.2 TBS/043807 Mobile Safari/537.36 MicroMessenger/6.6.1.1220(0x26060135) NetType/4G Language/zh_CN MicroMessenger/6.6.1.1220(0x26060135) NetType/4G Language/zh_CN miniProgram",
    "fake_cookie" => "BAIDUID=A4FDFAE43DDBF7E6956B02F6EF715373:FG=1; BAIDUID_BFESS=A4FDFAE43DDBF7E6956B02F6EF715373:FG=1; newlogin=1",

    "version" => "1.3.45",
    "sleep" => (int)env("_94LIST_SLEEP", 3),
    "max_once" => (int)env("_94LIST_MAX_ONCE", 20),
    "password" => env("_94LIST_PASSWORD", ""),
    "announce" => env("_94LIST_ANNOUNCE", "公告"),
    "user_agent" => env("_94LIST_USER_AGENT", "netdisk;7.42.0.5;PC"),
    "need_inv_code" => (bool)env("_94LIST_NEED_INV_CODE", true),
    "whitelist_mode" => (bool)env("_94LIST_WHITELIST_MODE", false),

    "show_copyright" => (bool)env("_94LIST_SHOW_COPYRIGHT", true),
    "custom_copyright" => env("_94LIST_CUSTOM_COPYRIGHT", "本项目半开源, 项目地址: https://github.com/huankong233/94list-laravel"),

    "main_server" => env("_94LIST_MAIN_SERVER", "空"),
    "code" => env("_94LIST_CODE", "空"),

    "parse_mode" => (int)env("_94LIST_PARSE_MODE", 3),
    "max_filesize" => (int)env("_94LIST_MAX_FILESIZE", 536870912000),
    "min_single_filesize" => (int)env("_94LIST_MIN_SINGLE_FILESIZE", 0),
    "max_single_filesize" => (int)env("_94LIST_MAX_SINGLE_FILESIZE", 53687091200),
    "token_mode" => (bool)env("_94LIST_TOKEN_MODE", true),
    "button_link" => env("_94LIST_BUTTON_LINK", ""),
    "limit_cn" => (bool)env("_94LIST_LIMIT_CN", true),
    "limit_prov" => (bool)env("_94LIST_LIMIT_PROV", false),

    "show_login_button" => (bool)env("_94LIST_SHOW_LOGIN_BUTTON", true),
    "token_bind_ip" => (bool)env("_94LIST_TOKEN_BIND_IP", false),

    "proxy_server" => env("HKLIST_PROXY_SERVER", ""),
    "default_inv_code" => env("DEFAULT_INV_CODE", 1),
    "proxy_password" => env("HKLIST_PROXY_PASSWORD", "download"),

    "download_ticket" => [
        "cookie" => env("HKLIST_DOWNLOAD_TICKET_COOKIE"),
        "cid" => env("HKLIST_DOWNLOAD_TICKET_CID"),
        "bdstoken" => env("HKLIST_DOWNLOAD_TICKET_BDSTOKEN"),
        "surl" => env("HKLIST_DOWNLOAD_TICKET_SURL"),
        "pwd" => env("HKLIST_DOWNLOAD_TICKET_PWD"),
        "path" => env("HKLIST_DOWNLOAD_TICKET_PATH")
    ],
    'message_list'=>[
        'delete_password' => '<div>暗号错误(或已更新)，请重新获取 
        <br><span style="color:red;font-weight: 700;">温馨提示:</span>
        <span>由于烧号快仅提供测试<span style="color:FF436A;font-weight: 700;position: relative;top: -2px;">【5次-30G文件】</span>
        <br><a href="https://hezu.gongxianghao.vip" target="_blank" style="font-weight: 900;">如需不限次数or流量解析前往下单</a>
        <br><a href="https://ass.coxpan.com" target="_blank" style="font-weight: 900;">作者推荐:超低价百度网盘svip出租，稳定好用！</a>
        <br><a href="http://qm.qq.com/cgi-bin/qm/qr?_wv=1027&amp;k=B-K3Z-CreEtxD4PW3gn2cPa-XuU1iSPg&amp;authKey=i%2Fq7Bamff%2BaV1PaCowD3RvZOhQELQCnd4URySWWZuO0c4Z1rN%2Ba3uHReFih3uTgT&amp;noverify=0&amp;group_code=63120253" target="_blank" style="font-weight: 900;">点击加入防失联交流群组</a></span></div>',
    ]
];

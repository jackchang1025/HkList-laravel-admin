<?php
session_start();
ini_set("session.bug_compat_42","Off");
traceHttp();

define("TOKEN", "cxxx123");


$wechatObj = new wechatCallbackapiTest();

if (isset($_GET['echostr'])) {
    $wechatObj->valid();
} else {
    $wechatObj->responseMsg();
}


class wechatCallbackapiTest{
    public function valid(){
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }


    private function checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];


        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );


        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    # 关键词自动回复
    public function responseMsg(){
        $postStr = @file_get_contents("php://input");
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            $msgType = "text";
 
 
            //判断是否为关注
            if($postObj->Event=="subscribe"){
                $contentStr="嗨！你终于来啦！ 恭喜你发现新世界大门 请前往文章了解了解哦~";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            
            //判断是否为用户发送消息
            if(!empty( $keyword )){
                
                $timeurl=$_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/getpasstime.php?get=xctime';
                $xctime = @file_get_contents($timeurl);

                $txt = '';
                switch($keyword){
                    // case '免费白嫖':
                    //     require_once("password.php");
                    //     require_once("getpass.php");
                    //     $contentStr = array();
                    //     $txt =  '取完验证码之后,' . "\n";
                    //     $txt .=  '记得给公众号文章点个赞.' . "\n\n";
                    //     $txt .=  "【暗号】 ". $password . "\n\n";
                    //     $txt .=  "  精选推荐：". "\n\n";
                    //     $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【超低价合租SVIP稳定好用】</a>' . "\n\n";
                    //     $txt .=  "暗号不定时更换。". "\n";
                    //     $txt .=  "下次暗号更新时间：". "\n";
                    //     $txt .=  "$xctime". "\n";
                    //     $txt .=  "加个星标，接收验证码推送∶" ."\n";
                    //     $txt .=  "1、点击头像". "\n";
                    //     $txt .=  "2、点击右上角的“...”". "\n";
                    //     $txt .=  "3、点击“设为星标”". "\n";
                    //     $contentStr = $txt;
                    //     break;
                        
                        
                        
                    case '免费白嫖':
                        $txt =  '取完验证码之后,' . "\n";
                        $txt .=  '记得给公众号文章点个赞.' . "\n\n";
                        $txt .=  '需要更新9.0版本使用' . "\n\n";
                        $txt .=  '否则报错403无权限！' . "\n\n";
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【点击获取暗号】</a>' . "\n\n";
                        $txt .=  ' 点击公告即重新显示暗号.' . "\n\n";
                        $txt .=  "  精选推荐：". "\n\n";
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【超低价合租SVIP稳定好用】</a>' . "\n\n";
                        $txt .=  '长期稳定下载合租 售后响应快' . "\n\n";
                        $txt .=  "暗号不定时更换。". "\n";
                        $txt .=  "下次暗号更新时间：". "\n";
                        $txt .=  (string)$xctime. "\n";
                        $txt .=  "加个星标，接收验证码推送∶" ."\n";
                        $txt .=  "1、点击头像". "\n";
                        $txt .=  "2、点击右上角的“...”". "\n";
                        $txt .=  "3、点击“设为星标”". "\n";
                        $contentStr = $txt;
                        break;
                        
                    case '小店':
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【超低价合租SVIP稳定好用】</a>' . "\n\n";
                        $txt .=  '长期稳定下载合租 售后响应快' . "\n\n";
                        $contentStr = $txt;
                        break;
                        
                    case '测试':
                        $txt =  '取完验证码之后,' . "\n";
                        $txt .=  '记得给公众号文章点个赞.' . "\n\n";
                        $txt .=  '需要更新9.0版本使用' . "\n\n";
                        $txt .=  '否则报错403无权限！' . "\n\n";
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【点击获取暗号】</a>' . "\n\n";
                        $txt .=  ' 点击公告即重新显示暗号.' . "\n\n";
                        $txt .=  "  精选推荐：". "\n\n";
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【超低价合租SVIP稳定好用】</a>' . "\n\n";
                        $txt .=  '长期稳定下载合租 售后响应快' . "\n\n";
                        $txt .=  "暗号不定时更换。". "\n";
                        $txt .=  "下次暗号更新时间：". "\n";
                        $txt .=  (string)$xctime. "\n";
                        $txt .=  "加个星标，接收验证码推送∶" ."\n";
                        $txt .=  "1、点击头像". "\n";
                        $txt .=  "2、点击右上角的“...”". "\n";
                        $txt .=  "3、点击“设为星标”". "\n";
                        $contentStr = $txt;
                        break;
                        
                    case '暗号':
                        $txt =  '取完验证码之后,' . "\n";
                        $txt .=  '记得给公众号文章点个赞.' . "\n\n";
                        $txt .=  '需要更新9.0版本使用' . "\n\n";
                        $txt .=  '否则报错403无权限！' . "\n\n";
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【点击获取暗号】</a>' . "\n\n";
                        $txt .=  ' 点击公告即重新显示暗号.' . "\n\n";
                        $txt .=  "  精选推荐：". "\n\n";
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【超低价合租SVIP稳定好用】</a>' . "\n\n";
                        $txt .=  '长期稳定下载合租 售后响应快' . "\n\n";
                        $txt .=  "暗号不定时更换。". "\n";
                        $txt .=  "下次暗号更新时间：". "\n";
                        $txt .=  (string)$xctime. "\n";
                        $txt .=  "加个星标，接收验证码推送∶" ."\n";
                        $txt .=  "1、点击头像". "\n";
                        $txt .=  "2、点击右上角的“...”". "\n";
                        $txt .=  "3、点击“设为星标”". "\n";
                        $contentStr = $txt;
                        break;
                    case '测试程序':
                        $contentStr = array();
                        $txt =  '取完验证码之后,' . "\n";
                        $txt .=  '记得给公众号文章点个赞.' . "\n\n";
                        $txt .=  '需要更新9.0版本使用' . "\n\n";
                        $txt .=  '否则报错403无权限！' . "\n\n";
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【点击获取暗号】</a>' . "\n\n";
                        $txt .=  ' 点击公告即重新显示暗号.' . "\n\n";
                        $txt .=  "  精选推荐：". "\n\n";
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【超低价合租SVIP稳定好用】</a>' . "\n\n";
                        $txt .=  '长期稳定下载合租 售后响应快' . "\n\n";
                        $txt .=  "暗号不定时更换。". "\n";
                        $txt .=  "下次暗号更新时间：". "\n";
                        $txt .=  (string)$xctime. "\n";
                        $txt .=  "加个星标，接收验证码推送∶" ."\n";
                        $txt .=  "1、点击头像". "\n";
                        $txt .=  "2、点击右上角的“...”". "\n";
                        $txt .=  "3、点击“设为星标”". "\n";
                        $contentStr = $txt;
                        break;
                        
                     case '免费白嫖测试12342223':
                        $txt =  '取完验证码之后,' . "\n";
                        $txt .=  '记得给公众号文章点个赞.' . "\n\n";
                        $txt .=  '  <a href="https://ass.baidassets.cn" target="_blank" >【点击领取暗号】</a>' . "\n\n";
                        $txt .=  "【暗号】 ". "\n\n";
                        $txt .=  "暗号不定时更换。". "\n";
                        $txt .=  "下次暗号更新时间：".$xctime. "\n";
                        $txt .=  "给星辰加个星标，接收验证码推送∶" ."\n";
                        $txt .=  "1、点击头像". "\n";
                        $txt .=  "2、点击右上角的“...”". "\n";
                        $txt .=  "3、点击“设为星标”". "\n";
                        $contentStr = $txt;
                        break;
             
             
                 case '免费白嫖23423':
                        $contentStr = array();
                        //随机回复1
                  //   $txt1 .=  '本次获得解锁隐藏暗号' . "\n";
                  //  $txt1 .=  '隐藏暗号不计入每日总次数' . "\n";
                      // $txt1 .=  '本次隐藏暗号次数【5次】' . "\n";
                      //  $txt1 .=  '隐藏暗号将同步最新发布的文章' . "\n";
                       // $txt1 .=  "举例1：" ."\n";
                     //   $txt1 .=  "文章发布的几点几分". "\n";
                  //      $txt1 .=  "日期2099-01-01 时分是00:29". "\n";
                  //      $txt1 .=  "时间【00:29】去掉 : 就是暗号". "\n";
                  //      $txt1 .=  "举例2：". "\n";
                  //      $txt1 .=  "比如12点10分,去掉 : 就是暗号". "\n";
                  //      $txt1 .=  '记得给公众号文章点个赞.' . "\n";
                 //       $txt1 .=  '您的点赞是给我最大的动力' . "\n";
                  //      $txt1 .=  "给星辰加个星标，接收验证码推送∶" ."\n";
                  //      $txt1 .=  "1、点击星辰的头像". "\n";
                 //       $txt1 .=  "2、点击右上角的“...”". "\n";
                   //     $txt1 .=  "3、点击“设为星标”". "\n";
                        //随机回复2

                        
                        
                        //随机回复3
                        
                        // $txt3 = "随机回复3";
                        
                        
                        //随机回复4
                        
                        // $txt4 = "随机回复4";
                        
                        
                        //默认回复
                        $txt .=  '取完暗号之后' . "\n";
                        $txt .=  '记得给公众号文章点个赞.' . "\n\n";
                        $txt .=  '  <a data-miniprogram-appid="wx0949ad19698f6605" >【点击领取暗号】</a>' . "\n\n";
                        $txt .=  "  精选推荐：". "\n\n";
                        $txt .=  '<a href="https://ass.baidassets.cn" target="_blank" >【超低价合租SVIP稳定好用】</a>' . "\n\n";
                        $txt .=  "下次暗号更新时间："."\n";
                        $txt .=  "$xctime ". "\n";
                        $txt .=  "温馨提示:" ."\n";
                        $txt .=  "在小程序点击【领取暗号】按钮". "\n";
                        $txt .=  "暗号刷新点击广告获得【5次】". "\n";
                        $txt .=  "测试前端程序的次数" ."\n";
                        $txt .=  "烧号快 每日上限【15次】" ."\n";
                        $txt .=  "测试程序需成本感谢你的理解" ."\n";
                        $txt .=  "如果提示小程序网络连接失败" ."\n";
                        $txt .=  "或者获取不了暗号" ."\n";
                        $txt .=  "请切换您的网络环境例如:" ."\n";
                        $txt .=  "WiFi切换4G 开启V皮N" ."\n";
                        $txt .=  "尝试使用大陆代理" ."\n";
                        $txt .=  "如果以上方法都不行请您" ."\n";
                        $txt .=  "设备开启手机飞行模式10秒" ."\n";
                        $txt .=  "然后关闭飞行重新尝试小程序" ."\n\n";
                        $txt .=  "加个星标，接收暗号更新推送∶" ."\n";
                        $txt .=  "1、点击头像". "\n";
                        $txt .=  "2、点击右上角的“...”". "\n";
                        $txt .=  "3、点击“设为星标”". "\n";
                        
                  break;
                 case '暗号':
                  $contentStr="请使用最新版,此口令暂停使用。";
                  break;
                  case '密码':
                      $loader = new EnvLoader();
                      $loader->load(__DIR__ . '/../.env');
                      $value = $loader->get('_94LIST_RANDOM_PASSWORD');
                      $contentStr .=  "取完暗号之后" . "\n";
                      $contentStr .=  '记得给公众号文章点个赞.' . "\n";
                      $contentStr .=  '您的点赞是给我最大的动力' . "\n";
                      $contentStr .=  "  精选推荐：". "\n\n";
                      $contentStr .=  '<a href="https://cdnass.baidassets.cn" target="_blank" >【超低价合租SVIP稳定好用】</a>' . "\n\n";
                      $contentStr .=  '长期稳定下载合租 售后响应快' . "\n\n";
                      $contentStr .=  "暗号:【{$value}】\n\n";
                      $contentStr .=  "防止滥用暗号不定时更换。". "\n";
                      $contentStr .=  "给乐玩油猴加个星标，接收暗号推送∶" ."\n";
                      $contentStr .=  "1、点击公众号的头像". "\n";
                      $contentStr .=  "2、点击右上角的“...”". "\n";
                      $contentStr .=  "3、点击“设为星标”". "\n";
                      break;
                  case '获取暗号':
                  $contentStr="请使用最新版,此口令暂停使用。";
                  break;
                  
                  case '获取密码':
                  $contentStr="请使用最新版,此口令暂停使用。";
                  break;
                  case '测试':
                  $contentStr="请使用最新版,此口令暂停使用。";
                  break;
                     
                  case '测试程序':
                  $contentStr="请使用最新版,此口令暂停使用。";
                  break;
                  default:
                  $contentStr="口令不对，请认真阅读举例哦";
                  break;
                }
         
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                echo "";
            }
        }else {
            echo "";
            exit;
        }
    }
}


function traceHttp(){
    logger("\n\nREMOTE_ADDR:".$_SERVER["REMOTE_ADDR"].(strstr($_SERVER["REMOTE_ADDR"],'101.226')? " FROM WeiXin": "Unknown IP"));
    logger("QUERY_STRING:".$_SERVER["QUERY_STRING"]);
}

function logger($log_content){
    if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
        sae_set_display_errors(false);
        sae_debug($log_content);
        sae_set_display_errors(true);
    }else{ //LOCAL
        $max_size = 500000;
        $log_filename = "log.xml";
        if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
        file_put_contents($log_filename, date('Y-m-d H:i:s').$log_content."\r\n", FILE_APPEND);
    }
}

class EnvLoader
{
    private static array $variables = [];

    public function load(string $path): void
    {
        if(!file_exists($path)) {
            throw new \RuntimeException("Environment file not found.");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach($lines as $line) {
            if(str_contains($line, '=')) {
                [$key, $value] = explode('=', $line, 2);
                self::$variables[trim($key)] = trim($value);
            }
        }
    }

    public function get($key, $default = null)
    {
        return self::$variables[$key] ?? $default;
    }
}
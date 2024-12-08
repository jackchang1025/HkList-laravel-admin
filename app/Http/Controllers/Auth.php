<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class Auth
{
    /**
     * 检查密码
     */
    public function status()
    {
        session_start();
        $password = config('baiduwp.password');
        if (empty($password)) {
            return json([
                'status' => 0,
                'msg' => '无需密码',
            ]);
		}
		if (session('Password') === $password) {
			return json([
                'status' => 2,
                'msg' => '已登录',
            ]);
		}
		return json([
            'status' => 1,
            'msg' => '未登录'
        ]);
    }

    public static function checkPassword(Request $request)
    {
        $password = config('baiduwp.password');
        $static_password_open = config('baiduwp.static_password_open');
        $static_password = config('baiduwp.static_password');
        $limit_password_open = config('baiduwp.limit_password_open');
        $limit_password_num = config('baiduwp.limit_password_num');
        $pwd = $request->post('password');
        $dl_password_open = config('baiduwp.dl_password_open');
        $dl_password = config('baiduwp.dl_password');
        $dl_nums = config('baiduwp.dl_nums');
        if( $static_password_open )
        {
            $static_password_info=explode(',',$static_password);
            if(in_array($pwd,$static_password_info)){
                $password = $pwd;
            }else{
                $password = $static_password;
            }
        }
        if (empty($password)) {
            return true;
        }
        $session_password = session('Password');
        
        if($dl_password_open){
            $dl_password_info=explode(',',$dl_password);
            if(in_array($pwd,$dl_password_info)){
                session('Password', $pwd);
                return true;
            }
        }
        
        if (!empty($session_password) && $session_password === $password) {
            // if($limit_password_open){
            //     $passinfo=Db::connect()->table("usenum")->where(array('id'=>1))->find();
            //     if($password==$passinfo['password']){
            //         $newmun=$passinfo['num']+1;
            //         if($newmun>$limit_password_num){
            //             return 999;
            //         }else{
            //             Db::connect()->table('usenum')->where(array('id'=>1))->update(['num' => $newmun]);
            //         }
            //     }else{
            //         Db::connect()->table('usenum')->where(array('id'=>1))->update(['num' => 1,'password' => $password]);
            //     }
            // }
            return true;
        }
        if ($pwd === $password) {
            // if($limit_password_open){
            //     $passinfo=Db::connect()->table("usenum")->where(array('id'=>1))->find();
            //     if($password==$passinfo['password']){
            //         $newmun=$passinfo['num']+1;
            //         if($newmun>$limit_password_num){
            //             return 999;
            //         }else{
            //             Db::connect()->table('usenum')->where(array('id'=>1))->update(['num' => $newmun]);
            //         }
            //     }else{
            //         Db::connect()->table('usenum')->where(array('id'=>1))->update(['num' => 1,'password' => $password]);
            //     }
            // }
            session('Password', $pwd);
            return true;
        }
        return false;
    }

}

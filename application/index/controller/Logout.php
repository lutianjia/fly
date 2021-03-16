<?php


namespace app\index\controller;


use think\Controller;
use think\Session;

class Logout extends Controller
{
        /*
         * 退出登录
         * 清空session
         * 跳转到登录页面
         */
    public function logout(){
        Session::delete('fly.email',null);
        //跳转
        return $this->fetch('login/login',[
            'd_vercode' => config('index.question'),
        ]);
    }
}
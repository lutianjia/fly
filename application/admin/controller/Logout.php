<?php


namespace app\admin\controller;



use think\Session;

class Logout extends Base
{
    /*
     * 退出登录
     * 清空session
     * 跳转到登录页面
     */
    public function logout(){
        Session::delete('fly.account',null);
        //跳转
        return $this->fetch('login/login');
    }
}
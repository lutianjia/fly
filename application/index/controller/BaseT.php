<?php


namespace app\index\controller;


use think\Controller;

class BaseT extends Controller
{
    public function _initialize()
    {
        //判断用户是否登录
        $isLogin = $this->isLogin();
        if($isLogin){
            return $this->redirect('Index/index');
        }
    }

    /*
     * 判断是否登录
     */
    public function isLogin(){
        //获取session
        $user = session('fly.email');
//        halt($user);
        if($user){
            return true;
        }
        return false;
    }
}
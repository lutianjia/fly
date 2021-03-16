<?php


namespace app\admin\controller;


use think\Controller;
use think\Session;

class Base extends Controller
{

    public $page = '';
    public $size = '';
    public $from = 0;

    public function _initialize()
    {
        //判断用户是否登录
        $isLogin = $this->isLogin();
        if(!$isLogin){
            return $this->redirect('Login/login');
        }
    }
    /*
     * 判断是否登录
     */
    public function isLogin(){
        //获取session
        $user = session('fly.account');
        if($user){
            return true;
        }
        return false;
    }

    /*
     * 获取用户信息
     */
    public function message(){
        $account = Session::get('fly.account');

        $result = model('Admin')->where('account', $account)->find();
        return $result;
    }

    public function getPageAndSize($data){
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page-1) * $this->size;
    }
}
<?php


namespace app\admin\controller;


use app\admin\validate\Admin;
use app\common\lib\IAuth;
use think\Controller;

class Login extends Controller
{
    public function login()
    {
        if (request()->isPost()) {
            $data = input('post.');
//            halt($data);
            $validate = new Admin();
            if (!$validate->check($data)) {
                return $this->error($validate->getError());
            }
//            if (!captcha_check($data['code'])) {
//                return $this->result('', 0, '验证码不正确');
//            }

            $user = model('Admin')->get(['account' => $data['account']]);
            if (IAuth::setPassword($data['password']) != $user->password) {
                return $this->result('', 0, '密码不正确');
            } else {
                if (input('remember')){
                    setcookie("account",$data['account'],time()+3600*24*7);
                    setcookie("password",$data['password'],time()+3600*24*7);
                }
//                halt($user['last_login_time']);
                //更新数据库 登录时间 次数 登录ip
                if(!$user['last_login_time']){
                    $udata = [
                        'login_count' => $user['login_count'] + 1,
                        'last_login_time' => time(),
                        'last_login_ip' => Request()->ip(),
                    ];
                    try{
                        model('Admin')->save($udata,['id' => $user->id]);
                    }catch (\Exception $e){
                        return $this->error($e->getMessage());
                    }
                }else{
                    $udata = [
                        'login_count' => $user['login_count'] + 1,
                        'last_login_time' => $user['last_login_time'] . ',' . time(),
                        'last_login_ip' => $user['last_login_ip'] . ',' . Request()->ip(),
                    ];
                    try{
                        model('Admin')->save($udata,['id' => $user->id]);
                    }catch (\Exception $e){
                        return $this->error($e->getMessage());
                    }
                }

                session('fly.account', $data['account']);
                return $this->result($user, 1, '后台登陆成功');
            }
        } else {
            return $this->fetch('');
        }
    }
}
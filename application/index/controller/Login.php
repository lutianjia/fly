<?php


namespace app\index\controller;


use app\common\lib\IAuth;
use app\index\model\Redis;
use app\index\model\User;
use app\index\validate\AdminUser;
use app\index\validate\Forget;
use app\index\validate\Reg;
use app\Tool\Rand;
use email\email;
use think\Controller;
use think\Session;

class Login extends BaseT
{
    public function login(){
       
 if(request()->isPost()) {
            $data = input('post.');
            //验证提交的数据
            $validate = new AdminUser();
            if (!$validate->check($data)) {
                return $this->result('', 0, $validate->getError());
            }

            //在数据库中查询
            try{
                $user = model('User')->get(['email' => $data['email']]);
            }catch (\Exception $e){
                return $this->result('', 0, $validate->getError());
            }
//            dump($user);
            if(!$user || $user->status != config('code.status_normal')){
                $this->error('该邮箱尚未注册');
            }
            if(IAuth::setPassword($data['password']) != $user->password){
                $this->error('密码不正确');
            }

            //更新数据库 登录时间 登录ip
            $udata = [
                'last_login_time' => time(),
                'last_login_ip' => Request()->ip(),
            ];
            try{
                model('User')->save($udata,['id' => $user->id]);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }

            session('fly.email', $data['email']);
            return $this->result('index', 1, '登陆成功');
        }else{
            return $this->fetch('',[
                'd_vercode' => config('index.question'),
            ]);
        }
    }

    /*
     * 忘记密码
     */
    public function forget(){
        if(request()->isPost()){
            $data = input('post.');
            //验证提交的数据
            $validate = new Forget();
            if (!$validate->check($data)) {
                return $this->result('', 0, $validate->getError());
            }
            //查看邮箱是否注册
            try{
                $user = model('User')->get(['email' => $data['email']]);
            }catch (\Exception $e){
                return $this->result('', 0, $validate->getError());
            }
//            dump($user);
            if(!$user || $user->status != config('code.status_normal')){
                $this->error('该邮箱尚未注册');
            }
            return $this->result($data['email'], 1, '邮件已成功发送，请在五分钟内完成验证');
        }else if($this->request->get()){
            $data = $this->request->get();
            $validate = new User();
            try{
                $user = model('User')->get(['email' => $data['email']]);
            }catch (\Exception $e){
                return $this->result('', 0, $validate->getError());
            }
            return $this->fetch('',[
                'data' => $data,
                'user' => $user,
            ]);
        }else{
            return $this->fetch('',[
                'd_vercode' => config('index.question'),
                'data' => ' ',
            ]);
        }
    }

    /*
     * 处理重置的密码
     */
    public function reg(){
        if(request()->isPost()) {
            $data = input('post.');
            //验证提交的数据
            $validate = new Reg();
            if (!$validate->check($data)) {
                return $this->result('', 0, $validate->getError());
            }
            //验证验证码
            $redis = new Redis();
            $code = $redis->redisGet($data['email']);
            if($data['vercode'] != $code){
                return $this->result('', 0, '验证码输入错误');
            }else{
                //将修改的数据写入数据库
                $udata['password'] = IAuth::setPassword($data['password']);
                model('User')->where('email' , $data['email'])->update($udata);
                $redis->del($data['email']);
                return $this->result('', 1, '密码修改成功');
            }
        }else{
            $this->result('', 0, '提交的数据不合法');
        }
    }

    /*
     * 发送邮箱
     */
    public function sendemail(){
        if(request()->isPost()) {
            $data = input('post.');
            $email = $data['email'];
            $rand = new Rand();
            $rand = $rand->rand();
            $redis = new Redis();
            $redis->redis($email, $rand);
            $mail = new email();
            $mail->setServer("smtp.exmail.qq.com", "1806955048@nyist.edu.cn", "257LlTtJj139."); //设置smtp服务器
            $mail->setFrom("1806955048@nyist.edu.cn"); //设置发件人
            $mail->setReceiver($email); //设置收件人，多个收件人，调用多次
            //      $mail->setCc("XXXX"); //设置抄送，多个抄送，调用多次
            //      $mail->setBcc("XXXXX"); //设置秘密抄送，多个秘密抄送，调用多次
            $mail->setMailInfo("验证码", "<b>$rand</b>"); //设置邮件主题、内容
            //        dump(123);exit;
            $result = $mail->sendMail(); //发送
            return true;
        }else{
            $this->result('', 0, '提交的数据不合法');
        }
    }


}

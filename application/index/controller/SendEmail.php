<?php


namespace app\index\controller;


use app\common\lib\IAuth;
use app\Tool\UUID;
use email\email;
use think\Controller;
use think\Session;

class SendEmail extends Controller
{
    /*
        * 发送邮箱
        */
    public function sendemail(){
        $data = input('post.');
//        halt($data['email']);
        $validate = new \app\index\validate\Email();
        if (!$validate->check($data)) {
            return $this->result('', 0, $validate->getError());
        }
        //检测提交数据是否存在
        $model = new \app\index\model\User();
        $result = $model->checksubmitusername($data['username']);
        if($result){
            return $this->result('', 0, '请更换名称');
        }
        $result = $model->checksubmit($data['email']);
        if($result){
            return $this->result('', 0, '该邮箱已经注册过');
        }
        //创建随机数码
        $data['code'] = UUID::create();
        $data['status'] = 0;
        $result = $this->message();
        $data['password']=isset($data['password'])?$data['password']:0;
        if($data['password'] != 0){
            $data['password'] = IAuth::setPassword($data['password']);
            try{
                model('User')->add($data);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }else{
            if($data['password'] == 0){
                unset($data['password']);
            }
            try{
                model('User')->where('email' , $result['email'])->update($data);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }

        $result = model('User')->where('email', $data['email'])->find();
//        halt($result);
        $id = $result['id'];
        $code = $result['code'];
        $mail = new email();
        $mail->setServer("smtp.exmail.qq.com", "1806955048@nyist.edu.cn", "257LlTtJj139."); //设置smtp服务器 #1:腾讯企业邮箱账号 #2密码
        $mail->setFrom("1806955048@nyist.edu.cn"); //设置发件人
        $mail->setReceiver($data['email']); //设置收件人，多个收件人，调用多次
        $mail->setMailInfo("fly", '请与24小时点击该连接完成验证. http://121.36.3.37/fly/public/index.php/index/Validateemail/validateEmail'
            . '?id=' . $id
            . '&code=' . $code); //设置邮件主题、内容
        $mail->sendMail(); //发送
        $this->logout();
    }

    /*
     * 退出登录
     * 清空session
     * 跳转到登录页面
     */
    public function logout(){
        Session::delete('fly.email');
    }

    /*
     * 获取用户信息
     */
    public function message(){
        $email = Session::get('fly.email');

        $result = model('User')->where('email', $email)->find();
        return $result;
    }
}

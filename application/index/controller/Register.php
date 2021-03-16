<?php


namespace app\index\controller;


use app\index\validate\User;

class Register extends BaseT
{
    public function register(){
        if(request()->isPost()){
            $data = input('post.');
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
            //验证提交数据
            $validate = new User();
            if (!$validate->check($data)) {
                return $this->result('', 0, $validate->getError());
            }else{
                return $this->result('', 1, '注意查收邮箱，进行最后一步注册');
            }
        }else{
            return $this->fetch('', [
                'd_vercode' => config('index.question'),
            ]);
        }

    }
}
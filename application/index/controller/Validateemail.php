<?php


namespace app\index\Controller;


use app\index\model\User;
use think\Controller;
use think\Request;
use think\Validate;

class Validateemail extends Controller
{
    public function validateEmail(Request $request){
        $id = $request->param('id');
        $code = $request->param('code');
        if($id == '' || $code == ''){
            return '验证异常';
        }
        $tempEmail = User::where('id', $id)->field(['code','create_time'])->find();
        if($tempEmail == null){
            return '验证异常';
        }
        if($tempEmail->code == $code){
            if((time()-strtotime($tempEmail->create_time)) > 8640000){
                return '该链接已失效';
            }

            $member = User::find($id);
            $member->status = 1;
            $member->save();

            $data['from_id'] = $id;
            $data['uid'] = $id;
            $data['content'] = '欢迎使用 layui';
            $data['item'] = 'welcome';
            model('Message')->save($data);
            return $this->redirect('Login/login');
        }else{
            return '该链接已失效';
        }
    }
}
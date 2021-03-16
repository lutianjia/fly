<?php


namespace app\admin\controller;


use app\common\lib\IAuth;
use think\Model;

class Admin extends Base
{
    public function adminList(){
        $user = parent::message();
        if($user['role'] != '超级管理员'){
            return $this->fetch('404/404');
        }
        $data = input('param.');
//           halt($data);
        $data = $this->searchDetail($data,'adminList');
//        halt($data);

        return $this->fetch('admin/admin-list',[
            'detail' => $data['detail'],
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'title' => empty($data['title']) ? '' : $data['title'],
            'count' => $data['count'],
            'user' => $user,
        ]);
    }

    /*
     * 添加管理员
     */
    public function adminAdd(){
        if(request()->isPost()){
            $data = input();
            $validate = new \app\admin\validate\AdminAdd();
            if (!$validate->check($data)) {
                return $this->error($validate->getError());
            }
            if($data['id'] != ''){
                unset($data['password_confirm']);
                $data['password'] = IAuth::setPassword($data['password']);
                try{
                    model('Admin')->save($data,['id' => $data['id']]);
                }catch (\Exception $e){
                    return $this->error($e->getMessage());
                }
                return $this->result('', 1, '修改成功');
            }else{
                $model = new \app\admin\model\Admin();
                $result = $model->checkAccount($data['account']);
                if($result){
                    return $this->result('', 0, '该账号以注册请更换账号');
                }
                unset($data['password_confirm']);
                $data['password'] = IAuth::setPassword($data['password']);
                try{
                    model('Admin')->save($data);
                }catch (\Exception $e){
                    return $this->error($e->getMessage());
                }
                return $this->result('', 1, '添加成功');
            }
        }elseif(request()->isGet()){
            $id = input('id');
//            halt($id);
            $user = [
                'account' => '',
            ];
            if($id == 'list'){
                return $this->fetch('admin/admin-add',[
                    'user' => $user,
                ]);
            }else{
                $user = show(Model('Admin')->where('id', $id)->find());
                return $this->fetch('admin/admin-add',[
                    'user' => $user,
                ]);
            }
        }
    }

    //搜索member页面数据
    public function searchDetail($data,$from){
        $whereData = [];
        //转换查询条件
        if (!empty($data['start_time']) && !empty($data['end_time']) && $data['end_time'] > $data['start_time']) {
            $whereData['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if($from == 'memberDel'){
            $whereData['status'] = -1;
        }
        if (!empty($data['title'])) {
            $whereData['account'] = ['like', '%' . $data['title'] . '%'];

            //获取表里的数据
            $detail = show(model('Admin')->getAdminsByCondition($whereData));
//            halt($detail);
            $count = sizeof($detail);
        }else{
            //获取表里的数据
            $detail = show(model('Admin')->getAdminsByCondition($whereData));
            $count = show(model('Admin')->getAdminsCountByCondition($whereData));
        }
        $data['detail'] = $detail;
        $data['count'] = $count;
        return $data;
    }
}
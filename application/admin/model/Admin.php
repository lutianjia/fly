<?php


namespace app\admin\model;


use app\index\model\Base;

class Admin extends Base
{
    public function checkAccount($data){
        $data = [
            'account' =>$data,
        ];
        return $this->where($data)
            ->find();
    }
}
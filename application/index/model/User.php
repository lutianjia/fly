<?php


namespace app\index\model;



class User extends Base
{
    protected $updateTime = 'last_login_time';
    public function checksubmit($data){
        $data = [
            'email' =>$data,
        ];
        return $this->where($data)
            ->select();
    }
    public function checksubmitusername($data){
        $data = [
            'username' =>$data,
        ];
        return $this->where($data)
            ->select();
    }

}
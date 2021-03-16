<?php


namespace app\admin\controller;




class Index extends Base
{
    public function index(){
        $user = parent::message();
        return $this->fetch('',[
            'user' => $user,
        ]);
    }


}
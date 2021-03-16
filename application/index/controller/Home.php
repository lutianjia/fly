<?php


namespace app\index\controller;


class Home extends Base
{
    public function home(){
        $result = parent::message();
        return $this->fetch('',[
            'user' => $result,
        ]);
    }
}
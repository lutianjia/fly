<?php


namespace app\index\model;


class Comment extends Base
{
    protected $autoWriteTimestamp = true;
    public function checksubmit($data){
        $data = [
            'id' =>$data,
        ];
        return show($this->where($data)
            ->find());
    }
}
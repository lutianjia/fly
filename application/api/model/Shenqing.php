<?php


namespace app\api\model;


use app\index\model\Base;

class Shenqing extends Base
{
    protected $autoWriteTimestamp = false; // 关闭自动写入时间戳
    protected $updateTime = false;// 只关闭自动写入update_time字段

    public function checksubmit($data){
        $data = [
            'uid' =>$data,
        ];
        return show($this->where($data)
            ->find());
    }
}
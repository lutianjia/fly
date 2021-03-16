<?php


namespace app\api\model;


use app\index\model\Base;

class Friend extends Base
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
    public function saveFriend($result){
        $check = $this->checksubmit($result['uid']);
//            halt($result);
        if(!$check){
            try{
                $this->save($result);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }else{
            $udata['uid'] = $result['uid'];
            try{
                $friend = $this->where($udata)->find();
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            $udata['fid'] = $friend['fid'] .','.$result['fid'];
            try{
                $this->where('uid',$udata['uid'])->update($udata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }
        $check = $this->checksubmit($result['fid']);
        if(!$check){
            $udata['uid'] = $result['fid'];
            $udata['fid'] = $result['uid'];
            try{
                $this->save($udata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }else{
            $tdata['uid'] = $result['fid'];
            try{
                $friend = $this->where($tdata)->find();
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            $tdata['fid'] = $friend['fid'] .','.$result['uid'];
            try{
                $this->where('uid',$tdata['uid'])->update($tdata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }
        return true;
    }
}
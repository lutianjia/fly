<?php


namespace app\index\controller;


use app\index\model\Redis;
use think\Db;

class Chat extends Base
{
    public function index(){
        $tid = input('tid');
        $data = parent::message();
        $fid = $data['id'];
        //取出信息
        $tidUser = show(model('User')->field('id,image,username')->where('id',$tid)->find());
        $fidUser = show(model('User')->field('image,username')->where('id',$fid)->find());
        //取出对话列表
        $where['tid']  = array('eq', $fid);
        $where['fid']  = array('eq',$fid);
        $where['_logic'] = 'or';
        $list_id = show(model('Msg')->field('tid,fid')->where("tid='$fid' or fid='$fid'")->select());

        $list_id = array_merge($list_id);
        for($i=0; $i<count($list_id); $i++){
            if(($list_id[$i]['tid'] == $fid) || ($list_id[$i]['tid'] == $tid)){
                unset($list_id[$i]['tid']);
            }
            if(($list_id[$i]['fid'] == $fid) || ($list_id[$i]['fid'] == $tid)){
                unset($list_id[$i]['fid']);
            }
        }

        foreach($list_id as $k=>$v){
            if(!$v){//判断是否为空（false）
                unset($list_id[$k]);//删除
            }
        }
//halt($list_id);
        if(!empty($list_id)){
            $list_id = $this->array_unique_fb($list_id);            
	    $list_id = array_merge($list_id);
            $list_array = [];
            for($i=0; $i<count($list_id); $i++){
                $list = show(model('User')->field('id,image,username')->where('id',$list_id[$i]['user_id'])->find());
                array_push($list_array,$list);
            }
        }else{
            $list_array=[];
        }
        $redis = new Redis();
        if(request()->isPost()) {
            $result = $redis->redisGet($fid);
            if ($result) {
                $redis->del($fid);
            }
//            halt(input('search'));
//            $search = input('search');
//            halt($search);
            if((input('search') == '') && (input('id') == '')){
                return $this->result('', 0, '请填写搜索内容');
            }
            if(input('search')) {
                $id = show(model('User')->field('id')->where('username',input('search'))->find());
                $a=0;
//                halt($list_array);
                for($i = 0; $i<count($list_array); $i++){
                    if($list_array[$i]['id'] == $id['id']){
                        $a++;
                    }
                }
                if($id['id'] == $tid){
                    $a++;
                }

                if(empty($id) || $a==0){
                    return $this->result('',0, '列表中不存在该用户');
                }

                $id = $id['id'];
            } else{
                $id = input('id');
            }

//            halt($list_array);
            $redis->redis_forever($fid, $id);
            $message = show(model('User')->field('id,image,username')->where('id',$id)->find());

            if($result){
                $message['noid'] = $result;
            }else{
                $message['noid'] = input('tid');
            }
            
            return $this->result($message, 1, '');
        }
        $user_id = $redis->redisGet($fid);
        if(!$user_id){
            $user_id=$tid;
        }
//halt($user_id);
        //halt($list_array);
        $top_message = show(model('User')->field('id,image,username')->where('id',$user_id)->find());
        return $this->fetch("chat/chat",[
            'fid' => $fid,
            'tid' => $tid,
            'tidUser' => $tidUser,
            'fidUser' => $fidUser,
            'list_array' => $list_array,
            'user_id' => $user_id,
            'top_message' => $top_message,
        ]);
    }

    //删除redis缓存
    public function del(){
        $redis = new Redis();
        $id = input('id');
//        halt($id);
        $result = $redis->redisGet($id);
        if ($result) {
            $redis->del($id);
        }
    }

    //二维数组去掉重复值,并保留键值
    function array_unique_fb($array2D){
        foreach ($array2D as $k=>$v){
            $v=join(',',$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
            $temp[$k]=$v;
        }
//        halt($array2D);

//        halt($temp);
        $temp=array_unique($temp); //去掉重复的字符串,也就是重复的一维数组
//        halt($temp);
        foreach ($temp as $k => $v){
//            var_dump($k);
            $array=explode(',',$v); //再将拆开的数组重新组装
            //下面的索引根据自己的情况进行修改即可
//            halt($array);
            $temp2[$k]['user_id'] =$array[0];
//            dump($array);
        }

        return $temp2;
    }
}

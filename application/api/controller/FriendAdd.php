<?php


namespace app\api\controller;


use app\api\model\Friend;
use app\api\model\Message;
use app\api\model\Shenqing;
use app\index\controller\Base;
use think\Db;

class FriendAdd extends Base
{
    public function friendAdd(){
        if(request()->isPost()) {
            $data = input('post.');
            $udata['uid'] = $data['id'];
            $result = parent::message();
            $udata['fid'] = $result['id'];
            //查看数据是否存在
            $model = new Shenqing();
            $result = $model->checksubmit($data['id']);
            if($result['fid'] == $udata['fid']){
                return $this->result('', 0, '您已经发过请求了，请耐心等待');
            }
            $result = $model->checksubmit($udata['fid']);
            if($result['uid'] == $udata['fid']){
                return $this->result('', 0, '对方发过请求了，请移步到我的信息页面查看');
            }
            try{
                $id = model('Shenqing')->insertGetId($udata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            $mdata['shenqing_id'] = $id;
            $mdata['from_id'] = $udata['fid'];
            $mdata['uid'] = $data['id'];
            $mdata['content'] = '你的操作666，期待与你成为好友';
            $mdata['item'] = 'addfriend';
            try{
                model('Message')->save($mdata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            return $this->result('', 1, '发送好友请求成功');
        }else{
            return $this->result('', 0, '请求错误');
        }
    }

    /*
     * 同意添加好友
     */
    public function agree(){
        if(request()->isPost()){
            $id = input('id');
            $data = $this->messageAndShenqingSearch($id);
            $result = $this->saveFriend($data);
            $udata['from_id'] = $data['uid'];
            $udata['uid'] = $data['fid'];
            $udata['content'] = '我们已经成为好友，快来和我一起聊天吧！';
            $udata['item'] = 'friendgive';
            model('Message')->save($udata);
            Message::destroy($id);
            Shenqing::destroy($data['shenqing_id']);
            if($result){
                return $this->result('', '1','好友添加成功');
            }else{
                return $this->result('', '0','好友添加失败');
            }
        }
    }

    /*
     * 好友添加--拒绝
     */
    public function refuse(){
        if(request()->isPost()){
            $id = input('id');
            $result = $this->messageAndShenqingSearch($id);
            $data['from_id'] = $result['uid'];
            $data['uid'] = $result['fid'];
            $data['content'] = '您想要与我成为好友，被拒绝';
            model('Message')->save($data);
            Message::destroy($id);
            Shenqing::destroy($result['shenqing_id']);
            return $this->result('', '1','好友申请已拒绝');
        }else{
            return $this->result('', '0', '数据非法');
        }
    }

    /*
     * 消息表、申请表关联查询
     */
    public function messageAndShenqingSearch($id){
        $data['a.id'] = $id;
        $result = Db::name("Message")
            ->alias("a")
            ->join("Shenqing i", 'a.shenqing_id = i.id')
            ->where($data)
            ->field('a.shenqing_id,i.uid,i.fid')
            ->find();
        $result = show($result);
        return $result;
    }

    public function saveFriend($result){
        $check = model('Friend')->checksubmit($result['uid']);
//            halt($result);
        if(!$check){
            $udata['uid'] = $result['uid'];
            $udata['fid'] = $result['fid'];
            try{
                Db::table('ent_friend') -> insert($udata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }else{
            $udata['uid'] = $result['uid'];
            try{
                $friend = model('Friend')->where($udata)->find();
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            $udata['fid'] = $friend['fid'] .','.$result['fid'];
            try{
                model('Friend')->where('uid',$udata['uid'])->update($udata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }
        $check = model('Friend')->checksubmit($result['fid']);
        if(!$check){
            $udata['uid'] = $result['fid'];
            $udata['fid'] = $result['uid'];
            try{
                model('Friend')->save($udata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }else{
            $tdata['uid'] = $result['fid'];
            try{
                $friend = model('Friend')->where($tdata)->find();
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            $tdata['fid'] = $friend['fid'] .','.$result['uid'];
            try{
                model('Friend')->where('uid',$tdata['uid'])->update($tdata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }
        return true;
    }
}
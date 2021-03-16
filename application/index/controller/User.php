<?php


namespace app\index\controller;

use app\api\model\Message;
use app\common\lib\IAuth;
use app\index\validate\Reviseo;
use think\Db;
use think\Session;

class User extends Base
{
    public function index(){
        $result = parent::message();
        //搜索该用户发表的贴子
        $data['user_id'] = $result['id'];
        $index = model('Allowance')->getNewsByCondition($data);
        $count = model('Allowance')->getNewsCountByCondition($data);
        $index=show($index);
        //搜索用户收藏的帖子
        $collect = show(model('User')->where('id',$data['user_id'])->find());
        $collect_id = $collect['collect'];
        $collect_array = explode(",",$collect_id);
        $collect_time = $collect['collect_time'];
        $collect_time_array = explode(",",$collect_time);
        for($i=0; $i<sizeof($collect_array); $i++){
            if($collect_array[$i] != ''){
                $adata['id'] = $collect_array[$i];
                $collect_jie[$i] = show(model('Allowance')->where($adata)->find());
                $collect_jie[$i]['create_time'] = $collect_time_array[$i];
            }
        }
        $collect_count = sizeof($collect_jie);

        return $this->fetch('',[
            'user' => $result,
            'index' => $index,
            'count' => $count,
            'collect_jie' => $collect_jie,
            'collect_count' => $collect_count,
        ]);
    }

    public function home(){
        $id = input('id');
        $username = input('username');
        if($id){
            $data['id'] = $id;
        }elseif($username){
            $id = show(model('User')->where('username',$username)->field('id')->find());
            $id = $id['id'];
            $data['id'] = $id;
        }
//        halt($id);
        $index = model('User')->where($data)->find();
        $result = parent::message();
        $email = Session::get('fly.email');
        $friend = show(model('Friend')->where('FIND_IN_SET(:id,fid)',['id' => $id],['uid' => $result['id']])->find());
//        halt($friend);
        //最近的帖子
        $adata['user_id'] = $id;
        $adata['status'] = config('code.status_normal');
        $order = ['read_count'=> 'desc', 'comment_count'=>'desc', 'create_time'=>'desc'];
        $tieData = model('Allowance')->where($adata)->order($order)->select();

        //最近的评论
        $cdata['a.user_id'] = $id;
        $cdata['i.status'] = config('code.status_normal');
        $order = ['create_time'=>'desc'];
        $commentData =Db::name("Comment")
            ->alias("a")
            ->join("Allowance i", 'a.article_id = i.id')
            ->where($cdata)
            ->field('a.create_time,a.content,a.id,i.title,a.article_id')
            ->order($order)
            ->select();
        $commentcontent = model('Comment')->where('user_id', $id)->field('id,content')->select();
        $commentcontent = json_encode(show($commentcontent));
//        halt($commentcontent);
        $this->assign("commentcontent",$commentcontent);
        return $this->fetch('',[
            'user' => $result,
            'email' => $email,
            'index' => $index,
            'friend' => $friend,
            'tieData' => $tieData,
            'commentData' => $commentData,
        ]);
    }

    public function set(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = new Reviseo();
            if (!$validate->check($data)) {
                return $this->result('', 0, $validate->getError());
            }
            $result = $this->checkEmail($data['email']);
            if(!$result){
                return $this->result('', 0, "您输入的邮箱与先使用的邮箱不一致,如果想要更换邮箱请点击重新验证邮箱");

            }
            $city = $data['province'] . $data['city'] . $data['county'];
            $data['city'] = $city;
            $data['update_time'] = time();
            unset($data['province'],$data['county']);
            try{
                model('User')->where('email' , $data['email'])->update($data);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            return $this->result('',1, '修改成功');
        }else{
            $result = parent::message();
            return $this->fetch('',[
                'user' => $result,
            ]);
        }
    }

    public function activate(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = new \app\index\validate\Email();
            if (!$validate->check($data)) {
                return $this->result('', 0, $validate->getError());
            }
            //检测提交数据是否存在
            $model = new \app\index\model\User();
            $result = $model->checksubmit($data['email']);
            if($result){
                return $this->result('', 0, '该邮箱已经注册过');
            }
            return $this->result('', 1, '注意查收邮箱，进行最后一步');
        }else{
            $result = parent::message();
            return $this->fetch('',[
                'user' => $result,
            ]);
        }

    }
    /*
     * 修改密码
     */
    public function setpassword(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = new \app\index\validate\Reviset();
            if (!$validate->check($data)) {
                return $this->result('', 0, $validate->getError());
            }
            //验证旧密码
            $result = parent::message();
            if(IAuth::setPassword($data['nowpass']) != $result['password']){
                return $this->result('', 0, '旧密码输入错误');
            }
            unset($data['nowpass'],$data['password_confirm']);
            $data['password'] = IAuth::setPassword($data['password']);
            model('User')->where('email' , $result['email'])->update($data);
            return $this->result('', 1, '密码修改成功');
        }
    }

    /*
     * 用户消息
     */
    public function message()
    {
        $result = parent::message();
        //查询消息
        if($result['dot'] == 1){
            $udata['dot'] = 0;
            model('User')->where('id',$result['id'])->update($udata);
        }
        $data['uid'] = $result['id'];
        $order = ['a.create_time' => 'desc'];
        $message = $res = Db::name("Message")
        ->alias("a")
        ->join("User i", 'a.from_id = i.id')
        ->where($data)
        ->field('a.id,a.article_id,a.uid,a.content,a.item,i.username,a.from_id,a.create_time,a.article_title')
        ->order($order)
        ->select();
        $message = show($message);
//        halt($message);
        return $this->fetch('',[
            'user' => $result,
            'message' => $message,
        ]);
    }

    /*
     * 消息删除
     */
    public function del(){
        if(request()->isPost()){
            $id = input('id');
            $result = Message::destroy($id);
            if($result){
                return $this->result('', 1, '信息删除成功');
            }else{
                return $this->result('', 0, '信息删除失败');
            }
        }else{
            return $this->result('', 0, '数据非法');
        }
    }

    /*
     * 消息全部删除
     */
    public function delAll(){
        if(request()->isPost()){
            $data = parent::message();
            $id = $data['id'];
            $result = Message::destroy(['uid' => $id]);
            if($result){
                return $this->result('', 1, '信息删除成功');
            }else{
                return $this->result('', 1, '信息已全部删除');
            }
        }else{
            return $this->result('', 0, '数据非法');
        }
    }

    /*
     * 邮箱验证
     */
    public function checkEmail($email){
        $getEmail = Session::get('fly.email');
        if($email != $getEmail){
            return false;
        }else{
            return true;
        }
    }

}
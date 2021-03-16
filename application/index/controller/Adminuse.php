<?php


namespace app\index\controller;


use app\index\model\Redis;
use app\index\validate\JieAdd;
use think\Controller;
use think\Db;
use think\Session;

class Adminuse extends Controller
{
    /*
    * 帖子详情页面
    */
    public function detail(){
        $id = input('id');
        $detail =Db::name("Allowance")
            ->alias("a")
            ->join("User i", 'a.user_id = i.id')
            ->where(['a.id' => $id])
            ->field('a.id,a.user_id,a.read_count,a.content,a.class,a.title,a.is_head_figure,a.collect_count,a.experience,a.comment_count,i.username,a.create_time,i.image')
            ->find();
        $detail = show($detail);
        $user_id = $detail['user_id'];
        $data['read_count'] = $detail['read_count'];
        $redis = new Redis();
        $redis = $redis->redisGet($id);
        if($redis != $detail['user_id']){
            $data['read_count'] = $detail['read_count']+1;
            $redis = new Redis();
            $redis->redis($id,$user_id);
        }
        try {
            model('Allowance')->where('id', $id)->update($data);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
        $result = parent::message();
        $detailcontent = $detail['content'];
        $this->assign("detailcontent",json_encode($detailcontent));
        $collect = show(model('User')->where('FIND_IN_SET(:id,collect)',['id' => $id],['id' => $result['id']])->find());
//        halt($collect);

        $comment = $this->comment($id);
//        halt($comment);
        $keyword = $result['id'];
        $star=Db::name('Comment')->where('article_id',$id)->where("find_in_set('".$keyword."',star_id)")->field('id')->select();
//        halt($star);
        if(!empty($star)){
            $commentEnd= [];
            $countStar = count($star);
            $countComment = count($comment);
            for($i=0; $i<$countStar; $i++){
                for($a=0; $a<$countComment; $a++){
                    if($comment[$a]['id'] == $star[$i]['id']){
                        $comment[$a]['isStar'] = 1;
                        $commentEnd[$a] = $comment[$a];
                    }else{
                        $comment[$a]['isStar'] = 0;
                    }
                }
            }

            $commentEnd = $this->arraySort($commentEnd, "create_time", "desc");
//        halt($commentEnd);
            $comment = $commentEnd+$comment;
            arsort($comment,0);
            $a=[];
            if(!empty($comment)){
                $a['0']= $comment[0];
            }

            $comment = $a+$comment;
        }else{
            $countComment = count($comment);
            for($a=0; $a<$countComment; $a++){
                $comment[$a]['isStar'] = 0;
            }
        }

//        dump($comment);
        $commentcontent = model('Comment')->where('article_id', $id)->field('id,content')->select();
        $commentcontent = json_encode(show($commentcontent));
//        halt($commentcontent);
        $this->assign("commentcontent",$commentcontent);
        $accept = model('Comment')->where('article_id',$id)->field('accept')->order(['accept' => 'desc'])->select();
        $accept = show($accept);
        if(!empty($accept)){
            if($accept[0]['accept'] == 1){
                $accept = 1;
            }else{
                $accept = 0;
            }
        }else{
            $accept = 0;
        }
        //本周热议
        $newData = newData();

        return $this->fetch('',[
            'user' => $result,
            'detail' => $detail,
            'read_count' => $data['read_count'],
            'collect' => $collect,
            'comment' => $comment,
            'accept' => $accept,
            'newData' => $newData,
            'star' => $star,
        ]);
    }

    /**
     * @desc arraySort php二维数组排序 按照指定的key 对数组进行自然排序
     * @param array $arr 将要排序的数组
     * @param string $keys 指定排序的key
     * @param string $type 排序类型 asc | desc
     * @return array
     */
    public function arraySort($arr, $keys, $type = 'asc')
    {
        $keysvalue = $new_array = array();
        foreach ($arr as $k => $v) {
            $keysvalue[$k] = $v[$keys];
        }

        $type == 'asc' ? asort($keysvalue) : arsort($keysvalue);
        foreach ($keysvalue as $k => $v) {
            $new_array[$k] = $arr[$k];
        }
        return $new_array;
    }

    /*
     * 获取用户信息
     */
    public function message(){
        $email = Session::get('fly.email');

        $result = model('User')->where('email', $email)->find();
        return $result;
    }

    /*
    * 评论
    */
    public function comment($id){
        $result = Db::name("Comment")
            ->alias("a")
            ->join("User i", 'a.user_id = i.id')
            ->where('article_id',$id)
            ->field('a.create_time,a.comment_id,a.accept,a.star,a.user_id,a.id,i.username,i.image')
            ->order(['accept' => 'desc','create_time' => 'desc'])
            ->select();
        $result = show($result);
        return $result;
    }

    /*
     * 用户home页面
     */
    public function home(){
        $id = input('id');
        $username = input('username');
        if($id){
            $data['id'] = $id;
        }elseif($username){
            $data['username'] = $username;
        }
//        halt($username);
        $index = model('User')->where($data)->find();
        $result = $this->message();
        $email = Session::get('fly.email');
        $friend = 'Adminuse';
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
        return $this->fetch('user/home',[
            'user' => $result,
            'email' => $email,
            'index' => $index,
            'friend' => $friend,
            'tieData' => $tieData,
            'commentData' => $commentData,
        ]);
    }
}
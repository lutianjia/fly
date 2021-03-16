<?php


namespace app\index\controller;


use app\index\model\Redis;
use app\index\validate\AdminUser;
use app\index\validate\JieAdd;
use think\Db;
use think\Request;

class Jie extends Base
{
    public function index(){
        $data = input('param.');
//        halt($data);
        $query = http_build_query($data);
        $result = parent::message();
        $type = input('type','');
        $adata['a.status'] = config('code.status_normal');
        $adata['i.status'] = config('code.status_normal');

        $this->getPageAndSize($data);

//        最新  热议
        $condition = input('condition');
        if($condition == '' || $condition == 'new'){
            $order = ['a.create_time' => 'desc'];
        }elseif ($condition == 're'){
            $order = ['comment_count' => 'desc'];
        }

        //综合 未结 已结 精华
        $from = input('from');
        if($from == '' || $from == 'zong'){

        }elseif ($from == 'wei'){
            $adata['jie'] = 0;
        }elseif ($from == 'yi'){
            $adata['jie'] = 1;
        }elseif ($from == 'jing'){
            $adata['read_count'] = ['egt', 200];
        }

        if($type != ''){
            //提问数据
            if($type == 'ti'){
                $adata['class'] = config('index.提问');
                $data = search('Allowance', 'User', $adata, $order, $this->from, $this->size);
                $pageTotal = count(search('Allowance', 'User', $adata, $order));
            }
            //分享数据
            if($type == 'fen'){
                $adata['class'] = config('index.分享');
                $data = search('Allowance', 'User', $adata, $order, $this->from, $this->size);
                $pageTotal = count(search('Allowance', 'User', $adata, $order));
            }
            //讨论数据
            if($type == 'tao'){
                $adata['class'] = config('index.讨论');
                $data = search('Allowance', 'User', $adata, $order, $this->from, $this->size);
                $pageTotal = count(search('Allowance', 'User', $adata, $order));
            }
            //建议数据
            if($type == 'jian'){
                $adata['class'] = config('index.建议');
                $data = search('Allowance', 'User', $adata, $order, $this->from, $this->size);
                $pageTotal = count(search('Allowance', 'User', $adata, $order));
            }
            //公告数据
            if($type == 'gong'){
                $adata['class'] = config('index.公告');
                $data = search('Allowance', 'User', $adata, $order, $this->from, $this->size);
                $pageTotal = count(search('Allowance', 'User', $adata, $order));
            }
            //动态数据
            if($type == 'dong'){
                $adata['class'] = config('index.动态');
                $data = search('Allowance', 'User', $adata, $order, $this->from, $this->size);
                $pageTotal = count(search('Allowance', 'User', $adata, $order));
            }
        }else{
            //更多求解
            $data = search('Allowance', 'User', $adata, $order, $this->from, $this->size);
            $pageTotal = count(search('Allowance', 'User', $adata, $order));
        }

        //本周热议
        $newData = newData();
//        halt($data);
        return $this->fetch('',[
            'user' => $result,
            'type' => $type,
            'data' => $data,
            'condition' => $condition,
            'from' => $from,
            'query' =>$query,
            'curr' => $this->page,
            'pageTotal' => $pageTotal,
            'newData' => $newData,
        ]);
    }

    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            //验证提交的数据
            $validate = new JieAdd();
            if (!$validate->check($data)) {
                return $this->result('', 0, $validate->getError());
            }

            $content = model('Shielding')->where('id', 1)->find();
//            halt($data['content']);
            $result = $this->strPosFuck($data['content'], $content['content']);
            if($result){
                $msg = "您发布的内容中包含屏蔽词:$result,请更换用词";
                return $this->result('', 0, $msg);
            }

            $id = model('Allowance')->get(['id' => $data['id']]);
//halt($data);          
  	    if($id != ''){
                //更新数据
                $data['status'] = 0;
                unset($data['vercode']);
                try {
                    model('Allowance')->where('id', $data['id'])->update($data);
                }catch (\Exception $e){
                    return $this->error($e->getMessage());
                }
                return $this->result('index', 1, '帖子更新成功,进入审核状态');
            }elseif($id == ''){
                //插入数据
                try{
                    model('Allowance')->add($data);
                }catch (\Exception $e){
                    return $this->error($e->getMessage());
                }
                return $this->result('index', 1, '帖子发表成功,进入审核状态');
            }

        }else{
            $id = input('id') ? input('id') : '';
            $message = model('Allowance')->where(['id' => $id])->find();
            $message = show($message);
//            halt($message);
            $result = parent::message();
            return $this->fetch('',[
                'user' => $result,
                'd_vercode' => config('index.question'),
                'message' => $message,
            ]);
        }
    }

    function strPosFuck($content,$fuck)
    {
        $content = trim($content);
        $fuckArr = explode("，",$fuck);  // 把关键字转换为数组
        for ($i=0; $i < count($fuckArr) ; $i++)
        {
// $fuckArr[$i] = trim($fuckArr[$i]);
            if ($fuckArr[$i] == "") {
                continue;  //如果关键字为空就跳过本次循环
# code...
            }
            if (strpos($content,trim($fuckArr[$i])) != false)
            {
                return $fuckArr[$i];  //如果匹配到关键字就返回关键字
                # code...
            }
        }    return false;  // 如果没有匹配到关键字就返回 false
    }

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
     * 评论
     */
    public function comment($id){
        $result = Db::name("Comment")
            ->alias("a")
            ->join("User i", 'a.user_id = i.id')
            ->where('article_id',$id)
            ->field('a.create_time,a.star_id,a.comment_id,a.accept,a.star,a.user_id,a.id,i.username,i.image')
            ->order(['accept' => 'desc','a.create_time' => 'desc'])
            ->select();
        $result = show($result);
        return $result;
    }

    /*
     * 删除帖子
     */
    public function delete(){
        if($id = input('id')){
            $data['status'] = -1;
            $del = model('Allowance')->where(['id' => $id])->update($data);
            if($del){
                return $this->result('', 1, '帖子删除成功');
            }
        }else{
            return json('','0', '请求异常');
        }
    }

    /*
     * 收藏帖子
     */
    public function collect(){
        if(request()->isPost()){
            $id = input('id');
            $data['id'] = $id;
            $result = model('Allowance')->where($data)->field('collect_count,user_id')->find();
            $result = show($result);
            $adata['collect_count'] = $result['collect_count'] + 1;
            model('Allowance')->where(['id' => $id])->update($adata);
            //更新user表信息
            $user = parent::message();
            $check = model('User')->where('id', $user['id'])->field('collect,collect_time')->find();
            $check = show($check);
//            halt($check);
            if(!$check['collect']){
                $udata['collect'] = $id;
                $udata['collect_time'] = time();
                try{
                    model('User')->where('id',$user['id'])->update($udata);
                }catch (\Exception $e){
                    return $this->error($e->getMessage());
                }
                return $this->result($adata, 1, '文章收藏成功');
            }else{
                $udata['collect'] = $check['collect'] .','.$id;
                $udata['collect_time'] = $check['collect_time'] .','.time();
                try{
                    model('User')->where('id',$user['id'])->update($udata);
                }catch (\Exception $e){
                    return $this->error($e->getMessage());
                }
                return $this->result($adata, 1, '文章收藏成功');
            }
        }else{
            return $this->result("", 0, '请求异常');
        }
    }

    /*
     * 帖子取消收藏
     */
    public function nocollect(){
        if(request()->isPost()){
            $id = input('id');
            $data['id'] = $id;
            $result = model('Allowance')->where($data)->field('collect_count,user_id')->find();
            $result = show($result);
            $adata['collect_count'] = $result['collect_count'] - 1;
            model('Allowance')->where(['id' => $id])->update($adata);
            //更新user表信息
            $user = parent::message();
            $check = model('User')->where('id', $user['id'])->field('collect,collect_time')->find();
            $check = show($check);
//            halt($check);
            $collect = str_replace("$id","",$check['collect']);
            //获取时间戳
            $zhong = $check['collect'];
            $collect_array = explode(",",$zhong);
            $collect_time = $check['collect_time'];
            $collect_time_array = explode(",",$collect_time);
            for($i=0; $i<sizeof($collect_array); $i++){
                if($id == $collect_array[$i]){
                    $collect_time = $collect_time_array[$i];
                }
            }
            $collect_time = str_replace("$collect_time","",$check['collect_time']);
            $udata['collect'] = $collect;
            $udata['collect_time'] = $collect_time;
            model('User')->where(['id' => $user['id']])->update($udata);
                return $this->result($adata, 1, '文章以取消收藏');

        }else{
            return $this->result('', 0, '请求异常');
        }
    }

}

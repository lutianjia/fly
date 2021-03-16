<?php


namespace app\index\controller;


use think\Db;

class Comment extends Base
{
    //文章评论
    public function comment()
    {
        if(request()->isPost()){
            $data= input('post.');
//            halt($data);
            $comment = $data['content'];
            $article_id = $data['jie_id'];
            //用户id
            $user = parent::message();
            $user = $user['id'];
            //回复某个评论用户的id
            $comment_id = input('post.comment_id', 0);
            $article_comment_id = input('post.article_comment_id', 0);
//            halt($article_comment_id);
            if ($article_comment_id != 0){
                model('Comment')->where('id',$article_comment_id)->update(['content' => $comment]);
            }else{
                $id = model('Comment')->insertGetId(['content' =>$comment, 'article_id' => $article_id, 'user_id' => $user, 'comment_id' => $comment_id, 'create_time' => time(), 'update_time' => time()]);
                model('User')->where('id',$user)->setInc('comment_count');
                model('Allowance')->where('id',$article_id)->setInc('comment_count');
            }

            if($comment_id != 0){
                if($article_comment_id == 0){
                    $article = model('Allowance')->where('id',$article_id)->find();
                    $article = show($article);
                    $message['from_id'] = $user;
                    $message['uid'] = $comment_id;
                    $message['item'] = 'comment';
                    $message['article_title'] = $article['title'];
                    $message['article_id'] = $article_id;
                    $message['content'] = '@了您在';
                    model('message')->save($message);
                    $udata['dot'] = 1;
                    model('User')->where('id',$message['uid'])->update($udata);
                }
            }
//            halt($article_comment_id);
            if($article_comment_id == 0) {
                $data = Db::name("Comment")
                    ->alias("a")
                    ->join("User i", 'a.user_id = i.id')
                    ->where(['a.id' => $id])
                    ->field('a.id,a.user_id,a.content,a.star,i.username,a.create_time,i.image')
                    ->find();
                if ($id) {
                    return $this->result($data, 1, '评论成功');
                } else {
                    return $this->result('', 0, '评论失败');
                }
            }else{
                $data = Db::name("Comment")
                    ->alias("a")
                    ->join("User i", 'a.user_id = i.id')
                    ->where(['a.id' => $article_comment_id])
                    ->field('a.id,a.user_id,a.content,a.star,i.username,a.create_time,i.image')
                    ->find();
                return $this->result($data, 1, '编辑成功');
            }

        }else{
            return $this->result('', 0, '请求异常');
        }
    }

    /*
     * 采纳评论
     */
    public function accept(){
        if(request()->isPost()){
            $id = input('id');
            $cdata['accept'] = 1;
            try{
                model('comment')->where('id',$id)->update($cdata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            $article_id = model('Comment')->where('id', $id)->field('user_id,article_id')->find();
            $experience = model('Allowance')->where('id', $article_id->article_id)->field('user_id,experience')->find();
//            halt($experience->experience);
            $user_experience = model('User')->where('id', $experience->user_id)->field('experience')->find();
            if($user_experience->experience<$experience->experience){
                return $this->result('',0,'您的飞吻数不足');
            }

            $result1 = model('User')->where('id', $experience->user_id)->setDec('experience',$experience->experience);
            $result2 = model('User')->where('id', $article_id->user_id)->setInc('experience',$experience->experience);
//            var_dump($result1);
//            var_dump($result2);
            if($result1 && $result2){
                return $this->result($id, 1, '该回复被采纳');
            }
        }else{
            return $this->result('', 0, '请求异常');
        }
    }

    /*
     * 回复
     */
    public function replace(){
        if(request()->isPost()){
            $user_id = input('user_id');
//            halt($user_id);
            $username = model('User')->where('id', $user_id)->field('username')->find();
            $data['user_id'] = $user_id;
            $data['username'] = $username['username'];
            return $this->result($data);
        }else{
            return $this->result('', 0, '请求异常');
        }
    }

    public function zhuanyi(){
        $data = input('');
//        halt($data['data']);
        return $this->result($data['data']);
    }

    /*
     * 点赞
     */
    public function star(){
        $user = parent::message();
        $id = input('id');
        $data = model('Comment')->where('id',$id)->find();
        $data = show($data);
        $cdata['star'] = $data['star']+1;
        $cdata['id'] = $data['id'];
        $check = model('Comment')->checksubmit($id);

        if(!$check['star_id']){
            $cdata['star_id'] = $user['id'];
            try{
                model('Comment')->where('id',$id)->update($cdata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }else{
            $cdata['star_id'] = $check['star_id'] . ',' . $user['id'];
            try{
                model('Comment')->where('id',$id)->update($cdata);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }

        return $this->result($cdata, 1, '点赞成功');
    }

    /*
     * 取消点赞
     */
    public function nostar(){
        $user = parent::message();
        $id = input('id');
//        halt($id);
        $data = model('Comment')->where('id',$id)->find();
        $data = show($data);
        $cdata['star'] = $data['star']-1;
        $cdata['id'] = $data['id'];
        $check = model('Comment')->checksubmit($id);

        $cdata['star_id'] =str_replace($user['id'],"",$check['star_id']);
        try{
            model('Comment')->where('id',$id)->update($cdata);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
        return $this->result($cdata, 1, '取消点赞');
    }

    /*
     * 编辑
     */
    public function edit(){
        if(request()->isPost()){
            $id = input('id');
            $data = model('Comment')->checksubmit($id);
            if($data){
                return $this->result($data);
            }else{
                return $this->result('', 0, '该回复已删除');
            }
        }else{
            return $this->result('', 0, '请求异常');
        }
    }

    /*
     * 删除
     */
    public function del(){
        if(request()->isPost()){
            $id = input('id');
            \app\index\model\Comment::destroy($id);
            return $this->result($id, 1, '该回复已删除');
        }else{
            return $this->result('', 0, '请求异常');
        }
    }
}
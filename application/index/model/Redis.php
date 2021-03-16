<?php


namespace app\index\model;



use think\Model;

class Redis extends Model
{
    /*
     * 连接redis
     */
//    public function connect(){
//        $redis = new \Redis();
//        $redis -> connect('127.0.0.1',6379);
//        $auth = $redis->auth('13939525831');
//    }
    /*
     * 设置redis
     */
    public function redis($email,$rand){
        $redis = new \Redis();
        $redis -> connect('127.0.0.1',6379);
        $auth = $redis->auth('13939525831');
        $redis->set($email,$rand);
        $redis->expire($email,300);
//        echo '用户名：'.$redis -> get('rand');
    }

    /*
     * 获取redis值
     */
    public function redisGet($email){
        $redis = new \Redis();
        $redis -> connect('127.0.0.1',6379);
        $auth = $redis->auth('13939525831');
        $rand = $redis->get($email);
        return $rand;
//        echo '用户名：'.$redis -> get('rand');
    }

    /*
     * 删除redis
     */
    public function del($email){
        $redis = new \Redis();
        $redis -> connect('127.0.0.1',6379);
        $auth = $redis->auth('13939525831');
        $redis->del($email);
    }

    /*
     * 设置永久redis
     */
    public function redis_forever($email,$rand){
        $redis = new \Redis();
        $redis -> connect('127.0.0.1',6379);
        $redis->auth('13939525831');
        $redis->set($email,$rand);
    }

}

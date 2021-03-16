<?php


namespace app\common;

Vendor('qiniu.php-sdk.autoload');
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use think\Controller;

class Upload extends Controller
{
    /*
         * 图片上传
         */
    public static function image() {
        if(empty($_FILES['file']['tmp_name'])){
            exception('您提交的图片数据不合法', 404);
        }
        //要上传的文件
        $file = $_FILES['file']['tmp_name'];
//echo $_FILES['file']['name'];exit;
        $ext = explode('.', $_FILES['file']['name']);
        $ext = $ext[1];
        $config = config('qiniu');
        //构建一个鉴权对象
        $auth = new Auth($config['ak'], $config['sk']);
        //生成上传的token
        $token = $auth->uploadToken($config['bucket']);
        //上传到七牛云后保存的文件名
        $key = date('Y')."/".date('m')."/".substr(md5($file), 0, 5).date('YmdHis').rand(0,9999).'.'.$ext;
//        echo $key;exit;
        //初始化UPloadManager类
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);

        if($err !== null){
            return null;
        }else{
            return $key;
        }
    }
}
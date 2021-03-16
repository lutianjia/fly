<?php


namespace app\api\controller;


use think\Controller;
use think\Session;

class Upload extends Controller
{
    public function index(){
        try{
            $image = \app\common\Upload::image();
        }catch(\Exception $e){
            return json_encode(['status' => 0, 'message' => '上传失败']);
        }
        $url = config('qiniu.image_url').'/'.$image;

        if($image){
            // 成功上传后 获取上传信息
            return json(['status' => 0, 'msg' => '上传成功!', 'url' => $url]);
        }else{
            // 上传失败获取错误信息
            return json(['status' => 1, 'msg' => $image->getError(), 'url' => '']);
        }
    }
}
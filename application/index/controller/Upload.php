<?php


namespace app\index\controller;


use think\Session;

class Upload extends Base
{
    public function upload0(){
        $img = request()->file('file');
//        dump($img);exit;
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $img->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            return json(['code' => 0, 'msg' => '上传成功!', 'url' => '/uploads/' . $info->getSaveName()]);
        }else{
            // 上传失败获取错误信息
            return json(['code' => 1, 'msg' => $img->getError(), 'url' => '']);
        }
    }

    /*
     * 七牛云图片上传
     */
    public function upload(){
        try{
            $image = \app\common\Upload::image();
        }catch(\Exception $e){
            echo json_encode(['status' => 0, 'message' => '上传失败']);
        }
        $url = config('qiniu.image_url').'/'.$image;
        $data = [
            'image' => $url,
        ];
        $email = Session::get('fly.email');
        model('User')->where('email' , $email)->update($data);

        if($image){
            // 成功上传后 获取上传信息
            return json(['code' => 0, 'msg' => '上传成功!', 'url' => $url]);
        }else{
            // 上传失败获取错误信息
            return json(['code' => 1, 'msg' => $image->getError(), 'url' => '']);
        }
    }
}
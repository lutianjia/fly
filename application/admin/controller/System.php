<?php


namespace app\admin\controller;


class System extends Base
{
    public function shielding(){
        if(request()->isPost()){
            $content = input('content');
            $data['content'] = $content;
            try{
                model('Shielding')->where('id', 1)->update($data);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            return $this->result('', 1, '修改成功');
        }else{
            $content = model('Shielding')->where('id', 1)->find();
            return $this->fetch('system/system-shielding',[
                'content' => $content['content'],
            ]);
        }
    }
}
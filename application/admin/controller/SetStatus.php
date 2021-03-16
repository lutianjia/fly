<?php


namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\User;
class setStatus extends Base
{
//审核通过
    public function agree(){
        if(request()->isPost()){
            $id = input('id');
            $table = input('table');
            $result = $this->setStatus($id, $table, config('code.status_normal'));
            if ($result){
                return $this->result('', 1, '已发布');
            }
        }else{
            return $this->result('', 0, '请求异常');
        }
    }

    /*
     * 上架
     */
    public function up(){
        if(request()->isPost()){
            $id = input('id');
            $table = input('table');
            $result = $this->setStatus($id, $table, config('code.status_normal'));
            if ($result){
                return $this->result('', 1, '已发布');
            }
        }else{
            return $this->result('', 0, '请求异常');
        }
    }

    /*
     * 下架
     */
    public function down(){
        if(request()->isPost()){
            $id = input('id');
            $table = input('table');
            $result = $this->setStatus($id, $table, config('code.status_down'));
            if ($result){
                return $this->result('', 1, '已下架');
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
            $table = input('table');
            $result = $this->setStatus($id, $table, config('code.status_delete'));
            if ($result){
                return $this->result('', 1, '已删除');
            }
        }else{
            return $this->result('', 0, '请求异常');
        }
    }

    /*
     * 彻底删除
     */
    public function thoroughDel(){
        if(request()->isPost()){
            $id = input('id');
            $result = User::destroy($id);
            if ($result){
                return $this->result('', 1, '已删除');
            }
        }else{
            return $this->result('', 0, '请求异常');
        }
    }

    /*
     * 彻底批量删除
     */
    public function thoroughDelete(){
        if(request()->isPost()){
            $data = input();
            $table = input('table');

            if(isset($data['id'])){
                $id_arr = implode(",",$data['id']);
            }else{
                return $this->result('', 0, '至少选择一篇文章');
            }

            $result = model("$table")->where("id in ($id_arr)")->delete();
            if ($result){
                return $this->result($data['id'], 1, '已删除');
            }
        }else{
            return $this->result('', 0, '请求异常');
        }
    }

    /*
     * 修改帖子状态
     */
    public function setStatus($id, $table, $status){
        $adata = [
            'status' => $status
        ];
        try{
            model($table)->save($adata,['id' => $id]);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
        return true;
    }

    /*
     * 批量删除
     */
    public function delete(){
        if(request()->isPost()){
            $data = input();
            if(empty($data['id'])){
                return $this->result('', 0, '至少选择一篇文章');
            }
            delete($data['table'], $data['id']);
            return $this->result($data['id'], 1, '删除成功');
        }else{
            return $this->result('', 0, '请求异常');
        }
    }
}
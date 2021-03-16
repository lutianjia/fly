<?php


namespace app\index\model;


use think\Db;
use think\Model;

class Base extends Model
{
    protected $autoWriteTimestamp = true;

    public function add($data){
        if(!is_array($data)){
            exception("传入的数据不合法");
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }

    /*
        * 根据条件来获取列表的数据
        */
    public function getNewsByCondition($condition = []){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'eq', config('code.status_normal')
            ];
        }

        $order = ['status' => 'desc','id' => 'desc'];

        $result = $this->where($condition)
            ->order($order)
            ->select();

        return $result;
    }

    /*
     *  根据条件来获取列表的数据多少
     */
    public function getNewsCountByCondition($condition = []){
        if(!isset($condition['status'])) {
            $condition['status'] = [
                'neq', config('code.status_delete')
            ];
        }
        return $this->where($condition)
            ->count();
    }

    /*
        * 根据条件来获取签到的数据
        */
    public function getInsByCondition($udata,$order){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'neq', config('code.status_delete')
            ];
        }

        $result = $this->where($udata)
            ->order($order)
            ->select();

        return $result;
    }

    /*
        * 根据条件来获取列表的数据
        */
    public function getArticlesByCondition($condition = []){
        if(!isset($condition['a.status'])){
            $condition['a.status'] = [
                'in', [0,1,2]
            ];
        }
        if(!isset($condition['class'])){
            $condition['class'] = [
                'in', [0,99,100,101,168,169]
            ];
        }

        if ($condition['class'] == 1){
            unset($condition['class']);
        }
//        halt($condition);

        $result =show(Db::name("Allowance")
            ->where($condition)
            ->alias("a")
            ->join("User i", 'a.user_id = i.id')
            ->field('a.id,a.user_id,a.read_count,a.class,a.title,a.status,i.username,a.create_time')
            ->select());
        return $result;
    }
    /*
     *  根据条件来获取列表的数据
     */
    public function getArticlesCountByCondition($condition = []){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'in', [0,1,2]
            ];
        }
        if(!isset($condition['class'])){
            $condition['class'] = [
                'in', [0,99,100,101,168,169]
            ];
        }

        if ($condition['class'] == 1){
            unset($condition['class']);
        }
        return $this->where($condition)
            ->count();
    }

    /*
       * 根据条件来获取列表的数据
       */
    public function getMembersByCondition($condition = []){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'in', [1,2]
            ];
        }
//        halt($condition);

        $result =show(Db::name("user")->where($condition)->select());
        return $result;
    }
    /*
     *  根据条件来获取列表的数据
     */
    public function getMembersCountByCondition($condition = []){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'in', [1,2]
            ];
        }
        return $this->where($condition)->count();
    }

    /*
       * 根据条件来获取列表的数据
       */
    public function getAdminsByCondition($condition = []){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'in', [1,2]
            ];
        }
//        halt($condition);

        $result =show(Db::name("Admin")->where($condition)->select());
        return $result;
    }
    /*
     *  根据条件来获取列表的数据
     */
    public function getAdminsCountByCondition($condition = []){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'in', [1,2]
            ];
        }
        return $this->where($condition)->count();
    }
}
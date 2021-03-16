<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/*
 * 通用化API接口数据转为数组输出到view
 */

use think\Db;

function show($data){
    $data=json_encode($data);
    $data = json_decode($data,true);
    return $data;
}

/*
 * 通用化API接口数据
 */
function showIn($status,  $data = [], $httpCode = 200){
    $data = [
        'status' => $status,
        'data' => $data,
    ];
    return json($data, $httpCode);
}

/*
 * 通用化两表查询数据
 */
function search($table1, $table2, $whereData, $order=[], $from=0, $size=1.2){
    if($size == 1.2){
        $result =  $res = Db::name($table1)
            ->alias("a")
            ->join("$table2 i", 'a.user_id = i.id')
            ->where($whereData)
            ->field('a.id,a.title,a.experience,a.class,a.comment_count,a.read_count,a.user_id,a.create_time,i.username,i.image')
            ->order($order)
            ->select();
        $result = show($result);
    }else{
        $result =  $res = Db::name($table1)
            ->alias("a")
            ->join("$table2 i", 'a.user_id = i.id')
            ->where($whereData)
            ->field('a.id,a.title,a.experience,a.class,a.comment_count,a.read_count,a.user_id,a.create_time,a.jie,a.is_head_figure,i.username,i.image')
            ->order($order)
            ->limit($from, $size)
            ->select();
        $result = show($result);
    }

    return $result;
}

/*
*function:显示某一个时间相当于当前时间在多少秒前，多少分钟前，多少小时前
*timeInt:unix time时间戳
*format:时间显示格式
*/
function timeFormat($timeInt,$format='Y-m-d'){
    if(empty($timeInt)||!is_numeric($timeInt)||!$timeInt){
        $timeInt = strtotime($timeInt);
    }
    $d=time()-$timeInt;
    if($d<0){
        return '';
    }else{
        if($d<60){
            return $d.'秒前';
        }else{
            if($d<3600){
                return floor($d/60).'分钟前';
            }else{
                if($d<86400){
                    return floor($d/3600).'小时前';
                }else{
                    if($d<259200){//3天内
                        return floor($d/86400).'天前';
                    }else{
                        return date($format,$timeInt);
                    }
                }
            }
        }
    }
}

/*
 * 获取本周热议的数据
 */
function newData(){
    $data['status'] = config('code.status_normal');
    $order = ['comment_count' => 'desc'];
    $result = model('Allowance')->where($data)->order($order)->limit(0,9)->select();
    return $result;
}



/*
 * 通用化批量删除
 */
function delete($table,$id){
    $id_arr = implode(",",$id);
    $res = model("$table")->where("id in ($id_arr)")->update(['status' => -1]);
    return $res;
}





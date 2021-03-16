<?php


namespace app\admin\controller;


class Member extends Base
{
    public function member(){
        $data = input('param.');
//           halt($data);
        $data = $this->searchDetail($data,'member');
        return $this->fetch('member/member-list', [
            'detail' => $data['detail'],
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'title' => empty($data['title']) ? '' : $data['title'],
            'count' => $data['count'],
        ]);
    }

    public function memberDel(){
        $data = input('param.');
//           halt($data);
        $data = $this->searchDetail($data,'memberDel');
        return $this->fetch('member/member-del',[
            'detail' => $data['detail'],
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'title' => empty($data['title']) ? '' : $data['title'],
            'count' => $data['count'],
        ]);
    }

    public function memberLevel(){
        $data = input('param.');
//           halt($data);
        $data = $this->searchDetail($data,'memberLevel');
//        halt($data);
        return $this->fetch('member/member-level',[
            'detail' => $data['detail'],
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'title' => empty($data['title']) ? '' : $data['title'],
            'count' => $data['count'],
        ]);
    }

    //二维数组去掉重复值
    function assoc_unique($arr, $key) {
        $tmp_arr = array();
        foreach ($arr as $k => $v) {
            if (in_array($v[$key], $tmp_arr)) {//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
                unset($arr[$k]);
            } else {
                $tmp_arr[] = $v[$key];
            }
        }
        sort($arr); //sort函数对数组进行排序
        return $arr;
    }

    //搜索member页面数据
    public function searchDetail($data,$from){
        $whereData = [];
        //转换查询条件
        if (!empty($data['start_time']) && !empty($data['end_time']) && $data['end_time'] > $data['start_time']) {
            $whereData['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if($from == 'memberDel'){
            $whereData['status'] = -1;
        }
        if (!empty($data['title'])) {
            $whereData['username']['username'] = ['like', '%' . $data['title'] . '%'];
            $whereData['nickname']['nickname'] = ['like', '%' . $data['title'] . '%'];
            $whereData['email']['email'] = ['like', '%' . $data['title'] . '%'];
            if($from == 'memberDel'){
                $whereData['username']['status'] = -1;
                $whereData['nickname']['status'] = -1;
                $whereData['email']['status'] = -1;
            }
            //获取表里的数据
            $detail = show(model('User')->getMembersByCondition($whereData['username']));
//            halt($detail);
            $nickdetail = show(model('User')->getMembersByCondition($whereData['nickname']));
            $emaildetail = show(model('User')->getMembersByCondition($whereData['email']));
            $detail = array_merge_recursive($detail,$nickdetail,$emaildetail);
            $detail = $this->assoc_unique($detail,'id');

            $count = sizeof($detail);
        }else{
            //获取表里的数据
            $detail = show(model('User')->getMembersByCondition($whereData));
            $count = show(model('User')->getMembersCountByCondition($whereData));
        }
        $data['detail'] = $detail;
        $data['count'] = $count;
        return $data;
    }
}
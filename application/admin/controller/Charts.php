<?php


namespace app\admin\controller;


class Charts extends Base
{
    public function charts6(){
        $start1 = date(strtotime('-1 monday', time()));
        $end1 = $start1 + 86400;
        $data['1'] = $this->search($start1,$end1,'Allowance');
        $start2 = $end1;
        $end2 = $start2 + 86400;
        $data['2'] = $this->search($start2,$end2,'Allowance');
        $start3 = $end2;
        $end3 = $start3 + 86400;
        $data['3'] = $this->search($start3,$end3,'Allowance');
        $start4 = $end3;
        $end4 = $start4 + 86400;
        $data['4'] = $this->search($start4,$end4,'Allowance');
        $start5 = $end4;
        $end5 = $start5 + 86400;
        $data['5'] = $this->search($start5,$end5,'Allowance');
        $start6 = $end5;
        $end6 = $start6 + 86400;
        $data['6'] = $this->search($start6,$end6,'Allowance');
        $start7 = $end6;
        $end7 = $start7 + 86400;
        $data['7'] = $this->search($start7,$end7,'Allowance');
//        halt($data);
        $this->assign("a",json_encode($data));
        return $this->fetch('charts/charts-6');
    }

    public function charts1(){
        $user = parent::message();
        if($user['role'] != '超级管理员'){
            return $this->fetch('404/404');
        }
        $start = 0;
        $start1 = date(strtotime('-1 monday', time()));
        $end1 = $start1 + 86400;
        $data['1'] = $this->search($start,$end1,'Allowance');
        $userData['1'] = $this->search($start,$end1,'User');
        $adminData['1'] = $this->search($start,$end1,'Admin');

        $end2 = $end1 + 86400;
        $data['2'] = $this->search($start,$end2,'Allowance');
        $userData['2'] = $this->search($start,$end2,'User');
        $adminData['2'] = $this->search($start,$end2,'Admin');

        $end3 = $end2 + 86400;
        $data['3'] = $this->search($start,$end3,'Allowance');
        $userData['3'] = $this->search($start,$end3,'User');
        $adminData['3'] = $this->search($start,$end3,'Admin');

        $end4 = $end3 + 86400;
        $data['4'] = $this->search($start,$end4,'Allowance');
        $userData['4'] = $this->search($start,$end4,'User');
        $adminData['4'] = $this->search($start,$end4,'Admin');

        $end5 = $end4 + 86400;
        $data['5'] = $this->search($start,$end5,'Allowance');
        $userData['5'] = $this->search($start,$end5,'User');
        $adminData['5'] = $this->search($start,$end5,'Admin');

        $end6 = $end5 + 86400;
        $data['6'] = $this->search($start,$end6,'Allowance');
        $userData['6'] = $this->search($start,$end6,'User');
        $adminData['6'] = $this->search($start,$end6,'Admin');

        $end7 = $end6 + 86400;
        $data['7'] = $this->search($start,$end7,'Allowance');
        $userData['7'] = $this->search($start,$end7,'User');
        $adminData['7'] = $this->search($start,$end7,'Admin');
//        halt($data);
        $this->assign("a",json_encode($data));
        $this->assign("b",json_encode($userData));
        $this->assign("c",json_encode($adminData));
        return $this->fetch('charts/charts-1');
    }

    public function search($start,$end,$model){
        $condition['create_time'] = [
            ['gt', $start],
            ['lt', $end],
        ];
        $condition['status'] = config('code.status_normal');

        $count = Model($model)->where($condition)->count();
        return $count;
    }
}
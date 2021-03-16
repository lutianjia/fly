<?php


namespace app\admin\controller;


class Welcome extends Base
{
    public function welcome(){
        $user = show(parent::message());
        $last_login_ip_array = explode(",",$user['last_login_ip']);

        $last_login_time_array = explode(",",$user['last_login_time']);

        $ip_size = sizeof($last_login_ip_array);
        $time_size = sizeof($last_login_time_array);
        if($ip_size >1){
            $last_login_ip = $last_login_ip_array[$ip_size-2];
            $last_login_time = $last_login_time_array[$time_size-2];
        }elseif ($ip_size = 1){
            $last_login_ip = $last_login_ip_array[0];
            $last_login_time = $last_login_time_array[0];
        }

        if($ip_size >= 3){
            $udata = [
                'last_login_ip' => $last_login_ip_array[$ip_size-2] . ',' . $last_login_ip_array[$ip_size-1],
            ];
            try{
                model('Admin')->save($udata,['id' => $user['id']]);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }
        if($time_size >= 3){
            $udata = [
                'last_login_time' => $last_login_time_array[$time_size-2] . ',' . $last_login_time_array[$time_size-1],
            ];
            try{
                model('Admin')->save($udata,['id' => $user['id']]);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
        }

        $data = $this->dataCount();
        return $this->fetch('',[
            'user' => $user,
            'data' => $data,
            'last_login_ip' => $last_login_ip,
            'last_login_time' => $last_login_time,
        ]);
    }
    //统计数据
    private function dataCount(){
        $int = date('Y-m-d');
        $int = strtotime($int);
        $int_s = $int - 86400;
        $data20 = model('Admin')->getNewsCountByCondition();
        $data10 = model('User')->getNewsCountByCondition();
        $data00 = model('Allowance')->getNewsCountByCondition();


        $condition['create_time'] = [
            ['gt', $int],
            ['lt', time()],
        ];
        $data21 = model('Admin')->getNewsCountByCondition($condition);
        $data11 = model('User')->getNewsCountByCondition($condition);
        $data01 = model('Allowance')->getNewsCountByCondition($condition);


        $condition['create_time'] = [
            ['gt', $int_s],
            ['lt', $int],
        ];
        $data22 = model('Admin')->getNewsCountByCondition($condition);
        $data12 = model('User')->getNewsCountByCondition($condition);
        $data02 = model('Allowance')->getNewsCountByCondition($condition);


        //获取本周起始时间戳和结束时间戳
        $beginThisweek = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('y'));
        $endThisweek=time();
        $condition['create_time'] = [
            ['gt', $beginThisweek],
            ['lt', $endThisweek],
        ];
        $data23 = model('Admin')->getNewsCountByCondition($condition);
        $data13 = model('User')->getNewsCountByCondition($condition);
        $data03 = model('Allowance')->getNewsCountByCondition($condition);


        //获取本月起始时间戳和结束时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        $condition['create_time'] = [
            ['gt', $beginThismonth],
            ['lt', $endThismonth],
        ];
        $data24 = model('Admin')->getNewsCountByCondition($condition);
        $data14 = model('User')->getNewsCountByCondition($condition);
        $data04 = model('Allowance')->getNewsCountByCondition($condition);


        $dataAdmin[0] = $data20;
        $dataAdmin[1] = $data21;
        $dataAdmin[2] = $data22;
        $dataAdmin[3] = $data23;
        $dataAdmin[4] = $data24;
//        halt($dataAdmin);
        $dataUser[0] = $data10;
        $dataUser[1] = $data11;
        $dataUser[2] = $data12;
        $dataUser[3] = $data13;
        $dataUser[4] = $data14;
//        halt($dataUser);
        $dataAllowance[0] = $data00;
        $dataAllowance[1] = $data01;
        $dataAllowance[2] = $data02;
        $dataAllowance[3] = $data03;
        $dataAllowance[4] = $data04;
//        halt($dataAllowance);
        $data[0] = $dataAllowance;
        $data[1] = $dataUser;
        $data[2] = $dataAdmin;
//        halt($data);
        return $data;
    }
}